@extends('layouts.app')

@section('title', 'Tambah Data SKKO')

@section('content')

<div class="p-4 lg:p-6">

    {{-- HEADER --}}
    <div class="mb-6">
        <div class="flex items-center gap-2 text-sm text-gray-500 mb-2">
            <a href="{{ route('skko.index') }}"
               class="hover:text-[#003082] transition">
                Data SKKO
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
            Tambah Data SKKO
        </h1>

        <p class="text-sm text-gray-500 mt-1">
            Masukkan informasi SKKO terbit tahun 2026 secara lengkap.
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


    <form action="{{ route('skko.store') }}"
          method="POST">

        @csrf


        {{-- ================================================= --}}
        {{-- INFORMASI UTAMA --}}
        {{-- ================================================= --}}

        <div class="bg-white rounded-2xl border border-gray-200
                    shadow-sm overflow-hidden mb-5">

            {{-- TITLE --}}
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
                            Informasi SKKO
                        </h2>

                        <p class="text-xs text-gray-500 mt-0.5">
                            Informasi dasar dan identitas SKKO
                        </p>
                    </div>

                </div>

            </div>


            {{-- INPUT --}}
            <div class="p-6">

                <div class="grid grid-cols-1 md:grid-cols-2
                            lg:grid-cols-3 gap-5">

                    {{-- POS ANGGARAN --}}
                    <div>
                        <label class="form-label">
                            Pos Anggaran
                        </label>

                        <input type="text"
                               name="POS_ANGGARAN"
                               value="{{ old('POS_ANGGARAN') }}"
                               class="form-input"
                               placeholder="Masukkan pos anggaran">
                    </div>


                    {{-- TYPE --}}
                    <div>
                        <label class="form-label">
                            Type SKKO
                        </label>

                        <input type="text"
                               name="TYPE_SKKO"
                               value="{{ old('TYPE_SKKO') }}"
                               class="form-input"
                               placeholder="Contoh: SKKO">
                    </div>


                    {{-- JENIS BIAYA --}}
                    <div>
                        <label class="form-label">
                            Jenis Biaya Operasi
                        </label>

                        <input type="text"
                               name="JENIS_BIAYA_OPERASI"
                               value="{{ old('JENIS_BIAYA_OPERASI') }}"
                               class="form-input"
                               placeholder="Jenis biaya operasi">
                    </div>


                    {{-- FUNGSI --}}
                    <div>
                        <label class="form-label">
                            Fungsi
                        </label>

                        <input type="text"
                               name="FUNGSI"
                               value="{{ old('FUNGSI') }}"
                               class="form-input"
                               placeholder="Masukkan fungsi">
                    </div>


                    {{-- UNSUR --}}
                    <div>
                        <label class="form-label">
                            Unsur
                        </label>

                        <input type="text"
                               name="UNSUR"
                               value="{{ old('UNSUR') }}"
                               class="form-input"
                               placeholder="Masukkan unsur">
                    </div>


                    {{-- SUB UNSUR --}}
                    <div>
                        <label class="form-label">
                            Sub Unsur
                        </label>

                        <input type="text"
                               name="SUB_UNSUR"
                               value="{{ old('SUB_UNSUR') }}"
                               class="form-input"
                               placeholder="Masukkan sub unsur">
                    </div>


                    {{-- NO SKKO --}}
                    <div>
                        <label class="form-label">
                            No. SKKO
                            <span class="text-red-500">*</span>
                        </label>

                        <input type="text"
                               name="NO_SKKO"
                               value="{{ old('NO_SKKO') }}"
                               required
                               class="form-input"
                               placeholder="Masukkan nomor SKKO">
                    </div>


                    {{-- NO PRK --}}
                    <div>
                        <label class="form-label">
                            No. PRK LKAO
                        </label>

                        <input type="text"
                               name="NO_PRK_LKAO"
                               value="{{ old('NO_PRK_LKAO') }}"
                               class="form-input"
                               placeholder="Masukkan No. PRK LKAO">
                    </div>


                    {{-- URAIAN --}}
                    <div class="md:col-span-2 lg:col-span-3">

                        <label class="form-label">
                            Uraian
                        </label>

                        <textarea name="URAIAN"
                                  rows="4"
                                  class="form-input resize-none"
                                  placeholder="Jelaskan uraian pekerjaan atau penggunaan SKKO...">{{ old('URAIAN') }}</textarea>

                        <p class="text-xs text-gray-400 mt-1.5">
                            Masukkan uraian secara singkat dan jelas.
                        </p>

                    </div>

                </div>

            </div>

        </div>


        {{-- ================================================= --}}
        {{-- SKKO AWAL --}}
        {{-- ================================================= --}}

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
                                     a2 2 0 00-2-2H5
                                     a2 2 0 00-2 2v12
                                     a2 2 0 002 2z"/>

                        </svg>

                    </div>

                    <div>
                        <h2 class="font-bold text-gray-800">
                            SKKO Awal Terbit
                        </h2>

                        <p class="text-xs text-gray-500 mt-0.5">
                            Data saat SKKO pertama kali diterbitkan
                        </p>
                    </div>

                </div>

            </div>


            <div class="p-6">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                    {{-- TANGGAL --}}
                    <div>
                        <label class="form-label">
                            Tanggal Terbit
                        </label>

                        <input type="date"
                               name="AWAL_TERBIT_TANGGAL"
                               value="{{ old('AWAL_TERBIT_TANGGAL') }}"
                               class="form-input">
                    </div>


                    {{-- NILAI --}}
                    <div>
                        <label class="form-label">
                            Nilai Terbit
                        </label>

                        <div class="relative">

                            <span class="absolute left-3 top-1/2
                                         -translate-y-1/2
                                         text-gray-500 text-sm">

                            </span>

                            <input type="number"
                                   name="AWAL_TERBIT_NILAI"
                                   value="{{ old('AWAL_TERBIT_NILAI') }}"
                                   min="0"
                                   step="0.01"
                                   class="form-input pl-10"
                                   placeholder="0">

                        </div>
                    </div>

                </div>

            </div>

        </div>


        {{-- ================================================= --}}
        {{-- REVISI --}}
        {{-- ================================================= --}}

        @foreach([
            1 => 'Pertama',
            2 => 'Kedua',
            3 => 'Ketiga',
            4 => 'Keempat'
        ] as $number => $label)

            <div class="bg-white rounded-2xl border border-gray-200
                        shadow-sm overflow-hidden mb-5">

                <div class="px-6 py-5 border-b border-gray-100">

                    <div class="flex items-center gap-3">

                        <div class="w-10 h-10 rounded-xl bg-yellow-50
                                    border border-yellow-100
                                    flex items-center justify-center">

                            <span class="font-bold text-yellow-600">
                                {{ $number }}
                            </span>

                        </div>

                        <div>

                            <h2 class="font-bold text-gray-800">
                                Revisi {{ $number }}
                            </h2>

                            <p class="text-xs text-gray-500 mt-0.5">
                                Data revisi {{ strtolower($label) }} SKKO
                            </p>

                        </div>

                    </div>

                </div>


                <div class="p-6">

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-5">


                        {{-- NO SKKO --}}
                        <div>

                            <label class="form-label">
                                No. SKKO
                            </label>

                            <input type="text"
                                   name="REV_{{ $number }}_NO_SKKO"
                                   value="{{ old('REV_'.$number.'_NO_SKKO') }}"
                                   class="form-input"
                                   placeholder="Nomor SKKO revisi">

                        </div>


                        {{-- TANGGAL --}}
                        <div>

                            <label class="form-label">
                                Tanggal
                            </label>

                            <input type="date"
                                   name="REV_{{ $number }}_TANGGAL"
                                   value="{{ old('REV_'.$number.'_TANGGAL') }}"
                                   class="form-input">

                        </div>


                        {{-- NILAI --}}
                        <div>

                            <label class="form-label">
                                Nilai Revisi
                            </label>

                            <div class="relative">

                                <span class="absolute left-3 top-1/2
                                             -translate-y-1/2
                                             text-gray-500 text-sm">

                                </span>

                                <input type="number"
                                       name="REV_{{ $number }}_NILAI"
                                       value="{{ old('REV_'.$number.'_NILAI') }}"
                                       min="0"
                                       step="0.01"
                                       class="form-input pl-10"
                                       placeholder="0">

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        @endforeach


        {{-- ================================================= --}}
        {{-- SKKO TERBIT --}}
        {{-- ================================================= --}}

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
                            SKKO Terbit
                        </h2>

                        <p class="text-xs text-gray-500 mt-0.5">
                            Data SKKO setelah proses penerbitan/revisi
                        </p>

                    </div>

                </div>

            </div>


            <div class="p-6">

                <div class="grid grid-cols-1 md:grid-cols-3 gap-5">

                    {{-- NO --}}
                    <div>

                        <label class="form-label">
                            No. SKKO
                        </label>

                        <input type="text"
                               name="SKKO_TERBIT_NO_SKKO"
                               value="{{ old('SKKO_TERBIT_NO_SKKO') }}"
                               class="form-input"
                               placeholder="Nomor SKKO terbit">

                    </div>


                    {{-- TANGGAL --}}
                    <div>

                        <label class="form-label">
                            Tanggal Terbit
                        </label>

                        <input type="date"
                               name="SKKO_TERBIT_TANGGAL"
                               value="{{ old('SKKO_TERBIT_TANGGAL') }}"
                               class="form-input">

                    </div>


                    {{-- NILAI --}}
                    <div>

                        <label class="form-label">
                            Nilai Terbit
                        </label>

                        <div class="relative">

                            <span class="absolute left-3 top-1/2
                                         -translate-y-1/2
                                         text-gray-500 text-sm">

                            </span>

                            <input type="number"
                                   name="SKKO_TERBIT_NILAI"
                                   value="{{ old('SKKO_TERBIT_NILAI') }}"
                                   min="0"
                                   step="0.01"
                                   class="form-input pl-10"
                                   placeholder="0">

                        </div>

                    </div>

                </div>

            </div>

        </div>


        {{-- ================================================= --}}
        {{-- BUTTON --}}
        {{-- ================================================= --}}

        <div class="flex flex-col-reverse sm:flex-row
                    items-center justify-end gap-3">

            <a href="{{ route('skko.index') }}"
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

                    Simpan Data SKKO

                </span>

            </button>

        </div>

    </form>

</div>


{{-- ================================================= --}}
{{-- INPUT STYLE --}}
{{-- ================================================= --}}

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
