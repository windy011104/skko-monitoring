@extends('layouts.app')

@section('title', 'Data Progres Kontrak')

@section('content')

    <div class="p-4 lg:p-6">

        {{-- HEADER --}}
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">

            <div>
                <h1 class="text-2xl font-bold text-gray-800">
                    Data Progres Kontrak
                </h1>

                <p class="text-sm text-gray-500 mt-1">
                    Kelola data progres pekerjaan dan kontrak
                </p>
            </div>

            <div class="flex flex-col sm:flex-row gap-2">

                {{-- IMPORT EXCEL PROGRES KONTRAK --}}
                <form action="{{ route('progres-kontrak.import') }}" method="POST" enctype="multipart/form-data">

                    @csrf

                    <label
                        class="inline-flex items-center justify-center gap-2
                   px-4 py-2.5 bg-green-600 hover:bg-green-700
                   text-white text-sm font-semibold rounded-lg
                   shadow-sm transition cursor-pointer">

                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">

                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 3v12m0 0l-4-4m4 4l4-4M5 21h14" />

                        </svg>

                        Import Excel

                        <input type="file" name="file" accept=".xlsx,.xls,.csv" class="hidden"
                            onchange="this.form.submit()">

                    </label>

                </form>


                {{-- TAMBAH PROGRES KONTRAK --}}
                <a href="{{ route('progres-kontrak.create') }}"
                    class="inline-flex items-center justify-center gap-2
               px-4 py-2.5 bg-pln-blue hover:bg-pln-light
               text-white text-sm font-semibold rounded-lg
               shadow-sm transition">

                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">

                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />

                    </svg>

                    Tambah Progres

                </a>

            </div>

        </div>


        {{-- SUCCESS MESSAGE --}}
        @if (session('success'))
            <div
                class="mb-5 flex items-center gap-3 p-4
                       rounded-xl bg-green-50 border border-green-200
                       text-green-700">

                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">

                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />

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
        <div class="bg-white rounded-xl border border-gray-100
                    shadow-sm overflow-hidden">

            {{-- CARD HEADER --}}
            <div class="px-5 py-4 border-b border-gray-100">

                <div class="flex flex-col lg:flex-row
                            lg:items-center lg:justify-between gap-4">

                    <div>
                        <h2 class="font-semibold text-gray-800">
                            Daftar Progres Kontrak
                        </h2>

                        <p class="text-xs text-gray-500 mt-1">
                            Seluruh data progres kontrak yang tersimpan dalam sistem
                        </p>
                    </div>


                    {{-- SEARCH --}}
                    <div class="relative">

                        <input type="text" id="searchProgresKontrak" placeholder="Cari data kontrak..."
                            class="w-full lg:w-72 pl-9 pr-3 py-2
                                   text-sm border border-gray-200
                                   rounded-lg
                                   focus:outline-none
                                   focus:ring-2 focus:ring-blue-100
                                   focus:border-pln-blue">

                        <svg class="absolute left-3 top-2.5
                                    w-4 h-4 text-gray-400"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">

                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35m0 0
                                           A7.5 7.5 0 103.5 9.5
                                           a7.5 7.5 0 0013.15 7.15z" />

                        </svg>

                    </div>

                </div>

            </div>


            {{-- INFO --}}
            <div class="px-5 py-3 bg-blue-50 border-b border-blue-100">

                <p class="text-xs text-blue-700">

                    <strong>{{ $dataProgresKontrak->count() }}</strong>
                    data progres kontrak terdaftar.

                    Geser tabel ke kanan untuk melihat seluruh informasi.

                </p>

            </div>


            {{-- TABLE --}}
            <div class="overflow-x-auto">

                <table id="tableProgresKontrak" class="min-w-max w-full text-sm border-collapse">

                    {{-- TABLE HEAD --}}
                    <thead>

                        {{-- GROUP HEADER --}}
                        <tr class="bg-[#003082] text-white">

                            <th rowspan="2" class="px-4 py-3 border border-blue-800">
                                No
                            </th>


                            {{-- IDENTITAS SKKO --}}
                            <th colspan="8" class="px-4 py-3 text-center border border-blue-800">
                                Identitas SKKO
                            </th>


                            {{-- PROSES KONTRAK --}}
                            <th colspan="8" class="px-4 py-3 text-center border border-blue-800">
                                Proses Kontrak
                            </th>


                            {{-- REALISASI --}}
                            <th colspan="4" class="px-4 py-3 text-center border border-blue-800">
                                Realisasi
                            </th>


                            {{-- AMANDEMEN --}}
                            <th colspan="2" class="px-4 py-3 text-center border border-blue-800">
                                Amandemen Waktu
                            </th>

                            <th colspan="2" class="px-4 py-3 text-center border border-blue-800">
                                Amandemen Nilai
                            </th>


                            {{-- USUL BAYAR 100 --}}
                            <th colspan="8" class="px-4 py-3 text-center border border-blue-800">
                                Usul Bayar 100%
                            </th>

                            <th colspan="2" class="px-4 py-3 text-center border border-blue-800">
                                Giro 100%
                            </th>


                            {{-- USUL BAYAR 95 --}}
                            <th colspan="8" class="px-4 py-3 text-center border border-blue-800">
                                Usul Bayar 95%
                            </th>

                            <th colspan="2" class="px-4 py-3 text-center border border-blue-800">
                                Giro 95%
                            </th>


                            {{-- USUL BAYAR 5 --}}
                            <th colspan="8" class="px-4 py-3 text-center border border-blue-800">
                                Usul Bayar 5%
                            </th>

                            <th colspan="2" class="px-4 py-3 text-center border border-blue-800">
                                Giro 5%
                            </th>


                            {{-- PROGRESS --}}
                            <th colspan="5" class="px-4 py-3 text-center border border-blue-800">
                                Progress Pekerjaan
                            </th>


                            {{-- RINGKASAN --}}
                            <th colspan="4" class="px-4 py-3 text-center border border-blue-800">
                                Ringkasan Pembayaran
                            </th>


                            {{-- SAP --}}
                            <th colspan="3" class="px-4 py-3 text-center border border-blue-800">
                                SAP 100%
                            </th>

                            <th colspan="3" class="px-4 py-3 text-center border border-blue-800">
                                SAP 95%
                            </th>

                            <th colspan="3" class="px-4 py-3 text-center border border-blue-800">
                                SAP 5%
                            </th>


                            {{-- PENGAWAS --}}
                            <th colspan="3" class="px-4 py-3 text-center border border-blue-800">
                                Data Pengawas dan Kontrak
                            </th>


                            {{-- TOTAL --}}
                            <th colspan="7" class="px-4 py-3 text-center border border-blue-800">
                                Total Kontrak dan Realisasi
                            </th>


                            {{-- PERHITUNGAN --}}
                            <th colspan="6" class="px-4 py-3 text-center border border-blue-800">
                                Tanggal dan Perhitungan
                            </th>


                            {{-- RENCANA --}}
                            <th colspan="2" class="px-4 py-3 text-center border border-blue-800">
                                Rencana Kontrak
                            </th>

                            <th colspan="2" class="px-4 py-3 text-center border border-blue-800">
                                Rencana Usul Bayar 95%
                            </th>

                            <th colspan="2" class="px-4 py-3 text-center border border-blue-800">
                                Rencana Usul Bayar 5%
                            </th>

                            <th colspan="2" class="px-4 py-3 text-center border border-blue-800">
                                Rencana Usul Bayar 100%
                            </th>


                            {{-- AKSI --}}
                            <th rowspan="2" class="px-4 py-3 text-center border border-blue-800">
                                Aksi
                            </th>

                        </tr>


                        {{-- COLUMN HEADER --}}
                        <tr class="bg-[#0064B4] text-white text-xs">

                            {{-- IDENTITAS --}}
                            <th class="px-4 py-3 border border-blue-700">SKKO</th>
                            <th class="px-4 py-3 border border-blue-700">PRK UID</th>
                            <th class="px-4 py-3 border border-blue-700">PRK LKAO</th>
                            <th class="px-4 py-3 border border-blue-700">PEKERJAAN</th>
                            <th class="px-4 py-3 border border-blue-700">LOKASI</th>
                            <th class="px-4 py-3 border border-blue-700">STATUS PEKERJAAN</th>
                            <th class="px-4 py-3 border border-blue-700">STATUS BAYAR</th>
                            <th class="px-4 py-3 border border-blue-700">WAKTU</th>


                            {{-- KONTRAK --}}
                            <th class="px-4 py-3 border border-blue-700">NO KONTRAK</th>
                            <th class="px-4 py-3 border border-blue-700">PELAKSANA</th>
                            <th class="px-4 py-3 border border-blue-700">MATERIAL KONTRAK</th>
                            <th class="px-4 py-3 border border-blue-700">JASA KONTRAK</th>
                            <th class="px-4 py-3 border border-blue-700">TOTAL NILAI KONTRAK</th>
                            <th class="px-4 py-3 border border-blue-700">VOLUME KONTRAK</th>
                            <th class="px-4 py-3 border border-blue-700">TGL MULAI</th>
                            <th class="px-4 py-3 border border-blue-700">TGL SELESAI</th>


                            {{-- REALISASI --}}
                            <th class="px-4 py-3 border border-blue-700">MATERIAL REALISASI</th>
                            <th class="px-4 py-3 border border-blue-700">JASA REALISASI</th>
                            <th class="px-4 py-3 border border-blue-700">TOTAL NILAI REALISASI</th>
                            <th class="px-4 py-3 border border-blue-700">VOLUME REALISASI</th>


                            {{-- AMANDEMEN --}}
                            <th class="px-4 py-3 border border-blue-700">NOMOR</th>
                            <th class="px-4 py-3 border border-blue-700">TANGGAL</th>
                            <th class="px-4 py-3 border border-blue-700">NOMOR</th>
                            <th class="px-4 py-3 border border-blue-700">TANGGAL</th>


                            {{-- USUL BAYAR 100 --}}
                            <th class="px-4 py-3 border border-blue-700">NO BAPP</th>
                            <th class="px-4 py-3 border border-blue-700">TGL BAPP</th>
                            <th class="px-4 py-3 border border-blue-700">NO BAST</th>
                            <th class="px-4 py-3 border border-blue-700">TGL BAST</th>
                            <th class="px-4 py-3 border border-blue-700">NO SUBMISSION ID</th>
                            <th class="px-4 py-3 border border-blue-700">TGL SUBMISSION</th>
                            <th class="px-4 py-3 border border-blue-700">NILAI</th>
                            <th class="px-4 py-3 border border-blue-700">PERSENTASE</th>


                            {{-- GIRO 100 --}}
                            <th class="px-4 py-3 border border-blue-700">TANGGAL</th>
                            <th class="px-4 py-3 border border-blue-700">NILAI</th>


                            {{-- USUL BAYAR 95 --}}
                            <th class="px-4 py-3 border border-blue-700">NO BAPP</th>
                            <th class="px-4 py-3 border border-blue-700">TGL BAPP</th>
                            <th class="px-4 py-3 border border-blue-700">NO BAST</th>
                            <th class="px-4 py-3 border border-blue-700">TGL BAST</th>
                            <th class="px-4 py-3 border border-blue-700">NO SUBMISSION ID</th>
                            <th class="px-4 py-3 border border-blue-700">TGL SUBMISSION</th>
                            <th class="px-4 py-3 border border-blue-700">NILAI</th>
                            <th class="px-4 py-3 border border-blue-700">PERSENTASE</th>


                            {{-- GIRO 95 --}}
                            <th class="px-4 py-3 border border-blue-700">TANGGAL</th>
                            <th class="px-4 py-3 border border-blue-700">NILAI</th>


                            {{-- USUL BAYAR 5 --}}
                            <th class="px-4 py-3 border border-blue-700">NO BAPP</th>
                            <th class="px-4 py-3 border border-blue-700">TGL BAPP</th>
                            <th class="px-4 py-3 border border-blue-700">NO BAST</th>
                            <th class="px-4 py-3 border border-blue-700">TGL BAST</th>
                            <th class="px-4 py-3 border border-blue-700">NO SUBMISSION ID</th>
                            <th class="px-4 py-3 border border-blue-700">TGL SUBMISSION</th>
                            <th class="px-4 py-3 border border-blue-700">NILAI</th>
                            <th class="px-4 py-3 border border-blue-700">PERSENTASE</th>


                            {{-- GIRO 5 --}}
                            <th class="px-4 py-3 border border-blue-700">TANGGAL</th>
                            <th class="px-4 py-3 border border-blue-700">NILAI</th>


                            {{-- PROGRESS --}}
                            <th class="px-4 py-3 border border-blue-700">KETERANGAN</th>
                            <th class="px-4 py-3 border border-blue-700">NILAI SISA</th>
                            <th class="px-4 py-3 border border-blue-700">KENDALA</th>
                            <th class="px-4 py-3 border border-blue-700">TINDAK LANJUT</th>
                            <th class="px-4 py-3 border border-blue-700">PERSENTASE FISIK</th>


                            {{-- RINGKASAN --}}
                            <th class="px-4 py-3 border border-blue-700">NO PO</th>
                            <th class="px-4 py-3 border border-blue-700">TOTAL USUL BAYAR</th>
                            <th class="px-4 py-3 border border-blue-700">TOTAL GIRO</th>
                            <th class="px-4 py-3 border border-blue-700">TOTAL OUTSTANDING</th>


                            {{-- SAP 100 --}}
                            <th class="px-4 py-3 border border-blue-700">NO INVOICE</th>
                            <th class="px-4 py-3 border border-blue-700">TANGGAL</th>
                            <th class="px-4 py-3 border border-blue-700">NO DOC</th>


                            {{-- SAP 95 --}}
                            <th class="px-4 py-3 border border-blue-700">NO INVOICE</th>
                            <th class="px-4 py-3 border border-blue-700">TANGGAL</th>
                            <th class="px-4 py-3 border border-blue-700">NO DOC</th>


                            {{-- SAP 5 --}}
                            <th class="px-4 py-3 border border-blue-700">NO INVOICE</th>
                            <th class="px-4 py-3 border border-blue-700">TANGGAL</th>
                            <th class="px-4 py-3 border border-blue-700">NO DOC</th>


                            {{-- PENGAWAS --}}
                            <th class="px-4 py-3 border border-blue-700">PENGAWAS</th>
                            <th class="px-4 py-3 border border-blue-700">JENIS JTL</th>
                            <th class="px-4 py-3 border border-blue-700">METODE KONTRAK</th>


                            {{-- TOTAL KONTRAK --}}
                            <th class="px-4 py-3 border border-blue-700">TOTAL MATERIAL TERKONTRAK</th>
                            <th class="px-4 py-3 border border-blue-700">TOTAL JASA TERKONTRAK</th>
                            <th class="px-4 py-3 border border-blue-700">TOTAL TERKONTRAK</th>
                            <th class="px-4 py-3 border border-blue-700">TERKONTRAK BELUM REALISASI</th>
                            <th class="px-4 py-3 border border-blue-700">TOTAL REALISASI MATERIAL</th>
                            <th class="px-4 py-3 border border-blue-700">TOTAL REALISASI JASA</th>
                            <th class="px-4 py-3 border border-blue-700">TOTAL REALISASI KONTRAK</th>


                            {{-- PERHITUNGAN --}}
                            <th class="px-4 py-3 border border-blue-700">TGL BULAN KONTRAK</th>
                            <th class="px-4 py-3 border border-blue-700">TGL BULAN USUL BAYAR 100</th>
                            <th class="px-4 py-3 border border-blue-700">TGL BULAN USUL BAYAR 95</th>
                            <th class="px-4 py-3 border border-blue-700">TGL BULAN USUL BAYAR 5</th>
                            <th class="px-4 py-3 border border-blue-700">SELISIH KONTRAK REALISASI</th>
                            <th class="px-4 py-3 border border-blue-700">PERSENTASE PENCAPAIAN KONTRAK</th>


                            {{-- RENCANA --}}
                            <th class="px-4 py-3 border border-blue-700">RP</th>
                            <th class="px-4 py-3 border border-blue-700">BULAN</th>

                            <th class="px-4 py-3 border border-blue-700">RP</th>
                            <th class="px-4 py-3 border border-blue-700">BULAN</th>

                            <th class="px-4 py-3 border border-blue-700">RP</th>
                            <th class="px-4 py-3 border border-blue-700">BULAN</th>

                            <th class="px-4 py-3 border border-blue-700">RP</th>
                            <th class="px-4 py-3 border border-blue-700">BULAN</th>

                        </tr>

                    </thead>


                    {{-- TABLE BODY --}}
                    <tbody class="divide-y divide-gray-100">

                        @forelse ($dataProgresKontrak as $kontrak)
                            <tr class="hover:bg-blue-50 transition">

                                {{-- NOMOR --}}
                                <td class="px-4 py-3 border-r border-gray-100 text-center">
                                    {{ $loop->iteration }}
                                </td>


                                {{-- IDENTITAS SKKO --}}
                                <td class="px-4 py-3 border-r border-gray-100">
                                    {{ $kontrak->skko ?? '-' }}
                                </td>

                                <td class="px-4 py-3 border-r border-gray-100">
                                    {{ $kontrak->prk_uid ?? '-' }}
                                </td>

                                <td class="px-4 py-3 border-r border-gray-100">
                                    {{ $kontrak->prk_lkao ?? '-' }}
                                </td>

                                <td class="px-4 py-3 border-r border-gray-100 max-w-xs">
                                    <div class="max-w-xs whitespace-normal">
                                        {{ $kontrak->pekerjaan ?? '-' }}
                                    </div>
                                </td>

                                <td class="px-4 py-3 border-r border-gray-100">
                                    {{ $kontrak->lokasi ?? '-' }}
                                </td>

                                <td class="px-4 py-3 border-r border-gray-100">
                                    {{ $kontrak->status_pekerjaan ?? '-' }}
                                </td>

                                <td class="px-4 py-3 border-r border-gray-100">
                                    {{ $kontrak->status_bayar ?? '-' }}
                                </td>

                                <td class="px-4 py-3 border-r border-gray-100">
                                    {{ $kontrak->waktu ?? '-' }}
                                </td>


                                {{-- PROSES KONTRAK --}}
                                <td class="px-4 py-3 border-r border-gray-100">
                                    {{ $kontrak->no_kontrak ?? '-' }}
                                </td>

                                <td class="px-4 py-3 border-r border-gray-100">
                                    {{ $kontrak->pelaksana ?? '-' }}
                                </td>

                                <td class="px-4 py-3 border-r border-gray-100 whitespace-nowrap">
                                    Rp {{ number_format($kontrak->nilai_material_kontrak  ?? 0, 2, ',', '.') }}
                                </td>

                                <td class="px-4 py-3 border-r border-gray-100 whitespace-nowrap">
                                    Rp {{ number_format($kontrak->nilai_jasa_kontrak  ?? 0, 2, ',', '.') }}
                                </td>

                                <td class="px-4 py-3 border-r border-gray-100 whitespace-nowrap">
                                    Rp {{ number_format($kontrak->total_nilai_kontrak  ?? 0, 2, ',', '.') }}
                                </td>

                                <td class="px-4 py-3 border-r border-gray-100">
                                    {{ $kontrak->volume_kontrak ?? '-' }}
                                </td>

                                <td class="px-4 py-3 border-r border-gray-100 whitespace-nowrap">
                                    {{ $kontrak->tgl_mulai ? \Carbon\Carbon::parse($kontrak->tgl_mulai)->format('d-m-Y') : '-' }}
                                </td>

                                <td class="px-4 py-3 border-r border-gray-100 whitespace-nowrap">
                                    {{ $kontrak->tgl_selesai ? \Carbon\Carbon::parse($kontrak->tgl_selesai)->format('d-m-Y') : '-' }}
                                </td>


                                {{-- REALISASI --}}
                                <td class="px-4 py-3 border-r border-gray-100">
                                    Rp {{ number_format($kontrak->nilai_material_realisasi  ?? 0, 2, ',', '.') }}
                                </td>

                                <td class="px-4 py-3 border-r border-gray-100">
                                    Rp {{ number_format($kontrak->nilai_jasa_realisasi  ?? 0, 2, ',', '.') }}
                                </td>

                                <td class="px-4 py-3 border-r border-gray-100">
                                    Rp {{ number_format($kontrak->total_nilai_realisasi  ?? 0, 2, ',', '.') }}
                                </td>

                                <td class="px-4 py-3 border-r border-gray-100">
                                    {{ $kontrak->volume_realisasi ?? '-' }}
                                </td>


                                {{-- AMANDEMEN --}}
                                <td class="px-4 py-3 border-r border-gray-100">
                                    {{ $kontrak->amandemen_waktu_nomor ?? '-' }}
                                </td>

                                <td class="px-4 py-3 border-r border-gray-100 whitespace-nowrap">
                                    {{ $kontrak->amandemen_waktu_tanggal
                                        ? \Carbon\Carbon::parse($kontrak->amandemen_waktu_tanggal)->format('d-m-Y')
                                        : '-' }}
                                </td>

                                <td class="px-4 py-3 border-r border-gray-100">
                                    {{ $kontrak->amandemen_nilai_nomor ?? '-' }}
                                </td>

                                <td class="px-4 py-3 border-r border-gray-100 whitespace-nowrap">
                                    {{ $kontrak->amandemen_nilai_tanggal
                                        ? \Carbon\Carbon::parse($kontrak->amandemen_nilai_tanggal)->format('d-m-Y')
                                        : '-' }}
                                </td>


                                {{-- USUL BAYAR 100 --}}
                                <td class="px-4 py-3 border-r border-gray-100">
                                    {{ $kontrak->usul_bayar_100_no_bapp ?? '-' }}
                                </td>

                                <td class="px-4 py-3 border-r border-gray-100">
                                    {{ $kontrak->usul_bayar_100_tgl_bapp ? \Carbon\Carbon::parse($kontrak->usul_bayar_100_tgl_bapp)->format('d-m-Y') : '-' }}
                                </td>

                                <td class="px-4 py-3 border-r border-gray-100">
                                    {{ $kontrak->usul_bayar_100_no_bast ?? '-' }}
                                </td>

                                <td class="px-4 py-3 border-r border-gray-100">
                                    {{ $kontrak->usul_bayar_100_tgl_bast ? \Carbon\Carbon::parse($kontrak->usul_bayar_100_tgl_bast)->format('d-m-Y') : '-' }}
                                </td>

                                <td class="px-4 py-3 border-r border-gray-100">
                                    {{ $kontrak->usul_bayar_100_no_submission_id ?? '-' }}
                                </td>

                                <td class="px-4 py-3 border-r border-gray-100">
                                    {{ $kontrak->usul_bayar_100_tgl_submission ? \Carbon\Carbon::parse($kontrak->usul_bayar_100_tgl_submission)->format('d-m-Y') : '-' }}
                                </td>

                                <td class="px-4 py-3 border-r border-gray-100 whitespace-nowrap">
                                    Rp {{ number_format($kontrak->usul_bayar_100_nilai  ?? 0, 2, ',', '.') }}
                                </td>

                                <td class="px-4 py-3 border-r border-gray-100">
                                    {{ $kontrak->usul_bayar_100_persentase ?? '-' }}%
                                </td>


                                {{-- GIRO 100 --}}
                                <td class="px-4 py-3 border-r border-gray-100">
                                    {{ $kontrak->giro_100_tanggal ? \Carbon\Carbon::parse($kontrak->giro_100_tanggal)->format('d-m-Y') : '-' }}
                                </td>

                                <td class="px-4 py-3 border-r border-gray-100">
                                    Rp {{ number_format($kontrak->giro_100_nilai  ?? 0, 2, ',', '.') }}
                                </td>


                                {{-- USUL BAYAR 95 --}}
                                <td class="px-4 py-3 border-r border-gray-100">
                                    {{ $kontrak->usul_bayar_95_no_bapp ?? '-' }}
                                </td>

                                <td class="px-4 py-3 border-r border-gray-100">
                                    {{ $kontrak->usul_bayar_95_tgl_bapp ? \Carbon\Carbon::parse($kontrak->usul_bayar_95_tgl_bapp)->format('d-m-Y') : '-' }}
                                </td>

                                <td class="px-4 py-3 border-r border-gray-100">
                                    {{ $kontrak->usul_bayar_95_no_bast ?? '-' }}
                                </td>

                                <td class="px-4 py-3 border-r border-gray-100">
                                    {{ $kontrak->usul_bayar_95_tgl_bast ? \Carbon\Carbon::parse($kontrak->usul_bayar_95_tgl_bast)->format('d-m-Y') : '-' }}
                                </td>

                                <td class="px-4 py-3 border-r border-gray-100">
                                    {{ $kontrak->usul_bayar_95_no_submission_id ?? '-' }}
                                </td>

                                <td class="px-4 py-3 border-r border-gray-100">
                                    {{ $kontrak->usul_bayar_95_tgl_submission ? \Carbon\Carbon::parse($kontrak->usul_bayar_95_tgl_submission)->format('d-m-Y') : '-' }}
                                </td>

                                <td class="px-4 py-3 border-r border-gray-100">
                                    Rp {{ number_format($kontrak->usul_bayar_95_nilai  ?? 0, 2, ',', '.') }}
                                </td>

                                <td class="px-4 py-3 border-r border-gray-100">
                                    {{ $kontrak->usul_bayar_95_persentase ?? '-' }}%
                                </td>


                                {{-- GIRO 95 --}}
                                <td class="px-4 py-3 border-r border-gray-100">
                                    {{ $kontrak->giro_95_tanggal ? \Carbon\Carbon::parse($kontrak->giro_95_tanggal)->format('d-m-Y') : '-' }}
                                </td>

                                <td class="px-4 py-3 border-r border-gray-100">
                                    Rp {{ number_format($kontrak->giro_95_nilai  ?? 0, 2, ',', '.') }}
                                </td>


                                {{-- USUL BAYAR 5 --}}
                                <td class="px-4 py-3 border-r border-gray-100">
                                    {{ $kontrak->usul_bayar_5_no_bapp ?? '-' }}
                                </td>

                                <td class="px-4 py-3 border-r border-gray-100">
                                    {{ $kontrak->usul_bayar_5_tgl_bapp ? \Carbon\Carbon::parse($kontrak->usul_bayar_5_tgl_bapp)->format('d-m-Y') : '-' }}
                                </td>

                                <td class="px-4 py-3 border-r border-gray-100">
                                    {{ $kontrak->usul_bayar_5_no_bast ?? '-' }}
                                </td>

                                <td class="px-4 py-3 border-r border-gray-100">
                                    {{ $kontrak->usul_bayar_5_tgl_bast ? \Carbon\Carbon::parse($kontrak->usul_bayar_5_tgl_bast)->format('d-m-Y') : '-' }}
                                </td>

                                <td class="px-4 py-3 border-r border-gray-100">
                                    {{ $kontrak->usul_bayar_5_no_submission_id ?? '-' }}
                                </td>

                                <td class="px-4 py-3 border-r border-gray-100">
                                    {{ $kontrak->usul_bayar_5_tgl_submission ? \Carbon\Carbon::parse($kontrak->usul_bayar_5_tgl_submission)->format('d-m-Y') : '-' }}
                                </td>

                                <td class="px-4 py-3 border-r border-gray-100">
                                    Rp {{ number_format($kontrak->usul_bayar_5_nilai  ?? 0, 2, ',', '.') }}
                                </td>

                                <td class="px-4 py-3 border-r border-gray-100">
                                    {{ $kontrak->usul_bayar_5_persentase ?? '-' }}%
                                </td>


                                {{-- GIRO 5 --}}
                                <td class="px-4 py-3 border-r border-gray-100">
                                    {{ $kontrak->giro_5_tanggal ? \Carbon\Carbon::parse($kontrak->giro_5_tanggal)->format('d-m-Y') : '-' }}
                                </td>

                                <td class="px-4 py-3 border-r border-gray-100">
                                    Rp {{ number_format($kontrak->giro_5_nilai  ?? 0, 2, ',', '.') }}
                                </td>


                                {{-- PROGRESS --}}
                                <td class="px-4 py-3 border-r border-gray-100 max-w-xs">
                                    <div class="max-w-xs whitespace-normal">
                                        {{ $kontrak->keterangan ?? '-' }}
                                    </div>
                                </td>

                                <td class="px-4 py-3 border-r border-gray-100">
                                    Rp {{ number_format($kontrak->nilai_sisa  ?? 0, 2, ',', '.') }}
                                </td>

                                <td class="px-4 py-3 border-r border-gray-100 max-w-xs">
                                    <div class="max-w-xs whitespace-normal">
                                        {{ $kontrak->kendala ?? '-' }}
                                    </div>
                                </td>

                                <td class="px-4 py-3 border-r border-gray-100 max-w-xs">
                                    <div class="max-w-xs whitespace-normal">
                                        {{ $kontrak->tindak_lanjut ?? '-' }}
                                    </div>
                                </td>

                                <td class="px-4 py-3 border-r border-gray-100">
                                    {{ $kontrak->persentase_fisik ?? '-' }}%
                                </td>


                                {{-- RINGKASAN --}}
                                <td class="px-4 py-3 border-r border-gray-100">
                                    {{ $kontrak->no_po ?? '-' }}
                                </td>

                                <td class="px-4 py-3 border-r border-gray-100">
                                    Rp {{ number_format($kontrak->total_usul_bayar  ?? 0, 2, ',', '.') }}
                                </td>

                                <td class="px-4 py-3 border-r border-gray-100">
                                    Rp {{ number_format($kontrak->total_giro  ?? 0, 2, ',', '.') }}
                                </td>

                                <td class="px-4 py-3 border-r border-gray-100">
                                    Rp {{ number_format($kontrak->total_outstanding  ?? 0, 2, ',', '.') }}
                                </td>


                                {{-- SAP 100 --}}
                                <td class="px-4 py-3 border-r border-gray-100">
                                    {{ $kontrak->sap_100_no_invoice ?? '-' }}
                                </td>

                                <td class="px-4 py-3 border-r border-gray-100">
                                    {{ $kontrak->sap_100_tanggal ? \Carbon\Carbon::parse($kontrak->sap_100_tanggal)->format('d-m-Y') : '-' }}
                                </td>

                                <td class="px-4 py-3 border-r border-gray-100">
                                    {{ $kontrak->sap_100_no_doc ?? '-' }}
                                </td>


                                {{-- SAP 95 --}}
                                <td class="px-4 py-3 border-r border-gray-100">
                                    {{ $kontrak->sap_95_no_invoice ?? '-' }}
                                </td>

                                <td class="px-4 py-3 border-r border-gray-100">
                                    {{ $kontrak->sap_95_tanggal ? \Carbon\Carbon::parse($kontrak->sap_95_tanggal)->format('d-m-Y') : '-' }}
                                </td>

                                <td class="px-4 py-3 border-r border-gray-100">
                                    {{ $kontrak->sap_95_no_doc ?? '-' }}
                                </td>


                                {{-- SAP 5 --}}
                                <td class="px-4 py-3 border-r border-gray-100">
                                    {{ $kontrak->sap_5_no_invoice ?? '-' }}
                                </td>

                                <td class="px-4 py-3 border-r border-gray-100">
                                    {{ $kontrak->sap_5_tanggal ? \Carbon\Carbon::parse($kontrak->sap_5_tanggal)->format('d-m-Y') : '-' }}
                                </td>

                                <td class="px-4 py-3 border-r border-gray-100">
                                    {{ $kontrak->sap_5_no_doc ?? '-' }}
                                </td>


                                {{-- PENGAWAS --}}
                                <td class="px-4 py-3 border-r border-gray-100">
                                    {{ $kontrak->pengawas ?? '-' }}
                                </td>

                                <td class="px-4 py-3 border-r border-gray-100">
                                    {{ $kontrak->jenis_jtl ?? '-' }}
                                </td>

                                <td class="px-4 py-3 border-r border-gray-100">
                                    {{ $kontrak->metode_kontrak ?? '-' }}
                                </td>


                                {{-- TOTAL KONTRAK --}}
                                <td class="px-4 py-3 border-r border-gray-100">
                                    Rp {{ number_format($kontrak->total_material_terkontrak  ?? 0, 2, ',', '.') }}
                                </td>

                                <td class="px-4 py-3 border-r border-gray-100">
                                    Rp {{ number_format($kontrak->total_jasa_terkontrak  ?? 0, 2, ',', '.') }}
                                </td>

                                <td class="px-4 py-3 border-r border-gray-100">
                                    Rp {{ number_format($kontrak->total_terkontrak  ?? 0, 2, ',', '.') }}
                                </td>

                                <td class="px-4 py-3 border-r border-gray-100">
                                    Rp {{ number_format($kontrak->terkontrak_belum_realisasi  ?? 0, 2, ',', '.') }}
                                </td>

                                <td class="px-4 py-3 border-r border-gray-100">
                                    Rp {{ number_format($kontrak->total_realisasi_material  ?? 0, 2, ',', '.') }}
                                </td>

                                <td class="px-4 py-3 border-r border-gray-100">
                                    Rp {{ number_format($kontrak->total_realisasi_jasa  ?? 0, 2, ',', '.') }}
                                </td>

                                <td class="px-4 py-3 border-r border-gray-100">
                                    Rp {{ number_format($kontrak->total_realisasi_kontrak  ?? 0, 2, ',', '.') }}
                                </td>


                                {{-- TANGGAL DAN PERHITUNGAN --}}
                                <td class="px-4 py-3 border-r border-gray-100">
                                    {{ $kontrak->tgl_bulan_kontrak ?? '-' }}
                                </td>

                                <td class="px-4 py-3 border-r border-gray-100">
                                    {{ $kontrak->tgl_bulan_usul_bayar_100 ?? '-' }}
                                </td>

                                <td class="px-4 py-3 border-r border-gray-100">
                                    {{ $kontrak->tgl_bulan_usul_bayar_95 ?? '-' }}
                                </td>

                                <td class="px-4 py-3 border-r border-gray-100">
                                    {{ $kontrak->tgl_bulan_usul_bayar_5 ?? '-' }}
                                </td>

                                <td class="px-4 py-3 border-r border-gray-100">
                                    {{ $kontrak->selisih_kontrak_realisasi ?? '-' }}
                                </td>

                                <td class="px-4 py-3 border-r border-gray-100">
                                    {{ $kontrak->persentase_pencapaian_kontrak ?? '-' }}%
                                </td>


                                {{-- RENCANA KONTRAK --}}
                                <td class="px-4 py-3 border-r border-gray-100">
                                    Rp {{ number_format($kontrak->rencana_kontrak_rp  ?? 0, 2, ',', '.') }}
                                </td>

                                <td class="px-4 py-3 border-r border-gray-100">
                                    {{ $kontrak->rencana_kontrak_bulan ?? '-' }}
                                </td>


                                {{-- RENCANA 95 --}}
                                <td class="px-4 py-3 border-r border-gray-100">
                                    Rp {{ number_format($kontrak->rencana_usul_bayar_95_rp  ?? 0, 2, ',', '.') }}
                                </td>

                                <td class="px-4 py-3 border-r border-gray-100">
                                    {{ $kontrak->rencana_usul_bayar_95_bulan ?? '-' }}
                                </td>


                                {{-- RENCANA 5 --}}
                                <td class="px-4 py-3 border-r border-gray-100">
                                    Rp {{ number_format($kontrak->rencana_usul_bayar_5_rp  ?? 0, 2, ',', '.') }}
                                </td>

                                <td class="px-4 py-3 border-r border-gray-100">
                                    {{ $kontrak->rencana_usul_bayar_5_bulan ?? '-' }}
                                </td>


                                {{-- RENCANA 100 --}}
                                <td class="px-4 py-3 border-r border-gray-100">
                                    Rp {{ number_format($kontrak->rencana_usul_bayar_100_rp  ?? 0, 2, ',', '.') }}
                                </td>

                                <td class="px-4 py-3 border-r border-gray-100">
                                    {{ $kontrak->rencana_usul_bayar_100_bulan ?? '-' }}
                                </td>


                                {{-- AKSI --}}
                                <td class="px-4 py-3">

                                    <div class="flex items-center justify-center gap-2">

                                        {{-- DETAIL --}}
                                        <a href="{{ route('progres-kontrak.show', $kontrak->id) }}" title="Detail"
                                            class="inline-flex items-center justify-center gap-1.5
                                                   px-3 py-2 rounded-lg
                                                   bg-blue-50 text-pln-blue
                                                   text-xs font-semibold
                                                   hover:bg-blue-100 transition">

                                            <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">

                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0
                                                               3 3 0 016 0z" />

                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943
                                                               7.523 5 12 5
                                                               c4.477 0 8.268 2.943
                                                               9.542 7
                                                               -1.274 4.057-5.065 7
                                                               -9.542 7
                                                               -4.477 0-8.268-2.943
                                                               -9.542-7z" />

                                            </svg>

                                            <span>Lihat</span>

                                        </a>


                                        {{-- EDIT --}}
                                        <a href="{{ route('progres-kontrak.edit', $kontrak->id) }}" title="Edit"
                                            class="inline-flex items-center justify-center gap-1.5
                                                   px-3 py-2 rounded-lg
                                                   bg-yellow-50 text-yellow-600
                                                   text-xs font-semibold
                                                   hover:bg-yellow-100 transition">

                                            <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">

                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11
                                                               a2 2 0 002 2h11
                                                               a2 2 0 002-2v-5" />

                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.5 2.5a2.121 2.121
                                                               0 013 3L12 15l-4 1
                                                               1-4 9.5-9.5z" />

                                            </svg>

                                            <span>Edit</span>

                                        </a>


                                        {{-- DELETE --}}
                                        <form action="{{ route('progres-kontrak.destroy', $kontrak->id) }}"
                                            method="POST" class="inline" onsubmit="return openDeleteModal(this)">

                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" title="Hapus"
                                                class="inline-flex items-center justify-center gap-1.5
                                                        px-3 py-2 rounded-lg
                                                        bg-red-50 text-red-600
                                                        text-xs font-semibold
                                                        hover:bg-red-100 transition">

                                                <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">

                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862
                                                        a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6
                                                        M9 7V4a1 1 0 011-1h4a1 1 0 011 1v3
                                                        M4 7h16" />

                                                </svg>

                                                <span>Hapus</span>

                                            </button>
                                        </form>

                                    </div>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="100" class="px-5 py-16 text-center">

                                    <div class="flex flex-col items-center">

                                        <div
                                            class="w-16 h-16 rounded-full
                                                   bg-blue-50
                                                   flex items-center justify-center
                                                   mb-4">

                                            <svg class="w-8 h-8 text-pln-blue" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">

                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7
                                                               a2 2 0 01-2-2V5
                                                               a2 2 0 012-2h5.586
                                                               a1 1 0 01.707.293
                                                               l5.414 5.414
                                                               A1 1 0 0119 5.707V19
                                                               a2 2 0 01-2 2z" />

                                            </svg>

                                        </div>

                                        <p class="font-semibold text-gray-700">
                                            Belum ada data progres kontrak
                                        </p>

                                        <p class="text-sm text-gray-400 mt-1">
                                            Silakan tambahkan data progres kontrak terlebih dahulu.
                                        </p>

                                        <a href="{{ route('progres-kontrak.create') }}"
                                            class="mt-4 inline-flex items-center
                                                   gap-2 px-4 py-2
                                                   bg-pln-blue text-white
                                                   rounded-lg text-sm font-semibold
                                                   hover:bg-pln-light transition">

                                            + Tambah Progres Kontrak

                                        </a>

                                    </div>

                                </td>

                            </tr>
                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>


    {{-- SEARCH --}}
    <script>
        document.getElementById('searchProgresKontrak').addEventListener('keyup', function() {

            let keyword = this.value.toLowerCase();

            document.querySelectorAll('#tableProgresKontrak tbody tr').forEach(function(row) {

                row.style.display =
                    row.innerText.toLowerCase().includes(keyword) ?
                    '' :
                    'none';

            });

        });
    </script>

@endsection
