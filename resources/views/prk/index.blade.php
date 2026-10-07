@extends('layouts.app')

@section('title', 'Data PRK LKAO')

@section('content')

<div class="p-4 lg:p-6">

    {{-- HEADER --}}
<div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">

    <div>
        <h1 class="text-2xl font-bold text-gray-800">
            Data PRK LKAO
        </h1>

        <p class="text-sm text-gray-500 mt-1">
            Kelola seluruh data PRK LKAO dan anggaran tahun 2026
        </p>
    </div>

    <div class="flex flex-col sm:flex-row gap-2">

        {{-- IMPORT EXCEL --}}
        <form action="{{ route('prk.import') }}"
              method="POST"
              enctype="multipart/form-data">

            @csrf

            <label
                class="inline-flex items-center justify-center gap-2
                       px-4 py-2.5 bg-green-600 hover:bg-green-700
                       text-white text-sm font-semibold rounded-lg
                       shadow-sm transition cursor-pointer">

                <svg class="w-5 h-5"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24">

                    <path stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M12 3v12m0 0l-4-4m4 4l4-4M5 21h14" />

                </svg>

                Import Excel

                <input
                    type="file"
                    name="file"
                    accept=".xlsx,.xls,.csv"
                    class="hidden"
                    onchange="this.form.submit()">

            </label>

        </form>


        {{-- TAMBAH PRK --}}
        <a href="{{ route('prk.create') }}"
            class="inline-flex items-center justify-center gap-2
                   px-4 py-2.5 bg-pln-blue hover:bg-pln-light
                   text-white text-sm font-semibold rounded-lg
                   shadow-sm transition">

            <svg class="w-5 h-5"
                fill="none"
                stroke="currentColor"
                viewBox="0 0 24 24">

                <path stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M12 4v16m8-8H4" />

            </svg>

            Tambah PRK

        </a>

    </div>

</div>


    {{-- SUCCESS MESSAGE --}}
    @if (session('success'))
        <div class="mb-5 flex items-center gap-3 p-4
                    rounded-xl bg-green-50 border border-green-200
                    text-green-700">

            <svg class="w-5 h-5 flex-shrink-0"
                fill="none"
                stroke="currentColor"
                viewBox="0 0 24 24">

                <path stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M5 13l4 4L19 7" />

            </svg>

            <span class="text-sm font-medium">
                {{ session('success') }}
            </span>

        </div>
    @endif


    {{-- ERROR MESSAGE --}}
    @if ($errors->any())
        <div class="mb-5 p-4 rounded-xl bg-red-50
                    border border-red-200 text-red-700">

            <p class="font-semibold text-sm mb-2">
                Terjadi kesalahan:
            </p>

            <ul class="list-disc list-inside text-sm">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>

        </div>
    @endif


    {{-- TABLE CARD --}}
    <div class="bg-white rounded-xl border border-gray-100
                shadow-sm overflow-hidden">

        {{-- CARD HEADER --}}
        <div class="px-5 py-4 border-b border-gray-100">

            <div class="flex flex-col lg:flex-row
                        lg:items-center lg:justify-between gap-4">

                <div>
                    <h2 class="font-semibold text-gray-800">
                        Daftar Seluruh Data PRK LKAO
                    </h2>

                    <p class="text-xs text-gray-500 mt-1">
                        Seluruh data PRK, anggaran, kontrak, pembayaran,
                        rencana bulanan, dan proyeksi.
                    </p>
                </div>


                {{-- SEARCH --}}
                <div class="relative">

                    <input type="text"
                        id="searchPRK"
                        placeholder="Cari data PRK..."
                        class="w-full lg:w-72 pl-9 pr-3 py-2
                               text-sm border border-gray-200
                               rounded-lg
                               focus:outline-none
                               focus:ring-2 focus:ring-blue-100
                               focus:border-pln-blue">

                    <svg class="absolute left-3 top-2.5
                                w-4 h-4 text-gray-400"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24">

                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M21 21l-4.35-4.35m0 0
                               A7.5 7.5 0 103.5 9.5
                               a7.5 7.5 0 0013.15 7.15z" />

                    </svg>

                </div>

            </div>

        </div>


        {{-- INFO --}}
        <div class="px-5 py-3 bg-blue-50 border-b border-blue-100">

            <p class="text-xs text-blue-700">
                <strong>{{ $dataPrk->count() }}</strong>
                data PRK terdaftar.
                Geser tabel ke kanan untuk melihat seluruh informasi.
            </p>

        </div>


        {{-- TABLE --}}
        <div class="overflow-x-auto">

            <table id="tablePRK"
                class="min-w-max w-full text-sm border-collapse">

                {{-- TABLE HEAD --}}
                <thead>

                    {{-- GROUP HEADER --}}
                    <tr class="bg-[#003082] text-white">

                        <th rowspan="2"
                            class="px-4 py-3 border border-blue-800">
                            No
                        </th>

                        <th colspan="6"
                            class="px-4 py-3 text-center border border-blue-800">
                            Informasi PRK
                        </th>

                        <th colspan="2"
                            class="px-4 py-3 text-center border border-blue-800">
                            Anggaran
                        </th>

                        <th colspan="6"
                            class="px-4 py-3 text-center border border-blue-800">
                            Kontrak dan Realisasi
                        </th>

                        <th colspan="3"
                            class="px-4 py-3 text-center border border-blue-800">
                            Pembayaran
                        </th>

                        <th rowspan="2"
                            class="px-4 py-3 text-center border border-blue-800">
                            Uraian Rencana Kontrak
                        </th>

                        <th colspan="12"
                            class="px-4 py-3 text-center border border-blue-800">
                            Rencana Bulanan
                        </th>

                        <th colspan="4"
                            class="px-4 py-3 text-center border border-blue-800">
                            Prognosa dan Proyeksi
                        </th>

                        <th rowspan="2"
                            class="px-4 py-3 text-center border border-blue-800">
                            Aksi
                        </th>

                    </tr>


                    {{-- COLUMN HEADER --}}
                    <tr class="bg-[#0064B4] text-white text-xs">

                        {{-- INFORMASI PRK --}}
                        <th class="px-4 py-3 border border-blue-700">
                            SKKO
                        </th>

                        <th class="px-4 py-3 border border-blue-700">
                            PRK LKAO
                        </th>

                        <th class="px-4 py-3 border border-blue-700">
                            NO PRK
                        </th>

                        <th class="px-4 py-3 border border-blue-700">
                            UNSUR 1
                        </th>

                        <th class="px-4 py-3 border border-blue-700">
                            KEGIATAN
                        </th>

                        <th class="px-4 py-3 border border-blue-700">
                            BIDANG
                        </th>


                        {{-- ANGGARAN --}}
                        <th class="px-4 py-3 border border-blue-700">
                            NILAI PRK TERBIT AWAL
                        </th>

                        <th class="px-4 py-3 border border-blue-700">
                            NOTA DINAS NILAI
                        </th>


                        {{-- KONTRAK --}}
                        <th class="px-4 py-3 border border-blue-700">
                            KONTRAK %
                        </th>

                        <th class="px-4 py-3 border border-blue-700">
                            KONTRAK NILAI
                        </th>

                        <th class="px-4 py-3 border border-blue-700">
                            REALISASI KONTRAK %
                        </th>

                        <th class="px-4 py-3 border border-blue-700">
                            REALISASI KONTRAK NILAI
                        </th>

                        <th class="px-4 py-3 border border-blue-700">
                            SISA ANGGARAN NILAI
                        </th>

                        <th class="px-4 py-3 border border-blue-700">
                            SISA ANGGARAN %
                        </th>


                        {{-- PEMBAYARAN --}}
                        <th class="px-4 py-3 border border-blue-700">
                            TOTAL USUL BAYAR
                        </th>

                        <th class="px-4 py-3 border border-blue-700">
                            TOTAL GIRO TERBAYAR
                        </th>

                        <th class="px-4 py-3 border border-blue-700">
                            TOTAL OUTSTANDING
                        </th>


                        {{-- RENCANA BULANAN --}}
                        <th class="px-4 py-3 border border-blue-700">
                            JAN
                        </th>

                        <th class="px-4 py-3 border border-blue-700">
                            FEB
                        </th>

                        <th class="px-4 py-3 border border-blue-700">
                            MAR
                        </th>

                        <th class="px-4 py-3 border border-blue-700">
                            APR
                        </th>

                        <th class="px-4 py-3 border border-blue-700">
                            MEI
                        </th>

                        <th class="px-4 py-3 border border-blue-700">
                            JUN
                        </th>

                        <th class="px-4 py-3 border border-blue-700">
                            JUL
                        </th>

                        <th class="px-4 py-3 border border-blue-700">
                            AGS
                        </th>

                        <th class="px-4 py-3 border border-blue-700">
                            SEP
                        </th>

                        <th class="px-4 py-3 border border-blue-700">
                            OKT
                        </th>

                        <th class="px-4 py-3 border border-blue-700">
                            NOV
                        </th>

                        <th class="px-4 py-3 border border-blue-700">
                            DES
                        </th>


                        {{-- PROGNOSA --}}
                        <th class="px-4 py-3 border border-blue-700">
                            PROGNOSA TERKONTRAK NILAI
                        </th>

                        <th class="px-4 py-3 border border-blue-700">
                            PROGNOSA TERKONTRAK %
                        </th>

                        <th class="px-4 py-3 border border-blue-700">
                            PROYEKSI SISA NILAI
                        </th>

                        <th class="px-4 py-3 border border-blue-700">
                            PROYEKSI SISA %
                        </th>

                    </tr>

                </thead>


                {{-- TABLE BODY --}}
                <tbody class="divide-y divide-gray-100">

                    @forelse ($dataPrk as $prk)

                        <tr class="hover:bg-blue-50 transition">

                            {{-- NO --}}
                            <td class="px-4 py-3 border-r border-gray-100 text-center">
                                {{ $loop->iteration }}
                            </td>


                            {{-- INFORMASI PRK --}}
                            <td class="px-4 py-3 border-r border-gray-100">
                                {{ $prk->skko ?? '-' }}
                            </td>

                            <td class="px-4 py-3 border-r border-gray-100">
                                {{ $prk->prk_lkao ?? '-' }}
                            </td>

                            <td class="px-4 py-3 border-r border-gray-100">
                                {{ $prk->no_prk ?? '-' }}
                            </td>

                            <td class="px-4 py-3 border-r border-gray-100">
                                {{ $prk->unsur_1 ?? '-' }}
                            </td>

                            <td class="px-4 py-3 border-r border-gray-100">
                                {{ $prk->kegiatan ?? '-' }}
                            </td>

                            <td class="px-4 py-3 border-r border-gray-100">
                                {{ $prk->bidang ?? '-' }}
                            </td>


                            {{-- ANGGARAN --}}
                            <td class="px-4 py-3 border-r border-gray-100 whitespace-nowrap">
                                Rp {{ number_format($prk->nilai_prk_terbit_awal ?? 0, 0, ',', '.') }}
                            </td>

                            <td class="px-4 py-3 border-r border-gray-100 whitespace-nowrap">
                                Rp {{ number_format($prk->nota_dinas_nilai ?? 0, 0, ',', '.') }}
                            </td>


                            {{-- KONTRAK --}}
                            <td class="px-4 py-3 border-r border-gray-100 whitespace-nowrap">
                                {{ number_format($prk->kontrak_persen ?? 0, 2, ',', '.') }}%
                            </td>

                            <td class="px-4 py-3 border-r border-gray-100 whitespace-nowrap">
                                Rp {{ number_format($prk->kontrak_nilai ?? 0, 0, ',', '.') }}
                            </td>

                            <td class="px-4 py-3 border-r border-gray-100 whitespace-nowrap">
                                {{ number_format($prk->realisasi_kontrak_persen ?? 0, 2, ',', '.') }}%
                            </td>

                            <td class="px-4 py-3 border-r border-gray-100 whitespace-nowrap">
                                Rp {{ number_format($prk->realisasi_kontrak_nilai ?? 0, 0, ',', '.') }}
                            </td>

                            <td class="px-4 py-3 border-r border-gray-100 whitespace-nowrap">
                                Rp {{ number_format($prk->sisa_anggaran_nilai ?? 0, 0, ',', '.') }}
                            </td>

                            <td class="px-4 py-3 border-r border-gray-100 whitespace-nowrap">
                                {{ number_format($prk->sisa_anggaran_persen ?? 0, 2, ',', '.') }}%
                            </td>


                            {{-- PEMBAYARAN --}}
                            <td class="px-4 py-3 border-r border-gray-100 whitespace-nowrap">
                                Rp {{ number_format($prk->total_usul_bayar ?? 0, 0, ',', '.') }}
                            </td>

                            <td class="px-4 py-3 border-r border-gray-100 whitespace-nowrap">
                                Rp {{ number_format($prk->total_giro_terbayar ?? 0, 0, ',', '.') }}
                            </td>

                            <td class="px-4 py-3 border-r border-gray-100 whitespace-nowrap">
                                Rp {{ number_format($prk->total_outstanding ?? 0, 0, ',', '.') }}
                            </td>


                            {{-- URAIAN RENCANA KONTRAK --}}
                            <td class="px-4 py-3 border-r border-gray-100 max-w-xs">
                                <div class="max-w-xs whitespace-normal">
                                    {{ $prk->uraian_rencana_kontrak ?? '-' }}
                                </div>
                            </td>


                            {{-- RENCANA BULANAN --}}
                            <td class="px-4 py-3 border-r border-gray-100 whitespace-nowrap">
                                Rp {{ number_format($prk->rencana_jan ?? 0, 0, ',', '.') }}
                            </td>

                            <td class="px-4 py-3 border-r border-gray-100 whitespace-nowrap">
                                Rp {{ number_format($prk->rencana_feb ?? 0, 0, ',', '.') }}
                            </td>

                            <td class="px-4 py-3 border-r border-gray-100 whitespace-nowrap">
                                Rp {{ number_format($prk->rencana_mar ?? 0, 0, ',', '.') }}
                            </td>

                            <td class="px-4 py-3 border-r border-gray-100 whitespace-nowrap">
                                Rp {{ number_format($prk->rencana_apr ?? 0, 0, ',', '.') }}
                            </td>

                            <td class="px-4 py-3 border-r border-gray-100 whitespace-nowrap">
                                Rp {{ number_format($prk->rencana_mei ?? 0, 0, ',', '.') }}
                            </td>

                            <td class="px-4 py-3 border-r border-gray-100 whitespace-nowrap">
                                Rp {{ number_format($prk->rencana_jun ?? 0, 0, ',', '.') }}
                            </td>

                            <td class="px-4 py-3 border-r border-gray-100 whitespace-nowrap">
                                Rp {{ number_format($prk->rencana_jul ?? 0, 0, ',', '.') }}
                            </td>

                            <td class="px-4 py-3 border-r border-gray-100 whitespace-nowrap">
                                Rp {{ number_format($prk->rencana_ags ?? 0, 0, ',', '.') }}
                            </td>

                            <td class="px-4 py-3 border-r border-gray-100 whitespace-nowrap">
                                Rp {{ number_format($prk->rencana_sep ?? 0, 0, ',', '.') }}
                            </td>

                            <td class="px-4 py-3 border-r border-gray-100 whitespace-nowrap">
                                Rp {{ number_format($prk->rencana_okt ?? 0, 0, ',', '.') }}
                            </td>

                            <td class="px-4 py-3 border-r border-gray-100 whitespace-nowrap">
                                Rp {{ number_format($prk->rencana_nov ?? 0, 0, ',', '.') }}
                            </td>

                            <td class="px-4 py-3 border-r border-gray-100 whitespace-nowrap">
                                Rp {{ number_format($prk->rencana_des ?? 0, 0, ',', '.') }}
                            </td>


                            {{-- PROGNOSA DAN PROYEKSI --}}
                            <td class="px-4 py-3 border-r border-gray-100 whitespace-nowrap">
                                Rp {{ number_format($prk->prognosa_terkontrak_nilai ?? 0, 0, ',', '.') }}
                            </td>

                            <td class="px-4 py-3 border-r border-gray-100 whitespace-nowrap">
                                {{ number_format($prk->prognosa_terkontrak_persen ?? 0, 2, ',', '.') }}%
                            </td>

                            <td class="px-4 py-3 border-r border-gray-100 whitespace-nowrap">
                                Rp {{ number_format($prk->proyeksi_sisa_nilai ?? 0, 0, ',', '.') }}
                            </td>

                            <td class="px-4 py-3 border-r border-gray-100 whitespace-nowrap">
                                {{ number_format($prk->proyeksi_sisa_persen ?? 0, 2, ',', '.') }}%
                            </td>


                            {{-- AKSI --}}
                            <td class="px-4 py-3">

                                <div class="flex items-center justify-center gap-2">

                                    {{-- DETAIL --}}
                                    <a href="{{ route('prk.show', ['prk' => $prk->id]) }}"
                                        title="Detail"
                                        class="inline-flex items-center justify-center gap-1.5
                                               px-3 py-2 rounded-lg
                                               bg-blue-50 text-pln-blue
                                               text-xs font-semibold
                                               hover:bg-blue-100 transition">

                                        <svg class="w-4 h-4"
                                            fill="none"
                                            stroke="currentColor"
                                            viewBox="0 0 24 24">

                                            <path stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M15 12a3 3 0 11-6 0
                                                   3 3 0 016 0z" />

                                            <path stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M2.458 12C3.732 7.943
                                                   7.523 5 12 5
                                                   c4.477 0 8.268 2.943
                                                   9.542 7
                                                   -1.274 4.057-5.065 7
                                                   -9.542 7
                                                   -4.477 0-8.268-2.943
                                                   -9.542-7z" />

                                        </svg>

                                        <span>Lihat</span>

                                    </a>


                                    {{-- EDIT --}}
                                    <a href="{{ route('prk.edit', ['prk' => $prk->id])  }}"
                                        title="Edit"
                                        class="inline-flex items-center justify-center gap-1.5
                                               px-3 py-2 rounded-lg
                                               bg-yellow-50 text-yellow-600
                                               text-xs font-semibold
                                               hover:bg-yellow-100 transition">

                                        <svg class="w-4 h-4"
                                            fill="none"
                                            stroke="currentColor"
                                            viewBox="0 0 24 24">

                                            <path stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11
                                                   a2 2 0 002-2v-5" />

                                            <path stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1
                                                   1-4 9.5-9.5z" />

                                        </svg>

                                        <span>Edit</span>

                                    </a>


                                    {{-- DELETE --}}
                                    <form action="{{ route('prk.destroy', $prk->id) }}"
    method="POST"
    class="inline"
    onsubmit="return openDeleteModal(this)">

    @csrf
    @method('DELETE')

    <button type="submit"
        title="Hapus"
        class="inline-flex items-center justify-center gap-1.5
               px-3 py-2 rounded-lg
               bg-red-50 text-red-600
               text-xs font-semibold
               hover:bg-red-100 transition">

        <svg class="w-4 h-4"
            fill="none"
            stroke="currentColor"
            viewBox="0 0 24 24">

            <path stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862
                   a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6
                   M9 7V4a1 1 0 011-1h4a1 1 0 011 1v3
                   M4 7h16" />

        </svg>

        <span>Hapus</span>

    </button>

</form>

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="48"
                                class="px-5 py-16 text-center">

                                <div class="flex flex-col items-center">

                                    <div class="w-16 h-16 rounded-full
                                                bg-blue-50
                                                flex items-center justify-center mb-4">

                                        <svg class="w-8 h-8 text-pln-blue"
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
                                                   a2 2 0 01-2 2z" />

                                        </svg>

                                    </div>

                                    <p class="font-semibold text-gray-700">
                                        Belum ada data PRK
                                    </p>

                                    <p class="text-sm text-gray-400 mt-1">
                                        Silakan tambahkan data PRK terlebih dahulu.
                                    </p>

                                    <a href="{{ route('prk.create') }}"
                                        class="mt-4 inline-flex items-center
                                               gap-2 px-4 py-2
                                               bg-pln-blue text-white
                                               rounded-lg text-sm font-semibold
                                               hover:bg-pln-light transition">

                                        + Tambah PRK

                                    </a>

                                </div>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>


{{-- SEARCH --}}
<script>
    document.getElementById('searchPRK').addEventListener('keyup', function () {

        let keyword = this.value.toLowerCase();

        document.querySelectorAll('#tablePRK tbody tr').forEach(function (row) {

            row.style.display =
                row.innerText.toLowerCase().includes(keyword)
                    ? ''
                    : 'none';

        });

    });
</script>

@endsection
