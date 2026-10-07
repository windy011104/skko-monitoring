@extends('layouts.app')

@section('title', 'Detail Data PRK LKAO')

@section('content')
<div class="min-h-screen bg-slate-50 py-6 px-4 sm:px-6 lg:px-8">

    <div class="max-w-7xl mx-auto">

        {{-- Header --}}
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">

            <div>
                <p class="text-sm text-blue-600 font-semibold">
                    Data PRK LKAO
                </p>

                <h1 class="text-2xl font-bold text-slate-800">
                    Detail Data PRK LKAO
                </h1>

                <p class="text-sm text-slate-500 mt-1">
                    Informasi lengkap data PRK LKAO.
                </p>
            </div>

            <div class="flex gap-2">

                <a href="{{ route('prk.index') }}"
                   class="px-4 py-2 rounded-lg border border-slate-300 bg-white text-slate-700 text-sm font-semibold hover:bg-slate-100 transition">
                    Kembali
                </a>

                <a href="{{ route('prk.edit', ['prk' => $prkLkao->id]) }}"
                   class="px-4 py-2 rounded-lg bg-blue-700 text-white text-sm font-semibold hover:bg-blue-800 transition">
                    Edit Data
                </a>

            </div>
        </div>

        {{-- Informasi Utama PRK --}}
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden mb-6">

            <div class="px-6 py-4 bg-blue-700">
                <h2 class="text-white font-bold text-lg">
                    Informasi Utama PRK LKAO
                </h2>
            </div>

            <div class="p-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">

                <div>
                    <p class="text-xs text-slate-500 mb-1">
                        SKKO
                    </p>

                    <p class="font-semibold text-blue-700">
                        {{ $prkLkao->skko ?? '-' }}
                    </p>
                </div>

                <div>
                    <p class="text-xs text-slate-500 mb-1">
                        PRK LKAO
                    </p>

                    <p class="font-semibold text-slate-800">
                        {{ $prkLkao->prk_lkao ?? '-' }}
                    </p>
                </div>

                <div>
                    <p class="text-xs text-slate-500 mb-1">
                        No. PRK
                    </p>

                    <p class="font-semibold text-slate-800">
                        {{ $prkLkao->no_prk ?? '-' }}
                    </p>
                </div>

                <div>
                    <p class="text-xs text-slate-500 mb-1">
                        Unsur 1
                    </p>

                    <p class="font-semibold text-slate-800">
                        {{ $prkLkao->unsur_1 ?? '-' }}
                    </p>
                </div>

                <div>
                    <p class="text-xs text-slate-500 mb-1">
                        Kegiatan
                    </p>

                    <p class="font-semibold text-slate-800">
                        {{ $prkLkao->kegiatan ?? '-' }}
                    </p>
                </div>

                <div>
                    <p class="text-xs text-slate-500 mb-1">
                        Bidang
                    </p>

                    <p class="font-semibold text-slate-800">
                        {{ $prkLkao->bidang ?? '-' }}
                    </p>
                </div>

            </div>
        </div>

        {{-- Data Anggaran --}}
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden mb-6">

            <div class="px-6 py-4 bg-slate-800">
                <h2 class="text-white font-bold text-lg">
                    Data Anggaran
                </h2>
            </div>

            <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-5">

                <div>
                    <p class="text-xs text-slate-500 mb-1">
                        Nilai PRK Terbit Awal
                    </p>

                    <p class="font-semibold text-slate-800">
                        Rp {{ number_format($prkLkao->nilai_prk_terbit_awal ?? 0, 2, ',', '.') }}
                    </p>
                </div>

                <div>
                    <p class="text-xs text-slate-500 mb-1">
                        Nota Dinas Nilai
                    </p>

                    <p class="font-semibold text-slate-800">
                        Rp {{ number_format($prkLkao->nota_dinas_nilai ?? 0, 2, ',', '.') }}
                    </p>
                </div>

            </div>
        </div>

        {{-- Data Kontrak --}}
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden mb-6">

            <div class="px-6 py-4 bg-blue-600">
                <h2 class="text-white font-bold text-lg">
                    Data Kontrak dan Realisasi
                </h2>
            </div>

            <div class="p-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">

                <div>
                    <p class="text-xs text-slate-500 mb-1">
                        Kontrak Persen
                    </p>

                    <p class="font-semibold text-slate-800">
                        {{ number_format($prkLkao->kontrak_persen ?? 0, 2, ',', '.') }}%
                    </p>
                </div>

                <div>
                    <p class="text-xs text-slate-500 mb-1">
                        Kontrak Nilai
                    </p>

                    <p class="font-semibold text-slate-800">
                        Rp {{ number_format($prkLkao->kontrak_nilai ?? 0, 2, ',', '.') }}
                    </p>
                </div>

                <div>
                    <p class="text-xs text-slate-500 mb-1">
                        Realisasi Kontrak Persen
                    </p>

                    <p class="font-semibold text-slate-800">
                        {{ number_format($prkLkao->realisasi_kontrak_persen ?? 0, 2, ',', '.') }}%
                    </p>
                </div>

                <div>
                    <p class="text-xs text-slate-500 mb-1">
                        Realisasi Kontrak Nilai
                    </p>

                    <p class="font-semibold text-slate-800">
                        Rp {{ number_format($prkLkao->realisasi_kontrak_nilai ?? 0, 2, ',', '.') }}
                    </p>
                </div>

                <div>
                    <p class="text-xs text-slate-500 mb-1">
                        Sisa Anggaran Nilai
                    </p>

                    <p class="font-semibold text-slate-800">
                        Rp {{ number_format($prkLkao->sisa_anggaran_nilai ?? 0, 2, ',', '.') }}
                    </p>
                </div>

                <div>
                    <p class="text-xs text-slate-500 mb-1">
                        Sisa Anggaran Persen
                    </p>

                    <p class="font-semibold text-slate-800">
                        {{ number_format($prkLkao->sisa_anggaran_persen ?? 0, 2, ',', '.') }}%
                    </p>
                </div>

            </div>
        </div>

        {{-- Data Pembayaran --}}
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden mb-6">

            <div class="px-6 py-4 bg-slate-800">
                <h2 class="text-white font-bold text-lg">
                    Data Pembayaran
                </h2>
            </div>

            <div class="p-6 grid grid-cols-1 md:grid-cols-3 gap-5">

                <div>
                    <p class="text-xs text-slate-500 mb-1">
                        Total Usul Bayar
                    </p>

                    <p class="font-semibold text-slate-800">
                        Rp {{ number_format($prkLkao->total_usul_bayar ?? 0, 2, ',', '.') }}
                    </p>
                </div>

                <div>
                    <p class="text-xs text-slate-500 mb-1">
                        Total Giro Terbayar
                    </p>

                    <p class="font-semibold text-slate-800">
                        Rp {{ number_format($prkLkao->total_giro_terbayar ?? 0, 2, ',', '.') }}
                    </p>
                </div>

                <div>
                    <p class="text-xs text-slate-500 mb-1">
                        Total Outstanding
                    </p>

                    <p class="font-semibold text-red-600">
                        Rp {{ number_format($prkLkao->total_outstanding ?? 0, 2, ',', '.') }}
                    </p>
                </div>

            </div>
        </div>

        {{-- Uraian Rencana Kontrak --}}
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden mb-6">

            <div class="px-6 py-4 bg-blue-600">
                <h2 class="text-white font-bold text-lg">
                    Uraian Rencana Kontrak
                </h2>
            </div>

            <div class="p-6">
                <p class="font-semibold text-slate-800 whitespace-pre-line">
                    {{ $prkLkao->uraian_rencana_kontrak ?? '-' }}
                </p>
            </div>

        </div>

        {{-- Rencana Bulanan --}}
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden mb-6">

            <div class="px-6 py-4 bg-slate-800">
                <h2 class="text-white font-bold text-lg">
                    Rencana Bulanan
                </h2>
            </div>

            <div class="p-6 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-5">

                @php
                    $months = [
                        'jan' => 'Januari',
                        'feb' => 'Februari',
                        'mar' => 'Maret',
                        'apr' => 'April',
                        'mei' => 'Mei',
                        'jun' => 'Juni',
                        'jul' => 'Juli',
                        'ags' => 'Agustus',
                        'sep' => 'September',
                        'okt' => 'Oktober',
                        'nov' => 'November',
                        'des' => 'Desember',
                    ];
                @endphp

                @foreach ($months as $key => $month)

                    <div>
                        <p class="text-xs text-slate-500 mb-1">
                            {{ $month }}
                        </p>

                        <p class="font-semibold text-slate-800">
                            Rp {{ number_format($prkLkao->{'rencana_'.$key} ?? 0, 2, ',', '.') }}
                        </p>
                    </div>

                @endforeach

            </div>
        </div>

        {{-- Prognosa dan Proyeksi --}}
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">

            <div class="px-6 py-4 bg-emerald-600">
                <h2 class="text-white font-bold text-lg">
                    Prognosa dan Proyeksi
                </h2>
            </div>

            <div class="p-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-5">

                <div>
                    <p class="text-xs text-slate-500 mb-1">
                        Prognosa Terkontrak Nilai
                    </p>

                    <p class="font-semibold text-slate-800">
                        Rp {{ number_format($prkLkao->prognosa_terkontrak_nilai ?? 0, 2, ',', '.') }}
                    </p>
                </div>

                <div>
                    <p class="text-xs text-slate-500 mb-1">
                        Prognosa Terkontrak Persen
                    </p>

                    <p class="font-semibold text-slate-800">
                        {{ number_format($prkLkao->prognosa_terkontrak_persen ?? 0, 2, ',', '.') }}%
                    </p>
                </div>

                <div>
                    <p class="text-xs text-slate-500 mb-1">
                        Proyeksi Sisa Nilai
                    </p>

                    <p class="font-semibold text-slate-800">
                        Rp {{ number_format($prkLkao->proyeksi_sisa_nilai ?? 0, 2, ',', '.') }}
                    </p>
                </div>

                <div>
                    <p class="text-xs text-slate-500 mb-1">
                        Proyeksi Sisa Persen
                    </p>

                    <p class="font-semibold text-emerald-700">
                        {{ number_format($prkLkao->proyeksi_sisa_persen ?? 0, 2, ',', '.') }}%
                    </p>
                </div>

            </div>
        </div>

    </div>
</div>
@endsection
