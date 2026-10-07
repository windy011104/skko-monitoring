@extends('layouts.app')

@section('title', 'Tambah Data PRK LKAO')

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

            <span class="text-gray-700">
                Tambah Data
            </span>

        </div>

        <h1 class="text-2xl font-bold text-gray-800">
            Tambah Data PRK LKAO
        </h1>

        <p class="text-sm text-gray-500 mt-1">
            Masukkan seluruh informasi PRK LKAO, anggaran, kontrak,
            pembayaran, rencana, dan proyeksi.
        </p>

    </div>


    {{-- ERROR --}}
    @if ($errors->any())

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

                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach

                    </ul>

                </div>

            </div>

        </div>

    @endif


    <form action="{{ route('prk.store') }}" method="POST">

        @csrf


        {{-- INFORMASI UTAMA --}}
        <div class="bg-white rounded-2xl border border-gray-200
                    shadow-sm overflow-hidden mb-5">

            <div class="px-6 py-5 border-b border-gray-100
                        bg-gradient-to-r from-blue-50 to-white">

                <div class="flex items-center gap-3">

                    <div class="w-10 h-10 rounded-xl bg-[#003082]
                                flex items-center justify-center">

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

                        <h2 class="font-bold text-gray-800">
                            Informasi PRK LKAO
                        </h2>

                        <p class="text-xs text-gray-500 mt-0.5">
                            Informasi dasar dan identitas PRK
                        </p>

                    </div>

                </div>

            </div>


            <div class="p-6">

                <div class="grid grid-cols-1 md:grid-cols-2
                            lg:grid-cols-3 gap-5">

                    <div>
                        <label class="form-label">
                            SKKO
                        </label>

                        <input type="text"
                               name="skko"
                               value="{{ old('skko') }}"
                               class="form-input"
                               placeholder="Masukkan SKKO">
                    </div>


                    <div>
                        <label class="form-label">
                            PRK LKAO
                        </label>

                        <input type="text"
                               name="prk_lkao"
                               value="{{ old('prk_lkao') }}"
                               class="form-input"
                               placeholder="Masukkan PRK LKAO">
                    </div>


                    <div>
                        <label class="form-label">
                            No. PRK
                        </label>

                        <input type="text"
                               name="no_prk"
                               value="{{ old('no_prk') }}"
                               class="form-input"
                               placeholder="Masukkan nomor PRK">
                    </div>


                    <div>
                        <label class="form-label">
                            Unsur 1
                        </label>

                        <input type="text"
                               name="unsur_1"
                               value="{{ old('unsur_1') }}"
                               class="form-input"
                               placeholder="Masukkan unsur">
                    </div>


                    <div>
                        <label class="form-label">
                            Kegiatan
                        </label>

                        <input type="text"
                               name="kegiatan"
                               value="{{ old('kegiatan') }}"
                               class="form-input"
                               placeholder="Masukkan kegiatan">
                    </div>


                    <div>
                        <label class="form-label">
                            Bidang
                        </label>

                        <input type="text"
                               name="bidang"
                               value="{{ old('bidang') }}"
                               class="form-input"
                               placeholder="Masukkan bidang">
                    </div>

                </div>

            </div>

        </div>


        {{-- DATA ANGGARAN --}}
        <div class="bg-white rounded-2xl border border-gray-200
                    shadow-sm overflow-hidden mb-5">

            <div class="px-6 py-5 border-b border-gray-100
                        bg-gradient-to-r from-blue-50 to-white">

                <div class="flex items-center gap-3">

                    <div class="w-10 h-10 rounded-xl bg-blue-100
                                flex items-center justify-center">

                        <svg class="w-5 h-5 text-[#003082]"
                             fill="none"
                             stroke="currentColor"
                             viewBox="0 0 24 24">

                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="2"
                                  d="M12 8c-1.657 0-3 .895-3 2s1.343 2
                                     3 2 3 .895 3 2-1.343 2-3 2m0-8
                                     c1.11 0 2.08.402 2.599 1M12 8V6m0
                                     12v-2m0 2c-1.11 0-2.08-.402-2.599-1
                                     M5 12a7 7 0 1014 0 7 7 0 00-14 0z"/>

                        </svg>

                    </div>

                    <div>

                        <h2 class="font-bold text-gray-800">
                            Data Anggaran
                        </h2>

                        <p class="text-xs text-gray-500 mt-0.5">
                            Nilai anggaran dan nota dinas
                        </p>

                    </div>

                </div>

            </div>


            <div class="p-6">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                    <div>
                        <label class="form-label">
                            Nilai PRK Terbit Awal
                        </label>

                        <input type="number"
                               name="nilai_prk_terbit_awal"
                               value="{{ old('nilai_prk_terbit_awal') }}"
                               min="0"
                               step="0.01"
                               class="form-input"
                               placeholder="0">
                    </div>


                    <div>
                        <label class="form-label">
                            Nota Dinas Nilai
                        </label>

                        <input type="number"
                               name="nota_dinas_nilai"
                               value="{{ old('nota_dinas_nilai') }}"
                               min="0"
                               step="0.01"
                               class="form-input"
                               placeholder="0">
                    </div>

                </div>

            </div>

        </div>


        {{-- DATA KONTRAK --}}
        <div class="bg-white rounded-2xl border border-gray-200
                    shadow-sm overflow-hidden mb-5">

            <div class="px-6 py-5 border-b border-gray-100
                        bg-gradient-to-r from-blue-50 to-white">

                <div class="flex items-center gap-3">

                    <div class="w-10 h-10 rounded-xl bg-blue-100
                                flex items-center justify-center">

                        <svg class="w-5 h-5 text-[#003082]"
                             fill="none"
                             stroke="currentColor"
                             viewBox="0 0 24 24">

                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="2"
                                  d="M9 12h6m-6 4h6m-7-9h8
                                     M5 5h14a2 2 0 012 2v10a2 2 0
                                     01-2 2H5a2 2 0 01-2-2V7a2 2
                                     0 012-2z"/>

                        </svg>

                    </div>

                    <div>

                        <h2 class="font-bold text-gray-800">
                            Data Kontrak dan Realisasi
                        </h2>

                        <p class="text-xs text-gray-500 mt-0.5">
                            Informasi nilai kontrak dan realisasi pekerjaan
                        </p>

                    </div>

                </div>

            </div>


            <div class="p-6">

                <div class="grid grid-cols-1 md:grid-cols-2
                            lg:grid-cols-3 gap-5">

                    <div>
                        <label class="form-label">
                            Kontrak Persentase
                        </label>

                        <input type="number"
                               name="kontrak_persen"
                               value="{{ old('kontrak_persen') }}"
                               min="0"
                               step="0.01"
                               class="form-input"
                               placeholder="0">
                    </div>


                    <div>
                        <label class="form-label">
                            Kontrak Nilai
                        </label>

                        <input type="number"
                               name="kontrak_nilai"
                               value="{{ old('kontrak_nilai') }}"
                               min="0"
                               step="0.01"
                               class="form-input"
                               placeholder="0">
                    </div>


                    <div>
                        <label class="form-label">
                            Realisasi Kontrak Persentase
                        </label>

                        <input type="number"
                               name="realisasi_kontrak_persen"
                               value="{{ old('realisasi_kontrak_persen') }}"
                               min="0"
                               step="0.01"
                               class="form-input"
                               placeholder="0">
                    </div>


                    <div>
                        <label class="form-label">
                            Realisasi Kontrak Nilai
                        </label>

                        <input type="number"
                               name="realisasi_kontrak_nilai"
                               value="{{ old('realisasi_kontrak_nilai') }}"
                               min="0"
                               step="0.01"
                               class="form-input"
                               placeholder="0">
                    </div>


                    <div>
                        <label class="form-label">
                            Sisa Anggaran Nilai
                        </label>

                        <input type="number"
                               name="sisa_anggaran_nilai"
                               value="{{ old('sisa_anggaran_nilai') }}"
                               min="0"
                               step="0.01"
                               class="form-input"
                               placeholder="0">
                    </div>


                    <div>
                        <label class="form-label">
                            Sisa Anggaran Persentase
                        </label>

                        <input type="number"
                               name="sisa_anggaran_persen"
                               value="{{ old('sisa_anggaran_persen') }}"
                               min="0"
                               step="0.01"
                               class="form-input"
                               placeholder="0">
                    </div>

                </div>

            </div>

        </div>


        {{-- DATA PEMBAYARAN --}}
        <div class="bg-white rounded-2xl border border-gray-200
                    shadow-sm overflow-hidden mb-5">

            <div class="px-6 py-5 border-b border-gray-100
                        bg-gradient-to-r from-blue-50 to-white">

                <div class="flex items-center gap-3">

                    <div class="w-10 h-10 rounded-xl bg-blue-100
                                flex items-center justify-center">

                        <svg class="w-5 h-5 text-[#003082]"
                             fill="none"
                             stroke="currentColor"
                             viewBox="0 0 24 24">

                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="2"
                                  d="M3 10h18M7 15h2m4 0h4
                                     M5 5h14a2 2 0 012 2v10a2 2
                                     0 01-2 2H5a2 2 0 01-2-2V7
                                     a2 2 0 012-2z"/>

                        </svg>

                    </div>

                    <div>

                        <h2 class="font-bold text-gray-800">
                            Data Pembayaran
                        </h2>

                        <p class="text-xs text-gray-500 mt-0.5">
                            Informasi usulan pembayaran dan outstanding
                        </p>

                    </div>

                </div>

            </div>


            <div class="p-6">

                <div class="grid grid-cols-1 md:grid-cols-3 gap-5">

                    <div>
                        <label class="form-label">
                            Total Usul Bayar
                        </label>

                        <input type="number"
                               name="total_usul_bayar"
                               value="{{ old('total_usul_bayar') }}"
                               min="0"
                               step="0.01"
                               class="form-input"
                               placeholder="0">
                    </div>


                    <div>
                        <label class="form-label">
                            Total Giro Terbayar
                        </label>

                        <input type="number"
                               name="total_giro_terbayar"
                               value="{{ old('total_giro_terbayar') }}"
                               min="0"
                               step="0.01"
                               class="form-input"
                               placeholder="0">
                    </div>


                    <div>
                        <label class="form-label">
                            Total Outstanding
                        </label>

                        <input type="number"
                               name="total_outstanding"
                               value="{{ old('total_outstanding') }}"
                               min="0"
                               step="0.01"
                               class="form-input"
                               placeholder="0">
                    </div>

                </div>

            </div>

        </div>


        {{-- RENCANA KONTRAK --}}
        <div class="bg-white rounded-2xl border border-gray-200
                    shadow-sm overflow-hidden mb-5">

            <div class="px-6 py-5 border-b border-gray-100
                        bg-gradient-to-r from-blue-50 to-white">

                <div class="flex items-center gap-3">

                    <div class="w-10 h-10 rounded-xl bg-blue-100
                                flex items-center justify-center">

                        <svg class="w-5 h-5 text-[#003082]"
                             fill="none"
                             stroke="currentColor"
                             viewBox="0 0 24 24">

                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="2"
                                  d="M4 6h16M4 12h16M4 18h10"/>

                        </svg>

                    </div>

                    <div>

                        <h2 class="font-bold text-gray-800">
                            Rencana Kontrak
                        </h2>

                        <p class="text-xs text-gray-500 mt-0.5">
                            Uraian rencana kontrak pekerjaan
                        </p>

                    </div>

                </div>

            </div>


            <div class="p-6">

                <label class="form-label">
                    Uraian Rencana Kontrak
                </label>

                <textarea name="uraian_rencana_kontrak"
                          rows="4"
                          class="form-input resize-none"
                          placeholder="Masukkan uraian rencana kontrak...">{{ old('uraian_rencana_kontrak') }}</textarea>

            </div>

        </div>


        {{-- RENCANA BULANAN --}}
        <div class="bg-white rounded-2xl border border-gray-200
                    shadow-sm overflow-hidden mb-5">

            <div class="px-6 py-5 border-b border-gray-100
                        bg-gradient-to-r from-blue-50 to-white">

                <div class="flex items-center gap-3">

                    <div class="w-10 h-10 rounded-xl bg-blue-100
                                flex items-center justify-center">

                        <svg class="w-5 h-5 text-[#003082]"
                             fill="none"
                             stroke="currentColor"
                             viewBox="0 0 24 24">

                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="2"
                                  d="M8 7V3m8 4V3m-9 8h10
                                     M5 21h14a2 2 0 002-2V7
                                     a2 2 0 00-2-2H5a2 2 0 00-2 2v12
                                     a2 2 0 002 2z"/>

                        </svg>

                    </div>

                    <div>

                        <h2 class="font-bold text-gray-800">
                            Rencana Bulanan
                        </h2>

                        <p class="text-xs text-gray-500 mt-0.5">
                            Rencana anggaran dari Januari sampai Desember
                        </p>

                    </div>

                </div>

            </div>


            <div class="p-6">

                <div class="grid grid-cols-1 md:grid-cols-2
                            lg:grid-cols-3 gap-5">

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
                        'des' => 'Desember'
                    ] as $month => $monthName)

                        <div>

                            <label class="form-label">
                                Rencana {{ $monthName }}
                            </label>

                            <input type="number"
                                   name="rencana_{{ $month }}"
                                   value="{{ old('rencana_'.$month) }}"
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
        <div class="bg-white rounded-2xl border-2 border-blue-100
                    shadow-sm overflow-hidden mb-6">

            <div class="px-6 py-5 border-b border-blue-100
                        bg-gradient-to-r from-blue-50 to-white">

                <div class="flex items-center gap-3">

                    <div class="w-10 h-10 rounded-xl bg-[#003082]
                                flex items-center justify-center">

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

                        <h2 class="font-bold text-gray-800">
                            Prognosa dan Proyeksi
                        </h2>

                        <p class="text-xs text-gray-500 mt-0.5">
                            Data perkiraan kontrak dan sisa anggaran
                        </p>

                    </div>

                </div>

            </div>


            <div class="p-6">

                <div class="grid grid-cols-1 md:grid-cols-2
                            lg:grid-cols-4 gap-5">

                    <div>
                        <label class="form-label">
                            Prognosa Terkontrak Nilai
                        </label>

                        <input type="number"
                               name="prognosa_terkontrak_nilai"
                               value="{{ old('prognosa_terkontrak_nilai') }}"
                               min="0"
                               step="0.01"
                               class="form-input"
                               placeholder="0">
                    </div>


                    <div>
                        <label class="form-label">
                            Prognosa Terkontrak Persentase
                        </label>

                        <input type="number"
                               name="prognosa_terkontrak_persen"
                               value="{{ old('prognosa_terkontrak_persen') }}"
                               min="0"
                               step="0.01"
                               class="form-input"
                               placeholder="0">
                    </div>


                    <div>
                        <label class="form-label">
                            Proyeksi Sisa Nilai
                        </label>

                        <input type="number"
                               name="proyeksi_sisa_nilai"
                               value="{{ old('proyeksi_sisa_nilai') }}"
                               min="0"
                               step="0.01"
                               class="form-input"
                               placeholder="0">
                    </div>


                    <div>
                        <label class="form-label">
                            Proyeksi Sisa Persentase
                        </label>

                        <input type="number"
                               name="proyeksi_sisa_persen"
                               value="{{ old('proyeksi_sisa_persen') }}"
                               min="0"
                               step="0.01"
                               class="form-input"
                               placeholder="0">
                    </div>

                </div>

            </div>

        </div>


        {{-- BUTTON --}}
        <div class="flex flex-col-reverse sm:flex-row
                    items-center justify-end gap-3">

            <a href="{{ route('prk.index') }}"
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

                    Simpan Data PRK

                </span>

            </button>

        </div>

    </form>

</div>


{{-- INPUT STYLE --}}
<style>

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
