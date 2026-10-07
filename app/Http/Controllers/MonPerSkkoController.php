<?php

namespace App\Http\Controllers;

use App\Models\PrkLkao;

class MonPerSkkoController extends Controller
{
    public function index()
    {
        $query = PrkLkao::query()
            ->whereNotNull('skko')
            ->where('skko', '!=', '');

        // Admin melihat semua bidang
        // User hanya melihat data sesuai bidangnya
        if (!auth()->user()->isAdmin()) {
            $query->whereRaw('UPPER(bidang) = ?', [
                strtoupper(auth()->user()->bidang->nama_bidang)
            ]);
        }

        $dataMonitoring = $query
            ->get()
            ->groupBy('skko');

        return view('mon_per_skko.index', compact('dataMonitoring'));
    }

    public function show($id)
    {
        // Ambil satu data PRK berdasarkan ID
        $prk = PrkLkao::findOrFail($id);

        // Jika user, pastikan PRK sesuai dengan bidang user
        if (!auth()->user()->isAdmin()) {
            abort_unless(
                strtoupper($prk->bidang) === strtoupper(auth()->user()->bidang->nama_bidang),
                403
            );
        }

        // Ambil semua PRK yang memiliki SKKO yang sama
        $query = PrkLkao::query()
            ->where('skko', $prk->skko);

        // User hanya boleh melihat PRK dari bidangnya
        if (!auth()->user()->isAdmin()) {
            $query->whereRaw('UPPER(bidang) = ?', [
                strtoupper(auth()->user()->bidang->nama_bidang)
            ]);
        }

        $dataPrk = $query->get();

        $skko = $prk->skko;

        return view('mon_per_skko.show', compact('skko', 'dataPrk'));
    }
}
