@extends('layouts.app')

@section('title', 'Edit Data SKKO')

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
                Edit Data
            </span>

        </div>

        <h1 class="text-2xl font-bold text-gray-800">
            Edit Data SKKO
        </h1>

        <p class="text-sm text-gray-500 mt-1">
            Perbarui informasi SKKO terbit tahun 2026.
        </p>

    </div>


    {{-- ERROR --}}
    @if($errors->any())

        <div class="mb-6 p-4 rounded-xl bg-red-50 border border-red-200">

            <div class="flex gap-3">

                <div class="flex-shrink-0">

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


    {{-- FORM EDIT SKKO --}}
    <form action="{{ route('skko.update', $skko->id) }}"
          method="POST">

        @csrf
        @method('PUT')


        {{-- INFORMASI UTAMA --}}
        <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden mb-5">

            <div class="px-6 py-5 border-b border-gray-100 bg-gradient-to-r from-blue-50 to-white">

                <div class="flex items-center gap-3">

                    <div class="w-10 h-10 rounded-xl bg-[#003082] flex items-center justify-center">

                        <svg class="w-5 h-5 text-white"
                             fill="none"
                             stroke="currentColor"
                             viewBox="0 0 24 24">

                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="2"
                                  d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414A2 2 0 0119 5.707V19a2 2 0 01-2 2z"/>

                        </svg>

                    </div>

                    <div>

                        <h2 class="font-bold text-gray-800">
                            Informasi Utama SKKO
                        </h2>

                        <p class="text-xs text-gray-500 mt-0.5">
                            Informasi dasar dan identitas SKKO
                        </p>

                    </div>

                </div>

            </div>


            <div class="p-6">

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">


                    {{-- NO --}}
                    <div>

                        <label class="form-label">
                            No
                        </label>

                        <input type="number"
                               name="NO"
                               value="{{ old('NO', $skko->NO) }}"
                               class="form-input"
                               placeholder="Masukkan nomor">

                    </div>


                    {{-- POS ANGGARAN --}}
                    <div>

                        <label class="form-label">
                            Pos Anggaran
                        </label>

                        <input type="text"
                               name="POS_ANGGARAN"
                               value="{{ old('POS_ANGGARAN', $skko->POS_ANGGARAN) }}"
                               class="form-input"
                               placeholder="Masukkan pos anggaran">

                    </div>


                    {{-- TYPE SKKO --}}
                    <div>

                        <label class="form-label">
                            Type SKKO
                        </label>

                        <input type="text"
                               name="TYPE_SKKO"
                               value="{{ old('TYPE_SKKO', $skko->TYPE_SKKO) }}"
                               class="form-input"
                               placeholder="Masukkan type SKKO">

                    </div>


                    {{-- JENIS BIAYA OPERASI --}}
                    <div>

                        <label class="form-label">
                            Jenis Biaya Operasi
                        </label>

                        <input type="text"
                               name="JENIS_BIAYA_OPERASI"
                               value="{{ old('JENIS_BIAYA_OPERASI', $skko->JENIS_BIAYA_OPERASI) }}"
                               class="form-input"
                               placeholder="Masukkan jenis biaya operasi">

                    </div>


                    {{-- FUNGSI --}}
                    <div>

                        <label class="form-label">
                            Fungsi
                        </label>

                        <input type="text"
                               name="FUNGSI"
                               value="{{ old('FUNGSI', $skko->FUNGSI) }}"
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
                               value="{{ old('UNSUR', $skko->UNSUR) }}"
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
                               value="{{ old('SUB_UNSUR', $skko->SUB_UNSUR) }}"
                               class="form-input"
                               placeholder="Masukkan sub unsur">

                    </div>


                    {{-- NO SKKO --}}
                    <div>

                        <label class="form-label">
                            No SKKO
                        </label>

                        <input type="text"
                               name="NO_SKKO"
                               value="{{ old('NO_SKKO', $skko->NO_SKKO) }}"
                               class="form-input"
                               placeholder="Masukkan nomor SKKO">

                    </div>


                    {{-- NO PRK LKAO --}}
                    <div>

                        <label class="form-label">
                            No PRK LKAO
                        </label>

                        <input type="text"
                               name="NO_PRK_LKAO"
                               value="{{ old('NO_PRK_LKAO', $skko->NO_PRK_LKAO) }}"
                               class="form-input"
                               placeholder="Masukkan No PRK LKAO">

                    </div>


                    {{-- URAIAN --}}
                    <div class="md:col-span-2 lg:col-span-3">

                        <label class="form-label">
                            Uraian
                        </label>

                        <textarea name="URAIAN"
                                  rows="4"
                                  class="form-input resize-none"
                                  placeholder="Masukkan uraian SKKO...">{{ old('URAIAN', $skko->URAIAN) }}</textarea>

                    </div>

                </div>

            </div>

        </div>


        {{-- AWAL TERBIT --}}
        <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden mb-5">

            <div class="px-6 py-5 border-b border-gray-100 bg-gradient-to-r from-blue-50 to-white">

                <div class="flex items-center gap-3">

                    <div class="w-10 h-10 rounded-xl bg-blue-100 flex items-center justify-center">

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

                        <h2 class="font-bold text-gray-800">
                            SKKO Terbit Awal
                        </h2>

                        <p class="text-xs text-gray-500 mt-0.5">
                            Informasi penerbitan SKKO awal
                        </p>

                    </div>

                </div>

            </div>


            <div class="p-6">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">


                    {{-- TANGGAL --}}
                    <div>

                        <label class="form-label">
                            Tanggal Terbit Awal
                        </label>

                        <input type="date"
                               name="AWAL_TERBIT_TANGGAL"
                               value="{{ old('AWAL_TERBIT_TANGGAL', $skko->AWAL_TERBIT_TANGGAL) }}"
                               class="form-input">

                    </div>


                    {{-- NILAI --}}
                    <div>

                        <label class="form-label">
                            Nilai Terbit Awal
                        </label>

                        <input type="number"
                               name="AWAL_TERBIT_NILAI"
                               value="{{ old('AWAL_TERBIT_NILAI', $skko->AWAL_TERBIT_NILAI) }}"
                               min="0"
                               step="0.01"
                               class="form-input"
                               placeholder="0">

                    </div>

                </div>

            </div>

        </div>


        {{-- REV 1 --}}
        <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden mb-5">

            <div class="px-6 py-5 border-b border-gray-100 bg-gradient-to-r from-blue-50 to-white">

                <div class="flex items-center gap-3">

                    <div class="w-10 h-10 rounded-xl bg-blue-100 flex items-center justify-center">

                        <svg class="w-5 h-5 text-[#003082]"
                             fill="none"
                             stroke="currentColor"
                             viewBox="0 0 24 24">

                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="2"
                                  d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>

                        </svg>

                    </div>

                    <div>

                        <h2 class="font-bold text-gray-800">
                            Revisi 1
                        </h2>

                        <p class="text-xs text-gray-500 mt-0.5">
                            Informasi perubahan atau revisi pertama SKKO
                        </p>

                    </div>

                </div>

            </div>


            <div class="p-6">

                <div class="grid grid-cols-1 md:grid-cols-3 gap-5">

                    <div>

                        <label class="form-label">
                            No SKKO Revisi 1
                        </label>

                        <input type="text"
                               name="REV_1_NO_SKKO"
                               value="{{ old('REV_1_NO_SKKO', $skko->REV_1_NO_SKKO) }}"
                               class="form-input"
                               placeholder="Masukkan nomor">

                    </div>

                    <div>

                        <label class="form-label">
                            Tanggal Revisi 1
                        </label>

                        <input type="date"
                               name="REV_1_TANGGAL"
                               value="{{ old('REV_1_TANGGAL', $skko->REV_1_TANGGAL) }}"
                               class="form-input">

                    </div>

                    <div>

                        <label class="form-label">
                            Nilai Revisi 1
                        </label>

                        <input type="number"
                               name="REV_1_NILAI"
                               value="{{ old('REV_1_NILAI', $skko->REV_1_NILAI) }}"
                               min="0"
                               step="0.01"
                               class="form-input"
                               placeholder="0">

                    </div>

                </div>

            </div>

        </div>


        {{-- REV 2 --}}
        <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden mb-5">

            <div class="px-6 py-5 border-b border-gray-100 bg-gradient-to-r from-blue-50 to-white">

                <div class="flex items-center gap-3">

                    <div class="w-10 h-10 rounded-xl bg-blue-100 flex items-center justify-center">

                        <svg class="w-5 h-5 text-[#003082]"
                             fill="none"
                             stroke="currentColor"
                             viewBox="0 0 24 24">

                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="2"
                                  d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>

                        </svg>

                    </div>

                    <div>

                        <h2 class="font-bold text-gray-800">
                            Revisi 2
                        </h2>

                        <p class="text-xs text-gray-500 mt-0.5">
                            Informasi perubahan atau revisi kedua SKKO
                        </p>

                    </div>

                </div>

            </div>


            <div class="p-6">

                <div class="grid grid-cols-1 md:grid-cols-3 gap-5">

                    <div>

                        <label class="form-label">
                            No SKKO Revisi 2
                        </label>

                        <input type="text"
                               name="REV_2_NO_SKKO"
                               value="{{ old('REV_2_NO_SKKO', $skko->REV_2_NO_SKKO) }}"
                               class="form-input"
                               placeholder="Masukkan nomor">

                    </div>

                    <div>

                        <label class="form-label">
                            Tanggal Revisi 2
                        </label>

                        <input type="date"
                               name="REV_2_TANGGAL"
                               value="{{ old('REV_2_TANGGAL', $skko->REV_2_TANGGAL) }}"
                               class="form-input">

                    </div>

                    <div>

                        <label class="form-label">
                            Nilai Revisi 2
                        </label>

                        <input type="number"
                               name="REV_2_NILAI"
                               value="{{ old('REV_2_NILAI', $skko->REV_2_NILAI) }}"
                               min="0"
                               step="0.01"
                               class="form-input"
                               placeholder="0">

                    </div>

                </div>

            </div>

        </div>


        {{-- REV 3 --}}
        <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden mb-5">

            <div class="px-6 py-5 border-b border-gray-100 bg-gradient-to-r from-blue-50 to-white">

                <div class="flex items-center gap-3">

                    <div class="w-10 h-10 rounded-xl bg-blue-100 flex items-center justify-center">

                        <svg class="w-5 h-5 text-[#003082]"
                             fill="none"
                             stroke="currentColor"
                             viewBox="0 0 24 24">

                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="2"
                                  d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>

                        </svg>

                    </div>

                    <div>

                        <h2 class="font-bold text-gray-800">
                            Revisi 3
                        </h2>

                        <p class="text-xs text-gray-500 mt-0.5">
                            Informasi perubahan atau revisi ketiga SKKO
                        </p>

                    </div>

                </div>

            </div>


            <div class="p-6">

                <div class="grid grid-cols-1 md:grid-cols-3 gap-5">

                    <div>

                        <label class="form-label">
                            No SKKO Revisi 3
                        </label>

                        <input type="text"
                               name="REV_3_NO_SKKO"
                               value="{{ old('REV_3_NO_SKKO', $skko->REV_3_NO_SKKO) }}"
                               class="form-input"
                               placeholder="Masukkan nomor">

                    </div>

                    <div>

                        <label class="form-label">
                            Tanggal Revisi 3
                        </label>

                        <input type="date"
                               name="REV_3_TANGGAL"
                               value="{{ old('REV_3_TANGGAL', $skko->REV_3_TANGGAL) }}"
                               class="form-input">

                    </div>

                    <div>

                        <label class="form-label">
                            Nilai Revisi 3
                        </label>

                        <input type="number"
                               name="REV_3_NILAI"
                               value="{{ old('REV_3_NILAI', $skko->REV_3_NILAI) }}"
                               min="0"
                               step="0.01"
                               class="form-input"
                               placeholder="0">

                    </div>

                </div>

            </div>

        </div>


        {{-- REV 4 --}}
        <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden mb-5">

            <div class="px-6 py-5 border-b border-gray-100 bg-gradient-to-r from-blue-50 to-white">

                <div class="flex items-center gap-3">

                    <div class="w-10 h-10 rounded-xl bg-blue-100 flex items-center justify-center">

                        <svg class="w-5 h-5 text-[#003082]"
                             fill="none"
                             stroke="currentColor"
                             viewBox="0 0 24 24">

                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="2"
                                  d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>

                        </svg>

                    </div>

                    <div>

                        <h2 class="font-bold text-gray-800">
                            Revisi 4
                        </h2>

                        <p class="text-xs text-gray-500 mt-0.5">
                            Informasi perubahan atau revisi keempat SKKO
                        </p>

                    </div>

                </div>

            </div>


            <div class="p-6">

                <div class="grid grid-cols-1 md:grid-cols-3 gap-5">

                    <div>

                        <label class="form-label">
                            No SKKO Revisi 4
                        </label>

                        <input type="text"
                               name="REV_4_NO_SKKO"
                               value="{{ old('REV_4_NO_SKKO', $skko->REV_4_NO_SKKO) }}"
                               class="form-input"
                               placeholder="Masukkan nomor">

                    </div>

                    <div>

                        <label class="form-label">
                            Tanggal Revisi 4
                        </label>

                        <input type="date"
                               name="REV_4_TANGGAL"
                               value="{{ old('REV_4_TANGGAL', $skko->REV_4_TANGGAL) }}"
                               class="form-input">

                    </div>

                    <div>

                        <label class="form-label">
                            Nilai Revisi 4
                        </label>

                        <input type="number"
                               name="REV_4_NILAI"
                               value="{{ old('REV_4_NILAI', $skko->REV_4_NILAI) }}"
                               min="0"
                               step="0.01"
                               class="form-input"
                               placeholder="0">

                    </div>

                </div>

            </div>

        </div>


        {{-- SKKO TERBIT --}}
        <div class="bg-white rounded-2xl border-2 border-blue-100 shadow-sm overflow-hidden mb-6">

            <div class="px-6 py-5 border-b border-blue-100 bg-gradient-to-r from-blue-50 to-white">

                <div class="flex items-center gap-3">

                    <div class="w-10 h-10 rounded-xl bg-[#003082] flex items-center justify-center">

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
                            Informasi SKKO yang telah diterbitkan
                        </p>

                    </div>

                </div>

            </div>


            <div class="p-6">

                <div class="grid grid-cols-1 md:grid-cols-3 gap-5">

                    {{-- NO SKKO --}}
                    <div>

                        <label class="form-label">
                            No SKKO Terbit
                        </label>

                        <input type="text"
                               name="SKKO_TERBIT_NO_SKKO"
                               value="{{ old('SKKO_TERBIT_NO_SKKO', $skko->SKKO_TERBIT_NO_SKKO) }}"
                               class="form-input"
                               placeholder="Masukkan nomor SKKO">

                    </div>


                    {{-- TANGGAL --}}
                    <div>

                        <label class="form-label">
                            Tanggal SKKO Terbit
                        </label>

                        <input type="date"
                               name="SKKO_TERBIT_TANGGAL"
                               value="{{ old('SKKO_TERBIT_TANGGAL', $skko->SKKO_TERBIT_TANGGAL) }}"
                               class="form-input">

                    </div>


                    {{-- NILAI --}}
                    <div>

                        <label class="form-label">
                            Nilai SKKO Terbit
                        </label>

                        <input type="number"
                               name="SKKO_TERBIT_NILAI"
                               value="{{ old('SKKO_TERBIT_NILAI', $skko->SKKO_TERBIT_NILAI) }}"
                               min="0"
                               step="0.01"
                               class="form-input"
                               placeholder="0">

                    </div>

                </div>

            </div>

        </div>


        {{-- BUTTON --}}
        <div class="flex flex-col-reverse sm:flex-row items-center justify-end gap-3">

            <a href="{{ route('skko.index') }}"
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

                    Update Data SKKO

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
