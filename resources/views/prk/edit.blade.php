@extends('layouts.app')

@section('title', 'Edit Data PRK LKAO')

@section('content')

<div class="p-4 lg:p-6">

    {{-- HEADER --}}
    <div class="mb-6">
        <div class="flex items-center gap-2 text-sm text-gray-500 mb-2">
            <a href="{{ route('prk.index') }}"
               class="hover:text-[#003082] transition">
                Data PRK LKAO
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

            <span class="text-gray-700">Edit Data</span>
        </div>

        <h1 class="text-2xl font-bold text-gray-800">
            Edit Data PRK LKAO
        </h1>

        <p class="text-sm text-gray-500 mt-1">
            Perbarui informasi PRK LKAO secara lengkap.
        </p>
    </div>

    {{-- ERROR --}}
    @if($errors->any())
        <div class="mb-6 p-4 rounded-xl bg-red-50 border border-red-200">
            <div class="flex gap-3">
                <div class="w-8 h-8 rounded-full bg-red-100 flex items-center justify-center">
                    <svg class="w-4 h-4 text-red-600"
                         fill="none"
                         stroke="currentColor"
                         viewBox="0 0 24 24">
                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>

                <div>
                    <p class="text-sm font-semibold text-red-700">
                        Data belum dapat diperbarui
                    </p>

                    <ul class="mt-1 list-disc list-inside text-sm text-red-600">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    @endif

    <form action="{{ route('prk.update', $prkLkao->id) }}"
          method="POST">

        @csrf
        @method('PUT')

        {{-- INFORMASI UTAMA --}}
        <div class="form-card">
            <div class="card-header">
                <div class="icon-box bg-[#003082]">
                    <svg class="w-5 h-5 text-white"
                         fill="none"
                         stroke="currentColor"
                         viewBox="0 0 24 24">
                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414A1 1 0 0119 5.707V19a2 2 0 01-2 2z"/>
                    </svg>
                </div>

                <div>
                    <h2 class="section-title">Informasi PRK LKAO</h2>
                    <p class="section-description">
                        Informasi dasar dan identitas PRK
                    </p>
                </div>
            </div>

            <div class="card-body">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
                    @foreach([
                        'skko' => 'SKKO',
                        'prk_lkao' => 'PRK LKAO',
                        'no_prk' => 'No. PRK',
                        'unsur_1' => 'Unsur 1',
                        'kegiatan' => 'Kegiatan',
                        'bidang' => 'Bidang',
                    ] as $name => $label)

                        <div>
                            <label class="form-label">{{ $label }}</label>

                            <input type="text"
                                   name="{{ $name }}"
                                   value="{{ old($name, $prkLkao->{$name}) }}"
                                   class="form-input"
                                   placeholder="Masukkan {{ strtolower($label) }}">
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- DATA ANGGARAN --}}
        <div class="form-card">
            <div class="card-header">
                <div class="icon-box bg-blue-100">
                    <svg class="w-5 h-5 text-[#003082]"
                         fill="none"
                         stroke="currentColor"
                         viewBox="0 0 24 24">
                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M12 8c-1.657 0-3 1.12-3 2.5S10.343 13 12 13s3 1.12 3 2.5S13.657 18 12 18m0-14v2m0 12v2m9-10a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>

                <div>
                    <h2 class="section-title">Data Anggaran</h2>
                    <p class="section-description">
                        Informasi nilai anggaran dan nota dinas
                    </p>
                </div>
            </div>

            <div class="card-body">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
                    @foreach([
                        'nilai_prk_terbit_awal' => 'Nilai PRK Terbit Awal',
                        'nota_dinas_nilai' => 'Nota Dinas Nilai',
                    ] as $name => $label)

                        <div>
                            <label class="form-label">{{ $label }}</label>

                            <input type="number"
                                   name="{{ $name }}"
                                   value="{{ old($name, $prkLkao->{$name}) }}"
                                   min="0"
                                   step="0.01"
                                   class="form-input"
                                   placeholder="0">
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- DATA KONTRAK --}}
        <div class="form-card">
            <div class="card-header">
                <div class="icon-box bg-blue-100">
                    <svg class="w-5 h-5 text-[#003082]"
                         fill="none"
                         stroke="currentColor"
                         viewBox="0 0 24 24">
                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414A1 1 0 0119 5.707V19a2 2 0 01-2 2z"/>
                    </svg>
                </div>

                <div>
                    <h2 class="section-title">Data Kontrak</h2>
                    <p class="section-description">
                        Informasi kontrak dan realisasi kontrak
                    </p>
                </div>
            </div>

            <div class="card-body">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
                    @foreach([
                        'kontrak_persen' => 'Kontrak Persen',
                        'kontrak_nilai' => 'Kontrak Nilai',
                        'realisasi_kontrak_persen' => 'Realisasi Kontrak Persen',
                        'realisasi_kontrak_nilai' => 'Realisasi Kontrak Nilai',
                        'sisa_anggaran_nilai' => 'Sisa Anggaran Nilai',
                        'sisa_anggaran_persen' => 'Sisa Anggaran Persen',
                    ] as $name => $label)

                        <div>
                            <label class="form-label">{{ $label }}</label>

                            <input type="number"
                                   name="{{ $name }}"
                                   value="{{ old($name, $prkLkao->{$name}) }}"
                                   min="0"
                                   step="0.01"
                                   class="form-input"
                                   placeholder="0">
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- DATA PEMBAYARAN --}}
        <div class="form-card">
            <div class="card-header">
                <div class="icon-box bg-blue-100">
                    <svg class="w-5 h-5 text-[#003082]"
                         fill="none"
                         stroke="currentColor"
                         viewBox="0 0 24 24">
                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M12 8c-1.657 0-3 1.12-3 2.5S10.343 13 12 13s3 1.12 3 2.5S13.657 18 12 18m0-14v2m0 12v2m9-10a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>

                <div>
                    <h2 class="section-title">Data Pembayaran</h2>
                    <p class="section-description">
                        Informasi usulan bayar dan outstanding
                    </p>
                </div>
            </div>

            <div class="card-body">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
                    @foreach([
                        'total_usul_bayar' => 'Total Usul Bayar',
                        'total_giro_terbayar' => 'Total Giro Terbayar',
                        'total_outstanding' => 'Total Outstanding',
                    ] as $name => $label)

                        <div>
                            <label class="form-label">{{ $label }}</label>

                            <input type="number"
                                   name="{{ $name }}"
                                   value="{{ old($name, $prkLkao->{$name}) }}"
                                   min="0"
                                   step="0.01"
                                   class="form-input"
                                   placeholder="0">
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- RENCANA KONTRAK --}}
        <div class="form-card">
            <div class="card-header">
                <div class="icon-box bg-blue-100">
                    <svg class="w-5 h-5 text-[#003082]"
                         fill="none"
                         stroke="currentColor"
                         viewBox="0 0 24 24">
                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M8 6h13M8 12h13M8 18h13M3 6h.01M3 12h.01M3 18h.01"/>
                    </svg>
                </div>

                <div>
                    <h2 class="section-title">Rencana Kontrak</h2>
                    <p class="section-description">
                        Uraian dan rencana pelaksanaan kontrak
                    </p>
                </div>
            </div>

            <div class="card-body">
                <label class="form-label">Uraian Rencana Kontrak</label>

                <textarea name="uraian_rencana_kontrak"
                          rows="4"
                          class="form-input resize-none"
                          placeholder="Masukkan uraian rencana kontrak...">{{ old('uraian_rencana_kontrak', $prkLkao->uraian_rencana_kontrak) }}</textarea>
            </div>
        </div>

        {{-- RENCANA BULANAN --}}
        <div class="form-card">
            <div class="card-header">
                <div class="icon-box bg-blue-100">
                    <svg class="w-5 h-5 text-[#003082]"
                         fill="none"
                         stroke="currentColor"
                         viewBox="0 0 24 24">
                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </div>

                <div>
                    <h2 class="section-title">Rencana Bulanan</h2>
                    <p class="section-description">
                        Rencana anggaran dari Januari sampai Desember
                    </p>
                </div>
            </div>

            <div class="card-body">
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-5">
                    @foreach([
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
                    ] as $bulan => $label)

                        @php
                            $field = 'rencana_' . $bulan;
                        @endphp

                        <div>
                            <label class="form-label">{{ $label }}</label>

                            <input type="number"
                                   name="{{ $field }}"
                                   value="{{ old($field, $prkLkao->{$field}) }}"
                                   min="0"
                                   step="0.01"
                                   class="form-input"
                                   placeholder="0">
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- PROGNOSA DAN PROYEKSI --}}
        <div class="form-card border-2 border-blue-100 mb-6">
            <div class="card-header">
                <div class="icon-box bg-[#003082]">
                    <svg class="w-5 h-5 text-white"
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
                    <h2 class="section-title">Prognosa dan Proyeksi</h2>
                    <p class="section-description">
                        Informasi prognosa terkontrak dan proyeksi sisa
                    </p>
                </div>
            </div>

            <div class="card-body">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-5">
                    @foreach([
                        'prognosa_terkontrak_nilai' => 'Prognosa Terkontrak Nilai',
                        'prognosa_terkontrak_persen' => 'Prognosa Terkontrak Persen',
                        'proyeksi_sisa_nilai' => 'Proyeksi Sisa Nilai',
                        'proyeksi_sisa_persen' => 'Proyeksi Sisa Persen',
                    ] as $name => $label)

                        <div>
                            <label class="form-label">{{ $label }}</label>

                            <input type="number"
                                   name="{{ $name }}"
                                   value="{{ old($name, $prkLkao->{$name}) }}"
                                   min="0"
                                   step="0.01"
                                   class="form-input"
                                   placeholder="0">
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- BUTTON --}}
        <div class="flex flex-col-reverse sm:flex-row items-center justify-end gap-3">
            <a href="{{ route('prk.index') }}"
               class="w-full sm:w-auto px-6 py-2.5 rounded-xl border border-gray-200 bg-white text-gray-600 text-sm font-semibold text-center hover:bg-gray-50 transition">
                Batal
            </a>

            <button type="submit"
                    class="w-full sm:w-auto px-6 py-2.5 rounded-xl bg-[#003082] hover:bg-[#0050A4] text-white text-sm font-semibold shadow-sm transition">

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

                    Update Data PRK
                </span>
            </button>
        </div>

    </form>
</div>

<style>
    .form-card {
        background: white;
        border: 1px solid #e5e7eb;
        border-radius: 1rem;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.04);
        overflow: hidden;
        margin-bottom: 1.25rem;
    }

    .card-header {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        padding: 1.25rem 1.5rem;
        border-bottom: 1px solid #f3f4f6;
        background: linear-gradient(to right, #eff6ff, #ffffff);
    }

    .card-body {
        padding: 1.5rem;
    }

    .icon-box {
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
    }
</style>

@endsection
