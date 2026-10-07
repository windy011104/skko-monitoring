<?php

namespace App\Http\Controllers;

use App\Models\ProgresKontrak;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Carbon\Carbon;

class ProgresKontrakController extends Controller
{
    /**
     * Mengecek apakah user boleh mengakses data progres kontrak.
     * Admin boleh mengakses semua data.
     * User hanya boleh mengakses data sesuai bidangnya.
     */
    private function authorizeData(ProgresKontrak $progresKontrak): void
    {
        if (!auth()->user()->isAdmin()) {
            abort_unless(
                (int) $progresKontrak->bidang_id === (int) auth()->user()->bidang_id,
                403
            );
        }
    }

    /**
     * Menampilkan seluruh data progres kontrak.
     */
    public function index()
    {
        if (auth()->user()->isAdmin()) {
            $dataProgresKontrak = ProgresKontrak::latest()->get();
        } else {
            $dataProgresKontrak = ProgresKontrak::where(
                'bidang_id',
                auth()->user()->bidang_id
            )->latest()->get();
        }

        return view(
            'progres_kontrak.index',
            compact('dataProgresKontrak')
        );
    }

    /**
     * Menampilkan form tambah data.
     */
    public function create()
    {
        return view('progres_kontrak.create');
    }

    /**
     * Menyimpan data baru.
     */
    public function store(Request $request)
    {
        $data = $request->validate($this->rules());

        // Bidang otomatis mengikuti user yang sedang login
        $data['bidang_id'] = auth()->user()->bidang_id;

        ProgresKontrak::create($data);

        return redirect()
            ->route('progres-kontrak.index')
            ->with(
                'success',
                'Data progres kontrak berhasil ditambahkan.'
            );
    }

    /**
     * Menampilkan detail data.
     */
    public function show(ProgresKontrak $progresKontrak)
    {
        $this->authorizeData($progresKontrak);

        return view(
            'progres_kontrak.show',
            compact('progresKontrak')
        );
    }

    /**
     * Menampilkan form edit.
     */
    public function edit(ProgresKontrak $progresKontrak)
    {
        $this->authorizeData($progresKontrak);

        return view(
            'progres_kontrak.edit',
            compact('progresKontrak')
        );
    }

    /**
     * Memperbarui data.
     */
    public function update(
        Request $request,
        ProgresKontrak $progresKontrak
    ) {
        $this->authorizeData($progresKontrak);

        $data = $request->validate($this->rules());

        // Jangan izinkan bidang berubah saat update
        $data['bidang_id'] = $progresKontrak->bidang_id;

        $progresKontrak->update($data);

        return redirect()
            ->route('progres-kontrak.index')
            ->with(
                'success',
                'Data progres kontrak berhasil diperbarui.'
            );
    }

    /**
     * Menghapus data.
     */
    public function destroy(ProgresKontrak $progresKontrak)
    {
        $this->authorizeData($progresKontrak);

        $progresKontrak->delete();

        return redirect()
            ->route('progres-kontrak.index')
            ->with(
                'success',
                'Data progres kontrak berhasil dihapus.'
            );
    }

    /**
     * Import data Progres Kontrak dari Excel
     *
     * Import berdasarkan NAMA HEADER, bukan posisi kolom.
     * Jadi jika posisi kolom Excel berubah, data tetap dapat dibaca.
     */
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:xlsx,xls,csv|max:10240',
        ]);

        try {
            $file = $request->file('file');

            $spreadsheet = IOFactory::load(
                $file->getRealPath()
            );

            $worksheet = $spreadsheet->getActiveSheet();

            $rows = $worksheet->toArray(
                null,
                true,
                true,
                true
            );

            /*
            |--------------------------------------------------------------------------
            | HEADER EXCEL
            |--------------------------------------------------------------------------
            |
            | Baris 1 = kelompok utama
            | Baris 2 = sub kelompok
            | Baris 3 = nama kolom
            | Baris 4 = nomor kolom
            | Baris 5 dst = data
            |
            */

            $groupRow = $rows[1] ?? [];
            $subGroupRow = $rows[2] ?? [];
            $headerRow = $rows[3] ?? [];

            /*
            |--------------------------------------------------------------------------
            | MEMBUAT DAFTAR KOLOM EXCEL
            |--------------------------------------------------------------------------
            */

            $columns = [];

            // Excel menggunakan banyak merge cell pada baris 1 dan 2.
            // Karena itu nilai group/subgroup harus diwariskan ke kolom berikutnya.

            $lastGroup = '';
            $lastSubGroup = '';
            $lastSubGroupRaw = '';

            foreach ($headerRow as $column => $header) {
                $rawGroup = trim(
                    (string) ($groupRow[$column] ?? '')
                );

                $rawSubGroup = trim(
                    (string) ($subGroupRow[$column] ?? '')
                );

                if ($rawGroup !== '') {
                    $lastGroup = $this->normalizeHeader(
                        $rawGroup
                    );

                    $lastSubGroup = '';
                    $lastSubGroupRaw = '';
                }

                if ($rawSubGroup !== '') {
                    $lastSubGroupRaw = $rawSubGroup;

                    $lastSubGroup = $this->normalizeHeader(
                        $rawSubGroup
                    );
                }

                $headerNormalized = $this->normalizeHeader(
                    $header
                );

                $columns[$column] = [
                    'group' => $lastGroup,
                    'subgroup' => $lastSubGroup,
                    'subgroup_raw' => $lastSubGroupRaw,

                    // Untuk merge vertikal seperti A1:A3,
                    // header baris 3 kosong.
                    'header' => $headerNormalized !== ''
                        ? $headerNormalized
                        : $lastGroup,
                ];
            }

            /*
            |--------------------------------------------------------------------------
            | FUNGSI MENCARI KOLOM
            |--------------------------------------------------------------------------
            */

            $findColumn = function (
                array $headers,
                ?string $group = null,
                ?string $subGroup = null,
                int $occurrence = 1
            ) use ($columns) {
                $found = [];

                $normalizedHeaders = array_map(
                    fn ($item) => $this->normalizeHeader($item),
                    $headers
                );

                $groupNormalized = $group !== null
                    ? $this->normalizeHeader($group)
                    : null;

                $subGroupNormalized = $subGroup !== null
                    ? $this->normalizeHeader($subGroup)
                    : null;

                foreach ($columns as $column => $info) {
                    // Header harus cocok.
                    // Untuk beberapa header yang memiliki
                    // tambahan PERCENT/teks hasil merge,
                    // substring diperbolehkan.
                    $headerMatch = false;

                    foreach ($normalizedHeaders as $wantedHeader) {
                        if ($wantedHeader === $info['header']) {
                            $headerMatch = true;
                            break;
                        }

                        if (
                            $wantedHeader !== '' &&
                            $info['header'] !== '' &&
                            (
                                str_contains(
                                    $info['header'],
                                    $wantedHeader
                                ) ||
                                str_contains(
                                    $wantedHeader,
                                    $info['header']
                                )
                            )
                        ) {
                            $headerMatch = true;
                            break;
                        }
                    }

                    if (!$headerMatch) {
                        continue;
                    }

                    if ($groupNormalized !== null) {
                        $groupFound = $info['group'];

                        // Group kosong tidak boleh dianggap
                        // cocok dengan semua group.
                        if ($groupFound === '') {
                            continue;
                        }

                        if (
                            $groupFound !== $groupNormalized &&
                            !str_contains(
                                $groupFound,
                                $groupNormalized
                            ) &&
                            !str_contains(
                                $groupNormalized,
                                $groupFound
                            )
                        ) {
                            continue;
                        }
                    }

                    if ($subGroupNormalized !== null) {
                        $subGroupFound = $info['subgroup'];

                        $subGroupRawFound =
                            $info['subgroup_raw'] ?? '';

                        // Subgroup RENCANA berupa angka
                        // 0.95, 0.05, dan 1.
                        // Bandingkan sebagai angka agar
                        // tidak gagal karena format Excel.
                        $numericRequested = is_numeric($subGroup)
                            ? (float) $subGroup
                            : null;

                        $numericFound = is_numeric(
                            $subGroupRawFound
                        )
                            ? (float) $subGroupRawFound
                            : null;

                        if (
                            $numericRequested !== null &&
                            $numericFound !== null
                        ) {
                            if (
                                abs(
                                    $numericRequested -
                                    $numericFound
                                ) > 0.000001
                            ) {
                                continue;
                            }
                        } else {
                            if ($subGroupFound === '') {
                                continue;
                            }

                            if (
                                $subGroupFound !==
                                    $subGroupNormalized &&
                                !str_contains(
                                    $subGroupFound,
                                    $subGroupNormalized
                                ) &&
                                !str_contains(
                                    $subGroupNormalized,
                                    $subGroupFound
                                )
                            ) {
                                continue;
                            }
                        }
                    }

                    $found[] = $column;
                }

                return $found[$occurrence - 1] ?? null;
            };

            /*
            |--------------------------------------------------------------------------
            | PEMETAAN KOLOM EXCEL → DATABASE
            |--------------------------------------------------------------------------
            */

            $map = [

                // IDENTITAS
                'skko' => $findColumn(['SKKO']),
                'prk_uid' => $findColumn(['PRK UID']),
                'prk_lkao' => $findColumn(['PRK LKAO']),
                'pekerjaan' => $findColumn(['PEKERJAAN']),
                'lokasi' => $findColumn(['LOKASI']),
                'status_pekerjaan' => 'H',
                'status_bayar' => $findColumn(['STATUS BAYAR']),
                'waktu' => $findColumn(['WAKTU']),

                // PROSES KONTRAK
                'no_kontrak' => $findColumn(
                    ['NO KONTRAK'],
                    'PROSSES KONTRAK'
                ),

                'pelaksana' => $findColumn(
                    ['PELAKSANA'],
                    'PROSSES KONTRAK'
                ),

                'nilai_material_kontrak' => $findColumn(
                    ['NILAI MATERIAL RP'],
                    'PROSSES KONTRAK'
                ),

                'nilai_jasa_kontrak' => $findColumn(
                    ['NILAI JASA RP'],
                    'PROSSES KONTRAK'
                ),

                'total_nilai_kontrak' => $findColumn(
                    ['TOTAL NILAI RP'],
                    'PROSSES KONTRAK'
                ),

                'volume_kontrak' => $findColumn(
                    ['VOL'],
                    'PROSSES KONTRAK'
                ),

                'tgl_mulai' => $findColumn(
                    ['TGL MULAI'],
                    'PROSSES KONTRAK'
                ),

                'tgl_selesai' => $findColumn(
                    ['TGL SELESAI'],
                    'PROSSES KONTRAK'
                ),

                // REALISASI
                'nilai_material_realisasi' => $findColumn(
                    ['NILAI MATERIAL RP'],
                    'REALISASI'
                ),

                'nilai_jasa_realisasi' => $findColumn(
                    ['NILAI JASA RP'],
                    'REALISASI'
                ),

                'total_nilai_realisasi' => $findColumn(
                    ['TOTAL NILAI RP'],
                    'REALISASI'
                ),

                'volume_realisasi' => $findColumn(
                    ['VOL'],
                    'REALISASI'
                ),

                // AMANDEMEN WAKTU
                'amandemen_waktu_nomor' => $findColumn(
                    ['NOMOR'],
                    'AMANDEMEN WAKTU'
                ),

                'amandemen_waktu_tanggal' => $findColumn(
                    ['TANGGAL'],
                    'AMANDEMEN WAKTU'
                ),

                // AMANDEMEN NILAI
                'amandemen_nilai_nomor' => $findColumn(
                    ['NOMOR'],
                    'AMANDEMEN NILAI'
                ),

                'amandemen_nilai_tanggal' => $findColumn(
                    ['TANGGAL'],
                    'AMANDEMEN NILAI'
                ),

                // USUL BAYAR 100%
                'usul_bayar_100_no_bapp' => $findColumn(
                    ['NO BAPP'],
                    'USUL BAYAR 100%'
                ),

                'usul_bayar_100_tgl_bapp' => $findColumn(
                    ['TGL'],
                    'USUL BAYAR 100%',
                    null,
                    1
                ),

                'usul_bayar_100_no_bast' => $findColumn(
                    ['NO BAST'],
                    'USUL BAYAR 100%'
                ),

                'usul_bayar_100_tgl_bast' => $findColumn(
                    ['TGL'],
                    'USUL BAYAR 100%',
                    null,
                    2
                ),

                'usul_bayar_100_no_submission_id' =>
                    $findColumn(
                        ['NO SUBMISSION ID'],
                        'USUL BAYAR 100%'
                    ),

                'usul_bayar_100_tgl_submission' =>
                    $findColumn(
                        ['TGL'],
                        'USUL BAYAR 100%',
                        null,
                        3
                    ),

                'usul_bayar_100_nilai' => $findColumn(
                    ['NILAI'],
                    'USUL BAYAR 100%'
                ),

                'usul_bayar_100_persentase' =>
                    $findColumn(
                        ['%'],
                        'USUL BAYAR 100%'
                    ),

                // GIRO 100%
                'giro_100_tanggal' => $findColumn(
                    ['TANGGAL GIRO'],
                    'GIRO 100%'
                ),

                'giro_100_nilai' => $findColumn(
                    ['NILAI GIRO'],
                    'GIRO 100%'
                ),

                // USUL BAYAR 95%
                'usul_bayar_95_no_bapp' => $findColumn(
                    ['NO BAPP'],
                    'USUL BAYAR 95%'
                ),

                'usul_bayar_95_tgl_bapp' => $findColumn(
                    ['TGL'],
                    'USUL BAYAR 95%',
                    null,
                    1
                ),

                'usul_bayar_95_no_bast' => $findColumn(
                    ['NO BAST'],
                    'USUL BAYAR 95%'
                ),

                'usul_bayar_95_tgl_bast' => $findColumn(
                    ['TGL'],
                    'USUL BAYAR 95%',
                    null,
                    2
                ),

                'usul_bayar_95_no_submission_id' =>
                    $findColumn(
                        ['NO SUBMISSION ID'],
                        'USUL BAYAR 95%'
                    ),

                'usul_bayar_95_tgl_submission' =>
                    $findColumn(
                        ['TGL'],
                        'USUL BAYAR 95%',
                        null,
                        3
                    ),

                'usul_bayar_95_nilai' => $findColumn(
                    ['NILAI'],
                    'USUL BAYAR 95%'
                ),

                'usul_bayar_95_persentase' =>
                    $findColumn(
                        ['%'],
                        'USUL BAYAR 95%'
                    ),

                // GIRO 95%
                'giro_95_tanggal' => $findColumn(
                    ['TANGGAL GIRO'],
                    'GIRO 95%'
                ),

                'giro_95_nilai' => $findColumn(
                    ['NILAI GIRO'],
                    'GIRO 95%'
                ),

                // USUL BAYAR 5%
                'usul_bayar_5_no_bapp' => $findColumn(
                    ['NO BAPP'],
                    'USUL BAYAR 5%'
                ),

                'usul_bayar_5_tgl_bapp' => $findColumn(
                    ['TGL'],
                    'USUL BAYAR 5%',
                    null,
                    1
                ),

                'usul_bayar_5_no_bast' => $findColumn(
                    ['NO BAST'],
                    'USUL BAYAR 5%'
                ),

                'usul_bayar_5_tgl_bast' => $findColumn(
                    ['TGL'],
                    'USUL BAYAR 5%',
                    null,
                    2
                ),

                'usul_bayar_5_no_submission_id' =>
                    $findColumn(
                        ['NO SUBMISSION ID'],
                        'USUL BAYAR 5%'
                    ),

                'usul_bayar_5_tgl_submission' =>
                    $findColumn(
                        ['TGL'],
                        'USUL BAYAR 5%',
                        null,
                        3
                    ),

                'usul_bayar_5_nilai' => $findColumn(
                    ['NILAI'],
                    'USUL BAYAR 5%'
                ),

                'usul_bayar_5_persentase' =>
                    $findColumn(
                        ['%'],
                        'USUL BAYAR 5%'
                    ),

                // GIRO 5%
                'giro_5_tanggal' => $findColumn(
                    ['TANGGAL GIRO'],
                    'GIRO 5%'
                ),

                'giro_5_nilai' => $findColumn(
                    ['NILAI GIRO'],
                    'GIRO 5%'
                ),

                // PROGRESS PEKERJAAN
                'keterangan' => $findColumn(
                    ['KETERANGAN'],
                    'PROGRESS PEKERJAAN'
                ),

                'nilai_sisa' => $findColumn(
                    ['NILAI SISA RP'],
                    'PROGRESS PEKERJAAN'
                ),

                'kendala' => $findColumn(
                    ['KENDALA'],
                    'PROGRESS PEKERJAAN'
                ),

                'tindak_lanjut' => $findColumn(
                    ['TINDAK LANJUT TGL KOMITMENT USUL BAYAR'],
                    'PROGRESS PEKERJAAN'
                ),

                'persentase_fisik' => $findColumn(
                    ['PERCENT FISIK'],
                    'PROGRESS PEKERJAAN'
                ),

                // PEMBAYARAN
                'no_po' => $findColumn(['NO PO']),

                'total_usul_bayar' => $findColumn([
                    'TOTAL USUL BAYAR'
                ]),

                'total_giro' => $findColumn([
                    'TOTAL GIRO TERBAYAR'
                ]),

                'total_outstanding' => $findColumn([
                    'TOTAL OUTSTANDING'
                ]),

                // SAP 100%
                'sap_100_no_invoice' => $findColumn(
                    ['NO INVOICE'],
                    'PEMBAYARAN 100%'
                ),

                'sap_100_tanggal' => $findColumn(
                    ['TANGGAL'],
                    'PEMBAYARAN 100%'
                ),

                'sap_100_no_doc' => $findColumn(
                    ['NO DOC'],
                    'PEMBAYARAN 100%'
                ),

                // SAP 95%
                'sap_95_no_invoice' => $findColumn(
                    ['NO INVOICE'],
                    'PEMBAYARAN 95%'
                ),

                'sap_95_tanggal' => $findColumn(
                    ['TANGGAL'],
                    'PEMBAYARAN 95%'
                ),

                'sap_95_no_doc' => $findColumn(
                    ['NO DOC'],
                    'PEMBAYARAN 95%'
                ),

                // SAP 5%
                'sap_5_no_invoice' => $findColumn(
                    ['NO INVOICE'],
                    'PEMBAYARAN 5%'
                ),

                'sap_5_tanggal' => $findColumn(
                    ['TANGGAL'],
                    'PEMBAYARAN 5%'
                ),

                'sap_5_no_doc' => $findColumn(
                    ['NO DOC'],
                    'PEMBAYARAN 5%'
                ),

                // INFORMASI KONTRAK
                'pengawas' => $findColumn(['PENGAWAS']),
                'jenis_jtl' => $findColumn(['JENIS JTL']),
                'metode_kontrak' => $findColumn(['METODE KONTRAK']),

                // TOTAL
                'total_material_terkontrak' => $findColumn([
                    'TOTAL MATERIAL TERKONTRAK TANPA RP NOTA DINAS'
                ]),

                'total_jasa_terkontrak' => $findColumn([
                    'TOTAL JASA TERKONTRAK TANPA RP NOTA DINAS'
                ]),

                'total_terkontrak' => $findColumn([
                    'TOTAL TERKONTRAK TANPA RP NOTA DINAS'
                ]),

                'terkontrak_belum_realisasi' => $findColumn([
                    'TERKONTRAK BELUM REALISASI'
                ]),

                'total_realisasi_material' => $findColumn([
                    'TOTAL REALISASI MATERIAL'
                ]),

                'total_realisasi_jasa' => $findColumn([
                    'TOTAL REALISASI JASA'
                ]),

                'total_realisasi_kontrak' => $findColumn([
                    'TOTAL REALISASI KONTRAK'
                ]),

                // TANGGAL / BULAN
                'tgl_bulan_kontrak' => $findColumn([
                    'TGL BULAN KONTRAK'
                ]),

                'tgl_bulan_usul_bayar_100' => $findColumn([
                    'TGL BULAN SESUAI USUL BAYAR 100 PERCENT'
                ]),

                'tgl_bulan_usul_bayar_95' => $findColumn([
                    'TGL BULAN SESUAI USUL BAYAR 95 PERCENT'
                ]),

                'tgl_bulan_usul_bayar_5' => $findColumn([
                    'TGL BULAN SESUAI USUL BAYAR 5 PERCENT'
                ]),

                // SELISIH
                'selisih_kontrak_realisasi' => $findColumn([
                    'SELISIH KONTRAK VS REALISASI'
                ]),

                'persentase_pencapaian_kontrak' => $findColumn([
                    'PERSENTASE PENCAPAIAN KONTRAK VS REALISASI'
                ]),

                // RENCANA
                'rencana_kontrak_rp' => $findColumn(
                    ['RP'],
                    'RENCANA KONTRAK'
                ),

                'rencana_kontrak_bulan' => $findColumn(
                    ['BULAN'],
                    'RENCANA KONTRAK'
                ),

                // Kolom RENCANA di Excel bersifat tetap
                // dan memakai merge cell.
                'rencana_usul_bayar_95_rp' => 'CP',
                'rencana_usul_bayar_95_bulan' => 'CQ',
                'rencana_usul_bayar_5_rp' => 'CR',
                'rencana_usul_bayar_5_bulan' => 'CS',
                'rencana_usul_bayar_100_rp' => 'CT',
                'rencana_usul_bayar_100_bulan' => 'CU',
            ];

            /*
            |--------------------------------------------------------------------------
            | IMPORT DATA
            |--------------------------------------------------------------------------
            */

            $imported = 0;

            foreach ($rows as $index => $row) {
                // Data dimulai dari baris 5
                if ($index < 5) {
                    continue;
                }

                // Lewati baris kosong
                if (empty(array_filter($row))) {
                    continue;
                }

                $get = function ($field) use ($map, $row) {
                    $column = $map[$field] ?? null;

                    return $column !== null
                        ? ($row[$column] ?? null)
                        : null;
                };

                // Gunakan nilai yang tampil di Excel
                // untuk field teks tertentu.
                $getFormatted = function ($field)
                    use ($map, $worksheet, $index) {
                    $column = $map[$field] ?? null;

                    if ($column === null) {
                        return null;
                    }

                    $value = $worksheet
                        ->getCell($column . $index)
                        ->getFormattedValue();

                    if (
                        $value === null ||
                        trim((string) $value) === ''
                    ) {
                        return null;
                    }

                    return trim((string) $value);
                };

                ProgresKontrak::create([

                    // BIDANG
                    // Otomatis mengikuti user yang melakukan import.
                    'bidang_id' => auth()->user()->bidang_id,

                    // IDENTITAS
                    'skko' => $get('skko'),
                    'prk_uid' => $get('prk_uid'),
                    'prk_lkao' => $get('prk_lkao'),
                    'pekerjaan' => $get('pekerjaan'),
                    'lokasi' => $get('lokasi'),
                    'status_pekerjaan' =>
                        $getFormatted('status_pekerjaan'),
                    'status_bayar' => $get('status_bayar'),
                    'waktu' => $get('waktu'),

                    // KONTRAK
                    'no_kontrak' => $get('no_kontrak'),
                    'pelaksana' => $get('pelaksana'),

                    'nilai_material_kontrak' =>
                        $this->cleanMoney(
                            $get('nilai_material_kontrak')
                        ),

                    'nilai_jasa_kontrak' =>
                        $this->cleanMoney(
                            $get('nilai_jasa_kontrak')
                        ),

                    'total_nilai_kontrak' =>
                        $this->cleanMoney(
                            $get('total_nilai_kontrak')
                        ),

                    'volume_kontrak' =>
                        $this->cleanMoney(
                            $get('volume_kontrak')
                        ),

                    'tgl_mulai' =>
                        $this->excelDate(
                            $get('tgl_mulai')
                        ),

                    'tgl_selesai' =>
                        $this->excelDate(
                            $get('tgl_selesai')
                        ),

                    // REALISASI
                    'nilai_material_realisasi' =>
                        $this->cleanMoney(
                            $get('nilai_material_realisasi')
                        ),

                    'nilai_jasa_realisasi' =>
                        $this->cleanMoney(
                            $get('nilai_jasa_realisasi')
                        ),

                    'total_nilai_realisasi' =>
                        $this->cleanMoney(
                            $get('total_nilai_realisasi')
                        ),

                    'volume_realisasi' =>
                        $this->cleanMoney(
                            $get('volume_realisasi')
                        ),

                    // AMANDEMEN
                    'amandemen_waktu_nomor' =>
                        $get('amandemen_waktu_nomor'),

                    'amandemen_waktu_tanggal' =>
                        $this->excelDate(
                            $get('amandemen_waktu_tanggal')
                        ),

                    'amandemen_nilai_nomor' =>
                        $get('amandemen_nilai_nomor'),

                    'amandemen_nilai_tanggal' =>
                        $this->excelDate(
                            $get('amandemen_nilai_tanggal')
                        ),

                    // USUL BAYAR 100
                    'usul_bayar_100_no_bapp' =>
                        $get('usul_bayar_100_no_bapp'),

                    'usul_bayar_100_tgl_bapp' =>
                        $this->excelDate(
                            $get('usul_bayar_100_tgl_bapp')
                        ),

                    'usul_bayar_100_no_bast' =>
                        $get('usul_bayar_100_no_bast'),

                    'usul_bayar_100_tgl_bast' =>
                        $this->excelDate(
                            $get('usul_bayar_100_tgl_bast')
                        ),

                    'usul_bayar_100_no_submission_id' =>
                        $get('usul_bayar_100_no_submission_id'),

                    'usul_bayar_100_tgl_submission' =>
                        $this->excelDate(
                            $get('usul_bayar_100_tgl_submission')
                        ),

                    'usul_bayar_100_nilai' =>
                        $this->cleanMoney(
                            $get('usul_bayar_100_nilai')
                        ),

                    'usul_bayar_100_persentase' =>
                        $this->cleanMoney(
                            $get('usul_bayar_100_persentase')
                        ),

                    // GIRO 100
                    'giro_100_tanggal' =>
                        $this->excelDate(
                            $get('giro_100_tanggal')
                        ),

                    'giro_100_nilai' =>
                        $this->cleanMoney(
                            $get('giro_100_nilai')
                        ),

                    // USUL BAYAR 95
                    'usul_bayar_95_no_bapp' =>
                        $get('usul_bayar_95_no_bapp'),

                    'usul_bayar_95_tgl_bapp' =>
                        $this->excelDate(
                            $get('usul_bayar_95_tgl_bapp')
                        ),

                    'usul_bayar_95_no_bast' =>
                        $get('usul_bayar_95_no_bast'),

                    'usul_bayar_95_tgl_bast' =>
                        $this->excelDate(
                            $get('usul_bayar_95_tgl_bast')
                        ),

                    'usul_bayar_95_no_submission_id' =>
                        $get('usul_bayar_95_no_submission_id'),

                    'usul_bayar_95_tgl_submission' =>
                        $this->excelDate(
                            $get('usul_bayar_95_tgl_submission')
                        ),

                    'usul_bayar_95_nilai' =>
                        $this->cleanMoney(
                            $get('usul_bayar_95_nilai')
                        ),

                    'usul_bayar_95_persentase' =>
                        $this->cleanMoney(
                            $get('usul_bayar_95_persentase')
                        ),

                    // GIRO 95
                    'giro_95_tanggal' =>
                        $this->excelDate(
                            $get('giro_95_tanggal')
                        ),

                    'giro_95_nilai' =>
                        $this->cleanMoney(
                            $get('giro_95_nilai')
                        ),

                    // USUL BAYAR 5
                    'usul_bayar_5_no_bapp' =>
                        $get('usul_bayar_5_no_bapp'),

                    'usul_bayar_5_tgl_bapp' =>
                        $this->excelDate(
                            $get('usul_bayar_5_tgl_bapp')
                        ),

                    'usul_bayar_5_no_bast' =>
                        $get('usul_bayar_5_no_bast'),

                    'usul_bayar_5_tgl_bast' =>
                        $this->excelDate(
                            $get('usul_bayar_5_tgl_bast')
                        ),

                    'usul_bayar_5_no_submission_id' =>
                        $get('usul_bayar_5_no_submission_id'),

                    'usul_bayar_5_tgl_submission' =>
                        $this->excelDate(
                            $get('usul_bayar_5_tgl_submission')
                        ),

                    'usul_bayar_5_nilai' =>
                        $this->cleanMoney(
                            $get('usul_bayar_5_nilai')
                        ),

                    'usul_bayar_5_persentase' =>
                        $this->cleanMoney(
                            $get('usul_bayar_5_persentase')
                        ),

                    // GIRO 5
                    'giro_5_tanggal' =>
                        $this->excelDate(
                            $get('giro_5_tanggal')
                        ),

                    'giro_5_nilai' =>
                        $this->cleanMoney(
                            $get('giro_5_nilai')
                        ),

                    // PROGRESS
                    'keterangan' =>
                        $get('keterangan'),

                    'nilai_sisa' =>
                        $this->cleanMoney(
                            $get('nilai_sisa')
                        ),

                    'kendala' =>
                        $get('kendala'),

                    'tindak_lanjut' =>
                        $get('tindak_lanjut'),

                    'persentase_fisik' =>
                        $this->cleanMoney(
                            $get('persentase_fisik')
                        ),

                    // PEMBAYARAN
                    'no_po' =>
                        $get('no_po'),

                    'total_usul_bayar' =>
                        $this->cleanMoney(
                            $get('total_usul_bayar')
                        ),

                    'total_giro' =>
                        $this->cleanMoney(
                            $get('total_giro')
                        ),

                    'total_outstanding' =>
                        $this->cleanMoney(
                            $get('total_outstanding')
                        ),

                    // SAP
                    'sap_100_no_invoice' =>
                        $get('sap_100_no_invoice'),

                    'sap_100_tanggal' =>
                        $this->excelDate(
                            $get('sap_100_tanggal')
                        ),

                    'sap_100_no_doc' =>
                        $get('sap_100_no_doc'),

                    'sap_95_no_invoice' =>
                        $get('sap_95_no_invoice'),

                    'sap_95_tanggal' =>
                        $this->excelDate(
                            $get('sap_95_tanggal')
                        ),

                    'sap_95_no_doc' =>
                        $get('sap_95_no_doc'),

                    'sap_5_no_invoice' =>
                        $get('sap_5_no_invoice'),

                    'sap_5_tanggal' =>
                        $this->excelDate(
                            $get('sap_5_tanggal')
                        ),

                    'sap_5_no_doc' =>
                        $get('sap_5_no_doc'),

                    // INFORMASI KONTRAK
                    'pengawas' =>
                        $get('pengawas'),

                    'jenis_jtl' =>
                        $get('jenis_jtl'),

                    'metode_kontrak' =>
                        $get('metode_kontrak'),

                    // TOTAL
                    'total_material_terkontrak' =>
                        $this->cleanMoney(
                            $get('total_material_terkontrak')
                        ),

                    'total_jasa_terkontrak' =>
                        $this->cleanMoney(
                            $get('total_jasa_terkontrak')
                        ),

                    'total_terkontrak' =>
                        $this->cleanMoney(
                            $get('total_terkontrak')
                        ),

                    'terkontrak_belum_realisasi' =>
                        $this->cleanMoney(
                            $get('terkontrak_belum_realisasi')
                        ),

                    'total_realisasi_material' =>
                        $this->cleanMoney(
                            $get('total_realisasi_material')
                        ),

                    'total_realisasi_jasa' =>
                        $this->cleanMoney(
                            $get('total_realisasi_jasa')
                        ),

                    'total_realisasi_kontrak' =>
                        $this->cleanMoney(
                            $get('total_realisasi_kontrak')
                        ),

                    // TANGGAL / BULAN
                    'tgl_bulan_kontrak' =>
                        $this->excelDate(
                            $get('tgl_bulan_kontrak')
                        ),

                    'tgl_bulan_usul_bayar_100' =>
                        $this->excelDate(
                            $get('tgl_bulan_usul_bayar_100')
                        ),

                    'tgl_bulan_usul_bayar_95' =>
                        $this->excelDate(
                            $get('tgl_bulan_usul_bayar_95')
                        ),

                    'tgl_bulan_usul_bayar_5' =>
                        $this->excelDate(
                            $get('tgl_bulan_usul_bayar_5')
                        ),

                    // SELISIH
                    'selisih_kontrak_realisasi' =>
                        $this->cleanMoney(
                            $get('selisih_kontrak_realisasi')
                        ),

                    'persentase_pencapaian_kontrak' =>
                        $this->cleanMoney(
                            $get('persentase_pencapaian_kontrak')
                        ),

                    // RENCANA
                    'rencana_kontrak_rp' =>
                        $this->cleanMoney(
                            $get('rencana_kontrak_rp')
                        ),

                    'rencana_kontrak_bulan' =>
                        $get('rencana_kontrak_bulan'),

                    'rencana_usul_bayar_95_rp' =>
                        $this->cleanMoney(
                            $get('rencana_usul_bayar_95_rp')
                        ),

                    'rencana_usul_bayar_95_bulan' =>
                        $get('rencana_usul_bayar_95_bulan'),

                    'rencana_usul_bayar_5_rp' =>
                        $this->cleanMoney(
                            $get('rencana_usul_bayar_5_rp')
                        ),

                    'rencana_usul_bayar_5_bulan' =>
                        $get('rencana_usul_bayar_5_bulan'),

                    'rencana_usul_bayar_100_rp' =>
                        $this->cleanMoney(
                            $get('rencana_usul_bayar_100_rp')
                        ),

                    'rencana_usul_bayar_100_bulan' =>
                        $get('rencana_usul_bayar_100_bulan'),
                ]);

                $imported++;
            }

            return redirect()
                ->route('progres-kontrak.index')
                ->with(
                    'success',
                    "Berhasil mengimport {$imported} data Progres Kontrak dari Excel."
                );
        } catch (\Exception $e) {
            return redirect()
                ->route('progres-kontrak.index')
                ->with(
                    'error',
                    'Import gagal: ' . $e->getMessage()
                );
        }
    }

    private function rules(): array
    {
        return [
            'skko' => 'nullable|string|max:255',
            'prk_uid' => 'nullable|string|max:255',
            'prk_lkao' => 'nullable|string|max:255',
            'pekerjaan' => 'nullable|string|max:255',
            'lokasi' => 'nullable|string|max:255',
            'status_pekerjaan' => 'nullable|string|max:100',
            'status_bayar' => 'nullable|string|max:100',
            'waktu' => 'nullable|string|max:100',

            'no_kontrak' => 'nullable|string|max:255',
            'pelaksana' => 'nullable|string|max:255',

            'nilai_material_kontrak' => 'nullable|numeric',
            'nilai_jasa_kontrak' => 'nullable|numeric',
            'total_nilai_kontrak' => 'nullable|numeric',
            'volume_kontrak' => 'nullable|numeric',

            'tgl_mulai' => 'nullable|date',
            'tgl_selesai' => 'nullable|date',

            'nilai_material_realisasi' => 'nullable|numeric',
            'nilai_jasa_realisasi' => 'nullable|numeric',
            'total_nilai_realisasi' => 'nullable|numeric',
            'volume_realisasi' => 'nullable|numeric',

            'amandemen_waktu_nomor' => 'nullable|string|max:255',
            'amandemen_waktu_tanggal' => 'nullable|date',
            'amandemen_nilai_nomor' => 'nullable|string|max:255',
            'amandemen_nilai_tanggal' => 'nullable|date',

            'usul_bayar_100_no_bapp' => 'nullable|string|max:255',
            'usul_bayar_100_tgl_bapp' => 'nullable|date',
            'usul_bayar_100_no_bast' => 'nullable|string|max:255',
            'usul_bayar_100_tgl_bast' => 'nullable|date',
            'usul_bayar_100_no_submission_id' =>
                'nullable|string|max:255',
            'usul_bayar_100_tgl_submission' =>
                'nullable|date',
            'usul_bayar_100_nilai' => 'nullable|numeric',
            'usul_bayar_100_persentase' => 'nullable|numeric',

            'giro_100_tanggal' => 'nullable|date',
            'giro_100_nilai' => 'nullable|numeric',

            'usul_bayar_95_no_bapp' => 'nullable|string|max:255',
            'usul_bayar_95_tgl_bapp' => 'nullable|date',
            'usul_bayar_95_no_bast' => 'nullable|string|max:255',
            'usul_bayar_95_tgl_bast' => 'nullable|date',
            'usul_bayar_95_no_submission_id' =>
                'nullable|string|max:255',
            'usul_bayar_95_tgl_submission' =>
                'nullable|date',
            'usul_bayar_95_nilai' => 'nullable|numeric',
            'usul_bayar_95_persentase' => 'nullable|numeric',

            'giro_95_tanggal' => 'nullable|date',
            'giro_95_nilai' => 'nullable|numeric',

            'usul_bayar_5_no_bapp' => 'nullable|string|max:255',
            'usul_bayar_5_tgl_bapp' => 'nullable|date',
            'usul_bayar_5_no_bast' => 'nullable|string|max:255',
            'usul_bayar_5_tgl_bast' => 'nullable|date',
            'usul_bayar_5_no_submission_id' =>
                'nullable|string|max:255',
            'usul_bayar_5_tgl_submission' =>
                'nullable|date',
            'usul_bayar_5_nilai' => 'nullable|numeric',
            'usul_bayar_5_persentase' => 'nullable|numeric',

            'giro_5_tanggal' => 'nullable|date',
            'giro_5_nilai' => 'nullable|numeric',

            'keterangan' => 'nullable|string',
            'nilai_sisa' => 'nullable|numeric',
            'kendala' => 'nullable|string',
            'tindak_lanjut' => 'nullable|string',
            'persentase_fisik' => 'nullable|numeric|min:0|max:100',

            'no_po' => 'nullable|string|max:255',
            'total_usul_bayar' => 'nullable|numeric',
            'total_giro' => 'nullable|numeric',
            'total_outstanding' => 'nullable|numeric',

            'sap_100_no_invoice' => 'nullable|string|max:255',
            'sap_100_tanggal' => 'nullable|date',
            'sap_100_no_doc' => 'nullable|string|max:255',

            'sap_95_no_invoice' => 'nullable|string|max:255',
            'sap_95_tanggal' => 'nullable|date',
            'sap_95_no_doc' => 'nullable|string|max:255',

            'sap_5_no_invoice' => 'nullable|string|max:255',
            'sap_5_tanggal' => 'nullable|date',
            'sap_5_no_doc' => 'nullable|string|max:255',

            'pengawas' => 'nullable|string|max:255',
            'jenis_jtl' => 'nullable|string|max:255',
            'metode_kontrak' => 'nullable|string|max:255',

            'total_material_terkontrak' => 'nullable|numeric',
            'total_jasa_terkontrak' => 'nullable|numeric',
            'total_terkontrak' => 'nullable|numeric',
            'terkontrak_belum_realisasi' => 'nullable|numeric',
            'total_realisasi_material' => 'nullable|numeric',
            'total_realisasi_jasa' => 'nullable|numeric',
            'total_realisasi_kontrak' => 'nullable|numeric',

            'tgl_bulan_kontrak' => 'nullable|date',
            'tgl_bulan_usul_bayar_100' => 'nullable|date',
            'tgl_bulan_usul_bayar_95' => 'nullable|date',
            'tgl_bulan_usul_bayar_5' => 'nullable|date',

            'selisih_kontrak_realisasi' => 'nullable|numeric',
            'persentase_pencapaian_kontrak' =>
                'nullable|numeric|min:0|max:100',

            'rencana_kontrak_rp' => 'nullable|numeric',
            'rencana_kontrak_bulan' => 'nullable|string|max:255',

            'rencana_usul_bayar_95_rp' => 'nullable|numeric',
            'rencana_usul_bayar_95_bulan' =>
                'nullable|string|max:255',

            'rencana_usul_bayar_5_rp' => 'nullable|numeric',
            'rencana_usul_bayar_5_bulan' =>
                'nullable|string|max:255',

            'rencana_usul_bayar_100_rp' => 'nullable|numeric',
            'rencana_usul_bayar_100_bulan' =>
                'nullable|string|max:255',
        ];
    }

    private function normalizeHeader($value): string
    {
        $value = strtoupper(trim((string) $value));

        $value = str_replace(
            [
                "\n",
                "\r",
                ".",
                ",",
                "(",
                ")",
                "%",
                "/",
                "-"
            ],
            [
                " ",
                " ",
                " ",
                " ",
                " ",
                " ",
                " PERCENT ",
                " ",
                " "
            ],
            $value
        );

        $value = preg_replace('/\s+/', ' ', $value);

        return trim($value);
    }

    private function cleanMoney($value)
    {
        if ($value === null || $value === '') {
            return null;
        }

        // Nilai numerik dari Excel dipertahankan apa adanya,
        // termasuk angka desimal.
        if (is_numeric($value)) {
            return $value;
        }

        $value = trim((string) $value);

        if ($value === '-' || $value === '--') {
            return null;
        }

        $value = str_ireplace(
            ['Rp', '%'],
            '',
            $value
        );

        $value = trim($value);

        // Pertahankan angka desimal sesuai nilai Excel.
        // Mendukung format Indonesia: 1.234.567,89
        // dan format internasional: 1,234,567.89

        $lastComma = strrpos($value, ',');
        $lastDot = strrpos($value, '.');

        if (
            $lastComma !== false &&
            $lastDot !== false
        ) {
            if ($lastComma > $lastDot) {
                // Format Indonesia:
                // titik ribuan, koma desimal.
                $value = str_replace(
                    '.',
                    '',
                    $value
                );

                $value = str_replace(
                    ',',
                    '.',
                    $value
                );
            } else {
                // Format internasional:
                // koma ribuan, titik desimal.
                $value = str_replace(
                    ',',
                    '',
                    $value
                );
            }
        } elseif ($lastComma !== false) {
            // Koma tunggal dengan 1-2 digit di belakangnya
            // dianggap desimal.
            $decimals =
                strlen($value) - $lastComma - 1;

            if (
                $decimals > 0 &&
                $decimals <= 2
            ) {
                $value = str_replace(
                    ',',
                    '.',
                    $value
                );
            } else {
                $value = str_replace(
                    ',',
                    '',
                    $value
                );
            }
        } elseif ($lastDot !== false) {
            // Titik tunggal dengan 1-2 digit di belakangnya
            // dianggap desimal.
            $decimals =
                strlen($value) - $lastDot - 1;

            if (
                $decimals > 0 &&
                $decimals <= 2
            ) {
                // Biarkan titik sebagai pemisah desimal.
            } else {
                $value = str_replace(
                    '.',
                    '',
                    $value
                );
            }
        }

        $value = preg_replace(
            '/[^0-9.\-]/',
            '',
            $value
        );

        return is_numeric($value)
            ? $value
            : null;
    }

    private function excelDate($value)
    {
        if ($value === null || $value === '') {
            return null;
        }

        try {
            // Jika sudah berupa object tanggal.
            if ($value instanceof \DateTimeInterface) {
                // Semua tanggal disimpan sebagai DATE
                // tanpa jam/menit/detik.
                return Carbon::parse($value)
                    ->startOfDay()
                    ->format('Y-m-d');
            }

            // Jika berupa angka serial Excel.
            if (is_numeric($value)) {
                return Carbon::instance(
                    \PhpOffice\PhpSpreadsheet\Shared\Date::
                        excelToDateTimeObject(
                            (float) $value
                        )
                )
                    ->startOfDay()
                    ->format('Y-m-d');
            }

            $value = trim((string) $value);

            if (
                $value === '' ||
                $value === '-' ||
                $value === '--'
            ) {
                return null;
            }

            // Hilangkan tanda kutip yang kadang
            // ikut terbaca dari Excel.
            $value = trim(
                $value,
                "\"'"
            );

            // Normalisasi nama bulan Indonesia
            // ke bahasa Inggris.
            $bulanIndonesia = [
                'januari' => 'January',
                'februari' => 'February',
                'maret' => 'March',
                'april' => 'April',
                'mei' => 'May',
                'juni' => 'June',
                'juli' => 'July',
                'agustus' => 'August',
                'september' => 'September',
                'oktober' => 'October',
                'november' => 'November',
                'desember' => 'December',

                'jan' => 'Jan',
                'feb' => 'Feb',
                'mar' => 'Mar',
                'apr' => 'Apr',
                'jun' => 'Jun',
                'jul' => 'Jul',
                'agu' => 'Aug',
                'ags' => 'Aug',
                'sep' => 'Sep',
                'okt' => 'Oct',
                'nov' => 'Nov',
                'des' => 'Dec',
            ];

            $lower = strtolower($value);

            foreach (
                $bulanIndonesia as $indo => $english
            ) {
                $lower = preg_replace(
                    '/\b' .
                    preg_quote($indo, '/') .
                    '\b/u',
                    $english,
                    $lower
                );
            }

            $value = preg_replace(
                '/\s+/',
                ' ',
                $lower
            );

            $formats = [
                'd F Y',
                'j F Y',
                'd M Y',
                'j M Y',
                'd F Y H:i:s',
                'j F Y H:i:s',
                'd F Y H:i',
                'j F Y H:i',
                'd M Y H:i:s',
                'j M Y H:i:s',
                'd M Y H:i',
                'j M Y H:i',
                'd/m/Y',
                'd-m-Y',
                'd.m.Y',
                'Y-m-d',
                'Y/m/d',
                'Y.m.d',
                'd/m/y',
                'd-m-y',
                'd.m.y',
            ];

            foreach ($formats as $format) {
                $date = \DateTime::createFromFormat(
                    $format,
                    $value
                );

                if ($date !== false) {
                    return $date->format('Y-m-d');
                }
            }

            // Fallback untuk format tanggal lain
            // yang masih dapat dikenali.
            try {
                return Carbon::parse($value)
                    ->format('Y-m-d');
            } catch (\Throwable $e) {
                return null;
            }
        } catch (\Throwable $e) {
            return null;
        }
    }
}
