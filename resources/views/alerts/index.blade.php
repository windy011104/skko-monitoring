@extends('layouts.app')

@section('content')

<div class="min-h-screen bg-gray-50">

    {{-- HEADER --}}
    <div class="bg-white border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-6 py-5">

            <div class="flex items-center justify-between gap-4">

                <div>
                    <h1 class="text-2xl font-bold text-gray-800">
                        Alert & Peringatan
                    </h1>

                    <p class="text-sm text-gray-500 mt-1">
                        Daftar peringatan berdasarkan kondisi data SKKO, kontrak, dan keuangan.
                    </p>
                </div>

                <div class="flex items-center gap-2">

                    <a href="{{ route('dashboard') }}"
                       class="inline-flex items-center px-4 py-2 rounded-lg border border-gray-300
                              text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 transition">

                        <svg class="w-4 h-4 mr-2"
                             fill="none"
                             stroke="currentColor"
                             viewBox="0 0 24 24">
                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="2"
                                  d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                        </svg>

                        Kembali
                    </a>

                    <a href="{{ route('alerts.index') }}"
                       class="inline-flex items-center px-4 py-2 rounded-lg
                              bg-pln-blue text-white text-sm font-medium
                              hover:opacity-90 transition">

                        <svg class="w-4 h-4 mr-2"
                             fill="none"
                             stroke="currentColor"
                             viewBox="0 0 24 24">
                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="2"
                                  d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                        </svg>

                        Refresh
                    </a>

                </div>

            </div>

        </div>
    </div>


    {{-- CONTENT --}}
    <div class="max-w-7xl mx-auto px-6 py-6">

        {{-- SUMMARY --}}
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-5 mb-6">

            {{-- SISA HUTANG --}}
            <div class="bg-white rounded-xl border border-gray-200 p-5">

                <div class="flex items-center justify-between">

                    <div>
                        <p class="text-sm text-gray-500">
                            Sisa Hutang
                        </p>

                        <p class="text-2xl font-bold text-red-600 mt-1">
                            {{ $prkSisaHutang->count() }}
                        </p>

                        <p class="text-xs text-gray-500 mt-1">
                            Data perlu ditindaklanjuti
                        </p>
                    </div>

                    <div class="w-11 h-11 rounded-lg bg-red-50 flex items-center justify-center">

                        <svg class="w-6 h-6 text-red-600"
                             fill="none"
                             stroke="currentColor"
                             viewBox="0 0 24 24">
                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="2"
                                  d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-10V4m0 16v-2m8-6a8 8 0 11-16 0 8 8 0 0116 0z"/>
                        </svg>

                    </div>

                </div>

            </div>


            {{-- KONTRAK TANPA NOMOR --}}
            <div class="bg-white rounded-xl border border-gray-200 p-5">

                <div class="flex items-center justify-between">

                    <div>
                        <p class="text-sm text-gray-500">
                            Kontrak Tanpa Nomor
                        </p>

                        <p class="text-2xl font-bold text-yellow-600 mt-1">
                            {{ $kontrakTanpaNomor->count() }}
                        </p>

                        <p class="text-xs text-gray-500 mt-1">
                            Data perlu dilengkapi
                        </p>
                    </div>

                    <div class="w-11 h-11 rounded-lg bg-yellow-50 flex items-center justify-center">

                        <svg class="w-6 h-6 text-yellow-600"
                             fill="none"
                             stroke="currentColor"
                             viewBox="0 0 24 24">
                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="2"
                                  d="M12 9v2m0 4h.01M5.07 19h13.86c1.54 0 2.5-1.67 1.73-3L13.73 4c-.77-1.33-2.69-1.33-3.46 0L3.34 16c-.77 1.33.19 3 1.73 3z"/>
                        </svg>

                    </div>

                </div>

            </div>


            {{-- JATUH TEMPO --}}
            <div class="bg-white rounded-xl border border-gray-200 p-5">

                <div class="flex items-center justify-between">

                    <div>
                        <p class="text-sm text-gray-500">
                            Mendekati Jatuh Tempo
                        </p>

                        <p class="text-2xl font-bold text-orange-600 mt-1">
                            {{ $kontrakMendekatiJatuhTempo->count() }}
                        </p>

                        <p class="text-xs text-gray-500 mt-1">
                            Maksimal 30 hari
                        </p>
                    </div>

                    <div class="w-11 h-11 rounded-lg bg-orange-50 flex items-center justify-center">

                        <svg class="w-6 h-6 text-orange-600"
                             fill="none"
                             stroke="currentColor"
                             viewBox="0 0 24 24">
                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="2"
                                  d="M12 8v4l3 2m6-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>

                    </div>

                </div>

            </div>


            {{-- KONTRAK TERLAMBAT --}}
            <div class="bg-white rounded-xl border border-gray-200 p-5">

                <div class="flex items-center justify-between">

                    <div>
                        <p class="text-sm text-gray-500">
                            Kontrak Terlambat
                        </p>

                        <p class="text-2xl font-bold text-red-600 mt-1">
                            {{ $kontrakTerlambat->count() }}
                        </p>

                        <p class="text-xs text-gray-500 mt-1">
                            Belum mencapai 100%
                        </p>
                    </div>

                    <div class="w-11 h-11 rounded-lg bg-red-50 flex items-center justify-center">

                        <svg class="w-6 h-6 text-red-600"
                             fill="none"
                             stroke="currentColor"
                             viewBox="0 0 24 24">
                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="2"
                                  d="M12 9v4m0 4h.01M10.29 3.86L2.82 17a2 2 0 001.74 3h14.88a2 2 0 001.74-3L13.71 3.86a2 2 0 00-3.42 0z"/>
                        </svg>

                    </div>

                </div>

            </div>

        </div>


        {{-- DETAIL ALERT --}}
        <div class="space-y-6">

            @foreach ($alerts as $alert)

                @php
                    $type = $alert['type'] ?? 'info';

                    $borderClass = match ($type) {
                        'danger' => 'border-red-200',
                        'warning' => 'border-yellow-200',
                        default => 'border-blue-200',
                    };

                    $iconBg = match ($type) {
                        'danger' => 'bg-red-50',
                        'warning' => 'bg-yellow-50',
                        default => 'bg-blue-50',
                    };

                    $iconText = match ($type) {
                        'danger' => 'text-red-600',
                        'warning' => 'text-yellow-600',
                        default => 'text-blue-600',
                    };

                    $badgeBg = match ($type) {
                        'danger' => 'bg-red-100 text-red-700',
                        'warning' => 'bg-yellow-100 text-yellow-700',
                        default => 'bg-blue-100 text-blue-700',
                    };
                @endphp


                <div class="bg-white rounded-xl border {{ $borderClass }} overflow-hidden">

                    {{-- ALERT HEADER --}}
                    <div class="px-6 py-4 border-b border-gray-100">

                        <div class="flex items-start justify-between gap-4">

                            <div class="flex items-start gap-3">

                                <div class="w-10 h-10 rounded-lg {{ $iconBg }} flex items-center justify-center flex-shrink-0">

                                    @if ($type === 'danger')

                                        <svg class="w-5 h-5 {{ $iconText }}"
                                             fill="none"
                                             stroke="currentColor"
                                             viewBox="0 0 24 24">
                                            <path stroke-linecap="round"
                                                  stroke-linejoin="round"
                                                  stroke-width="2"
                                                  d="M12 9v4m0 4h.01M10.29 3.86L2.82 17a2 2 0 001.74 3h14.88a2 2 0 001.74-3L13.71 3.86a2 2 0 00-3.42 0z"/>
                                        </svg>

                                    @elseif ($type === 'warning')

                                        <svg class="w-5 h-5 {{ $iconText }}"
                                             fill="none"
                                             stroke="currentColor"
                                             viewBox="0 0 24 24">
                                            <path stroke-linecap="round"
                                                  stroke-linejoin="round"
                                                  stroke-width="2"
                                                  d="M12 9v2m0 4h.01M5.07 19h13.86c1.54 0 2.5-1.67 1.73-3L13.73 4c-.77-1.33-2.69-1.33-3.46 0L3.34 16c-.77 1.33.19 3 1.73 3z"/>
                                        </svg>

                                    @else

                                        <svg class="w-5 h-5 {{ $iconText }}"
                                             fill="none"
                                             stroke="currentColor"
                                             viewBox="0 0 24 24">
                                            <path stroke-linecap="round"
                                                  stroke-linejoin="round"
                                                  stroke-width="2"
                                                  d="M13 16h-1v-4h-1m1-4h.01M12 20a8 8 0 100-16 8 8 0 000 16z"/>
                                        </svg>

                                    @endif

                                </div>


                                <div>

                                    <div class="flex items-center gap-2 flex-wrap">

                                        <h2 class="text-base font-semibold text-gray-800">
                                            {{ $alert['title'] }}
                                        </h2>

                                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-semibold {{ $badgeBg }}">
                                            {{ $alert['count'] }} Data
                                        </span>

                                    </div>

                                    <p class="text-sm text-gray-500 mt-1">
                                        {{ $alert['message'] }}
                                    </p>

                                </div>

                            </div>

                        </div>

                    </div>


                    {{-- DATA ALERT --}}
                    @if (!empty($alert['data']) && $alert['data']->count() > 0)

                        <div class="overflow-x-auto">

                            <table class="w-full text-sm">

                                <thead class="bg-gray-50 border-b border-gray-200">

                                    @if ($alert['title'] === 'Sisa Hutang')

                                        <tr>
                                            <th class="px-6 py-3 text-left font-semibold text-gray-600">
                                                No
                                            </th>

                                            <th class="px-6 py-3 text-left font-semibold text-gray-600">
                                                No. SKKO
                                            </th>

                                            <th class="px-6 py-3 text-left font-semibold text-gray-600">
                                                Uraian
                                            </th>

                                            <th class="px-6 py-3 text-right font-semibold text-gray-600">
                                                Sisa Hutang
                                            </th>

                                            <th class="px-6 py-3 text-center font-semibold text-gray-600">
                                                Aksi
                                            </th>
                                        </tr>

                                    @else

                                        <tr>
                                            <th class="px-6 py-3 text-left font-semibold text-gray-600">
                                                No
                                            </th>

                                            <th class="px-6 py-3 text-left font-semibold text-gray-600">
                                                No. Kontrak
                                            </th>

                                            <th class="px-6 py-3 text-left font-semibold text-gray-600">
                                                Vendor
                                            </th>

                                            <th class="px-6 py-3 text-center font-semibold text-gray-600">
                                                Progress
                                            </th>

                                            <th class="px-6 py-3 text-left font-semibold text-gray-600">
                                                Tanggal Selesai
                                            </th>

                                            <th class="px-6 py-3 text-center font-semibold text-gray-600">
                                                Aksi
                                            </th>
                                        </tr>

                                    @endif

                                </thead>


                                <tbody class="divide-y divide-gray-100">

                                    @foreach ($alert['data'] as $index => $item)

                                        @if ($alert['title'] === 'Sisa Hutang')

                                            <tr class="hover:bg-gray-50 transition">

                                                <td class="px-6 py-4 text-gray-500">
                                                    {{ $index + 1 }}
                                                </td>

                                                <td class="px-6 py-4 font-medium text-gray-800">
                                                    {{ $item->skko ?? '-' }}
                                                </td>

                                                <td class="px-6 py-4 text-gray-600">
                                                    {{ $item->uraian ?? '-' }}
                                                </td>

                                                <td class="px-6 py-4 text-right font-semibold text-red-600">
                                                    Rp {{ number_format((float) ($item->total_outstanding ?? 0), 0, ',', '.') }}
                                                </td>

                                                <td class="px-6 py-4 text-center">

                                                    <a href="{{ route('prk.edit', $item->id) }}"
                                                       class="inline-flex items-center px-3 py-2 rounded-lg
                                                              bg-pln-blue text-white text-xs font-medium
                                                              hover:opacity-90 transition">

                                                        Detail

                                                    </a>

                                                </td>

                                            </tr>

                                        @else

                                            @php
                                                $progress = (float) ($item->persentase_fisik ?? 0);

                                                if ($progress > 0 && $progress <= 1) {
                                                    $progress *= 100;
                                                }

                                                $progress = min(max($progress, 0), 100);

                                                $tanggalSelesai = null;
                                                $hariSisa = null;

                                                if (!empty($item->tgl_selesai)) {
                                                    try {
                                                        $tanggalSelesai = \Carbon\Carbon::parse($item->tgl_selesai);
                                                        $hariSisa = now()->diffInDays($tanggalSelesai, false);
                                                    } catch (\Throwable $e) {
                                                        $tanggalSelesai = null;
                                                    }
                                                }
                                            @endphp


                                            <tr class="hover:bg-gray-50 transition">

                                                <td class="px-6 py-4 text-gray-500">
                                                    {{ $index + 1 }}
                                                </td>

                                                <td class="px-6 py-4 font-medium text-gray-800">
                                                    {{ $item->no_kontrak ?: 'Belum ada nomor' }}
                                                </td>

                                                <td class="px-6 py-4 text-gray-600">
                                                    {{ $item->vendor ?? '-' }}
                                                </td>

                                                <td class="px-6 py-4">

                                                    <div class="flex items-center gap-2">

                                                        <div class="w-20 bg-gray-200 rounded-full h-2">

                                                            <div class="bg-pln-blue h-2 rounded-full"
                                                                 style="width: {{ $progress }}%">
                                                            </div>

                                                        </div>

                                                        <span class="text-xs font-medium text-gray-600">
                                                            {{ number_format($progress, 0) }}%
                                                        </span>

                                                    </div>

                                                </td>

                                                <td class="px-6 py-4">

                                                    @if ($tanggalSelesai)

                                                        <div class="text-gray-700">
                                                            {{ $tanggalSelesai->format('d/m/Y') }}
                                                        </div>

                                                        @if ($alert['title'] === 'Jatuh Tempo')

                                                            @if ($hariSisa !== null && $hariSisa >= 0)

                                                                <div class="text-xs text-yellow-600 mt-1">
                                                                    {{ $hariSisa }} hari lagi
                                                                </div>

                                                            @endif

                                                        @elseif ($alert['title'] === 'Kontrak Terlambat')

                                                            @if ($hariSisa !== null && $hariSisa < 0)

                                                                <div class="text-xs text-red-600 mt-1">
                                                                    Lewat {{ abs($hariSisa) }} hari
                                                                </div>

                                                            @endif

                                                        @endif

                                                    @else

                                                        <span class="text-gray-400">
                                                            -
                                                        </span>

                                                    @endif

                                                </td>

                                                <td class="px-6 py-4 text-center">

                                                    <a href="{{ route('progres-kontrak.edit', $item->id) }}"
                                                       class="inline-flex items-center px-3 py-2 rounded-lg
                                                              bg-pln-blue text-white text-xs font-medium
                                                              hover:opacity-90 transition">

                                                        Detail

                                                    </a>

                                                </td>

                                            </tr>

                                        @endif

                                    @endforeach

                                </tbody>

                            </table>

                        </div>


                        {{-- FOOTER --}}
                        <div class="px-6 py-4 bg-gray-50 border-t border-gray-100">

                            @if ($alert['title'] === 'Sisa Hutang')

                                <a href="{{ route('prk.index') }}"
                                   class="text-sm font-medium text-pln-blue hover:underline">
                                    Lihat Semua Data PRK →
                                </a>

                            @else

                                <a href="{{ route('progres-kontrak.index') }}"
                                   class="text-sm font-medium text-pln-blue hover:underline">
                                    Lihat Semua Data Kontrak →
                                </a>

                            @endif

                        </div>

                    @else

                        <div class="px-6 py-8 text-center">

                            <div class="text-gray-400 text-sm">
                                Tidak ada data yang perlu ditampilkan.
                            </div>

                        </div>

                    @endif

                </div>

            @endforeach

        </div>

    </div>

</div>

@endsection
