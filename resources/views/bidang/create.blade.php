@extends('layouts.app')

@section('title', 'Tambah Bidang')

@section('content')

<div class="p-4 lg:p-6">

    <div class="mb-6">

        <h1 class="text-2xl font-bold text-gray-800">
            Tambah Bidang
        </h1>

        <p class="text-sm text-gray-500 mt-1">
            Tambahkan bidang baru ke sistem
        </p>

    </div>


    <form action="{{ route('bidang.store') }}" method="POST">

        @csrf

        <div class="bg-white rounded-xl shadow-sm
                    border border-gray-100 overflow-hidden">

            <div class="px-5 py-4 border-b border-gray-100">

                <h2 class="font-semibold text-gray-800">
                    Informasi Bidang
                </h2>

            </div>


            <div class="p-5">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">


                    {{-- Nama Bidang --}}
                    <div>

                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Nama Bidang
                        </label>

                        <input type="text"
                            name="nama_bidang"
                            value="{{ old('nama_bidang') }}"
                            required
                            placeholder="Contoh: K3L"
                            class="w-full px-4 py-3 border border-gray-200
                                   rounded-lg text-sm
                                   focus:outline-none focus:border-[#003082]">

                        @error('nama_bidang')
                            <p class="text-xs text-red-500 mt-1">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>


                    {{-- Keterangan --}}
                    <div>

                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Keterangan
                        </label>

                        <input type="text"
                            name="keterangan"
                            value="{{ old('keterangan') }}"
                            placeholder="Masukkan keterangan bidang"
                            class="w-full px-4 py-3 border border-gray-200
                                   rounded-lg text-sm
                                   focus:outline-none focus:border-[#003082]">

                        @error('keterangan')
                            <p class="text-xs text-red-500 mt-1">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>


                    {{-- Status --}}
                    <div>

                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Status Bidang
                        </label>

                        <label class="flex items-center gap-3 mt-3">

                            <input type="checkbox"
                                name="is_active"
                                value="1"
                                checked
                                class="w-4 h-4 text-[#003082] rounded">

                            <span class="text-sm text-gray-700">
                                Bidang aktif
                            </span>

                        </label>

                    </div>

                </div>

            </div>


            {{-- BUTTON --}}
            <div class="px-5 py-4 bg-gray-50
                        border-t border-gray-100
                        flex justify-end gap-3">

                <a href="{{ route('bidang.index') }}"
                    class="px-4 py-2.5 rounded-lg
                           bg-white border border-gray-200
                           text-gray-600 text-sm font-semibold
                           hover:bg-gray-100 transition">
                    Batal
                </a>

                <button type="submit"
                    class="px-5 py-2.5 rounded-lg
                           bg-[#003082] text-white
                           text-sm font-semibold
                           hover:bg-[#002568] transition">
                    Simpan Bidang
                </button>

            </div>

        </div>

    </form>

</div>

@endsection
