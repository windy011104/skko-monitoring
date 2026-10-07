@extends('layouts.app')

@section('title', 'MON Per SKKO')

@section('content')

    <div class="p-4 lg:p-6">

        {{-- HEADER --}}
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">

            <div>
                <h1 class="text-2xl font-bold text-gray-800">
                    MON Per SKKO
                </h1>

                <p class="text-sm text-gray-500 mt-1">
                    Monitoring realisasi dan perkembangan setiap SKKO berdasarkan data PRK
                </p>
            </div>

        </div>


        {{-- SUCCESS MESSAGE --}}
        @if (session('success'))
            <div
                class="mb-5 flex items-center gap-3 p-4
                       rounded-xl bg-green-50 border border-green-200
                       text-green-700">

                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">

                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M5 13l4 4L19 7" />

                </svg>

                <span class="text-sm font-medium">
                    {{ session('success') }}
                </span>

            </div>
        @endif


        {{-- ERROR MESSAGE --}}
        @if ($errors->any())
            <div class="mb-5 p-4 rounded-xl bg-red-50
                        border border-red-200 text-red-700">

                <p class="font-semibold text-sm mb-2">
                    Terjadi kesalahan:
                </p>

                <ul class="list-disc list-inside text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>

            </div>
        @endif


        {{-- TABLE CARD --}}
        <div class="bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden">

            {{-- CARD HEADER --}}
            <div class="px-5 py-4 border-b border-gray-100">

                <div class="flex flex-col lg:flex-row
                            lg:items-center lg:justify-between gap-4">

                    <div>
                        <h2 class="font-semibold text-gray-800">
                            Monitoring Per SKKO
                        </h2>

                        <p class="text-xs text-gray-500 mt-1">
                            Ringkasan nilai berdasarkan seluruh PRK yang terkait dengan setiap SKKO
                        </p>
                    </div>


                    {{-- SEARCH --}}
                    <div class="relative">

                        <input
                            type="text"
                            id="searchMonitoring"
                            placeholder="Cari SKKO..."
                            class="w-full lg:w-72 pl-9 pr-3 py-2
                                   text-sm border border-gray-200
                                   rounded-lg
                                   focus:outline-none
                                   focus:ring-2 focus:ring-blue-100
                                   focus:border-pln-blue">

                        <svg
                            class="absolute left-3 top-2.5
                                   w-4 h-4 text-gray-400"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24">

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M21 21l-4.35-4.35m0 0
                                   A7.5 7.5 0 103.5 9.5
                                   a7.5 7.5 0 0013.15 7.15z" />

                        </svg>

                    </div>

                </div>

            </div>


            {{-- INFO --}}
            <div class="px-5 py-3 bg-blue-50 border-b border-blue-100">

                <p class="text-xs text-blue-700">

                    <strong>{{ $dataMonitoring->count() }}</strong>
                    SKKO yang memiliki data PRK.

                    Klik tombol
                    <strong>Lihat Detail</strong>
                    untuk melihat PRK yang terkait dengan SKKO.

                </p>

            </div>


            {{-- TABLE --}}
            <div class="overflow-x-auto">

                <table
                    id="tableMonitoring"
                    class="min-w-max w-full text-sm border-collapse">

                    {{-- TABLE HEAD --}}
                    <thead>

                        {{-- GROUP HEADER --}}
                        <tr class="bg-[#003082] text-white">

                            {{-- NO --}}
                            <th
                                rowspan="2"
                                class="px-4 py-3 text-center border border-blue-800">
                                No
                            </th>

                            {{-- SKKO TERBIT --}}
                            <th
                                colspan="2"
                                class="px-4 py-3 text-center border border-blue-800">
                                SKKO TERBIT
                            </th>

                            {{-- PROSES NOTA DINAS --}}
                            <th
                                colspan="2"
                                class="px-4 py-3 text-center border border-blue-800">
                                Proses Nota Dinas
                            </th>

                            {{-- TERKONTRAK --}}
                            <th
                                colspan="2"
                                class="px-4 py-3 text-center border border-blue-800">
                                Terkontrak
                            </th>

                            {{-- REALISASI KONTRAK --}}
                            <th
                                colspan="2"
                                class="px-4 py-3 text-center border border-blue-800">
                                Realisasi Kontrak
                            </th>

                            {{-- USUL BAYAR --}}
                            <th
                                colspan="2"
                                class="px-4 py-3 text-center border border-blue-800">
                                Usul Bayar
                            </th>

                            {{-- TERBAYAR --}}
                            <th
                                colspan="2"
                                class="px-4 py-3 text-center border border-blue-800">
                                Terbayar
                            </th>

                            {{-- SISA ANGGARAN --}}
                            <th
                                colspan="2"
                                class="px-4 py-3 text-center border border-blue-800">
                                Sisa Anggaran
                            </th>

                            {{-- POTENSI HU --}}
                            <th
                                rowspan="2"
                                class="px-4 py-3 text-center border border-blue-800">
                                Potensi HU
                            </th>

                            {{-- AKSI --}}
                            <th
                                rowspan="2"
                                class="px-4 py-3 text-center border border-blue-800">
                                Aksi
                            </th>

                        </tr>


                        {{-- COLUMN HEADER --}}
                        <tr class="bg-[#0064B4] text-white text-xs">

                            {{-- SKKO TERBIT --}}
                            <th class="px-4 py-3 border border-blue-700">
                                URAIAN
                            </th>

                            <th class="px-4 py-3 border border-blue-700">
                                NILAI
                            </th>

                            {{-- NOTA DINAS --}}
                            <th class="px-4 py-3 border border-blue-700">
                                NILAI
                            </th>

                            <th class="px-4 py-3 border border-blue-700">
                                %
                            </th>

                            {{-- TERKONTRAK --}}
                            <th class="px-4 py-3 border border-blue-700">
                                NILAI
                            </th>

                            <th class="px-4 py-3 border border-blue-700">
                                %
                            </th>

                            {{-- REALISASI --}}
                            <th class="px-4 py-3 border border-blue-700">
                                NILAI
                            </th>

                            <th class="px-4 py-3 border border-blue-700">
                                %
                            </th>

                            {{-- USUL BAYAR --}}
                            <th class="px-4 py-3 border border-blue-700">
                                NILAI
                            </th>

                            <th class="px-4 py-3 border border-blue-700">
                                %
                            </th>

                            {{-- TERBAYAR --}}
                            <th class="px-4 py-3 border border-blue-700">
                                NILAI
                            </th>

                            <th class="px-4 py-3 border border-blue-700">
                                %
                            </th>

                            {{-- SISA --}}
                            <th class="px-4 py-3 border border-blue-700">
                                NILAI
                            </th>

                            <th class="px-4 py-3 border border-blue-700">
                                %
                            </th>

                        </tr>

                    </thead>


                    {{-- TABLE BODY --}}
                    <tbody class="divide-y divide-gray-100">

                        {{-- VARIABEL TOTAL --}}
                        @php
                            $jumlahSkkoTerbit = 0;
                            $jumlahNotaDinas = 0;
                            $jumlahKontrak = 0;
                            $jumlahRealisasi = 0;
                            $jumlahUsulBayar = 0;
                            $jumlahTerbayar = 0;
                            $jumlahSisaAnggaran = 0;
                            $jumlahPotensiHu = 0;
                        @endphp


                        @forelse ($dataMonitoring as $skko => $dataPrk)

                            @php

                                // TOTAL NILAI
                                $skkoTerbit = $dataPrk->sum('nilai_prk_terbit_awal');

                                $notaDinas = $dataPrk->sum('nota_dinas_nilai');

                                $kontrak = $dataPrk->sum('kontrak_nilai');

                                $realisasi = $dataPrk->sum('realisasi_kontrak_nilai');

                                $usulBayar = $dataPrk->sum('total_usul_bayar');

                                $terbayar = $dataPrk->sum('total_giro_terbayar');

                                $sisaAnggaran = $dataPrk->sum('sisa_anggaran_nilai');


                                // POTENSI HU
                                $potensiHu = $notaDinas + $realisasi - $usulBayar;


                                // JUMLAH SEMUA DATA
                                $jumlahSkkoTerbit += $skkoTerbit;
                                $jumlahNotaDinas += $notaDinas;
                                $jumlahKontrak += $kontrak;
                                $jumlahRealisasi += $realisasi;
                                $jumlahUsulBayar += $usulBayar;
                                $jumlahTerbayar += $terbayar;
                                $jumlahSisaAnggaran += $sisaAnggaran;
                                $jumlahPotensiHu += $potensiHu;


                                // PERSENTASE
                                $notaDinasPersen = $skkoTerbit > 0
                                    ? ($notaDinas / $skkoTerbit) * 100
                                    : 0;

                                $kontrakPersen = $skkoTerbit > 0
                                    ? ($kontrak / $skkoTerbit) * 100
                                    : 0;

                                $realisasiPersen = $kontrak > 0
                                    ? ($realisasi / $kontrak) * 100
                                    : 0;

                                $usulBayarPersen = $realisasi > 0
                                    ? ($usulBayar / $realisasi) * 100
                                    : 0;

                                $terbayarPersen = $usulBayar > 0
                                    ? ($terbayar / $usulBayar) * 100
                                    : 0;

                                $sisaPersen = $skkoTerbit > 0
                                    ? ($sisaAnggaran / $skkoTerbit) * 100
                                    : 0;


                                // ID DETAIL
                                $idDetail = $dataPrk->first()->id;

                            @endphp


                            {{-- DATA ROW --}}
                            <tr class="hover:bg-blue-50 transition">

                                {{-- NO --}}
                                <td
                                    class="px-4 py-3 border-r border-gray-100 text-center">
                                    {{ $loop->iteration }}
                                </td>


                                {{-- SKKO TERBIT - URAIAN --}}
                                <td
                                    class="px-4 py-3 border-r border-gray-100 min-w-[360px]">

                                    <div class="max-w-md whitespace-normal">

                                        <span class="font-semibold text-pln-blue">
                                            {{ $skko }}
                                        </span>

                                        <p class="text-xs text-gray-400 mt-1">
                                            {{ $dataPrk->count() }}
                                            PRK terkait
                                        </p>

                                    </div>

                                </td>


                                {{-- SKKO TERBIT - NILAI --}}
                                <td
                                    class="px-4 py-3 border-r border-gray-100 whitespace-nowrap">

                                    Rp
                                    {{ number_format($skkoTerbit, 0, ',', '.') }}

                                </td>


                                {{-- NOTA DINAS - NILAI --}}
                                <td
                                    class="px-4 py-3 border-r border-gray-100 whitespace-nowrap">

                                    Rp
                                    {{ number_format($notaDinas, 0, ',', '.') }}

                                </td>


                                {{-- NOTA DINAS - % --}}
                                <td
                                    class="px-4 py-3 border-r border-gray-100 text-center whitespace-nowrap">

                                    {{ number_format($notaDinasPersen, 2, ',', '.') }}%

                                </td>


                                {{-- KONTRAK - NILAI --}}
                                <td
                                    class="px-4 py-3 border-r border-gray-100 whitespace-nowrap">

                                    Rp
                                    {{ number_format($kontrak, 0, ',', '.') }}

                                </td>


                                {{-- KONTRAK - % --}}
                                <td
                                    class="px-4 py-3 border-r border-gray-100 text-center whitespace-nowrap">

                                    {{ number_format($kontrakPersen, 2, ',', '.') }}%

                                </td>


                                {{-- REALISASI - NILAI --}}
                                <td
                                    class="px-4 py-3 border-r border-gray-100 whitespace-nowrap">

                                    Rp
                                    {{ number_format($realisasi, 0, ',', '.') }}

                                </td>


                                {{-- REALISASI - % --}}
                                <td
                                    class="px-4 py-3 border-r border-gray-100 text-center whitespace-nowrap">

                                    {{ number_format($realisasiPersen, 2, ',', '.') }}%

                                </td>


                                {{-- USUL BAYAR - NILAI --}}
                                <td
                                    class="px-4 py-3 border-r border-gray-100 whitespace-nowrap">

                                    Rp
                                    {{ number_format($usulBayar, 0, ',', '.') }}

                                </td>


                                {{-- USUL BAYAR - % --}}
                                <td
                                    class="px-4 py-3 border-r border-gray-100 text-center whitespace-nowrap">

                                    {{ number_format($usulBayarPersen, 2, ',', '.') }}%

                                </td>


                                {{-- TERBAYAR - NILAI --}}
                                <td
                                    class="px-4 py-3 border-r border-gray-100 whitespace-nowrap">

                                    Rp
                                    {{ number_format($terbayar, 0, ',', '.') }}

                                </td>


                                {{-- TERBAYAR - % --}}
                                <td
                                    class="px-4 py-3 border-r border-gray-100 text-center whitespace-nowrap">

                                    {{ number_format($terbayarPersen, 2, ',', '.') }}%

                                </td>


                                {{-- SISA ANGGARAN - NILAI --}}
                                <td
                                    class="px-4 py-3 border-r border-gray-100 whitespace-nowrap">

                                    Rp
                                    {{ number_format($sisaAnggaran, 0, ',', '.') }}

                                </td>


                                {{-- SISA ANGGARAN - % --}}
                                <td
                                    class="px-4 py-3 border-r border-gray-100 text-center whitespace-nowrap">

                                    {{ number_format($sisaPersen, 2, ',', '.') }}%

                                </td>


                                {{-- POTENSI HU --}}
                                <td
                                    class="px-4 py-3 border-r border-gray-100 whitespace-nowrap font-semibold">

                                    Rp
                                    {{ number_format($potensiHu, 0, ',', '.') }}

                                </td>


                                {{-- AKSI --}}
                                <td
                                    class="px-4 py-3 border-r border-gray-100">

                                    <div class="flex items-center justify-center">

                                        <a
                                            href="{{ route('monitoring.show', ['id' => $idDetail]) }}"
                                            class="inline-flex items-center justify-center gap-1.5
                                                   px-3 py-2 rounded-lg
                                                   bg-blue-50 text-pln-blue
                                                   text-xs font-semibold
                                                   hover:bg-blue-100 transition">

                                            <svg
                                                class="w-4 h-4"
                                                fill="none"
                                                stroke="currentColor"
                                                viewBox="0 0 24 24">

                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M15 12a3 3 0 11-6 0
                                                       3 3 0 016 0z" />

                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M2.458 12C3.732 7.943
                                                       7.523 5 12 5
                                                       c4.477 0 8.268 2.943
                                                       9.542 7
                                                       -1.274 4.057-5.065 7
                                                       -9.542 7
                                                       -4.477 0-8.268-2.943
                                                       -9.542-7z" />

                                            </svg>

                                            <span>
                                                Lihat Detail
                                            </span>

                                        </a>

                                    </div>

                                </td>

                            </tr>


                        @empty

                            {{-- EMPTY DATA --}}
                            <tr>

                                <td
                                    colspan="17"
                                    class="px-5 py-16 text-center">

                                    <div class="flex flex-col items-center">

                                        <div
                                            class="w-16 h-16 rounded-full
                                                   bg-blue-50
                                                   flex items-center justify-center
                                                   mb-4">

                                            <svg
                                                class="w-8 h-8 text-pln-blue"
                                                fill="none"
                                                stroke="currentColor"
                                                viewBox="0 0 24 24">

                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M9 12h6m-6 4h6m2 5H7
                                                       a2 2 0 01-2-2V5
                                                       a2 2 0 012-2h5.586
                                                       a1 1 0 01.707.293
                                                       l5.414 5.414
                                                       A1 1 0 0119 5.707V19
                                                       a2 2 0 01-2 2z" />

                                            </svg>

                                        </div>

                                        <p class="font-semibold text-gray-700">
                                            Belum ada data monitoring
                                        </p>

                                        <p class="text-sm text-gray-400 mt-1">
                                            Data monitoring akan muncul setelah data PRK tersedia.
                                        </p>

                                    </div>

                                </td>

                            </tr>

                        @endforelse

                    </tbody>


                    {{-- FOOTER TOTAL --}}
                    <tfoot>

                        {{-- JUMLAH MURNI --}}
                        <tr class="bg-blue-50 font-semibold text-gray-800">

                            <td
                                colspan="2"
                                class="px-4 py-3 border border-blue-200 text-center">
                                JUMLAH MURNI
                            </td>

                            {{-- SKKO TERBIT --}}
                            <td class="px-4 py-3 border border-blue-200 whitespace-nowrap">
                                Rp {{ number_format($jumlahSkkoTerbit, 0, ',', '.') }}
                            </td>

                            {{-- NOTA DINAS --}}
                            <td class="px-4 py-3 border border-blue-200 whitespace-nowrap">
                                Rp {{ number_format($jumlahNotaDinas, 0, ',', '.') }}
                            </td>

                            <td class="px-4 py-3 border border-blue-200 text-center">
                                {{ number_format(
                                    $jumlahSkkoTerbit > 0
                                        ? ($jumlahNotaDinas / $jumlahSkkoTerbit) * 100
                                        : 0,
                                    2,
                                    ',',
                                    '.'
                                ) }}%
                            </td>

                            {{-- TERKONTRAK --}}
                            <td class="px-4 py-3 border border-blue-200 whitespace-nowrap">
                                Rp {{ number_format($jumlahKontrak, 0, ',', '.') }}
                            </td>

                            <td class="px-4 py-3 border border-blue-200 text-center">
                                {{ number_format(
                                    $jumlahSkkoTerbit > 0
                                        ? ($jumlahKontrak / $jumlahSkkoTerbit) * 100
                                        : 0,
                                    2,
                                    ',',
                                    '.'
                                ) }}%
                            </td>

                            {{-- REALISASI --}}
                            <td class="px-4 py-3 border border-blue-200 whitespace-nowrap">
                                Rp {{ number_format($jumlahRealisasi, 0, ',', '.') }}
                            </td>

                            <td class="px-4 py-3 border border-blue-200 text-center">
                                {{ number_format(
                                    $jumlahKontrak > 0
                                        ? ($jumlahRealisasi / $jumlahKontrak) * 100
                                        : 0,
                                    2,
                                    ',',
                                    '.'
                                ) }}%
                            </td>

                            {{-- USUL BAYAR --}}
                            <td class="px-4 py-3 border border-blue-200 whitespace-nowrap">
                                Rp {{ number_format($jumlahUsulBayar, 0, ',', '.') }}
                            </td>

                            <td class="px-4 py-3 border border-blue-200 text-center">
                                {{ number_format(
                                    $jumlahRealisasi > 0
                                        ? ($jumlahUsulBayar / $jumlahRealisasi) * 100
                                        : 0,
                                    2,
                                    ',',
                                    '.'
                                ) }}%
                            </td>

                            {{-- TERBAYAR --}}
                            <td class="px-4 py-3 border border-blue-200 whitespace-nowrap">
                                Rp {{ number_format($jumlahTerbayar, 0, ',', '.') }}
                            </td>

                            <td class="px-4 py-3 border border-blue-200 text-center">
                                {{ number_format(
                                    $jumlahUsulBayar > 0
                                        ? ($jumlahTerbayar / $jumlahUsulBayar) * 100
                                        : 0,
                                    2,
                                    ',',
                                    '.'
                                ) }}%
                            </td>

                            {{-- SISA ANGGARAN --}}
                            <td class="px-4 py-3 border border-blue-200 whitespace-nowrap">
                                Rp {{ number_format($jumlahSisaAnggaran, 0, ',', '.') }}
                            </td>

                            <td class="px-4 py-3 border border-blue-200 text-center">
                                {{ number_format(
                                    $jumlahSkkoTerbit > 0
                                        ? ($jumlahSisaAnggaran / $jumlahSkkoTerbit) * 100
                                        : 0,
                                    2,
                                    ',',
                                    '.'
                                ) }}%
                            </td>

                            {{-- POTENSI HU --}}
                            <td class="px-4 py-3 border border-blue-200 whitespace-nowrap">
                                Rp {{ number_format($jumlahPotensiHu, 0, ',', '.') }}
                            </td>

                            {{-- AKSI --}}
                            <td class="px-4 py-3 border border-blue-200"></td>

                        </tr>


                        {{-- TOTAL --}}
                        <tr class="bg-white font-semibold text-gray-800">

                            <td
                                colspan="2"
                                class="px-4 py-3 border border-blue-200 text-center">
                                TOTAL
                            </td>

                            {{-- SKKO TERBIT --}}
                            <td class="px-4 py-3 border border-blue-200 whitespace-nowrap">
                                Rp {{ number_format($jumlahSkkoTerbit, 0, ',', '.') }}
                            </td>

                            {{-- NOTA DINAS --}}
                            <td class="px-4 py-3 border border-blue-200 whitespace-nowrap">
                                Rp {{ number_format($jumlahNotaDinas, 0, ',', '.') }}
                            </td>

                            <td class="px-4 py-3 border border-blue-200 text-center">
                                {{ number_format(
                                    $jumlahSkkoTerbit > 0
                                        ? ($jumlahNotaDinas / $jumlahSkkoTerbit) * 100
                                        : 0,
                                    2,
                                    ',',
                                    '.'
                                ) }}%
                            </td>

                            {{-- TERKONTRAK --}}
                            <td class="px-4 py-3 border border-blue-200 whitespace-nowrap">
                                Rp {{ number_format($jumlahKontrak, 0, ',', '.') }}
                            </td>

                            <td class="px-4 py-3 border border-blue-200 text-center">
                                {{ number_format(
                                    $jumlahSkkoTerbit > 0
                                        ? ($jumlahKontrak / $jumlahSkkoTerbit) * 100
                                        : 0,
                                    2,
                                    ',',
                                    '.'
                                ) }}%
                            </td>

                            {{-- REALISASI --}}
                            <td class="px-4 py-3 border border-blue-200 whitespace-nowrap">
                                Rp {{ number_format($jumlahRealisasi, 0, ',', '.') }}
                            </td>

                            <td class="px-4 py-3 border border-blue-200 text-center">
                                {{ number_format(
                                    $jumlahKontrak > 0
                                        ? ($jumlahRealisasi / $jumlahKontrak) * 100
                                        : 0,
                                    2,
                                    ',',
                                    '.'
                                ) }}%
                            </td>

                            {{-- USUL BAYAR --}}
                            <td class="px-4 py-3 border border-blue-200 whitespace-nowrap">
                                Rp {{ number_format($jumlahUsulBayar, 0, ',', '.') }}
                            </td>

                            <td class="px-4 py-3 border border-blue-200 text-center">
                                {{ number_format(
                                    $jumlahRealisasi > 0
                                        ? ($jumlahUsulBayar / $jumlahRealisasi) * 100
                                        : 0,
                                    2,
                                    ',',
                                    '.'
                                ) }}%
                            </td>

                            {{-- TERBAYAR --}}
                            <td class="px-4 py-3 border border-blue-200 whitespace-nowrap">
                                Rp {{ number_format($jumlahTerbayar, 0, ',', '.') }}
                            </td>

                            <td class="px-4 py-3 border border-blue-200 text-center">
                                {{ number_format(
                                    $jumlahUsulBayar > 0
                                        ? ($jumlahTerbayar / $jumlahUsulBayar) * 100
                                        : 0,
                                    2,
                                    ',',
                                    '.'
                                ) }}%
                            </td>

                            {{-- SISA ANGGARAN --}}
                            <td class="px-4 py-3 border border-blue-200 whitespace-nowrap">
                                Rp {{ number_format($jumlahSisaAnggaran, 0, ',', '.') }}
                            </td>

                            <td class="px-4 py-3 border border-blue-200 text-center">
                                {{ number_format(
                                    $jumlahSkkoTerbit > 0
                                        ? ($jumlahSisaAnggaran / $jumlahSkkoTerbit) * 100
                                        : 0,
                                    2,
                                    ',',
                                    '.'
                                ) }}%
                            </td>

                            {{-- POTENSI HU --}}
                            <td class="px-4 py-3 border border-blue-200 whitespace-nowrap">
                                Rp {{ number_format($jumlahPotensiHu, 0, ',', '.') }}
                            </td>

                            {{-- AKSI --}}
                            <td class="px-4 py-3 border border-blue-200"></td>

                        </tr>

                    </tfoot>

                </table>

            </div>

        </div>

    </div>


    {{-- SEARCH --}}
    <script>

        document
            .getElementById('searchMonitoring')
            .addEventListener('keyup', function() {

                let keyword = this.value.toLowerCase();

                document
                    .querySelectorAll('#tableMonitoring tbody tr')
                    .forEach(function(row) {

                        row.style.display =
                            row.innerText
                                .toLowerCase()
                                .includes(keyword)
                                ? ''
                                : 'none';

                    });

            });

    </script>

@endsection
