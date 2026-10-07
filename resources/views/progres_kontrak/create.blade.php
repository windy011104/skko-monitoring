@extends('layouts.app')

@section('title', 'Tambah Progres Kontrak')

@section('content')

<div class="p-4 lg:p-6">

    {{-- HEADER --}}
    <div class="mb-6">

        <div class="flex items-center gap-2 text-sm text-gray-500 mb-2">

            <a href="{{ route('progres-kontrak.index') }}"
               class="hover:text-[#003082] transition">
                Progres Kontrak
            </a>

            <svg class="w-4 h-4"
                 fill="none"
                 stroke="currentColor"
                 viewBox="0 0 24 24">
                <path stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M9 5l7 7-7 7"/>
            </svg>

            <span class="text-gray-700">
                Tambah Data
            </span>

        </div>

        <h1 class="text-2xl font-bold text-gray-800">
            Tambah Progres Kontrak
        </h1>

        <p class="text-sm text-gray-500 mt-1">
            Masukkan data progres kontrak sesuai dokumen yang tersedia.
            Semua kolom boleh dikosongkan.
        </p>

    </div>


    {{-- ERROR --}}
    @if($errors->any())

        <div class="mb-6 p-4 rounded-xl bg-red-50 border border-red-200">

            <div class="flex gap-3">

                <div class="flex-shrink-0">
                    <div class="w-8 h-8 rounded-full bg-red-100
                                flex items-center justify-center">

                        <svg class="w-4 h-4 text-red-600"
                             fill="none"
                             stroke="currentColor"
                             viewBox="0 0 24 24">

                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="2"
                                  d="M12 8v4m0 4h.01M21 12
                                     a9 9 0 11-18 0 9 9 0 0118 0z"/>

                        </svg>

                    </div>
                </div>

                <div>

                    <p class="text-sm font-semibold text-red-700">
                        Data belum dapat disimpan
                    </p>

                    <ul class="mt-1 list-disc list-inside
                               text-sm text-red-600">

                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach

                    </ul>

                </div>

            </div>

        </div>

    @endif


    <form action="{{ route('progres-kontrak.store') }}"
          method="POST">

        @csrf


        {{-- ================================================= --}}
        {{-- A. IDENTITAS SKKO --}}
        {{-- ================================================= --}}

        <div class="form-card">

            <div class="form-card-header">

                <div class="section-icon bg-[#003082]">

                    <svg class="w-5 h-5 text-white"
                         fill="none"
                         stroke="currentColor"
                         viewBox="0 0 24 24">

                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M9 12h6m-6 4h6m2 5H7
                                 a2 2 0 01-2-2V5
                                 a2 2 0 012-2h5.586
                                 a1 1 0 01.707.293
                                 l5.414 5.414
                                 A1 1 0 0119 5.707V19
                                 a2 2 0 01-2 2z"/>

                    </svg>

                </div>

                <div>

                    <h2 class="section-title">
                        Identitas SKKO
                    </h2>

                    <p class="section-description">
                        Informasi dasar dan identitas pekerjaan SKKO
                    </p>

                </div>

            </div>

            <div class="form-card-body">

                <div class="form-grid">

                    @include('progres_kontrak.partials.input', [
                        'name' => 'skko',
                        'label' => 'SKKO',
                        'placeholder' => 'Masukkan nomor atau nama SKKO'
                    ])

                    @include('progres_kontrak.partials.input', [
                        'name' => 'prk_uid',
                        'label' => 'PRK UID',
                        'placeholder' => 'Masukkan PRK UID'
                    ])

                    @include('progres_kontrak.partials.input', [
                        'name' => 'prk_lkao',
                        'label' => 'PRK LKAO',
                        'placeholder' => 'Masukkan PRK LKAO'
                    ])

                    @include('progres_kontrak.partials.input', [
                        'name' => 'pekerjaan',
                        'label' => 'Pekerjaan',
                        'placeholder' => 'Masukkan nama pekerjaan'
                    ])

                    @include('progres_kontrak.partials.input', [
                        'name' => 'lokasi',
                        'label' => 'Lokasi',
                        'placeholder' => 'Masukkan lokasi pekerjaan'
                    ])

                    @include('progres_kontrak.partials.input', [
                        'name' => 'status_pekerjaan',
                        'label' => 'Status Pekerjaan',
                        'placeholder' => 'Contoh: Berjalan / Selesai'
                    ])

                    @include('progres_kontrak.partials.input', [
                        'name' => 'status_bayar',
                        'label' => 'Status Bayar',
                        'placeholder' => 'Contoh: Belum Bayar / Lunas'
                    ])

                    @include('progres_kontrak.partials.input', [
                        'name' => 'waktu',
                        'label' => 'Waktu',
                        'placeholder' => 'Masukkan waktu pekerjaan'
                    ])

                </div>

            </div>

        </div>


        {{-- ================================================= --}}
        {{-- B. PROSES KONTRAK --}}
        {{-- ================================================= --}}

        <div class="form-card">

            <div class="form-card-header">

                <div class="section-icon bg-blue-100">

                    <svg class="w-5 h-5 text-[#003082]"
                         fill="none"
                         stroke="currentColor"
                         viewBox="0 0 24 24">

                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M9 7h6m-6 4h6m-6 4h6
                                 M5 21h14a2 2 0 002-2V5
                                 a2 2 0 00-2-2H5
                                 a2 2 0 00-2 2v14
                                 a2 2 0 002 2z"/>

                    </svg>

                </div>

                <div>

                    <h2 class="section-title">
                        Proses Kontrak
                    </h2>

                    <p class="section-description">
                        Informasi kontrak dan nilai pekerjaan
                    </p>

                </div>

            </div>

            <div class="form-card-body">

                <div class="form-grid">

                    @include('progres_kontrak.partials.input', [
                        'name' => 'no_kontrak',
                        'label' => 'No. Kontrak',
                        'placeholder' => 'Masukkan nomor kontrak'
                    ])

                    @include('progres_kontrak.partials.input', [
                        'name' => 'pelaksana',
                        'label' => 'Pelaksana',
                        'placeholder' => 'Masukkan nama pelaksana'
                    ])

                    @include('progres_kontrak.partials.number', [
                        'name' => 'nilai_material_kontrak',
                        'label' => 'Nilai Material Kontrak'
                    ])

                    @include('progres_kontrak.partials.number', [
                        'name' => 'nilai_jasa_kontrak',
                        'label' => 'Nilai Jasa Kontrak'
                    ])

                    @include('progres_kontrak.partials.number', [
                        'name' => 'total_nilai_kontrak',
                        'label' => 'Total Nilai Kontrak'
                    ])

                    @include('progres_kontrak.partials.number', [
                        'name' => 'volume_kontrak',
                        'label' => 'Volume Kontrak'
                    ])

                    @include('progres_kontrak.partials.date', [
                        'name' => 'tgl_mulai',
                        'label' => 'Tanggal Mulai'
                    ])

                    @include('progres_kontrak.partials.date', [
                        'name' => 'tgl_selesai',
                        'label' => 'Tanggal Selesai'
                    ])

                </div>

            </div>

        </div>


        {{-- ================================================= --}}
        {{-- C. REALISASI --}}
        {{-- ================================================= --}}

        <div class="form-card">

            <div class="form-card-header">

                <div class="section-icon bg-blue-100">

                    <svg class="w-5 h-5 text-[#003082]"
                         fill="none"
                         stroke="currentColor"
                         viewBox="0 0 24 24">

                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M3 12h4l3 8 4-16 3 8h4"/>

                    </svg>

                </div>

                <div>

                    <h2 class="section-title">
                        Realisasi
                    </h2>

                    <p class="section-description">
                        Data realisasi material, jasa, dan volume
                    </p>

                </div>

            </div>

            <div class="form-card-body">

                <div class="form-grid">

                    @include('progres_kontrak.partials.number', [
                        'name' => 'nilai_material_realisasi',
                        'label' => 'Nilai Material Realisasi'
                    ])

                    @include('progres_kontrak.partials.number', [
                        'name' => 'nilai_jasa_realisasi',
                        'label' => 'Nilai Jasa Realisasi'
                    ])

                    @include('progres_kontrak.partials.number', [
                        'name' => 'total_nilai_realisasi',
                        'label' => 'Total Nilai Realisasi'
                    ])

                    @include('progres_kontrak.partials.number', [
                        'name' => 'volume_realisasi',
                        'label' => 'Volume Realisasi'
                    ])

                </div>

            </div>

        </div>


        {{-- ================================================= --}}
        {{-- D. AMANDEMEN WAKTU --}}
        {{-- ================================================= --}}

        <div class="form-card">

            <div class="form-card-header">

                <div class="section-icon bg-yellow-50 border border-yellow-100">

                    <svg class="w-5 h-5 text-yellow-600"
                         fill="none"
                         stroke="currentColor"
                         viewBox="0 0 24 24">

                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M12 8v4l3 2m6-2
                                 a9 9 0 11-18 0
                                 a9 9 0 0118 0z"/>

                    </svg>

                </div>

                <div>

                    <h2 class="section-title">
                        Amandemen Waktu
                    </h2>

                    <p class="section-description">
                        Data perubahan waktu kontrak
                    </p>

                </div>

            </div>

            <div class="form-card-body">

                <div class="form-grid">

                    @include('progres_kontrak.partials.input', [
                        'name' => 'amandemen_waktu_nomor',
                        'label' => 'Nomor Amandemen Waktu',
                        'placeholder' => 'Masukkan nomor amandemen'
                    ])

                    @include('progres_kontrak.partials.date', [
                        'name' => 'amandemen_waktu_tanggal',
                        'label' => 'Tanggal Amandemen Waktu'
                    ])

                </div>

            </div>

        </div>


        {{-- ================================================= --}}
        {{-- E. AMANDEMEN NILAI --}}
        {{-- ================================================= --}}

        <div class="form-card">

            <div class="form-card-header">

                <div class="section-icon bg-yellow-50 border border-yellow-100">

                    <svg class="w-5 h-5 text-yellow-600"
                         fill="none"
                         stroke="currentColor"
                         viewBox="0 0 24 24">

                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M12 8c-2.2 0-4 1.1-4 2.5S9.8 13 12 13
                                 s4 1.1 4 2.5S14.2 18 12 18
                                 m0-13v14"/>

                    </svg>

                </div>

                <div>

                    <h2 class="section-title">
                        Amandemen Nilai
                    </h2>

                    <p class="section-description">
                        Data perubahan nilai kontrak
                    </p>

                </div>

            </div>

            <div class="form-card-body">

                <div class="form-grid">

                    @include('progres_kontrak.partials.input', [
                        'name' => 'amandemen_nilai_nomor',
                        'label' => 'Nomor Amandemen Nilai',
                        'placeholder' => 'Masukkan nomor amandemen'
                    ])

                    @include('progres_kontrak.partials.date', [
                        'name' => 'amandemen_nilai_tanggal',
                        'label' => 'Tanggal Amandemen Nilai'
                    ])

                </div>

            </div>

        </div>


        {{-- ================================================= --}}
        {{-- F. USUL BAYAR 100% --}}
        {{-- ================================================= --}}

        @include('progres_kontrak.partials.payment-section', [
            'title' => 'Usul Bayar 100%',
            'prefix' => '100'
        ])


        {{-- ================================================= --}}
        {{-- GIRO 100% --}}
        {{-- ================================================= --}}

        <div class="form-card">

            <div class="form-card-header">

                <div class="section-icon bg-green-100">

                    <svg class="w-5 h-5 text-green-700"
                         fill="none"
                         stroke="currentColor"
                         viewBox="0 0 24 24">

                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M5 13l4 4L19 7"/>

                    </svg>

                </div>

                <div>

                    <h2 class="section-title">
                        Giro 100%
                    </h2>

                    <p class="section-description">
                        Informasi pencairan giro 100%
                    </p>

                </div>

            </div>

            <div class="form-card-body">

                <div class="form-grid">

                    @include('progres_kontrak.partials.date', [
                        'name' => 'giro_100_tanggal',
                        'label' => 'Tanggal Giro 100%'
                    ])

                    @include('progres_kontrak.partials.number', [
                        'name' => 'giro_100_nilai',
                        'label' => 'Nilai Giro 100%'
                    ])

                </div>

            </div>

        </div>


        {{-- ================================================= --}}
        {{-- G. USUL BAYAR 95% --}}
        {{-- ================================================= --}}

        @include('progres_kontrak.partials.payment-section', [
            'title' => 'Usul Bayar 95%',
            'prefix' => '95'
        ])


        {{-- ================================================= --}}
        {{-- GIRO 95% --}}
        {{-- ================================================= --}}

        <div class="form-card">

            <div class="form-card-header">

                <div class="section-icon bg-green-100">

                    <svg class="w-5 h-5 text-green-700"
                         fill="none"
                         stroke="currentColor"
                         viewBox="0 0 24 24">

                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M5 13l4 4L19 7"/>

                    </svg>

                </div>

                <div>

                    <h2 class="section-title">
                        Giro 95%
                    </h2>

                    <p class="section-description">
                        Informasi pencairan giro 95%
                    </p>

                </div>

            </div>

            <div class="form-card-body">

                <div class="form-grid">

                    @include('progres_kontrak.partials.date', [
                        'name' => 'giro_95_tanggal',
                        'label' => 'Tanggal Giro 95%'
                    ])

                    @include('progres_kontrak.partials.number', [
                        'name' => 'giro_95_nilai',
                        'label' => 'Nilai Giro 95%'
                    ])

                </div>

            </div>

        </div>


        {{-- ================================================= --}}
        {{-- H. USUL BAYAR 5% --}}
        {{-- ================================================= --}}

        @include('progres_kontrak.partials.payment-section', [
            'title' => 'Usul Bayar 5%',
            'prefix' => '5'
        ])


        {{-- ================================================= --}}
        {{-- GIRO 5% --}}
        {{-- ================================================= --}}

        <div class="form-card">

            <div class="form-card-header">

                <div class="section-icon bg-green-100">

                    <svg class="w-5 h-5 text-green-700"
                         fill="none"
                         stroke="currentColor"
                         viewBox="0 0 24 24">

                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M5 13l4 4L19 7"/>

                    </svg>

                </div>

                <div>

                    <h2 class="section-title">
                        Giro 5%
                    </h2>

                    <p class="section-description">
                        Informasi pencairan giro 5%
                    </p>

                </div>

            </div>

            <div class="form-card-body">

                <div class="form-grid">

                    @include('progres_kontrak.partials.date', [
                        'name' => 'giro_5_tanggal',
                        'label' => 'Tanggal Giro 5%'
                    ])

                    @include('progres_kontrak.partials.number', [
                        'name' => 'giro_5_nilai',
                        'label' => 'Nilai Giro 5%'
                    ])

                </div>

            </div>

        </div>


        {{-- ================================================= --}}
        {{-- I. PROGRESS PEKERJAAN --}}
        {{-- ================================================= --}}

        <div class="form-card">

            <div class="form-card-header">

                <div class="section-icon bg-purple-100">

                    <svg class="w-5 h-5 text-purple-700"
                         fill="none"
                         stroke="currentColor"
                         viewBox="0 0 24 24">

                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M3 6h18M3 12h18M3 18h18"/>

                    </svg>

                </div>

                <div>

                    <h2 class="section-title">
                        Progress Pekerjaan
                    </h2>

                    <p class="section-description">
                        Informasi perkembangan, kendala, dan tindak lanjut
                    </p>

                </div>

            </div>

            <div class="form-card-body">

                <div class="form-grid">

                    @include('progres_kontrak.partials.textarea', [
                        'name' => 'keterangan',
                        'label' => 'Keterangan',
                        'placeholder' => 'Masukkan keterangan pekerjaan'
                    ])

                    @include('progres_kontrak.partials.number', [
                        'name' => 'nilai_sisa',
                        'label' => 'Nilai Sisa'
                    ])

                    @include('progres_kontrak.partials.textarea', [
                        'name' => 'kendala',
                        'label' => 'Kendala',
                        'placeholder' => 'Masukkan kendala pekerjaan'
                    ])

                    @include('progres_kontrak.partials.textarea', [
                        'name' => 'tindak_lanjut',
                        'label' => 'Tindak Lanjut',
                        'placeholder' => 'Masukkan tindak lanjut'
                    ])

                    @include('progres_kontrak.partials.number', [
                        'name' => 'persentase_fisik',
                        'label' => 'Persentase Fisik',
                        'placeholder' => 'Contoh: 75'
                    ])

                </div>

            </div>

        </div>


        {{-- ================================================= --}}
        {{-- J. RINGKASAN PEMBAYARAN --}}
        {{-- ================================================= --}}

        <div class="form-card">

            <div class="form-card-header">

                <div class="section-icon bg-green-100">

                    <svg class="w-5 h-5 text-green-700"
                         fill="none"
                         stroke="currentColor"
                         viewBox="0 0 24 24">

                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M12 8c-2.2 0-4 1.1-4 2.5S9.8 13 12 13
                                 s4 1.1 4 2.5S14.2 18 12 18
                                 m0-13v14"/>

                    </svg>

                </div>

                <div>

                    <h2 class="section-title">
                        Ringkasan Pembayaran
                    </h2>

                    <p class="section-description">
                        Ringkasan nilai usul bayar, giro, dan outstanding
                    </p>

                </div>

            </div>

            <div class="form-card-body">

                <div class="form-grid">

                    @include('progres_kontrak.partials.input', [
                        'name' => 'no_po',
                        'label' => 'No. PO',
                        'placeholder' => 'Masukkan nomor PO'
                    ])

                    @include('progres_kontrak.partials.number', [
                        'name' => 'total_usul_bayar',
                        'label' => 'Total Usul Bayar'
                    ])

                    @include('progres_kontrak.partials.number', [
                        'name' => 'total_giro',
                        'label' => 'Total Giro'
                    ])

                    @include('progres_kontrak.partials.number', [
                        'name' => 'total_outstanding',
                        'label' => 'Total Outstanding'
                    ])

                </div>

            </div>

        </div>


        {{-- ================================================= --}}
        {{-- K. NOMOR DOKUMEN SAP --}}
        {{-- ================================================= --}}

        @foreach(['100', '95', '5'] as $sap)

            <div class="form-card">

                <div class="form-card-header">

                    <div class="section-icon bg-indigo-100">

                        <svg class="w-5 h-5 text-indigo-700"
                             fill="none"
                             stroke="currentColor"
                             viewBox="0 0 24 24">

                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="2"
                                  d="M9 12h6m-6 4h6m2 5H7
                                     a2 2 0 01-2-2V5
                                     a2 2 0 012-2h5.586
                                     a1 1 0 01.707.293
                                     l5.414 5.414
                                     A1 1 0 0119 5.707V19
                                     a2 2 0 01-2 2z"/>

                        </svg>

                    </div>

                    <div>

                        <h2 class="section-title">
                            Nomor Dokumen SAP {{ $sap }}%
                        </h2>

                        <p class="section-description">
                            Informasi invoice dan dokumen SAP
                        </p>

                    </div>

                </div>

                <div class="form-card-body">

                    <div class="form-grid">

                        @include('progres_kontrak.partials.input', [
                            'name' => "sap_{$sap}_no_invoice",
                            'label' => "No. Invoice {$sap}%",
                            'placeholder' => 'Masukkan nomor invoice'
                        ])

                        @include('progres_kontrak.partials.date', [
                            'name' => "sap_{$sap}_tanggal",
                            'label' => "Tanggal SAP {$sap}%"
                        ])

                        @include('progres_kontrak.partials.input', [
                            'name' => "sap_{$sap}_no_doc",
                            'label' => "No. Doc {$sap}%",
                            'placeholder' => 'Masukkan nomor dokumen'
                        ])

                    </div>

                </div>

            </div>

        @endforeach


        {{-- ================================================= --}}
        {{-- L. DATA PENGAWAS DAN KONTRAK --}}
        {{-- ================================================= --}}

        <div class="form-card">

            <div class="form-card-header">

                <div class="section-icon bg-blue-100">

                    <svg class="w-5 h-5 text-[#003082]"
                         fill="none"
                         stroke="currentColor"
                         viewBox="0 0 24 24">

                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M16 21v-2a4 4 0 00-4-4H6
                                 a4 4 0 00-4 4v2
                                 M9 11a4 4 0 100-8 4 4 0 000 8
                                 M22 21v-2a4 4 0 00-3-3.87
                                 M16 3.13a4 4 0 010 7.75"/>

                    </svg>

                </div>

                <div>

                    <h2 class="section-title">
                        Data Pengawas dan Kontrak
                    </h2>

                    <p class="section-description">
                        Informasi pengawas, jenis JTL, dan metode kontrak
                    </p>

                </div>

            </div>

            <div class="form-card-body">

                <div class="form-grid">

                    @include('progres_kontrak.partials.input', [
                        'name' => 'pengawas',
                        'label' => 'Pengawas',
                        'placeholder' => 'Masukkan nama pengawas'
                    ])

                    @include('progres_kontrak.partials.input', [
                        'name' => 'jenis_jtl',
                        'label' => 'Jenis JTL',
                        'placeholder' => 'Masukkan jenis JTL'
                    ])

                    @include('progres_kontrak.partials.input', [
                        'name' => 'metode_kontrak',
                        'label' => 'Metode Kontrak',
                        'placeholder' => 'Masukkan metode kontrak'
                    ])

                </div>

            </div>

        </div>


        {{-- ================================================= --}}
        {{-- M. NILAI KONTRAK DAN REALISASI --}}
        {{-- ================================================= --}}

        <div class="form-card">

            <div class="form-card-header">

                <div class="section-icon bg-blue-100">

                    <svg class="w-5 h-5 text-[#003082]"
                         fill="none"
                         stroke="currentColor"
                         viewBox="0 0 24 24">

                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M3 12h18M12 3v18"/>

                    </svg>

                </div>

                <div>

                    <h2 class="section-title">
                        Nilai Kontrak dan Realisasi
                    </h2>

                    <p class="section-description">
                        Rincian nilai kontrak dan nilai realisasi
                    </p>

                </div>

            </div>

            <div class="form-card-body">

                <div class="form-grid">

                    @foreach([
                        'total_material_terkontrak' => 'Total Material Terkontrak',
                        'total_jasa_terkontrak' => 'Total Jasa Terkontrak',
                        'total_terkontrak' => 'Total Terkontrak',
                        'terkontrak_belum_realisasi' => 'Terkontrak Belum Realisasi',
                        'total_realisasi_material' => 'Total Realisasi Material',
                        'total_realisasi_jasa' => 'Total Realisasi Jasa',
                        'total_realisasi_kontrak' => 'Total Realisasi Kontrak'
                    ] as $name => $label)

                        @include('progres_kontrak.partials.number', [
                            'name' => $name,
                            'label' => $label
                        ])

                    @endforeach

                </div>

            </div>

        </div>


        {{-- ================================================= --}}
        {{-- N. TANGGAL DAN PERHITUNGAN --}}
        {{-- ================================================= --}}

        <div class="form-card">

            <div class="form-card-header">

                <div class="section-icon bg-purple-100">

                    <svg class="w-5 h-5 text-purple-700"
                         fill="none"
                         stroke="currentColor"
                         viewBox="0 0 24 24">

                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M8 7V3m8 4V3m-9 8h10
                                 M5 21h14a2 2 0 002-2V7
                                 a2 2 0 00-2-2H5
                                 a2 2 0 00-2 2v12
                                 a2 2 0 002 2z"/>

                    </svg>

                </div>

                <div>

                    <h2 class="section-title">
                        Tanggal dan Perhitungan
                    </h2>

                    <p class="section-description">
                        Informasi tanggal dan hasil perhitungan kontrak
                    </p>

                </div>

            </div>

            <div class="form-card-body">

                <div class="form-grid">

                    @foreach([
                        'tgl_bulan_kontrak' => 'Tanggal Bulan Kontrak',
                        'tgl_bulan_usul_bayar_100' => 'Tanggal Bulan Usul Bayar 100%',
                        'tgl_bulan_usul_bayar_95' => 'Tanggal Bulan Usul Bayar 95%',
                        'tgl_bulan_usul_bayar_5' => 'Tanggal Bulan Usul Bayar 5%'
                    ] as $name => $label)

                        @include('progres_kontrak.partials.date', [
                            'name' => $name,
                            'label' => $label
                        ])

                    @endforeach

                    @include('progres_kontrak.partials.number', [
                        'name' => 'selisih_kontrak_realisasi',
                        'label' => 'Selisih Kontrak Realisasi'
                    ])

                    @include('progres_kontrak.partials.number', [
                        'name' => 'persentase_pencapaian_kontrak',
                        'label' => 'Persentase Pencapaian Kontrak'
                    ])

                </div>

            </div>

        </div>


        {{-- ================================================= --}}
        {{-- O - R. RENCANA --}}
        {{-- ================================================= --}}

        @foreach([
            [
                'title' => 'Rencana Kontrak',
                'rp' => 'rencana_kontrak_rp',
                'bulan' => 'rencana_kontrak_bulan'
            ],
            [
                'title' => 'Rencana Usul Bayar 95%',
                'rp' => 'rencana_usul_bayar_95_rp',
                'bulan' => 'rencana_usul_bayar_95_bulan'
            ],
            [
                'title' => 'Rencana Usul Bayar 5%',
                'rp' => 'rencana_usul_bayar_5_rp',
                'bulan' => 'rencana_usul_bayar_5_bulan'
            ],
            [
                'title' => 'Rencana Usul Bayar 100%',
                'rp' => 'rencana_usul_bayar_100_rp',
                'bulan' => 'rencana_usul_bayar_100_bulan'
            ]
        ] as $rencana)

            <div class="form-card">

                <div class="form-card-header">

                    <div class="section-icon bg-yellow-50 border border-yellow-100">

                        <svg class="w-5 h-5 text-yellow-600"
                             fill="none"
                             stroke="currentColor"
                             viewBox="0 0 24 24">

                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="2"
                                  d="M12 8v4l3 2m6-2
                                     a9 9 0 11-18 0
                                     a9 9 0 0118 0z"/>

                        </svg>

                    </div>

                    <div>

                        <h2 class="section-title">
                            {{ $rencana['title'] }}
                        </h2>

                        <p class="section-description">
                            Rencana nilai dan bulan pembayaran
                        </p>

                    </div>

                </div>

                <div class="form-card-body">

                    <div class="form-grid">

                        @include('progres_kontrak.partials.number', [
                            'name' => $rencana['rp'],
                            'label' => 'Rencana Nilai (Rp)'
                        ])

                        @include('progres_kontrak.partials.input', [
                            'name' => $rencana['bulan'],
                            'label' => 'Rencana Bulan',
                            'placeholder' => 'Contoh: September 2026'
                        ])

                    </div>

                </div>

            </div>

        @endforeach


        {{-- BUTTON --}}
        <div class="flex flex-col-reverse sm:flex-row
                    items-center justify-end gap-3 mt-6">

            <a href="{{ route('progres-kontrak.index') }}"
               class="w-full sm:w-auto px-6 py-2.5
                      rounded-xl border border-gray-200
                      bg-white text-gray-600 text-sm font-semibold
                      text-center hover:bg-gray-50 transition">

                Batal

            </a>

            <button type="submit"
                    class="w-full sm:w-auto px-6 py-2.5
                           rounded-xl bg-[#003082]
                           hover:bg-[#0050A4]
                           text-white text-sm font-semibold
                           shadow-sm transition">

                <span class="inline-flex items-center gap-2">

                    <svg class="w-4 h-4"
                         fill="none"
                         stroke="currentColor"
                         viewBox="0 0 24 24">

                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M5 13l4 4L19 7"/>

                    </svg>

                    Simpan Progres Kontrak

                </span>

            </button>

        </div>

    </form>

</div>


{{-- STYLE --}}
<style>

    .form-card {
        background-color: #ffffff;
        border: 1px solid #e5e7eb;
        border-radius: 1rem;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.04);
        overflow: hidden;
        margin-bottom: 1.25rem;
    }

    .form-card-header {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        padding: 1.25rem 1.5rem;
        border-bottom: 1px solid #f3f4f6;
        background: linear-gradient(to right, #eff6ff, #ffffff);
    }

    .section-icon {
        width: 2.5rem;
        height: 2.5rem;
        border-radius: 0.75rem;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .section-title {
        font-weight: 700;
        color: #1f2937;
    }

    .section-description {
        font-size: 0.75rem;
        color: #6b7280;
        margin-top: 0.125rem;
    }

    .form-card-body {
        padding: 1.5rem;
    }

    .form-grid {
        display: grid;
        grid-template-columns: repeat(1, minmax(0, 1fr));
        gap: 1.25rem;
    }

    .form-label {
        display: block;
        font-size: 0.875rem;
        font-weight: 600;
        color: #374151;
        margin-bottom: 0.5rem;
    }

    .form-input {
        width: 100%;
        padding: 0.7rem 0.85rem;
        border: 1px solid #e5e7eb;
        border-radius: 0.75rem;
        background-color: #ffffff;
        color: #1f2937;
        font-size: 0.875rem;
        outline: none;
        transition: all 0.2s ease;
    }

    .form-input::placeholder {
        color: #9ca3af;
    }

    .form-input:hover {
        border-color: #cbd5e1;
    }

    .form-input:focus {
        border-color: #003082;
        box-shadow: 0 0 0 3px rgba(0, 48, 130, 0.08);
    }

    textarea.form-input {
        line-height: 1.5;
        resize: vertical;
    }

    @media (min-width: 768px) {
        .form-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
    }

    @media (min-width: 1024px) {
        .form-grid {
            grid-template-columns: repeat(3, minmax(0, 1fr));
        }
    }

</style>

@endsection
