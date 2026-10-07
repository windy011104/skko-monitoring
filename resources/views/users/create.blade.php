@extends('layouts.app')

@section('title', 'Tambah User')

@section('content')

<div class="p-4 lg:p-6">

    <div class="mb-6">

        <h1 class="text-2xl font-bold text-gray-800">
            Tambah User
        </h1>

        <p class="text-sm text-gray-500 mt-1">
            Tambahkan akun pengguna baru ke sistem
        </p>

    </div>


    <form action="{{ route('users.store') }}" method="POST">

        @csrf

        <div class="bg-white rounded-xl shadow-sm
                    border border-gray-100 overflow-hidden">

            <div class="px-5 py-4 border-b border-gray-100">

                <h2 class="font-semibold text-gray-800">
                    Informasi User
                </h2>

            </div>


            <div class="p-5">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">


                    {{-- Nama --}}
                    <div>

                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Nama Lengkap
                        </label>

                        <input type="text"
                            name="name"
                            value="{{ old('name') }}"
                            required
                            placeholder="Masukkan nama lengkap"
                            class="w-full px-4 py-3 border border-gray-200
                                   rounded-lg text-sm
                                   focus:outline-none focus:border-[#003082]">

                        @error('name')
                            <p class="text-xs text-red-500 mt-1">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>


                    {{-- Username --}}
                    <div>

                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Username
                        </label>

                        <input type="text"
                            name="username"
                            value="{{ old('username') }}"
                            required
                            placeholder="Masukkan username"
                            class="w-full px-4 py-3 border border-gray-200
                                   rounded-lg text-sm
                                   focus:outline-none focus:border-[#003082]">

                        @error('username')
                            <p class="text-xs text-red-500 mt-1">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>


                    {{-- Email --}}
                    <div>

                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Email
                        </label>

                        <input type="email"
                            name="email"
                            value="{{ old('email') }}"
                            required
                            placeholder="nama@pln.co.id"
                            class="w-full px-4 py-3 border border-gray-200
                                   rounded-lg text-sm
                                   focus:outline-none focus:border-[#003082]">

                        @error('email')
                            <p class="text-xs text-red-500 mt-1">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>


                    {{-- Password --}}
                    <div>

                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Password
                        </label>

                        <input type="password"
                            name="password"
                            required
                            placeholder="Minimal 6 karakter"
                            class="w-full px-4 py-3 border border-gray-200
                                   rounded-lg text-sm
                                   focus:outline-none focus:border-[#003082]">

                        @error('password')
                            <p class="text-xs text-red-500 mt-1">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>


                    {{-- Role --}}
                    <div>

                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Role
                        </label>

                        <select name="role"
                            required
                            class="w-full px-4 py-3 border border-gray-200
                                   rounded-lg text-sm bg-white
                                   focus:outline-none focus:border-[#003082]">

                            <option value="">Pilih Role</option>
                            <option value="admin" {{ old('role') === 'admin' ? 'selected' : '' }}>
                                Admin
                            </option>
                            <option value="user" {{ old('role') === 'user' ? 'selected' : '' }}>
                                User
                            </option>

                        </select>

                        @error('role')
                            <p class="text-xs text-red-500 mt-1">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>


                    {{-- Bidang --}}
                    <div>

                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Bidang
                        </label>

                        <select
                            name="bidang_id"
                            required
                            class="w-full px-4 py-3 border border-gray-200
                                   rounded-lg text-sm bg-white
                                   focus:outline-none focus:border-[#003082]">

                            <option value="">
                                Pilih Bidang
                            </option>

                            @foreach ($bidangs as $bidang)
                                <option
                                    value="{{ $bidang->id }}"
                                    {{ old('bidang_id') == $bidang->id ? 'selected' : '' }}>
                                    {{ $bidang->nama_bidang }}
                                </option>
                            @endforeach

                        </select>

                        @error('bidang_id')
                            <p class="text-xs text-red-500 mt-1">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>


                    {{-- Unit Kerja --}}
                    <div>

                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Unit Kerja
                        </label>

                        <input type="text"
                            name="unit_kerja"
                            value="{{ old('unit_kerja') }}"
                            placeholder="Contoh: PLN UP3 Bukittinggi"
                            class="w-full px-4 py-3 border border-gray-200
                                   rounded-lg text-sm
                                   focus:outline-none focus:border-[#003082]">

                        @error('unit_kerja')
                            <p class="text-xs text-red-500 mt-1">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>


                    {{-- Jabatan --}}
                    <div>

                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Jabatan
                        </label>

                        <input type="text"
                            name="jabatan"
                            value="{{ old('jabatan') }}"
                            placeholder="Masukkan jabatan"
                            class="w-full px-4 py-3 border border-gray-200
                                   rounded-lg text-sm
                                   focus:outline-none focus:border-[#003082]">

                        @error('jabatan')
                            <p class="text-xs text-red-500 mt-1">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>


                    {{-- Status --}}
                    <div>

                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Status Akun
                        </label>

                        <label class="flex items-center gap-3 mt-3">

                            <input type="checkbox"
                                name="is_active"
                                value="1"
                                checked
                                class="w-4 h-4 text-[#003082] rounded">

                            <span class="text-sm text-gray-700">
                                Akun aktif
                            </span>

                        </label>

                    </div>

                </div>

            </div>


            {{-- BUTTON --}}
            <div class="px-5 py-4 bg-gray-50
                        border-t border-gray-100
                        flex justify-end gap-3">

                <a href="{{ route('users.index') }}"
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
                    Simpan User
                </button>

            </div>

        </div>

    </form>

</div>

@endsection
