@extends('layouts.app')

@section('title', 'Manajemen User')

@section('content')

    <div class="p-4 lg:p-6">

        {{-- HEADER --}}
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">

            <div>

                <h1 class="text-2xl font-bold text-gray-800">
                    Manajemen User
                </h1>

                <p class="text-sm text-gray-500 mt-1">
                    Kelola akun pengguna sistem monitoring SKKO
                </p>

            </div>

            <a href="{{ route('users.create') }}"
                class="inline-flex items-center justify-center gap-2
                   px-4 py-2.5
                   bg-[#003082] text-white
                   rounded-lg text-sm font-semibold
                   hover:bg-[#002568] transition">

                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">

                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />

                </svg>

                Tambah User

            </a>

        </div>


        {{-- SUCCESS --}}
        @if (session('success'))
            <div
                class="mb-5 flex items-center gap-3 p-4
                    rounded-xl bg-green-50
                    border border-green-200
                    text-green-700">

                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">

                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />

                </svg>

                <span class="text-sm font-medium">
                    {{ session('success') }}
                </span>

            </div>
        @endif


        {{-- ERROR --}}
        @if (session('error'))
            <div
                class="mb-5 flex items-center gap-3 p-4
                    rounded-xl bg-red-50
                    border border-red-200
                    text-red-700">

                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">

                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />

                </svg>

                <span class="text-sm font-medium">
                    {{ session('error') }}
                </span>

            </div>
        @endif


        {{-- VALIDATION ERROR --}}
        @if ($errors->any())

            <div class="mb-5 p-4 rounded-xl
                    bg-red-50 border border-red-200 text-red-700">

                <ul class="list-disc list-inside text-sm">

                    @foreach ($errors->all() as $error)
                        <li>
                            {{ $error }}
                        </li>
                    @endforeach

                </ul>

            </div>

        @endif


        {{-- TABLE --}}
        <div class="bg-white rounded-xl shadow-sm
                border border-gray-100 overflow-hidden">

            <div class="px-5 py-4 border-b border-gray-100">

                <h2 class="font-semibold text-gray-800">
                    Daftar Pengguna
                </h2>

                <p class="text-xs text-gray-500 mt-1">
                    Total {{ $users->count() }} pengguna
                </p>

            </div>


            <div class="overflow-x-auto">

                <table class="w-full">

                    <thead class="bg-gray-50 border-b border-gray-100">

                        <tr>

                            <th
                                class="px-5 py-3 text-left text-xs
                                   font-semibold text-gray-500 uppercase">
                                No
                            </th>

                            <th
                                class="px-5 py-3 text-left text-xs
                                   font-semibold text-gray-500 uppercase">
                                Nama
                            </th>

                            <th
                                class="px-5 py-3 text-left text-xs
                                   font-semibold text-gray-500 uppercase">
                                Username
                            </th>

                            <th
                                class="px-5 py-3 text-left text-xs
                                   font-semibold text-gray-500 uppercase">
                                Email
                            </th>

                            <th
                                class="px-5 py-3 text-left text-xs
                                   font-semibold text-gray-500 uppercase">
                                Unit Kerja
                            </th>

                            {{-- BIDANG --}}
                            <th
                                class="px-5 py-3 text-left text-xs
                                   font-semibold text-gray-500 uppercase">
                                Bidang
                            </th>

                            <th
                                class="px-5 py-3 text-center text-xs
                                   font-semibold text-gray-500 uppercase">
                                Role
                            </th>

                            <th
                                class="px-5 py-3 text-center text-xs
                                   font-semibold text-gray-500 uppercase">
                                Status
                            </th>

                            <th
                                class="px-5 py-3 text-center text-xs
                                   font-semibold text-gray-500 uppercase">
                                Aksi
                            </th>

                        </tr>

                    </thead>


                    <tbody class="divide-y divide-gray-50">

                        @forelse ($users as $user)
                            <tr class="hover:bg-gray-50 transition">

                                <td class="px-5 py-4 text-sm text-gray-500">
                                    {{ $loop->iteration }}
                                </td>


                                <td class="px-5 py-4">

                                    <p class="text-sm font-semibold text-gray-800">
                                        {{ $user->name }}
                                    </p>

                                    <p class="text-xs text-gray-400 mt-0.5">
                                        {{ $user->jabatan ?? '-' }}
                                    </p>

                                </td>


                                <td class="px-5 py-4 text-sm text-gray-600">
                                    {{ $user->username }}
                                </td>


                                <td class="px-5 py-4 text-sm text-gray-600">
                                    {{ $user->email }}
                                </td>


                                <td class="px-5 py-4 text-sm text-gray-600">
                                    {{ $user->unit_kerja ?? '-' }}
                                </td>


                                {{-- BIDANG --}}
                                <td class="px-5 py-4">

                                    @if ($user->bidang)
                                        <span
                                            class="inline-flex px-2.5 py-1
                                                 rounded-full
                                                 bg-blue-50 text-blue-700
                                                 text-xs font-semibold">
                                            {{ $user->bidang->nama_bidang }}
                                        </span>
                                    @else
                                        <span class="text-sm text-gray-400">
                                            -
                                        </span>
                                    @endif

                                </td>


                                {{-- ROLE --}}
                                <td class="px-5 py-4 text-center">

                                    @if ($user->isAdmin())
                                        <span
                                            class="inline-flex px-2.5 py-1
                                                 rounded-full
                                                 bg-red-50 text-red-700
                                                 text-xs font-semibold">
                                            Admin
                                        </span>
                                    @else
                                        <span
                                            class="inline-flex px-2.5 py-1
                                                 rounded-full
                                                 bg-blue-50 text-blue-700
                                                 text-xs font-semibold">
                                            User
                                        </span>
                                    @endif

                                </td>


                                {{-- STATUS --}}
                                <td class="px-5 py-4 text-center">

                                    @if ($user->is_active)
                                        <span
                                            class="inline-flex px-2.5 py-1
                                                 rounded-full
                                                 bg-green-50 text-green-700
                                                 text-xs font-semibold">
                                            Aktif
                                        </span>
                                    @else
                                        <span
                                            class="inline-flex px-2.5 py-1
                                                 rounded-full
                                                 bg-gray-100 text-gray-600
                                                 text-xs font-semibold">
                                            Tidak Aktif
                                        </span>
                                    @endif

                                </td>


                                {{-- AKSI --}}
                                <td class="px-5 py-4">

                                    <div class="flex items-center justify-center gap-2">

                                        {{-- EDIT --}}
                                        <a href="{{ route('users.edit', $user) }}" title="Edit"
                                            class="inline-flex items-center justify-center gap-1.5
                                                    px-3 py-2 rounded-lg
                                                    bg-yellow-50 text-yellow-600
                                                    text-xs font-semibold
                                                    hover:bg-yellow-100 transition">

                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">

                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11 a2 2 0 002-2v-5" />

                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z" />

                                            </svg>

                                            <span>Edit</span>

                                        </a>


                                        {{-- HAPUS --}}
                                        @if ($user->id !== auth()->id())
                                            <form action="{{ route('users.destroy', $user) }}" method="POST"
                                                class="inline" onsubmit="return openDeleteModal(this)">

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

                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862
                               a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6
                               M9 7V4a1 1 0 011-1h4a1 1 0 011 1v3
                               M4 7h16" />

                                                    </svg>

                                                    <span>Hapus</span>

                                                </button>

                                            </form>
                                        @endif

                                    </div>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="9" class="px-5 py-12 text-center">

                                    <div class="flex flex-col items-center">

                                        <svg class="w-12 h-12 text-gray-300 mb-3" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">

                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857
                                                       M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857
                                                       M7 20H2v-2a3 3 0 015.356-1.857
                                                       M7 20v-2c0-.656.126-1.283.356-1.857
                                                       m0 0a5.002 5.002 0 019.288 0
                                                       M15 7a3 3 0 11-6 0 3 3 0 016 0z" />

                                        </svg>

                                        <p class="font-semibold text-gray-600">
                                            Belum ada data user
                                        </p>

                                        <p class="text-sm text-gray-400 mt-1">
                                            Silakan tambahkan user terlebih dahulu.
                                        </p>

                                    </div>

                                </td>

                            </tr>
                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>

@endsection
