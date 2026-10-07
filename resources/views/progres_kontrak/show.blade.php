@extends('layouts.app')

@section('title', 'Detail Progres Kontrak')

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
                Detail Data
            </span>

        </div>

        <div class="flex flex-col sm:flex-row sm:items-center
                    sm:justify-between gap-4">

            <div>
                <h1 class="text-2xl font-bold text-gray-800">
                    Detail Progres Kontrak
                </h1>

                <p class="text-sm text-gray-500 mt-1">
                    Informasi lengkap data progres kontrak.
                </p>
            </div>

            <div class="flex gap-2">

                <a href="{{ route('progres-kontrak.index') }}"
                   class="px-4 py-2 rounded-xl border border-gray-200
                          bg-white text-gray-600 text-sm font-semibold
                          hover:bg-gray-50 transition">

                    Kembali

                </a>

                <a href="{{ route('progres-kontrak.edit', $progresKontrak->id) }}"
                   class="px-4 py-2 rounded-xl bg-[#003082]
                          text-white text-sm font-semibold
                          hover:bg-[#0050A4] transition">

                    Edit Data

                </a>

            </div>

        </div>

    </div>


    {{-- IDENTITAS SKKO --}}
    <div class="detail-card">

        <div class="detail-header">
            <h2>Identitas SKKO</h2>
            <p>Informasi dasar dan identitas pekerjaan SKKO</p>
        </div>

        <div class="detail-grid">

            @foreach([
                'skko' => 'SKKO',
                'prk_uid' => 'PRK UID',
                'prk_lkao' => 'PRK LKAO',
                'pekerjaan' => 'Pekerjaan',
                'lokasi' => 'Lokasi',
                'status_pekerjaan' => 'Status Pekerjaan',
                'status_bayar' => 'Status Bayar',
                'waktu' => 'Waktu'
            ] as $name => $label)

                <div>
                    <span class="detail-label">
                        {{ $label }}
                    </span>

                    <span class="detail-value">
                        {{ $progresKontrak->{$name} ?: '-' }}
                    </span>
                </div>

            @endforeach

        </div>

    </div>


    {{-- PROSES KONTRAK --}}
    <div class="detail-card">

        <div class="detail-header">
            <h2>Proses Kontrak</h2>
            <p>Informasi kontrak dan nilai pekerjaan</p>
        </div>

        <div class="detail-grid">

            @foreach([
                'no_kontrak' => 'No. Kontrak',
                'pelaksana' => 'Pelaksana',
                'nilai_material_kontrak' => 'Nilai Material Kontrak',
                'nilai_jasa_kontrak' => 'Nilai Jasa Kontrak',
                'total_nilai_kontrak' => 'Total Nilai Kontrak',
                'volume_kontrak' => 'Volume Kontrak',
                'tgl_mulai' => 'Tanggal Mulai',
                'tgl_selesai' => 'Tanggal Selesai'
            ] as $name => $label)

                <div>
                    <span class="detail-label">
                        {{ $label }}
                    </span>

                    <span class="detail-value">
                        {{ $progresKontrak->{$name} ?: '-' }}
                    </span>
                </div>

            @endforeach

        </div>

    </div>


    {{-- REALISASI --}}
    <div class="detail-card">

        <div class="detail-header">
            <h2>Realisasi</h2>
            <p>Data realisasi material, jasa, dan volume</p>
        </div>

        <div class="detail-grid">

            @foreach([
                'nilai_material_realisasi' => 'Nilai Material Realisasi',
                'nilai_jasa_realisasi' => 'Nilai Jasa Realisasi',
                'total_nilai_realisasi' => 'Total Nilai Realisasi',
                'volume_realisasi' => 'Volume Realisasi'
            ] as $name => $label)

                <div>
                    <span class="detail-label">
                        {{ $label }}
                    </span>

                    <span class="detail-value">
                        {{ $progresKontrak->{$name} ?: '-' }}
                    </span>
                </div>

            @endforeach

        </div>

    </div>


    {{-- DATA LAINNYA --}}
    @foreach([
        'Amandemen Waktu' => [
            'amandemen_waktu_nomor' => 'Nomor Amandemen Waktu',
            'amandemen_waktu_tanggal' => 'Tanggal Amandemen Waktu'
        ],

        'Amandemen Nilai' => [
            'amandemen_nilai_nomor' => 'Nomor Amandemen Nilai',
            'amandemen_nilai_tanggal' => 'Tanggal Amandemen Nilai'
        ],

        'Progress Pekerjaan' => [
            'keterangan' => 'Keterangan',
            'nilai_sisa' => 'Nilai Sisa',
            'kendala' => 'Kendala',
            'tindak_lanjut' => 'Tindak Lanjut',
            'persentase_fisik' => 'Persentase Fisik'
        ],

        'Ringkasan Pembayaran' => [
            'no_po' => 'No. PO',
            'total_usul_bayar' => 'Total Usul Bayar',
            'total_giro' => 'Total Giro',
            'total_outstanding' => 'Total Outstanding'
        ],

        'Data Pengawas dan Kontrak' => [
            'pengawas' => 'Pengawas',
            'jenis_jtl' => 'Jenis JTL',
            'metode_kontrak' => 'Metode Kontrak'
        ],

        'Nilai Kontrak dan Realisasi' => [
            'total_material_terkontrak' => 'Total Material Terkontrak',
            'total_jasa_terkontrak' => 'Total Jasa Terkontrak',
            'total_terkontrak' => 'Total Terkontrak',
            'terkontrak_belum_realisasi' => 'Terkontrak Belum Realisasi',
            'total_realisasi_material' => 'Total Realisasi Material',
            'total_realisasi_jasa' => 'Total Realisasi Jasa',
            'total_realisasi_kontrak' => 'Total Realisasi Kontrak'
        ],

        'Tanggal dan Perhitungan' => [
            'tgl_bulan_kontrak' => 'Tanggal Bulan Kontrak',
            'tgl_bulan_usul_bayar_100' => 'Tanggal Bulan Usul Bayar 100%',
            'tgl_bulan_usul_bayar_95' => 'Tanggal Bulan Usul Bayar 95%',
            'tgl_bulan_usul_bayar_5' => 'Tanggal Bulan Usul Bayar 5%',
            'selisih_kontrak_realisasi' => 'Selisih Kontrak Realisasi',
            'persentase_pencapaian_kontrak' => 'Persentase Pencapaian Kontrak'
        ]
    ] as $section => $fields)

        <div class="detail-card">

            <div class="detail-header">
                <h2>{{ $section }}</h2>
                <p>Informasi {{ strtolower($section) }}</p>
            </div>

            <div class="detail-grid">

                @foreach($fields as $name => $label)

                    <div>
                        <span class="detail-label">
                            {{ $label }}
                        </span>

                        <span class="detail-value">
                            {{ $progresKontrak->{$name} ?: '-' }}
                        </span>
                    </div>

                @endforeach

            </div>

        </div>

    @endforeach


    {{-- SAP --}}
    @foreach(['100', '95', '5'] as $sap)

        <div class="detail-card">

            <div class="detail-header">
                <h2>Nomor Dokumen SAP {{ $sap }}%</h2>
                <p>Informasi invoice dan dokumen SAP</p>
            </div>

            <div class="detail-grid">

                @foreach([
                    "sap_{$sap}_no_invoice" => "No. Invoice {$sap}%",
                    "sap_{$sap}_tanggal" => "Tanggal SAP {$sap}%",
                    "sap_{$sap}_no_doc" => "No. Doc {$sap}%"
                ] as $name => $label)

                    <div>
                        <span class="detail-label">
                            {{ $label }}
                        </span>

                        <span class="detail-value">
                            {{ $progresKontrak->{$name} ?: '-' }}
                        </span>
                    </div>

                @endforeach

            </div>

        </div>

    @endforeach


    {{-- RENCANA --}}
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

        <div class="detail-card">

            <div class="detail-header">
                <h2>{{ $rencana['title'] }}</h2>
                <p>Rencana nilai dan bulan pembayaran</p>
            </div>

            <div class="detail-grid">

                <div>
                    <span class="detail-label">
                        Rencana Nilai (Rp)
                    </span>

                    <span class="detail-value">
                        {{ $progresKontrak->{$rencana['rp']} ?: '-' }}
                    </span>
                </div>

                <div>
                    <span class="detail-label">
                        Rencana Bulan
                    </span>

                    <span class="detail-value">
                        {{ $progresKontrak->{$rencana['bulan']} ?: '-' }}
                    </span>
                </div>

            </div>

        </div>

    @endforeach


    <div class="flex justify-end mt-6">

        <a href="{{ route('progres-kontrak.edit', $progresKontrak->id) }}"
           class="px-6 py-2.5 rounded-xl bg-[#003082]
                  hover:bg-[#0050A4] text-white
                  text-sm font-semibold transition">

            Edit Progres Kontrak

        </a>

    </div>

</div>


<style>

    .detail-card {
        background: white;
        border: 1px solid #e5e7eb;
        border-radius: 1rem;
        overflow: hidden;
        margin-bottom: 1.25rem;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.04);
    }

    .detail-header {
        padding: 1.25rem 1.5rem;
        border-bottom: 1px solid #f3f4f6;
        background: linear-gradient(to right, #eff6ff, #ffffff);
    }

    .detail-header h2 {
        font-weight: 700;
        color: #1f2937;
        font-size: 1rem;
    }

    .detail-header p {
        font-size: 0.75rem;
        color: #6b7280;
        margin-top: 0.125rem;
    }

    .detail-grid {
        display: grid;
        grid-template-columns: repeat(1, minmax(0, 1fr));
        gap: 1.25rem;
        padding: 1.5rem;
    }

    .detail-label {
        display: block;
        font-size: 0.75rem;
        color: #6b7280;
        margin-bottom: 0.3rem;
    }

    .detail-value {
        display: block;
        color: #1f2937;
        font-size: 0.875rem;
        font-weight: 600;
        overflow-wrap: anywhere;
    }

    @media (min-width: 768px) {
        .detail-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
    }

    @media (min-width: 1024px) {
        .detail-grid {
            grid-template-columns: repeat(3, minmax(0, 1fr));
        }
    }

</style>

@endsection
