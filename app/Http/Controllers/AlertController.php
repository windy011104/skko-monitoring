<?php

namespace App\Http\Controllers;

use App\Models\PrkLkao;
use App\Models\ProgresKontrak;
use Carbon\Carbon;
use Illuminate\View\View;

class AlertController extends Controller
{
    public function index(): View
    {
        /*
        |--------------------------------------------------------------------------
        | DATA PRK / SISA HUTANG
        |--------------------------------------------------------------------------
        */

        $queryPrk = PrkLkao::query()
            ->whereNotNull('skko')
            ->where('skko', '!=', '');

        // Admin melihat semua bidang
        // User hanya melihat data sesuai bidangnya
        if (!auth()->user()->isAdmin()) {
            $queryPrk->whereRaw('UPPER(bidang) = ?', [
                strtoupper(auth()->user()->bidang->nama_bidang)
            ]);
        }

        $dataPrk = $queryPrk->get();

        $sisaHutang = $dataPrk->sum(function ($item) {
            return (float) ($item->total_outstanding ?? 0);
        });

        $prkSisaHutang = $dataPrk
            ->filter(function ($item) {
                return (float) ($item->total_outstanding ?? 0) > 0;
            })
            ->values();


        /*
        |--------------------------------------------------------------------------
        | DATA KONTRAK
        |--------------------------------------------------------------------------
        */

        $queryKontrak = ProgresKontrak::query()
            ->latest();

        // Admin melihat semua bidang
        // User hanya melihat data sesuai bidangnya
        if (!auth()->user()->isAdmin()) {
            $queryKontrak->where(
                'bidang_id',
                auth()->user()->bidang_id
            );
        }

        $dataKontrak = $queryKontrak->get();


        /*
        |--------------------------------------------------------------------------
        | KONTRAK TANPA NOMOR
        |--------------------------------------------------------------------------
        */

        $kontrakTanpaNomor = $dataKontrak
            ->filter(function ($item) {
                return empty($item->no_kontrak);
            })
            ->values();


        /*
        |--------------------------------------------------------------------------
        | KONTRAK MENDEKATI JATUH TEMPO
        |--------------------------------------------------------------------------
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
            ->values();


        /*
        |--------------------------------------------------------------------------
        | KONTRAK TERLAMBAT
        |--------------------------------------------------------------------------
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
            ->values();


        /*
        |--------------------------------------------------------------------------
        | ALERT
        |--------------------------------------------------------------------------
        */

        $alerts = [];


        /*
        |--------------------------------------------------------------------------
        | SISA HUTANG
        |--------------------------------------------------------------------------
        */

        if ($sisaHutang > 0) {

            $alerts[] = [
                'type' => 'danger',
                'title' => 'Sisa Hutang',
                'count' => $prkSisaHutang->count(),
                'message' =>
                    'Masih terdapat sisa hutang sebesar Rp '
                    . number_format(
                        $sisaHutang,
                        0,
                        ',',
                        '.'
                    ),
                'route' => 'prk.index',
                'data' => $prkSisaHutang,
            ];
        }


        /*
        |--------------------------------------------------------------------------
        | KONTRAK TANPA NOMOR
        |--------------------------------------------------------------------------
        */

        if ($kontrakTanpaNomor->count() > 0) {

            $alerts[] = [
                'type' => 'warning',
                'title' => 'Data Kontrak',
                'count' => $kontrakTanpaNomor->count(),
                'message' =>
                    $kontrakTanpaNomor->count()
                    . ' data kontrak belum memiliki nomor kontrak.',
                'route' => 'progres-kontrak.index',
                'data' => $kontrakTanpaNomor,
            ];
        }


        /*
        |--------------------------------------------------------------------------
        | JATUH TEMPO
        |--------------------------------------------------------------------------
        */

        if ($kontrakMendekatiJatuhTempo->count() > 0) {

            $alerts[] = [
                'type' => 'warning',
                'title' => 'Jatuh Tempo',
                'count' => $kontrakMendekatiJatuhTempo->count(),
                'message' =>
                    $kontrakMendekatiJatuhTempo->count()
                    . ' kontrak mendekati tanggal selesai.',
                'route' => 'progres-kontrak.index',
                'data' => $kontrakMendekatiJatuhTempo,
            ];
        }


        /*
        |--------------------------------------------------------------------------
        | KONTRAK TERLAMBAT
        |--------------------------------------------------------------------------
        */

        if ($kontrakTerlambat->count() > 0) {

            $alerts[] = [
                'type' => 'danger',
                'title' => 'Kontrak Terlambat',
                'count' => $kontrakTerlambat->count(),
                'message' =>
                    $kontrakTerlambat->count()
                    . ' kontrak melewati tanggal selesai dan belum mencapai 100%.',
                'route' => 'progres-kontrak.index',
                'data' => $kontrakTerlambat,
            ];
        }


        /*
        |--------------------------------------------------------------------------
        | TIDAK ADA ALERT
        |--------------------------------------------------------------------------
        */

        if (count($alerts) === 0) {

            $alerts[] = [
                'type' => 'info',
                'title' => 'Monitoring',
                'count' => 0,
                'message' =>
                    'Tidak terdapat peringatan berdasarkan data saat ini.',
                'route' => null,
                'data' => collect(),
            ];
        }


        /*
        |--------------------------------------------------------------------------
        | KIRIM DATA KE VIEW
        |--------------------------------------------------------------------------
        */

        return view('alerts.index', compact(
            'alerts',
            'sisaHutang',
            'prkSisaHutang',
            'kontrakTanpaNomor',
            'kontrakMendekatiJatuhTempo',
            'kontrakTerlambat'
        ));
    }
}
