@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="p-6 space-y-6">

        {{-- ============================================================ --}}
        {{-- PAGE HEADER --}}
        {{-- ============================================================ --}}
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Dashboard Monitoring SKKO</h1>
                <p class="text-sm text-gray-500 mt-1">
                    <span class="font-medium text-pln-blue">
                        {{ auth()->user()->unit_kerja ?? 'PLN UP3 Bukittinggi' }}
                    </span>
                </p>
            </div>

            <div class="flex items-center space-x-3">
                <button onclick="window.location.reload()"
                    class="flex items-center space-x-2 px-4 py-2 bg-white border border-gray-200 rounded-lg text-sm font-medium text-gray-600 hover:bg-gray-50 hover:border-gray-300 transition-all shadow-sm">

                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                    </svg>

                    <span>Refresh Data</span>
                </button>

                @if (auth()->user()->isAdmin())
                    <button
                        class="flex items-center space-x-2 px-4 py-2 rounded-lg text-sm font-semibold text-white shadow-sm transition-all"
                        style="background: linear-gradient(135deg, #003082, #0064B4);">

                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                        </svg>

                        <span>Export Laporan</span>
                    </button>
                @endif
            </div>
        </div>


        {{-- ============================================================ --}}
        {{-- KPI CARDS --}}
        {{-- ============================================================ --}}
        <div class="grid grid-cols-2 lg:grid-cols-3 xl:grid-cols-6 gap-4">

            {{-- Total SKKO --}}
            <div class="stat-card bg-white rounded-xl p-5 shadow-sm border border-gray-100">
                <div class="flex items-center justify-between mb-3">

                    <div class="w-10 h-10 rounded-lg flex items-center justify-center"
                        style="background: rgba(0,48,130,0.1);">

                        <svg class="w-5 h-5" style="color:#003082" fill="none" stroke="currentColor" viewBox="0 0 24 24">

                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>
                    </div>

                    <span class="text-xs font-medium px-2 py-0.5 rounded-full"
                        style="background:rgba(0,48,130,0.08); color:#003082;">
                        Total
                    </span>
                </div>

                <p class="text-2xl font-bold text-gray-900">
                    {{ $dashboardData['totalSkko'] }}
                </p>

                <p class="text-xs text-gray-500 mt-1">
                    Total SKKO
                </p>
            </div>


            {{-- Kontrak Aktif --}}
            <div class="stat-card bg-white rounded-xl p-5 shadow-sm border border-gray-100">
                <div class="flex items-center justify-between mb-3">

                    <div class="w-10 h-10 rounded-lg bg-green-50 flex items-center justify-center">
                        <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">

                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>

                    <span class="text-xs font-medium px-2 py-0.5 rounded-full bg-green-50 text-green-700">
                        Aktif
                    </span>
                </div>

                <p class="text-2xl font-bold text-gray-900">
                    {{ $dashboardData['kontrakAktif'] }}
                </p>

                <p class="text-xs text-gray-500 mt-1">
                    Kontrak Aktif
                </p>
            </div>


            {{-- Progress Rata-rata --}}
            <div class="stat-card bg-white rounded-xl p-5 shadow-sm border border-gray-100">
                <div class="flex items-center justify-between mb-3">

                    <div class="w-10 h-10 rounded-lg bg-orange-50 flex items-center justify-center">
                        <svg class="w-5 h-5 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">

                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                        </svg>
                    </div>

                    <span class="text-xs font-medium px-2 py-0.5 rounded-full bg-orange-50 text-orange-600">
                        Rata-rata
                    </span>
                </div>

                <p class="text-2xl font-bold text-gray-900">
                    {{ number_format($dashboardData['progressRataRata'], 2, ',', '.') }}%
                </p>

                <div class="mt-2 bg-gray-100 rounded-full h-1.5">
                    <div class="h-1.5 rounded-full bg-orange-400"
                        style="width: {{ min(max($dashboardData['progressRataRata'], 0), 100) }}%">
                    </div>
                </div>

                <p class="text-xs text-gray-500 mt-1">
                    Progress Rata-rata
                </p>
            </div>


            {{-- Total Nilai Kontrak --}}
            <div class="stat-card bg-white rounded-xl p-5 shadow-sm border border-gray-100">
                <div class="flex items-center justify-between mb-3">

                    <div class="w-10 h-10 rounded-lg bg-purple-50 flex items-center justify-center">
                        <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">

                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>

                <p class="text-lg font-bold text-gray-900">
                    Rp {{ number_format($dashboardData['totalNilaiKontrak'], 0, ',', '.') }}
                </p>

                <p class="text-xs text-gray-500 mt-1">
                    Total Nilai Kontrak
                </p>
            </div>


            {{-- Sisa Hutang --}}
            <div class="stat-card bg-white rounded-xl p-5 shadow-sm border border-gray-100">
                <div class="flex items-center justify-between mb-3">

                    <div class="w-10 h-10 rounded-lg bg-red-50 flex items-center justify-center">
                        <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">

                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                    </div>

                    <span class="text-xs font-medium px-2 py-0.5 rounded-full bg-red-50 text-red-600">
                        Outstanding
                    </span>
                </div>

                <p class="text-lg font-bold text-red-600">
                    Rp {{ number_format($dashboardData['sisaHutang'], 0, ',', '.') }}
                </p>

                <p class="text-xs text-gray-500 mt-1">
                    Sisa Hutang
                </p>
            </div>


            {{-- Saldo PDP --}}
            <div class="stat-card bg-white rounded-xl p-5 shadow-sm border border-gray-100">
                <div class="flex items-center justify-between mb-3">

                    <div class="w-10 h-10 rounded-lg bg-teal-50 flex items-center justify-center">
                        <svg class="w-5 h-5 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">

                            <path stroke-linecap="round" stroke-linecap="round" stroke-width="2"
                                d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>

                    <span class="text-xs font-medium px-2 py-0.5 rounded-full bg-teal-50 text-teal-700">
                        {{ $dashboardData['pdpData']['pencapaian'] }}%
                    </span>
                </div>

                <p class="text-lg font-bold text-gray-900">
                    Rp {{ number_format($dashboardData['saldoPdp'], 0, ',', '.') }}
                </p>

                <p class="text-xs text-gray-500 mt-1">
                    Saldo PDP
                </p>
            </div>

        </div>


        {{-- ============================================================ --}}
        {{-- ALERT & PROGRESS CHART ROW --}}
        {{-- ============================================================ --}}
        <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">

            {{-- Alert / Peringatan --}}
            <div class="xl:col-span-1">
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">

                    <div class="px-5 py-4 border-b border-gray-100 flex items-center justify-between">

                        <div class="flex items-center space-x-2">
                            <div class="w-2 h-2 bg-red-500 rounded-full animate-pulse"></div>
                            <h2 class="font-semibold text-gray-800">
                                Alert & Peringatan
                            </h2>
                        </div>

                        <span class="text-xs text-red-600 font-medium bg-red-50 px-2 py-1 rounded-full">
                            {{ count($dashboardData['alerts']) }} Aktif
                        </span>
                    </div>

                    <div class="p-4 space-y-3">

                        @forelse($dashboardData['alerts'] as $alert)
                            <div
                                class="flex items-start space-x-3 p-3 rounded-lg border-l-4
                        {{ $alert['type'] === 'danger'
                            ? 'bg-red-50 border-red-400'
                            : ($alert['type'] === 'warning'
                                ? 'bg-yellow-50 border-yellow-400'
                                : 'bg-blue-50 border-blue-400') }}">

                                <div class="flex-shrink-0 mt-0.5">

                                    @if ($alert['type'] === 'danger')
                                        <svg class="w-4 h-4 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    @elseif($alert['type'] === 'warning')
                                        <svg class="w-4 h-4 text-yellow-500" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">

                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    @else
                                        <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">

                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    @endif

                                </div>

                                <div class="flex-1 min-w-0">

                                    <div class="flex items-center justify-between">

                                        <p
                                            class="text-xs font-semibold
                                    {{ $alert['type'] === 'danger'
                                        ? 'text-red-700'
                                        : ($alert['type'] === 'warning'
                                            ? 'text-yellow-700'
                                            : 'text-blue-700') }}">

                                            {{ $alert['title'] }}
                                        </p>

                                        {{-- Controller tadi tidak menyediakan count --}}
                                        @if (isset($alert['count']))
                                            <span
                                                class="text-xs font-bold px-1.5 py-0.5 rounded-full ml-2
                                    {{ $alert['type'] === 'danger'
                                        ? 'bg-red-200 text-red-800'
                                        : ($alert['type'] === 'warning'
                                            ? 'bg-yellow-200 text-yellow-800'
                                            : 'bg-blue-200 text-blue-800') }}">

                                                {{ $alert['count'] }}
                                            </span>
                                        @endif

                                    </div>

                                    <p class="text-xs text-gray-600 mt-0.5">
                                        {{ $alert['message'] }}
                                    </p>

                                </div>
                            </div>

                        @empty

                            <div class="text-center py-6">
                                <svg class="w-8 h-8 mx-auto text-green-400 mb-2" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">

                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg>

                                <p class="text-sm font-medium text-gray-600">
                                    Tidak ada peringatan
                                </p>

                                <p class="text-xs text-gray-400 mt-1">
                                    Semua data dalam kondisi normal.
                                </p>
                            </div>
                        @endforelse

                        <a href="{{ route('alerts.index') }}"
                            class="block text-center text-xs text-pln-blue font-medium hover:underline mt-2">
                            Lihat Semua Peringatan →
                        </a>

                    </div>
                </div>
            </div>


            {{-- Progress Chart --}}
            <div class="xl:col-span-2">
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 h-full">

                    <div class="px-5 py-4 border-b border-gray-100 flex items-center justify-between">

                        <h2 class="font-semibold text-gray-800">
                            Grafik Progress Pekerjaan
                        </h2>

                        <div class="flex items-center space-x-4 text-xs">

                            <div class="flex items-center space-x-1.5">
                                <div class="w-6 h-0.5" style="border-top: 2px dashed #003082;">
                                </div>
                                <span class="text-gray-500">Target</span>
                            </div>

                            <div class="flex items-center space-x-1.5">
                                <div class="w-6 h-0.5 bg-green-500"></div>
                                <span class="text-gray-500">Realisasi</span>
                            </div>

                        </div>
                    </div>

                    <div class="p-5">
                        <canvas id="progressChart" height="100"></canvas>
                    </div>

                </div>
            </div>

        </div>


        {{-- ============================================================ --}}
        {{-- KEUANGAN & PDP ROW --}}
        {{-- ============================================================ --}}
        <div class="grid grid-cols-1 xl:grid-cols-3 gap-6 items-stretch">

            {{-- Keuangan Summary --}}
            <div class="xl:col-span-2 h-full">

                <div class="bg-white rounded-xl shadow-sm border border-gray-100 h-full flex flex-col">

                    <div class="px-5 py-4 border-b border-gray-100">
                        <h2 class="font-semibold text-gray-800">
                            Ringkasan Keuangan
                        </h2>
                    </div>

                    <div class="p-5 flex-1 flex items-center">

                        @php
                            $keuanganItems = [
                                [
                                    'label' => 'Realisasi',
                                    'value' => $dashboardData['keuanganData']['realisasi'],
                                    'color' => 'blue',
                                ],
                                [
                                    'label' => 'Rencana Bayar',
                                    'value' => $dashboardData['keuanganData']['rencanaBayar'],
                                    'color' => 'purple',
                                ],
                                [
                                    'label' => 'Usul Bayar',
                                    'value' => $dashboardData['keuanganData']['usulBayar'],
                                    'color' => 'yellow',
                                ],
                                [
                                    'label' => 'Pembayaran',
                                    'value' => $dashboardData['keuanganData']['pembayaran'],
                                    'color' => 'green',
                                ],
                                [
                                    'label' => 'Sisa Hutang',
                                    'value' => $dashboardData['keuanganData']['sisaHutang'],
                                    'color' => 'red',
                                ],
                            ];

                            $colorMap = [
                                'blue' => 'bg-blue-50 text-blue-700 border-blue-200',
                                'purple' => 'bg-purple-50 text-purple-700 border-purple-200',
                                'yellow' => 'bg-yellow-50 text-yellow-700 border-yellow-200',
                                'green' => 'bg-green-50 text-green-700 border-green-200',
                                'red' => 'bg-red-50 text-red-700 border-red-200',
                            ];
                        @endphp

                        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-4 w-full">

                            @foreach ($keuanganItems as $item)
                                <div
                                    class="rounded-xl p-5 border {{ $colorMap[$item['color']] }} h-[230px] flex flex-col justify-center">

                                    <div class="flex items-center justify-between mb-6">

                                        <p class="text-sm font-semibold">
                                            {{ $item['label'] }}
                                        </p>

                                        <span class="w-2.5 h-2.5 rounded-full bg-current opacity-50"></span>

                                    </div>

                                    <div>

                                        <p class="text-xs opacity-70 mb-2">
                                            Nilai
                                        </p>

                                        <p class="text-base font-bold leading-relaxed">
                                            Rp {{ number_format($item['value'], 0, ',', '.') }}
                                        </p>

                                    </div>

                                </div>
                            @endforeach

                        </div>

                    </div>

                </div>

            </div>


            {{-- PDP Monitor --}}
            <div class="xl:col-span-1 h-full">

                <div class="bg-white rounded-xl shadow-sm border border-gray-100 h-full">

                    <div class="px-5 py-4 border-b border-gray-100">
                        <h2 class="font-semibold text-gray-800">
                            Monitoring PDP
                        </h2>
                    </div>

                    <div class="p-5">

                        {{-- PDP Pencapaian --}}
                        <div class="text-center mb-4">

                            <div class="relative inline-flex items-center justify-center">

                                <svg class="w-24 h-24 -rotate-90" viewBox="0 0 36 36">

                                    <path d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831"
                                        fill="none" stroke="#E5E7EB" stroke-width="3" />

                                    <path d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831"
                                        fill="none" stroke="#0064B4" stroke-width="3"
                                        stroke-dasharray="{{ min(max($dashboardData['pdpData']['pencapaian'], 0), 100) }}, 100" />

                                </svg>

                                <div class="absolute text-center">

                                    <p class="text-lg font-bold text-pln-blue">
                                        {{ $dashboardData['pdpData']['pencapaian'] }}%
                                    </p>

                                    <p class="text-xs text-gray-400">
                                        Pencapaian
                                    </p>

                                </div>

                            </div>

                        </div>


                        {{-- PDP Detail --}}
                        <div class="space-y-2">

                            @php
                                $pdpItems = [
                                    [
                                        'label' => 'Saldo Awal',
                                        'value' => $dashboardData['pdpData']['saldoAwal'],
                                    ],
                                    [
                                        'label' => 'Penambahan',
                                        'value' => $dashboardData['pdpData']['penambahan'],
                                    ],
                                    [
                                        'label' => 'Pengurangan',
                                        'value' => $dashboardData['pdpData']['pengurangan'],
                                    ],
                                    [
                                        'label' => 'Saldo Akhir',
                                        'value' => $dashboardData['pdpData']['saldoAkhir'],
                                    ],
                                ];
                            @endphp

                            @foreach ($pdpItems as $pdp)
                                <div class="flex justify-between items-center text-xs py-1.5 border-b border-gray-50">

                                    <span class="text-gray-500">
                                        {{ $pdp['label'] }}
                                    </span>

                                    <span class="font-semibold text-gray-800">
                                        Rp {{ number_format($pdp['value'], 0, ',', '.') }}

                                    </span>

                                </div>
                            @endforeach


                            <div class="mt-2">

                                <div class="flex justify-between text-xs text-gray-500 mb-1">

                                    <span>Target Settlement</span>

                                    <span>
                                        Rp {{ number_format($dashboardData['pdpData']['targetSettlement'], 0, ',', '.') }}
                                    </span>

                                </div>

                                <div class="bg-gray-100 rounded-full h-2">

                                    <div class="h-2 rounded-full"
                                        style="width: {{ min(max($dashboardData['pdpData']['pencapaian'], 0), 100) }}%; background: linear-gradient(90deg, #003082, #0064B4);">
                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>
                </div>
            </div>

        </div>

        {{-- ============================================================ --}}
        {{-- MONITORING PER SKKO --}}
        {{-- ============================================================ --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-100">

            <div class="px-5 py-4 border-b border-gray-100 flex items-center justify-between">

                <div>
                    <h2 class="font-semibold text-gray-800">
                        Monitoring per SKKO
                    </h2>

                    <p class="text-xs text-gray-500 mt-1">
                        Ringkasan data PRK berdasarkan SKKO
                    </p>
                </div>

                <span class="text-xs font-medium px-2.5 py-1 rounded-full bg-blue-50 text-pln-blue">
                    {{ count($dashboardData['monitoringSkko'] ?? []) }} SKKO
                </span>

            </div>

            <div class="overflow-x-auto">

                <table class="w-full">

                    <thead>

                        <tr class="bg-gray-50 border-b border-gray-100">

                            <th class="text-left px-5 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                SKKO
                            </th>

                            <th class="text-center px-4 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                Jumlah PRK
                            </th>

                            <th class="text-right px-4 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                Nilai PRK
                            </th>

                            <th class="text-right px-4 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                Nilai Kontrak
                            </th>

                            <th class="text-right px-4 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                Realisasi
                            </th>

                            <th class="text-right px-5 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                Sisa Hutang
                            </th>

                        </tr>

                    </thead>

                    <tbody class="divide-y divide-gray-50">

                        @forelse($dashboardData['monitoringSkko'] ?? [] as $item)
                            <tr class="hover:bg-gray-50 transition-colors">

                                {{-- SKKO --}}
                                <td class="px-5 py-4">

                                    <span class="text-sm font-mono font-medium text-pln-blue">
                                        {{ $item['skko'] }}
                                    </span>

                                </td>


                                {{-- Jumlah PRK --}}
                                <td class="px-4 py-4 text-center">

                                    <span
                                        class="inline-flex items-center justify-center min-w-[32px] px-2 py-1 rounded-full bg-blue-50 text-blue-700 text-xs font-semibold">

                                        {{ $item['jumlahPrk'] }}

                                    </span>

                                </td>


                                {{-- Nilai PRK --}}
                                <td class="px-4 py-4 text-right">

                                    <span class="text-sm font-semibold text-gray-800">

                                        Rp
                                        {{ number_format($item['nilaiPrk'] ?? 0, 0, ',', '.') }}

                                    </span>

                                </td>


                                {{-- Nilai Kontrak --}}
                                <td class="px-4 py-4 text-right">

                                    <span class="text-sm font-semibold text-gray-800">

                                        Rp
                                        {{ number_format($item['nilaiKontrak'] ?? 0, 0, ',', '.') }}

                                    </span>

                                </td>


                                {{-- Realisasi --}}
                                <td class="px-4 py-4 text-right">

                                    <span class="text-sm font-semibold text-green-600">

                                        Rp
                                        {{ number_format($item['realisasi'] ?? 0, 0, ',', '.') }}

                                    </span>

                                </td>


                                {{-- Sisa Hutang --}}
                                <td class="px-5 py-4 text-right">

                                    <span
                                        class="text-sm font-semibold {{ ($item['sisaHutang'] ?? 0) > 0 ? 'text-red-600' : 'text-gray-800' }}">

                                        Rp
                                        {{ number_format($item['sisaHutang'] ?? 0, 0, ',', '.') }}

                                    </span>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="6" class="px-5 py-8 text-center">

                                    <p class="text-sm font-medium text-gray-500">
                                        Belum ada data SKKO.
                                    </p>

                                    <p class="text-xs text-gray-400 mt-1">
                                        Data monitoring SKKO akan tampil setelah tersedia.
                                    </p>

                                </td>

                            </tr>
                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>


        {{-- ============================================================ --}}
        {{-- KONTRAK TERBARU TABLE --}}
        {{-- ============================================================ --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-100">

            <div class="px-5 py-4 border-b border-gray-100 flex items-center justify-between">

                <h2 class="font-semibold text-gray-800">
                    Kontrak Terbaru
                </h2>

                <a href="#" class="text-sm text-pln-blue font-medium hover:underline">
                    Lihat Semua →
                </a>

            </div>

            <div class="overflow-x-auto">

                <table class="w-full">

                    <thead>

                        <tr class="bg-gray-50 border-b border-gray-100">

                            <th class="text-left px-5 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                No. Kontrak
                            </th>

                            <th class="text-left px-4 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                Vendor
                            </th>

                            <th
                                class="text-left px-4 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider hidden md:table-cell">
                                Jenis Pekerjaan
                            </th>

                            <th
                                class="text-right px-4 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider hidden lg:table-cell">
                                Nilai Kontrak
                            </th>

                            <th class="text-center px-4 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                Progress
                            </th>

                            <th class="text-center px-4 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                Status
                            </th>

                            <th
                                class="text-center px-4 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider hidden xl:table-cell">
                                Jatuh Tempo
                            </th>

                            @if (auth()->user()->isAdmin())
                                <th
                                    class="text-center px-4 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                    Aksi
                                </th>
                            @endif

                        </tr>

                    </thead>


                    <tbody class="divide-y divide-gray-50">

                        @forelse($dashboardData['kontrakTerbaru'] as $kontrak)

                            @php
                                $jatuhtempo = !empty($kontrak['jatuh_tempo'])
                                    ? \Carbon\Carbon::parse($kontrak['jatuh_tempo'])
                                    : null;

                                $hariSisa = $jatuhtempo ? now()->diffInDays($jatuhtempo, false) : null;

                                $isNearDeadline = $hariSisa !== null && $hariSisa >= 0 && $hariSisa <= 30;

                                $isExpired = $hariSisa !== null && $hariSisa < 0;

                                $progress = (float) ($kontrak['progress'] ?? 0);

                                if ($progress > 0 && $progress <= 1) {
                                    $progress *= 100;
                                }

                                $progress = min(max($progress, 0), 100);

                                /*
                                 * Controller tadi belum mengirim status.
                                 * Status ditentukan dari progress dan jatuh tempo.
                                 */
                                if ($isExpired && $progress < 100) {
                                    $status = 'terlambat';
                                } elseif ($progress >= 100) {
                                    $status = 'selesai';
                                } else {
                                    $status = 'aktif';
                                }
                            @endphp


                            <tr class="hover:bg-gray-50 transition-colors">

                                {{-- No Kontrak --}}
                                <td class="px-5 py-4">
                                    <span class="text-sm font-mono font-medium text-pln-blue">
                                        {{ $kontrak['no_kontrak'] ?? '-' }}
                                    </span>
                                </td>


                                {{-- Vendor --}}
                                <td class="px-4 py-4">
                                    <p class="text-sm font-medium text-gray-800">
                                        {{ $kontrak['vendor'] ?? '-' }}
                                    </p>
                                </td>


                                {{-- Jenis Pekerjaan --}}
                                <td class="px-4 py-4 hidden md:table-cell">
                                    <p class="text-sm text-gray-600 max-w-xs truncate">
                                        {{ $kontrak['jenis_pekerjaan'] ?? '-' }}
                                    </p>
                                </td>


                                {{-- Nilai Kontrak --}}
                                <td class="px-4 py-4 text-right hidden lg:table-cell">
                                    <span class="text-sm font-semibold text-gray-800">
                                        Rp {{ number_format($kontrak['nilai_kontrak'] ?? 0, 0, ',', '.') }}
                                    </span>
                                </td>


                                {{-- Progress --}}
                                <td class="px-4 py-4">

                                    <div class="flex items-center space-x-2 min-w-[100px]">

                                        <div class="flex-1 bg-gray-100 rounded-full h-2">

                                            <div class="h-2 rounded-full
                                            {{ $progress >= 80
                                                ? 'bg-green-500'
                                                : ($progress >= 50
                                                    ? 'bg-blue-500'
                                                    : ($progress >= 25
                                                        ? 'bg-yellow-500'
                                                        : 'bg-red-400')) }}"
                                                style="width: {{ $progress }}%">
                                            </div>

                                        </div>

                                        <span class="text-xs font-semibold text-gray-700 w-10 text-right">
                                            {{ number_format($progress, 0) }}%
                                        </span>

                                    </div>

                                </td>


                                {{-- Status --}}
                                <td class="px-4 py-4 text-center">

                                    @if ($status === 'aktif')
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-green-100 text-green-700">
                                            Aktif
                                        </span>
                                    @elseif($status === 'selesai')
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-gray-100 text-gray-600">
                                            Selesai
                                        </span>
                                    @else
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-red-100 text-red-700">
                                            Terlambat
                                        </span>
                                    @endif

                                </td>


                                {{-- Jatuh Tempo --}}
                                <td class="px-4 py-4 text-center hidden xl:table-cell">

                                    @if ($jatuhtempo)
                                        <span
                                            class="text-xs
                                    {{ $isExpired
                                        ? 'text-red-600 font-semibold'
                                        : ($isNearDeadline
                                            ? 'text-yellow-600 font-semibold'
                                            : 'text-gray-600') }}">

                                            {{ $jatuhtempo->format('d/m/Y') }}

                                            @if ($isNearDeadline)
                                                <br>
                                                <span class="text-yellow-600">
                                                    ({{ $hariSisa }}h lagi)
                                                </span>
                                            @elseif($isExpired)
                                                <br>
                                                <span class="text-red-600">
                                                    (Lewat)
                                                </span>
                                            @endif

                                        </span>
                                    @else
                                        <span class="text-xs text-gray-400">
                                            -
                                        </span>
                                    @endif

                                </td>


                                {{-- Aksi --}}
                                @if (auth()->user()->isAdmin())
                                    <td class="px-4 py-4 text-center">

                                        <div class="flex items-center justify-center space-x-2">

                                            <button
                                                class="p-1.5 text-gray-400 hover:text-pln-blue hover:bg-blue-50 rounded-lg transition-colors"
                                                title="Lihat Detail">

                                                <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">

                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />

                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />

                                                </svg>

                                            </button>


                                            <button
                                                class="p-1.5 text-gray-400 hover:text-yellow-500 hover:bg-yellow-50 rounded-lg transition-colors"
                                                title="Edit">

                                                <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">

                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />

                                                </svg>

                                            </button>

                                        </div>

                                    </td>
                                @endif

                            </tr>

                        @empty

                            <tr>
                                <td colspan="{{ auth()->user()->isAdmin() ? 8 : 7 }}"
                                    class="px-5 py-8 text-center text-sm text-gray-500">

                                    Belum ada data kontrak.

                                </td>
                            </tr>
                        @endforelse

                    </tbody>

                </table>

            </div>
        </div>

    </div>
@endsection


@push('scripts')
    <script>
        // ============================================================
        // PROGRESS CHART
        // ============================================================

        const progressCanvas = document.getElementById('progressChart');

        if (progressCanvas) {

            const progressCtx = progressCanvas.getContext('2d');

            new Chart(progressCtx, {

                type: 'line',

                data: {

                    labels: @json($dashboardData['progressChart']['labels'] ?? []),

                    datasets: [

                        {
                            label: 'Target (%)',

                            data: @json($dashboardData['progressChart']['target'] ?? []),

                            borderColor: '#003082',

                            borderDash: [6, 3],

                            borderWidth: 2,

                            pointBackgroundColor: '#003082',

                            pointRadius: 4,

                            fill: false,

                            tension: 0.4,
                        },

                        {
                            label: 'Realisasi (%)',

                            data: @json($dashboardData['progressChart']['realisasi'] ?? []),

                            borderColor: '#10b981',

                            backgroundColor: 'rgba(16, 185, 129, 0.08)',

                            borderWidth: 2.5,

                            pointBackgroundColor: '#10b981',

                            pointRadius: 4,

                            fill: true,

                            tension: 0.4,
                        }

                    ]
                },

                options: {

                    responsive: true,

                    maintainAspectRatio: true,

                    interaction: {
                        mode: 'index',
                        intersect: false
                    },

                    plugins: {

                        legend: {
                            display: false
                        },

                        tooltip: {

                            backgroundColor: 'white',

                            titleColor: '#374151',

                            bodyColor: '#6B7280',

                            borderColor: '#E5E7EB',

                            borderWidth: 1,

                            padding: 12,

                            callbacks: {

                                label: ctx =>
                                    ` ${ctx.dataset.label}: ${ctx.raw}%`

                            }
                        }
                    },

                    scales: {

                        y: {

                            min: 0,

                            max: 100,

                            ticks: {

                                callback: val => val + '%',

                                font: {
                                    size: 11
                                },

                                color: '#9CA3AF',
                            },

                            grid: {
                                color: '#F3F4F6'
                            }
                        },

                        x: {

                            ticks: {

                                font: {
                                    size: 11
                                },

                                color: '#9CA3AF'
                            },

                            grid: {
                                display: false
                            }
                        }

                    }
                }

            });

        }
    </script>
@endpush
