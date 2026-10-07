@extends('layouts.app')

@section('title', 'Edit Progres Kontrak')

@section('content')

    <div class="p-4 lg:p-6">

        {{-- HEADER --}}
        <div class="mb-6">

            <div class="flex items-center gap-2 text-sm text-gray-500 mb-2">

                <a href="{{ route('progres-kontrak.index') }}" class="hover:text-[#003082] transition">
                    Progres Kontrak
                </a>

                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">

                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />

                </svg>

                <span class="text-gray-700">
                    Edit Data
                </span>

            </div>

            <h1 class="text-2xl font-bold text-gray-800">
                Edit Progres Kontrak
            </h1>

            <p class="text-sm text-gray-500 mt-1">
                Perbarui data progres kontrak sesuai dokumen yang tersedia.
                Semua kolom boleh dikosongkan.
            </p>

        </div>


        {{-- ERROR --}}
        @if ($errors->any())

            <div class="mb-6 p-4 rounded-xl bg-red-50 border border-red-200">

                <p class="text-sm font-semibold text-red-700">
                    Data belum dapat diperbarui
                </p>

                <ul class="mt-1 list-disc list-inside text-sm text-red-600">

                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach

                </ul>

            </div>

        @endif


        <form action="{{ route('progres-kontrak.update', $progresKontrak->id) }}" method="POST">

            @csrf
            @method('PUT')

            {{-- A. IDENTITAS SKKO --}}
            <div class="form-card">

                <div class="form-card-header">
                    <div class="section-icon bg-[#003082]">
                        <span class="text-white text-lg">▤</span>
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
                            'placeholder' => 'Masukkan nomor atau nama SKKO',
                            'value' => old('skko', $progresKontrak->skko ?? ''),
                        ])

                        @include('progres_kontrak.partials.input', [
                            'name' => 'prk_uid',
                            'label' => 'PRK UID',
                            'placeholder' => 'Masukkan PRK UID',
                            'value' => old('prk_uid', $progresKontrak->prk_uid ?? ''),
                        ])

                        @include('progres_kontrak.partials.input', [
                            'name' => 'prk_lkao',
                            'label' => 'PRK LKAO',
                            'placeholder' => 'Masukkan PRK LKAO',
                            'value' => old('prk_lkao', $progresKontrak->prk_lkao ?? ''),
                        ])

                        @include('progres_kontrak.partials.input', [
                            'name' => 'pekerjaan',
                            'label' => 'Pekerjaan',
                            'placeholder' => 'Masukkan nama pekerjaan',
                            'value' => old('pekerjaan', $progresKontrak->pekerjaan ?? ''),
                        ])

                        @include('progres_kontrak.partials.input', [
                            'name' => 'lokasi',
                            'label' => 'Lokasi',
                            'placeholder' => 'Masukkan lokasi pekerjaan',
                            'value' => old('lokasi', $progresKontrak->lokasi ?? ''),
                        ])

                        @include('progres_kontrak.partials.input', [
                            'name' => 'status_pekerjaan',
                            'label' => 'Status Pekerjaan',
                            'placeholder' => 'Contoh: Berjalan / Selesai',
                            'value' => old('status_pekerjaan', $progresKontrak->status_pekerjaan ?? ''),
                        ])

                        @include('progres_kontrak.partials.input', [
                            'name' => 'status_bayar',
                            'label' => 'Status Bayar',
                            'placeholder' => 'Contoh: Belum Bayar / Lunas',
                            'value' => old('status_bayar', $progresKontrak->status_bayar ?? ''),
                        ])

                        @include('progres_kontrak.partials.input', [
                            'name' => 'waktu',
                            'label' => 'Waktu',
                            'placeholder' => 'Masukkan waktu pekerjaan',
                            'value' => old('waktu', $progresKontrak->waktu ?? ''),
                        ])

                    </div>

                </div>

            </div>


            {{-- B. PROSES KONTRAK --}}
            <div class="form-card">

                <div class="form-card-header">
                    <div class="section-icon bg-blue-100">
                        <span class="text-[#003082] text-lg">▤</span>
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
                            'placeholder' => 'Masukkan nomor kontrak',
                            'value' => old('no_kontrak', $progresKontrak->no_kontrak ?? ''),
                        ])

                        @include('progres_kontrak.partials.input', [
                            'name' => 'pelaksana',
                            'label' => 'Pelaksana',
                            'placeholder' => 'Masukkan nama pelaksana',
                            'value' => old('pelaksana', $progresKontrak->pelaksana ?? ''),
                        ])

                        @include('progres_kontrak.partials.number', [
                            'name' => 'nilai_material_kontrak',
                            'label' => 'Nilai Material Kontrak',
                            'value' => old(
                                'nilai_material_kontrak',
                                $progresKontrak->nilai_material_kontrak ?? ''),
                        ])

                        @include('progres_kontrak.partials.number', [
                            'name' => 'nilai_jasa_kontrak',
                            'label' => 'Nilai Jasa Kontrak',
                            'value' => old('nilai_jasa_kontrak', $progresKontrak->nilai_jasa_kontrak ?? ''),
                        ])

                        @include('progres_kontrak.partials.number', [
                            'name' => 'total_nilai_kontrak',
                            'label' => 'Total Nilai Kontrak',
                            'value' => old('total_nilai_kontrak', $progresKontrak->total_nilai_kontrak ?? ''),
                        ])

                        @include('progres_kontrak.partials.number', [
                            'name' => 'volume_kontrak',
                            'label' => 'Volume Kontrak',
                            'value' => old('volume_kontrak', $progresKontrak->volume_kontrak ?? ''),
                        ])

                        @include('progres_kontrak.partials.date', [
                            'name' => 'tgl_mulai',
                            'label' => 'Tanggal Mulai',
                            'value' => old('tgl_mulai', $progresKontrak->tgl_mulai ?? ''),
                        ])

                        @include('progres_kontrak.partials.date', [
                            'name' => 'tgl_selesai',
                            'label' => 'Tanggal Selesai',
                            'value' => old('tgl_selesai', $progresKontrak->tgl_selesai ?? ''),
                        ])

                    </div>

                </div>

            </div>


            {{-- C. REALISASI --}}
            <div class="form-card">

                <div class="form-card-header">
                    <div class="section-icon bg-blue-100">
                        <span class="text-[#003082] text-lg">↗</span>
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

                        @foreach ([
            'nilai_material_realisasi' => 'Nilai Material Realisasi',
            'nilai_jasa_realisasi' => 'Nilai Jasa Realisasi',
            'total_nilai_realisasi' => 'Total Nilai Realisasi',
            'volume_realisasi' => 'Volume Realisasi',
        ] as $name => $label)
                            @include('progres_kontrak.partials.number', [
                                'name' => $name,
                                'label' => $label,
                                'value' => old($name, $progresKontrak->{$name} ?? ''),
                            ])
                        @endforeach

                    </div>

                </div>

            </div>


            {{-- D. AMANDEMEN WAKTU --}}
            <div class="form-card">

                <div class="form-card-header">
                    <div class="section-icon bg-yellow-50">
                        <span class="text-yellow-600 text-lg">◷</span>
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
                            'placeholder' => 'Masukkan nomor amandemen',
                            'value' => old('amandemen_waktu_nomor', $progresKontrak->amandemen_waktu_nomor ?? ''),
                        ])

                        @include('progres_kontrak.partials.date', [
                            'name' => 'amandemen_waktu_tanggal',
                            'label' => 'Tanggal Amandemen Waktu',
                            'value' => old(
                                'amandemen_waktu_tanggal',
                                $progresKontrak->amandemen_waktu_tanggal ?? ''),
                        ])

                    </div>

                </div>

            </div>


            {{-- E. AMANDEMEN NILAI --}}
            <div class="form-card">

                <div class="form-card-header">
                    <div class="section-icon bg-yellow-50">
                        <span class="text-yellow-600 text-lg">Rp</span>
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
                            'placeholder' => 'Masukkan nomor amandemen',
                            'value' => old('amandemen_nilai_nomor', $progresKontrak->amandemen_nilai_nomor ?? ''),
                        ])

                        @include('progres_kontrak.partials.date', [
                            'name' => 'amandemen_nilai_tanggal',
                            'label' => 'Tanggal Amandemen Nilai',
                            'value' => old(
                                'amandemen_nilai_tanggal',
                                $progresKontrak->amandemen_nilai_tanggal ?? ''),
                        ])

                    </div>

                </div>

            </div>


            {{-- F. PEMBAYARAN --}}
            @foreach (['100', '95', '5'] as $payment)
                @include('progres_kontrak.partials.payment-section', [
                    'title' => "Usul Bayar {$payment}%",
                    'prefix' => $payment,
                    'data' => $progresKontrak,
                ])
            @endforeach


            {{-- GIRO --}}
            @foreach (['100', '95', '5'] as $giro)
                <div class="form-card">

                    <div class="form-card-header">
                        <div class="section-icon bg-green-100">
                            <span class="text-green-700 text-lg">✓</span>
                        </div>

                        <div>
                            <h2 class="section-title">
                                Giro {{ $giro }}%
                            </h2>

                            <p class="section-description">
                                Informasi pencairan giro {{ $giro }}%
                            </p>
                        </div>
                    </div>

                    <div class="form-card-body">

                        <div class="form-grid">

                            @include('progres_kontrak.partials.date', [
                                'name' => "giro_{$giro}_tanggal",
                                'label' => "Tanggal Giro {$giro}%",
                                'value' => old(
                                    "giro_{$giro}_tanggal",
                                    $progresKontrak->{"giro_{$giro}_tanggal"} ?? ''),
                            ])

                            @include('progres_kontrak.partials.number', [
                                'name' => "giro_{$giro}_nilai",
                                'label' => "Nilai Giro {$giro}%",
                                'value' => old(
                                    "giro_{$giro}_nilai",
                                    $progresKontrak->{"giro_{$giro}_nilai"} ?? ''),
                            ])

                        </div>

                    </div>

                </div>
            @endforeach


            {{-- PROGRESS PEKERJAAN --}}
            <div class="form-card">

                <div class="form-card-header">
                    <div class="section-icon bg-purple-100">
                        <span class="text-purple-700 text-lg">☷</span>
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

                        @foreach ([
            'keterangan' => 'Keterangan',
            'kendala' => 'Kendala',
            'tindak_lanjut' => 'Tindak Lanjut',
        ] as $name => $label)
                            @include('progres_kontrak.partials.textarea', [
                                'name' => $name,
                                'label' => $label,
                                'placeholder' => "Masukkan {$label}",
                                'value' => old($name, $progresKontrak->{$name} ?? ''),
                            ])
                        @endforeach

                        @include('progres_kontrak.partials.number', [
                            'name' => 'nilai_sisa',
                            'label' => 'Nilai Sisa',
                            'value' => old('nilai_sisa', $progresKontrak->nilai_sisa ?? ''),
                        ])

                        @include('progres_kontrak.partials.number', [
                            'name' => 'persentase_fisik',
                            'label' => 'Persentase Fisik',
                            'value' => old('persentase_fisik', $progresKontrak->persentase_fisik ?? ''),
                        ])

                    </div>

                </div>

            </div>


            {{-- RINGKASAN PEMBAYARAN --}}
            <div class="form-card">

                <div class="form-card-header">
                    <div class="section-icon bg-green-100">
                        <span class="text-green-700 text-lg">Rp</span>
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
                            'placeholder' => 'Masukkan nomor PO',
                            'value' => old('no_po', $progresKontrak->no_po ?? ''),
                        ])

                        @foreach ([
            'total_usul_bayar' => 'Total Usul Bayar',
            'total_giro' => 'Total Giro',
            'total_outstanding' => 'Total Outstanding',
        ] as $name => $label)
                            @include('progres_kontrak.partials.number', [
                                'name' => $name,
                                'label' => $label,
                                'value' => old($name, $progresKontrak->{$name} ?? ''),
                            ])
                        @endforeach

                    </div>

                </div>

            </div>


            {{-- NOMOR DOKUMEN SAP --}}
            @foreach (['100', '95', '5'] as $sap)
                <div class="form-card">

                    <div class="form-card-header">
                        <div class="section-icon bg-indigo-100">
                            <span class="text-indigo-700 text-lg">▤</span>
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
                                'placeholder' => 'Masukkan nomor invoice',
                                'value' => old(
                                    "sap_{$sap}_no_invoice",
                                    $progresKontrak->{"sap_{$sap}_no_invoice"} ?? ''),
                            ])

                            @include('progres_kontrak.partials.date', [
                                'name' => "sap_{$sap}_tanggal",
                                'label' => "Tanggal SAP {$sap}%",
                                'value' => old(
                                    "sap_{$sap}_tanggal",
                                    $progresKontrak->{"sap_{$sap}_tanggal"} ?? ''),
                            ])

                            @include('progres_kontrak.partials.input', [
                                'name' => "sap_{$sap}_no_doc",
                                'label' => "No. Doc {$sap}%",
                                'placeholder' => 'Masukkan nomor dokumen',
                                'value' => old("sap_{$sap}_no_doc", $progresKontrak->{"sap_{$sap}_no_doc"} ?? ''),
                            ])

                        </div>

                    </div>

                </div>
            @endforeach


            {{-- DATA PENGAWAS --}}
            <div class="form-card">

                <div class="form-card-header">
                    <div class="section-icon bg-blue-100">
                        <span class="text-[#003082] text-lg">♙</span>
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

                        @foreach ([
            'pengawas' => 'Pengawas',
            'jenis_jtl' => 'Jenis JTL',
            'metode_kontrak' => 'Metode Kontrak',
        ] as $name => $label)
                            @include('progres_kontrak.partials.input', [
                                'name' => $name,
                                'label' => $label,
                                'placeholder' => "Masukkan {$label}",
                                'value' => old($name, $progresKontrak->{$name} ?? ''),
                            ])
                        @endforeach

                    </div>

                </div>

            </div>


            {{-- NILAI KONTRAK --}}
            <div class="form-card">

                <div class="form-card-header">
                    <div class="section-icon bg-blue-100">
                        <span class="text-[#003082] text-lg">+</span>
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

                        @foreach ([
            'total_material_terkontrak' => 'Total Material Terkontrak',
            'total_jasa_terkontrak' => 'Total Jasa Terkontrak',
            'total_terkontrak' => 'Total Terkontrak',
            'terkontrak_belum_realisasi' => 'Terkontrak Belum Realisasi',
            'total_realisasi_material' => 'Total Realisasi Material',
            'total_realisasi_jasa' => 'Total Realisasi Jasa',
            'total_realisasi_kontrak' => 'Total Realisasi Kontrak',
        ] as $name => $label)
                            @include('progres_kontrak.partials.number', [
                                'name' => $name,
                                'label' => $label,
                                'value' => old($name, $progresKontrak->{$name} ?? ''),
                            ])
                        @endforeach

                    </div>

                </div>

            </div>


            {{-- TANGGAL DAN PERHITUNGAN --}}
            <div class="form-card">

                <div class="form-card-header">
                    <div class="section-icon bg-purple-100">
                        <span class="text-purple-700 text-lg">▦</span>
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

                        @foreach ([
            'tgl_bulan_kontrak' => 'Tanggal Bulan Kontrak',
            'tgl_bulan_usul_bayar_100' => 'Tanggal Bulan Usul Bayar 100%',
            'tgl_bulan_usul_bayar_95' => 'Tanggal Bulan Usul Bayar 95%',
            'tgl_bulan_usul_bayar_5' => 'Tanggal Bulan Usul Bayar 5%',
        ] as $name => $label)
                            @include('progres_kontrak.partials.date', [
                                'name' => $name,
                                'label' => $label,
                                'value' => old($name, $progresKontrak->{$name} ?? ''),
                            ])
                        @endforeach

                        @foreach ([
            'selisih_kontrak_realisasi' => 'Selisih Kontrak Realisasi',
            'persentase_pencapaian_kontrak' => 'Persentase Pencapaian Kontrak',
        ] as $name => $label)
                            @include('progres_kontrak.partials.number', [
                                'name' => $name,
                                'label' => $label,
                                'value' => old($name, $progresKontrak->{$name} ?? ''),
                            ])
                        @endforeach

                    </div>

                </div>

            </div>


            {{-- RENCANA --}}
            @foreach ([
            [
                'title' => 'Rencana Kontrak',
                'rp' => 'rencana_kontrak_rp',
                'bulan' => 'rencana_kontrak_bulan',
            ],
            [
                'title' => 'Rencana Usul Bayar 95%',
                'rp' => 'rencana_usul_bayar_95_rp',
                'bulan' => 'rencana_usul_bayar_95_bulan',
            ],
            [
                'title' => 'Rencana Usul Bayar 5%',
                'rp' => 'rencana_usul_bayar_5_rp',
                'bulan' => 'rencana_usul_bayar_5_bulan',
            ],
            [
                'title' => 'Rencana Usul Bayar 100%',
                'rp' => 'rencana_usul_bayar_100_rp',
                'bulan' => 'rencana_usul_bayar_100_bulan',
            ],
        ] as $rencana)
                <div class="form-card">

                    <div class="form-card-header">

                        <div class="section-icon bg-yellow-50">
                            <span class="text-yellow-600 text-lg">◷</span>
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
                                'label' => 'Rencana Nilai (Rp)',
                                'value' => old($rencana['rp'], $progresKontrak->{$rencana['rp']} ?? ''),
                            ])

                            @include('progres_kontrak.partials.input', [
                                'name' => $rencana['bulan'],
                                'label' => 'Rencana Bulan',
                                'placeholder' => 'Contoh: September 2026',
                                'value' => old($rencana['bulan'], $progresKontrak->{$rencana['bulan']} ?? ''),
                            ])

                        </div>

                    </div>

                </div>
            @endforeach


            {{-- BUTTON --}}
            <div class="flex flex-col-reverse sm:flex-row
                    items-center justify-end gap-3 mt-6">

                <a href="{{ route('progres-kontrak.index') }}"
                    class="w-full sm:w-auto px-6 py-2.5 rounded-xl
                      border border-gray-200 bg-white text-gray-600
                      text-sm font-semibold text-center
                      hover:bg-gray-50 transition">

                    Batal

                </a>

                <button type="submit"
                    class="w-full sm:w-auto px-6 py-2.5 rounded-xl
                           bg-[#003082] hover:bg-[#0050A4]
                           text-white text-sm font-semibold
                           shadow-sm transition">

                    <span class="inline-flex items-center gap-2">

                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">

                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />

                        </svg>

                        Update Progres Kontrak

                    </span>

                </button>

            </div>

        </form>

    </div>
   <style>

    /* ================================
       FORM LABEL
    ================================= */

    .form-label {
        display: block;
        font-size: 0.875rem;
        font-weight: 600;
        color: #374151;
        margin-bottom: 0.5rem;
    }


    /* ================================
       FORM INPUT
    ================================= */

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
        box-sizing: border-box;
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
    }


    /* ================================
       FORM CARD
    ================================= */

    .form-card {
        background-color: #ffffff;
        border: 1px solid #e5e7eb;
        border-radius: 1rem;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
        overflow: hidden;
        margin-bottom: 1.25rem;
    }


    /* ================================
       HEADER CARD
    ================================= */

    .form-card-header {
        display: flex;
        align-items: center;
        gap: 0.75rem;

        padding: 1.25rem 1.5rem;

        border-bottom: 1px solid #f3f4f6;

        background: linear-gradient(
            to right,
            #eff6ff,
            #ffffff
        );
    }


    /* ================================
       ICON SECTION
    ================================= */

    .section-icon {
        width: 2.5rem;
        height: 2.5rem;
        min-width: 2.5rem;

        border-radius: 0.75rem;

        display: flex;
        align-items: center;
        justify-content: center;
    }


    /* ================================
       TITLE SECTION
    ================================= */

    .section-title {
        font-size: 1rem;
        font-weight: 700;
        color: #1f2937;
        line-height: 1.4;
    }

    .section-description {
        font-size: 0.75rem;
        color: #6b7280;
        margin-top: 0.125rem;
    }


    /* ================================
       BODY CARD
    ================================= */

    .form-card-body {
        padding: 1.5rem;
    }


    /* ================================
       FORM GRID
    ================================= */

    .form-grid {
        display: grid;
        grid-template-columns: repeat(1, minmax(0, 1fr));
        gap: 1.25rem;
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


    /* ================================
       MOBILE
    ================================= */

    @media (max-width: 640px) {

        .form-card-header {
            padding: 1rem;
        }

        .form-card-body {
            padding: 1rem;
        }

        .form-grid {
            gap: 1rem;
        }

    }

</style>
@endsection
