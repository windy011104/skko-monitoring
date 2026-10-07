<?php

namespace App\Http\Controllers;

use App\Models\PrkLkao;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Shared\Date as ExcelDate;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class PrkLkaoController extends Controller
{
    public function index()
    {
        if (auth()->user()->isAdmin()) {
            $dataPrk = PrkLkao::latest()->get();
        } else {
            $dataPrk = PrkLkao::whereRaw('UPPER(bidang) = ?', [
                strtoupper(auth()->user()->bidang->nama_bidang)
            ])->latest()->get();
        }

        return view('prk.index', compact('dataPrk'));
    }

    public function create()
    {
        return view('prk.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate($this->rules());

        $this->fillNumericDefaults($validated);

        PrkLkao::create($validated);

        return redirect()
            ->route('prk.index')
            ->with('success', 'Data PRK LKAO berhasil ditambahkan.');
    }

    public function show($id)
    {
        $prkLkao = PrkLkao::findOrFail($id);

        return view('prk.show', compact('prkLkao'));
    }

    public function edit($id)
    {
        $prkLkao = PrkLkao::findOrFail($id);

        return view('prk.edit', compact('prkLkao'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate($this->rules());

        $this->fillNumericDefaults($validated);

        $prkLkao = PrkLkao::findOrFail($id);

        $prkLkao->update($validated);

        return redirect()
            ->route('prk.index')
            ->with('success', 'Data PRK LKAO berhasil diperbarui.');
    }

    public function destroy(PrkLkao $prkLkao)
    {
        $prkLkao->delete();

        return redirect()
            ->route('prk.index')
            ->with('success', 'Data PRK LKAO berhasil dihapus.');
    }

    /**
     * Import PRK LKAO dari Excel.
     *
     * Struktur Excel:
     * Baris 1 = header utama
     * Baris 2 = sub-header
     * Baris 3-4 = kosong
     * Baris 5 dst = data
     */
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:xlsx,xls,csv|max:10240',
        ]);

        try {
            $file = $request->file('file');
            $spreadsheet = IOFactory::load($file->getRealPath());
            $worksheet = $spreadsheet->getActiveSheet();

            $highestRow = $worksheet->getHighestRow();

            $imported = 0;
            $skipped = 0;

            for ($row = 5; $row <= $highestRow; $row++) {

                $get = function (int $column) use ($worksheet, $row) {
    $cell = Coordinate::stringFromColumnIndex($column) . $row;
    return $worksheet->getCell($cell)->getValue();
};
$get = function (int $column) use ($worksheet, $row) {
    $cell = Coordinate::stringFromColumnIndex($column) . $row;
    return $worksheet->getCell($cell)->getValue();
};

$getFormatted = function (int $column) use ($worksheet, $row) {
    $cell = Coordinate::stringFromColumnIndex($column) . $row;
    return $worksheet->getCell($cell)->getFormattedValue();
};

                $skko = $this->cleanText($get(1));
                $prkLkao = $this->cleanText($get(2));
                $noPrk = $this->cleanText($get(3));

                // Lewati baris subtotal/total yang tidak memiliki identitas PRK.
                if ($skko === null && $prkLkao === null && $noPrk === null) {
                    $skipped++;
                    continue;
                }

                $data = [
                    // IDENTITAS
                    'skko' => $skko,
                    'prk_lkao' => $prkLkao,
                    'no_prk' => $noPrk,
                    'unsur_1' => $this->cleanText($get(4)),

                    // NILAI PRK
                    'nilai_prk_terbit_awal' => $this->cleanNumber($get(6)),

                    // KEGIATAN / BIDANG
                    'kegiatan' => $this->cleanText($get(8)),
                    'bidang' => auth()->user()->isAdmin()
                                ? $this->cleanText($get(9))
                                : auth()->user()->bidang->nama_bidang,

                    // NOTA DINAS - yang tersedia di DB hanya NILAI (kolom K)
                    'nota_dinas_nilai' => $this->cleanNumber($get(11)),

                    // KONTRAK - % kolom M, NILAI kolom N
                    'kontrak_persen' => $this->cleanPercent($get(13)) * 100,
                    'kontrak_nilai' => $this->cleanNumber($get(14)),

                    // REALISASI KONTRAK - % kolom P, NILAI kolom Q
                    'realisasi_kontrak_persen' => $this->cleanPercent($get(16)) * 100,
                    'realisasi_kontrak_nilai' => $this->cleanNumber($get(17)),

                    // SISA ANGGARAN - NILAI kolom R, % kolom S
                    'sisa_anggaran_nilai' => $this->cleanNumber($get(18)),
                    'sisa_anggaran_persen' => $this->cleanPercent($get(19)),

                    // PEMBAYARAN
                    'total_usul_bayar' => $this->cleanNumber($get(20)),
                    'total_giro_terbayar' => $this->cleanNumber($get(21)),
                    'total_outstanding' => $this->cleanNumber($get(22)),

                    // RENCANA KONTRAK
                    'uraian_rencana_kontrak' => $this->cleanText($get(23)),
                    'rencana_jan' => $this->cleanNumber($get(24)),
                    'rencana_feb' => $this->cleanNumber($get(25)),
                    'rencana_mar' => $this->cleanNumber($get(26)),
                    'rencana_apr' => $this->cleanNumber($get(27)),
                    'rencana_mei' => $this->cleanNumber($get(28)),
                    'rencana_jun' => $this->cleanNumber($get(29)),
                    'rencana_jul' => $this->cleanNumber($get(30)),
                    'rencana_ags' => $this->cleanNumber($get(31)),
                    'rencana_sep' => $this->cleanNumber($get(32)),
                    'rencana_okt' => $this->cleanNumber($get(33)),
                    'rencana_nov' => $this->cleanNumber($get(34)),
                    'rencana_des' => $this->cleanNumber($get(35)),

                    // PROGNOSA TERKONTRAK
                    'prognosa_terkontrak_nilai' => $this->cleanNumber($get(36)),
                    'prognosa_terkontrak_persen' => $this->cleanPercent($get(37)),

                    // PROYEKSI SISA
                    'proyeksi_sisa_nilai' => $this->cleanNumber($get(38)),
                    'proyeksi_sisa_persen' => $this->cleanPercent($get(39)),
                ];

                // Nilai kosong dibuat 0, sama seperti proses input manual saat ini.
                $this->fillNumericDefaults($data);

                PrkLkao::create($data);
                $imported++;
            }

            return redirect()
                ->route('prk.index')
                ->with(
                    'success',
                    "Berhasil mengimport {$imported} data PRK LKAO dari Excel."
                );
        } catch (\Throwable $e) {
            return redirect()
                ->route('prk.index')
                ->withErrors([
                    'file' => 'Import PRK gagal: ' . $e->getMessage(),
                ]);
        }
    }

    private function rules(): array
    {
        return [
            'skko' => 'nullable|string|max:255',
            'prk_lkao' => 'nullable|string|max:255',
            'no_prk' => 'nullable|string|max:255',
            'unsur_1' => 'nullable|string|max:255',
            'nilai_prk_terbit_awal' => 'nullable|numeric',
            'kegiatan' => 'nullable|string|max:255',
            'bidang' => 'nullable|string|max:255',
            'nota_dinas_nilai' => 'nullable|numeric',

            'kontrak_persen' => 'nullable|numeric',
            'kontrak_nilai' => 'nullable|numeric',
            'realisasi_kontrak_persen' => 'nullable|numeric',
            'realisasi_kontrak_nilai' => 'nullable|numeric',
            'sisa_anggaran_nilai' => 'nullable|numeric',
            'sisa_anggaran_persen' => 'nullable|numeric',

            'total_usul_bayar' => 'nullable|numeric',
            'total_giro_terbayar' => 'nullable|numeric',
            'total_outstanding' => 'nullable|numeric',

            'uraian_rencana_kontrak' => 'nullable|string',

            'rencana_jan' => 'nullable|numeric',
            'rencana_feb' => 'nullable|numeric',
            'rencana_mar' => 'nullable|numeric',
            'rencana_apr' => 'nullable|numeric',
            'rencana_mei' => 'nullable|numeric',
            'rencana_jun' => 'nullable|numeric',
            'rencana_jul' => 'nullable|numeric',
            'rencana_ags' => 'nullable|numeric',
            'rencana_sep' => 'nullable|numeric',
            'rencana_okt' => 'nullable|numeric',
            'rencana_nov' => 'nullable|numeric',
            'rencana_des' => 'nullable|numeric',

            'prognosa_terkontrak_nilai' => 'nullable|numeric',
            'prognosa_terkontrak_persen' => 'nullable|numeric',
            'proyeksi_sisa_nilai' => 'nullable|numeric',
            'proyeksi_sisa_persen' => 'nullable|numeric',
        ];
    }

    private function fillNumericDefaults(array &$data): void
    {
        foreach ($this->numericFields() as $field) {
            $data[$field] = $data[$field] ?? 0;
        }
    }

    private function numericFields(): array
    {
        return [
            'nilai_prk_terbit_awal',
            'nota_dinas_nilai',
            'kontrak_persen',
            'kontrak_nilai',
            'realisasi_kontrak_persen',
            'realisasi_kontrak_nilai',
            'sisa_anggaran_nilai',
            'sisa_anggaran_persen',
            'total_usul_bayar',
            'total_giro_terbayar',
            'total_outstanding',
            'rencana_jan',
            'rencana_feb',
            'rencana_mar',
            'rencana_apr',
            'rencana_mei',
            'rencana_jun',
            'rencana_jul',
            'rencana_ags',
            'rencana_sep',
            'rencana_okt',
            'rencana_nov',
            'rencana_des',
            'prognosa_terkontrak_nilai',
            'prognosa_terkontrak_persen',
            'proyeksi_sisa_nilai',
            'proyeksi_sisa_persen',
        ];
    }

    private function cleanText($value): ?string
    {
        if ($value === null) {
            return null;
        }

        $value = trim((string) $value);

        if ($value === '' || $value === '-' || $value === '--') {
            return null;
        }

        return $value;
    }

    /**
     * Membersihkan angka uang tanpa melakukan pembulatan.
     * Contoh: Rp789,832,038 -> 789832038
     *         123,981,895.00 -> 123981895.00
     */
    private function cleanNumber($value): ?float
    {
        if ($value === null || $value === '') {
            return null;
        }

        if (is_numeric($value)) {
            return (float) $value;
        }

        $value = trim((string) $value);

        if ($value === '' || $value === '-' || $value === '--') {
            return null;
        }

        $negative = false;

        if (str_starts_with($value, '(') && str_ends_with($value, ')')) {
            $negative = true;
            $value = trim($value, '()');
        }

        $value = str_replace(['Rp', 'rp', 'RP', '%', ' '], '', $value);

        // Format Excel PRK dominan: Rp789,832,038 / 123,981,895.00
        if (str_contains($value, ',') && str_contains($value, '.')) {
            $value = str_replace(',', '', $value);
        } elseif (str_contains($value, ',')) {
            // Angka seperti 123,45 dianggap desimal; angka dengan kelompok
            // ribuan seperti 789,832,038 dianggap pemisah ribuan.
            $parts = explode(',', $value);
            $last = end($parts);

            if (count($parts) > 2 || strlen($last) === 3) {
                $value = str_replace(',', '', $value);
            } else {
                $value = str_replace(',', '.', $value);
            }
        }

        $value = preg_replace('/[^0-9.\-]/', '', $value);

        if ($value === '' || $value === '-' || !is_numeric($value)) {
            return null;
        }

        $number = (float) $value;

        return $negative ? -$number : $number;
    }

    /**
     * Persentase Excel:
     * 1      -> 1
     * 0.87   -> 0.87
     * "99.95%" -> 99.95
     * "0.05%"  -> 0.05
     *
     * Nilai numeric Excel tidak dikali 100 agar tetap sama dengan nilai sumber.
     */
    private function cleanPercent($value): ?float
{
    if ($value === null || $value === '') {
        return null;
    }

    if (is_numeric($value)) {
        return (float) $value;
    }

    $value = trim((string) $value);

    if ($value === '' || $value === '-' || $value === '--') {
        return null;
    }

    $value = str_replace('%', '', $value);
    $value = str_replace(',', '.', $value);
    $value = preg_replace('/[^0-9.\-]/', '', $value);

    return is_numeric($value) ? (float) $value : null;
}
}
