<?php

namespace App\Http\Controllers;

use App\Models\PrkLkao;
use App\Models\ProgresKontrak;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        /*
        |--------------------------------------------------------------------------
        | DATA PRK / SKKO
        |--------------------------------------------------------------------------
        | Semua data diambil langsung dari database.
        */
        if (auth()->user()->isAdmin()) {
            $dataPrk = PrkLkao::query()
                ->whereNotNull('skko')
                ->where('skko', '!=', '')
                ->get();
        } else {
            $dataPrk = PrkLkao::query()
                ->whereNotNull('skko')
                ->where('skko', '!=', '')
                ->whereRaw('UPPER(bidang) = ?', [
                    strtoupper(auth()->user()->bidang->nama_bidang)
                ])
                ->get();
        }


        /*
        |--------------------------------------------------------------------------
        | DATA PROGRES KONTRAK
        |--------------------------------------------------------------------------
        */
        if (auth()->user()->isAdmin()) {
            $dataKontrak = ProgresKontrak::query()
                ->latest()
                ->get();
        } else {
            $dataKontrak = ProgresKontrak::query()
                ->where('bidang_id', auth()->user()->bidang_id)
                ->latest()
                ->get();
        }


        /*
        |--------------------------------------------------------------------------
        | TOTAL SKKO
        |--------------------------------------------------------------------------
        */
        $totalSkko = $dataPrk
            ->pluck('skko')
            ->filter()
            ->unique()
            ->count();


        /*
        |--------------------------------------------------------------------------
        | TOTAL KONTRAK
        |--------------------------------------------------------------------------
        */
        $totalKontrak = $dataKontrak->count();


        /*
        |--------------------------------------------------------------------------
        | KONTRAK AKTIF
        |--------------------------------------------------------------------------
        | Aktif = memiliki nomor kontrak dan progress belum 100%.
        */
        $kontrakAktif = $dataKontrak
            ->filter(function ($item) {
                if (empty($item->no_kontrak)) {
                    return false;
                }

                $progress = is_numeric($item->persentase_fisik)
                    ? (float) $item->persentase_fisik
                    : 0;

                return $progress < 100;
            })
            ->count();


        /*
        |--------------------------------------------------------------------------
        | PROGRESS RATA-RATA
        |--------------------------------------------------------------------------
        */
        $progressValues = $dataKontrak
        ->map(function ($item) {

            $nilaiKontrak = (float) ($item->total_nilai_kontrak ?? 0);
            $nilaiRealisasi = (float) ($item->total_nilai_realisasi ?? 0);

            if ($nilaiKontrak <= 0) {
                return null;
            }

            $progress = ($nilaiRealisasi / $nilaiKontrak) * 100;

            return min($progress, 100);
        })
        ->filter(function ($value) {
            return $value !== null;
        });

        $progressRataRata = $progressValues->count() > 0
            ? round($progressValues->avg(), 2)
            : 0;


        /*
        |--------------------------------------------------------------------------
        | DATA KEUANGAN DARI PRK
        |--------------------------------------------------------------------------
        */

        $totalNilaiPrk = $dataPrk->sum(function ($item) {
            return (float) ($item->nilai_prk_terbit_awal ?? 0);
        });

        $totalNotaDinas = $dataPrk->sum(function ($item) {
            return (float) ($item->nota_dinas_nilai ?? 0);
        });

        $totalKontrakPrk = $dataPrk->sum(function ($item) {
            return (float) ($item->kontrak_nilai ?? 0);
        });

        $totalRealisasiPrk = $dataPrk->sum(function ($item) {
            return (float) ($item->realisasi_kontrak_nilai ?? 0);
        });

        $totalUsulBayar = $dataPrk->sum(function ($item) {
            return (float) ($item->total_usul_bayar ?? 0);
        });

        $totalTerbayar = $dataPrk->sum(function ($item) {
            return (float) ($item->total_giro_terbayar ?? 0);
        });

        $sisaHutang = $dataPrk->sum(function ($item) {
            return (float) ($item->total_outstanding ?? 0);
        });

        $sisaAnggaran = $dataPrk->sum(function ($item) {
            return (float) ($item->sisa_anggaran_nilai ?? 0);
        });


        /*
        |--------------------------------------------------------------------------
        | PROGNOSA
        |--------------------------------------------------------------------------
        */
        $totalPrognosaTerkontrak = $dataPrk->sum(function ($item) {
            return (float) ($item->prognosa_terkontrak_nilai ?? 0);
        });

        $totalProyeksiSisa = $dataPrk->sum(function ($item) {
            return (float) ($item->proyeksi_sisa_nilai ?? 0);
        });

        /*
|--------------------------------------------------------------------------
| MONITORING PER SKKO
|--------------------------------------------------------------------------
| Data mengikuti bidang user karena menggunakan $dataPrk
|--------------------------------------------------------------------------
*/

$monitoringSkko = $dataPrk
    ->filter(function ($item) {
        return !empty($item->skko);
    })
    ->groupBy('skko')
    ->map(function ($items, $skko) {

        return [
            'skko' => $skko,

            'jumlahPrk' => $items->count(),

            'nilaiPrk' => $items->sum(function ($item) {
                return (float) ($item->nilai_prk_terbit_awal ?? 0);
            }),

            'nilaiKontrak' => $items->sum(function ($item) {
                return (float) ($item->kontrak_nilai ?? 0);
            }),

            'realisasi' => $items->sum(function ($item) {
                return (float) ($item->realisasi_kontrak_nilai ?? 0);
            }),

            'sisaHutang' => $items->sum(function ($item) {
                return (float) ($item->total_outstanding ?? 0);
            }),
        ];
        })
        ->sortBy('skko')
        ->values()
        ->toArray();

        /*
        |--------------------------------------------------------------------------
        | RENCANA BAYAR JANUARI - DESEMBER
        |--------------------------------------------------------------------------
        */
        $rencanaBulanan = [
            'Jan' => $dataPrk->sum(fn ($item) => (float) ($item->rencana_jan ?? 0)),
            'Feb' => $dataPrk->sum(fn ($item) => (float) ($item->rencana_feb ?? 0)),
            'Mar' => $dataPrk->sum(fn ($item) => (float) ($item->rencana_mar ?? 0)),
            'Apr' => $dataPrk->sum(fn ($item) => (float) ($item->rencana_apr ?? 0)),
            'Mei' => $dataPrk->sum(fn ($item) => (float) ($item->rencana_mei ?? 0)),
            'Jun' => $dataPrk->sum(fn ($item) => (float) ($item->rencana_jun ?? 0)),
            'Jul' => $dataPrk->sum(fn ($item) => (float) ($item->rencana_jul ?? 0)),
            'Agu' => $dataPrk->sum(fn ($item) => (float) ($item->rencana_ags ?? 0)),
            'Sep' => $dataPrk->sum(fn ($item) => (float) ($item->rencana_sep ?? 0)),
            'Okt' => $dataPrk->sum(fn ($item) => (float) ($item->rencana_okt ?? 0)),
            'Nov' => $dataPrk->sum(fn ($item) => (float) ($item->rencana_nov ?? 0)),
            'Des' => $dataPrk->sum(fn ($item) => (float) ($item->rencana_des ?? 0)),
        ];

        $totalRencanaBayar = array_sum($rencanaBulanan);


        /*
        |--------------------------------------------------------------------------
        | TOTAL NILAI KONTRAK
        |--------------------------------------------------------------------------
        | Menggunakan data ProgresKontrak.
        */
        $totalNilaiKontrak = $dataKontrak->sum(function ($item) {
            return (float) ($item->total_nilai_kontrak ?? 0);
        });


        /*
        |--------------------------------------------------------------------------
        | TOTAL REALISASI KONTRAK
        |--------------------------------------------------------------------------
        */
        $totalNilaiRealisasiKontrak = $dataKontrak->sum(function ($item) {
            return (float) ($item->total_nilai_realisasi ?? 0);
        });


        /*
        |--------------------------------------------------------------------------
        | TOTAL OUTSTANDING KONTRAK
        |--------------------------------------------------------------------------
        */
        $totalOutstandingKontrak = $dataKontrak->sum(function ($item) {
            return (float) ($item->total_outstanding ?? 0);
        });


        /*
        |--------------------------------------------------------------------------
        | KEUANGAN
        |--------------------------------------------------------------------------
        */
        $keuanganData = [
            'realisasi' => $totalRealisasiPrk,
            'rencanaBayar' => $totalRencanaBayar,
            'usulBayar' => $totalUsulBayar,
            'pembayaran' => $totalTerbayar,
            'sisaHutang' => $sisaHutang,
        ];

                /*
        |--------------------------------------------------------------------------
        | GRAFIK TARGET & REALISASI
        |--------------------------------------------------------------------------
        | Target     = nilai kontrak berdasarkan bulan kontrak
        | Realisasi  = nilai realisasi berdasarkan bulan kontrak
        | Data       = ProgresKontrak
        |--------------------------------------------------------------------------
        */

        $bulanLabels = [
            1 => 'Jan',
            2 => 'Feb',
            3 => 'Mar',
            4 => 'Apr',
            5 => 'Mei',
            6 => 'Jun',
            7 => 'Jul',
            8 => 'Agu',
            9 => 'Sep',
            10 => 'Okt',
            11 => 'Nov',
            12 => 'Des',
        ];

        /*
        |--------------------------------------------------------------------------
        | TARGET BULANAN
        |--------------------------------------------------------------------------
        | Target menggunakan TOTAL NILAI KONTRAK.
        | Bulan ditentukan dari tgl_bulan_kontrak.
        */

        $targetBulanan = array_fill(1, 12, 0);
        $realisasiBulanan = array_fill(1, 12, 0);

        foreach ($dataKontrak as $kontrak) {

            if (empty($kontrak->tgl_bulan_kontrak)) {
                continue;
            }

            try {

                $tanggal = Carbon::parse(
                    $kontrak->tgl_bulan_kontrak
                );

                $bulan = (int) $tanggal->month;

                /*
                | Target = nilai kontrak
                */
                $nilaiKontrak = (float) (
                    $kontrak->total_nilai_kontrak ?? 0
                );

                $targetBulanan[$bulan] += $nilaiKontrak;

                /*
                | Realisasi = nilai realisasi
                */
                $nilaiRealisasi = (float) (
                    $kontrak->total_nilai_realisasi ?? 0
                );

                $realisasiBulanan[$bulan] += $nilaiRealisasi;

            } catch (\Throwable $e) {
                continue;
            }
        }


        /*
        |--------------------------------------------------------------------------
        | TOTAL TARGET
        |--------------------------------------------------------------------------
        */

        $totalTarget = array_sum($targetBulanan);


        /*
        |--------------------------------------------------------------------------
        | TOTAL REALISASI
        |--------------------------------------------------------------------------
        */

        $totalRealisasiChart = array_sum($realisasiBulanan);


        /*
        |--------------------------------------------------------------------------
        | PERSENTASE KUMULATIF
        |--------------------------------------------------------------------------
        */

        $targetChart = [];
        $realisasiChart = [];

        $kumulatifTarget = 0;
        $kumulatifRealisasi = 0;

        foreach (range(1, 12) as $bulan) {

            $kumulatifTarget += $targetBulanan[$bulan];

            $kumulatifRealisasi += $realisasiBulanan[$bulan];


            /*
            | Target kumulatif
            */

            $targetPersen = $totalTarget > 0
                ? ($kumulatifTarget / $totalTarget) * 100
                : 0;


            /*
            | Realisasi kumulatif
            */

            $realisasiPersen = $totalTarget > 0
                ? ($kumulatifRealisasi / $totalTarget) * 100
                : 0;


            $targetChart[] = round(
                min(100, max(0, $targetPersen)),
                2
            );

            $realisasiChart[] = round(
                min(100, max(0, $realisasiPersen)),
                2
            );
        }


        /*
        |--------------------------------------------------------------------------
        | DATA UNTUK CHART
        |--------------------------------------------------------------------------
        */

        $progressChart = [
            'labels' => array_values($bulanLabels),
            'target' => $targetChart,
            'realisasi' => $realisasiChart,
        ];


        /*
        |--------------------------------------------------------------------------
        | MONITORING PDP
        |--------------------------------------------------------------------------
        |
        | Saat ini project belum memiliki sumber tabel/model PDP yang
        | terverifikasi. Agar dashboard tidak memakai angka dummy,
        | nilai PDP dihitung dari angka keuangan aktual yang memang tersedia.
        |
        | Saldo Awal      = Nilai PRK terbit awal
        | Penambahan      = Nilai kontrak
        | Pengurangan     = Nilai yang sudah terbayar
        | Saldo Akhir     = Outstanding
        | Target          = Outstanding yang masih harus diselesaikan
        |
        */

        $saldoAwalPdp = $totalNilaiPrk;

        $penambahanPdp = $totalKontrakPrk;

        $penguranganPdp = $totalTerbayar;

        $saldoAkhirPdp = $sisaHutang;

        $targetSettlement = $sisaHutang;

        $totalSudahDiselesaikan =
            $penguranganPdp + $saldoAkhirPdp;

        $pencapaianPdp = $totalSudahDiselesaikan > 0
            ? round(
                ($penguranganPdp / $totalSudahDiselesaikan) * 100,
                2
            )
            : 0;

        $pencapaianPdp = min(
            100,
            max(0, $pencapaianPdp)
        );

        $pdpData = [
            'saldoAwal' => $saldoAwalPdp,
            'penambahan' => $penambahanPdp,
            'pengurangan' => $penguranganPdp,
            'saldoAkhir' => $saldoAkhirPdp,
            'targetSettlement' => $targetSettlement,
            'pencapaian' => $pencapaianPdp,
        ];


        /*
        |--------------------------------------------------------------------------
        | ALERT / PERINGATAN
        |--------------------------------------------------------------------------
        */
        $alerts = [];


        /*
        | Sisa hutang
        */
        if ($sisaHutang > 0) {

            $alerts[] = [
                'type' => 'danger',
                'title' => 'Sisa Hutang',
                'count' => $dataPrk
                    ->filter(function ($item) {
                        return (float) ($item->total_outstanding ?? 0) > 0;
                    })
                    ->count(),
                'message' =>
                    'Masih terdapat sisa hutang sebesar Rp '
                    . number_format(
                        $sisaHutang,
                        0,
                        ',',
                        '.'
                    ),
            ];
        }


        /*
        | Kontrak tanpa nomor
        */
        $kontrakTanpaNomor = $dataKontrak
            ->filter(function ($item) {
                return empty($item->no_kontrak);
            })
            ->count();

        if ($kontrakTanpaNomor > 0) {

            $alerts[] = [
                'type' => 'warning',
                'title' => 'Data Kontrak',
                'count' => $kontrakTanpaNomor,
                'message' =>
                    $kontrakTanpaNomor
                    . ' data kontrak belum memiliki nomor kontrak.',
            ];
        }


        /*
        | Kontrak mendekati jatuh tempo
        */
        $kontrakMendekatiJatuhTempo = $dataKontrak
            ->filter(function ($item) {

                if (
                    empty($item->tgl_selesai) ||
                    empty($item->no_kontrak)
                ) {
                    return false;
                }

                try {
                    $tanggalSelesai = Carbon::parse(
                        $item->tgl_selesai
                    );

                    $hariSisa = now()->diffInDays(
                        $tanggalSelesai,
                        false
                    );

                    $progress = (float) (
                        $item->persentase_fisik ?? 0
                    );

                    return $hariSisa >= 0
                        && $hariSisa <= 30
                        && $progress < 100;

                } catch (\Throwable $e) {
                    return false;
                }
            })
            ->count();

        if ($kontrakMendekatiJatuhTempo > 0) {

            $alerts[] = [
                'type' => 'warning',
                'title' => 'Jatuh Tempo',
                'count' => $kontrakMendekatiJatuhTempo,
                'message' =>
                    $kontrakMendekatiJatuhTempo
                    . ' kontrak mendekati tanggal selesai.',
            ];
        }


        /*
        | Kontrak terlambat
        */
        $kontrakTerlambat = $dataKontrak
            ->filter(function ($item) {

                if (
                    empty($item->tgl_selesai) ||
                    empty($item->no_kontrak)
                ) {
                    return false;
                }

                try {
                    $tanggalSelesai = Carbon::parse(
                        $item->tgl_selesai
                    );

                    $progress = (float) (
                        $item->persentase_fisik ?? 0
                    );

                    return $tanggalSelesai->isPast()
                        && $progress < 100;

                } catch (\Throwable $e) {
                    return false;
                }
            })
            ->count();

        if ($kontrakTerlambat > 0) {

            $alerts[] = [
                'type' => 'danger',
                'title' => 'Kontrak Terlambat',
                'count' => $kontrakTerlambat,
                'message' =>
                    $kontrakTerlambat
                    . ' kontrak melewati tanggal selesai dan belum mencapai 100%.',
            ];
        }


        /*
        | Tidak ada alert
        */
        if (count($alerts) === 0) {

            $alerts[] = [
                'type' => 'info',
                'title' => 'Monitoring',
                'count' => 0,
                'message' =>
                    'Tidak terdapat peringatan berdasarkan data saat ini.',
            ];
        }


        /*
        |--------------------------------------------------------------------------
        | KONTRAK TERBARU
        |--------------------------------------------------------------------------
        */
        $kontrakTerbaru = $dataKontrak
            ->take(10)
            ->map(function ($item) {

                $progress = is_numeric($item->persentase_fisik)
                    ? (float) $item->persentase_fisik
                    : 0;

                $status = 'aktif';

                if ($progress >= 100) {

                    $status = 'selesai';

                } elseif (!empty($item->tgl_selesai)) {

                    try {

                        $tanggalSelesai = Carbon::parse(
                            $item->tgl_selesai
                        );

                        if (
                            $tanggalSelesai->isPast()
                            && $progress < 100
                        ) {
                            $status = 'terlambat';
                        }

                    } catch (\Throwable $e) {
                        // Tetap aktif jika tanggal tidak valid.
                    }
                }


                return [
                    'no_kontrak' =>
                        $item->no_kontrak ?? '-',

                    'vendor' =>
                        $item->pelaksana ?? '-',

                    'jenis_pekerjaan' =>
                        $item->pekerjaan ?? '-',

                    'nilai_kontrak' =>
                        (float) (
                            $item->total_nilai_kontrak ?? 0
                        ),

                    'progress' =>
                        $progress,

                    'status' =>
                        $status,

                    'jatuh_tempo' =>
                        $item->tgl_selesai
                            ?? now()->format('Y-m-d'),
                ];
            })
            ->values()
            ->toArray();


        /*
        |--------------------------------------------------------------------------
        | DATA TAMBAHAN DASHBOARD
        |--------------------------------------------------------------------------
        */
        $dashboardData = [

            // SKKO
            'totalSkko' => $totalSkko,

            // KONTRAK
            'totalKontrak' => $totalKontrak,
            'kontrakAktif' => $kontrakAktif,

            // PROGRESS
            'progressRataRata' => $progressRataRata,

            // NILAI KONTRAK
            'totalNilaiKontrak' => $totalNilaiKontrak,

            // KEUANGAN
            'totalNilaiPrk' => $totalNilaiPrk,
            'totalNotaDinas' => $totalNotaDinas,
            'totalKontrakPrk' => $totalKontrakPrk,
            'totalRealisasi' => $totalRealisasiPrk,
            'totalNilaiRealisasiKontrak' =>
                $totalNilaiRealisasiKontrak,

            'totalUsulBayar' => $totalUsulBayar,
            'totalTerbayar' => $totalTerbayar,

            'sisaHutang' => $sisaHutang,
            'sisaAnggaran' => $sisaAnggaran,

            // PROGNOSA
            'totalPrognosaTerkontrak' =>
                $totalPrognosaTerkontrak,

            'totalProyeksiSisa' =>
                $totalProyeksiSisa,

            // MONITORING PER SKKO
            'monitoringSkko' =>
                $monitoringSkko,

            // RENCANA
            'rencanaBulanan' =>
                $rencanaBulanan,

            // RENCANA
            'rencanaBulanan' =>
                $rencanaBulanan,

            'totalRencanaBayar' =>
                $totalRencanaBayar,

            // PDP
            'saldoPdp' =>
                $pdpData['saldoAkhir'],

            // CHART
            'progressChart' =>
                $progressChart,

            // KEUANGAN
            'keuanganData' =>
                $keuanganData,

            // PDP
            'pdpData' =>
                $pdpData,

            // ALERT
            'alerts' =>
                $alerts,

            // KONTRAK TERBARU
            'kontrakTerbaru' =>
                $kontrakTerbaru,
        ];


        /*
        |--------------------------------------------------------------------------
        | VIEW
        |--------------------------------------------------------------------------
        */
        return view(
            'dashboard.index',
            compact('dashboardData')
        );
    }
}
