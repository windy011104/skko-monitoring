@extends('layouts.app')

@section('title', 'Detail MON Per SKKO')

@section('content')

    <div class="p-4 lg:p-6">

        {{-- HEADER --}}
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">

            <div>

                <h1 class="text-2xl font-bold text-gray-800">
                    Detail Monitoring SKKO
                </h1>

                <p class="text-sm text-gray-500 mt-1">
                    Detail PRK yang terkait dengan SKKO
                </p>

            </div>


            {{-- KEMBALI --}}
            <a
                href="{{ route('monitoring.index') }}"
                class="inline-flex items-center justify-center gap-2
                       px-4 py-2.5
                       bg-gray-100 hover:bg-gray-200
                       text-gray-700
                       text-sm font-semibold
                       rounded-lg
                       shadow-sm
                       transition">

                <svg
                    class="w-5 h-5"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24">

                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M10 19l-7-7m0 0l7-7m-7 7h18" />

                </svg>

                Kembali

            </a>

        </div>


        {{-- INFORMASI SKKO --}}
        <div class="bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden mb-6">

            <div class="px-5 py-4 border-b border-gray-100">

                <h2 class="font-semibold text-gray-800">
                    Informasi SKKO
                </h2>

                <p class="text-xs text-gray-500 mt-1">
                    Informasi SKKO berdasarkan data PRK
                </p>

            </div>


            <div class="p-5">

                <div class="bg-blue-50 border border-blue-100 rounded-xl p-4">

                    <p class="text-xs text-blue-600 font-semibold mb-1">
                        NO. SKKO
                    </p>

                    <p class="text-lg font-bold text-pln-blue break-all">
                        {{ $skko }}
                    </p>

                </div>

            </div>

        </div>


        {{-- DATA PRK --}}
        <div class="bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden">

            {{-- CARD HEADER --}}
            <div class="px-5 py-4 border-b border-gray-100">

                <div class="flex flex-col lg:flex-row
                            lg:items-center lg:justify-between gap-4">

                    <div>

                        <h2 class="font-semibold text-gray-800">
                            PRK Terkait
                        </h2>

                        <p class="text-xs text-gray-500 mt-1">

                            Terdapat
                            <strong>{{ $dataPrk->count() }}</strong>
                            PRK yang terkait dengan SKKO ini.

                        </p>

                    </div>


                    {{-- SEARCH PRK --}}
                    <div class="relative">

                        <input
                            type="text"
                            id="searchPRK"
                            placeholder="Cari PRK..."
                            class="w-full lg:w-72 pl-9 pr-3 py-2
                                   text-sm border border-gray-200
                                   rounded-lg
                                   focus:outline-none
                                   focus:ring-2 focus:ring-blue-100
                                   focus:border-pln-blue">

                        <svg
                            class="absolute left-3 top-2.5
                                   w-4 h-4 text-gray-400"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24">

                            <path
                                stroke-linecap="round"
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
                    PRK terkait dengan SKKO ini.

                    Data ditampilkan berdasarkan data PRK yang tersimpan
                    di sistem.

                </p>

            </div>


            {{-- TABLE --}}
            <div class="overflow-x-auto">

                <table
                    id="tablePRK"
                    class="min-w-max w-full text-sm border-collapse">

                    <thead>

                        <tr class="bg-[#003082] text-white">

                            <th class="px-4 py-3 border border-blue-800">
                                No
                            </th>

                            <th class="px-4 py-3 border border-blue-800">
                                PRK LKAO
                            </th>

                            <th class="px-4 py-3 border border-blue-800">
                                NO PRK
                            </th>

                            <th class="px-4 py-3 border border-blue-800">
                                UNSUR
                            </th>

                            <th class="px-4 py-3 border border-blue-800">
                                KEGIATAN
                            </th>

                            <th class="px-4 py-3 border border-blue-800">
                                BIDANG
                            </th>

                            <th class="px-4 py-3 border border-blue-800">
                                NILAI PRK
                            </th>

                            <th class="px-4 py-3 border border-blue-800">
                                KONTRAK
                            </th>

                            <th class="px-4 py-3 border border-blue-800">
                                REALISASI
                            </th>

                            <th class="px-4 py-3 border border-blue-800">
                                SISA ANGGARAN
                            </th>

                        </tr>

                    </thead>


                    <tbody class="divide-y divide-gray-100">

                        @foreach ($dataPrk as $prk)

                            <tr class="hover:bg-blue-50 transition">

                                {{-- NO --}}
                                <td
                                    class="px-4 py-3 border-r border-gray-100 text-center">

                                    {{ $loop->iteration }}

                                </td>


                                {{-- PRK LKAO --}}
                                <td
                                    class="px-4 py-3 border-r border-gray-100">

                                    <span class="font-semibold text-pln-blue">

                                        {{ $prk->prk_lkao ?? '-' }}

                                    </span>

                                </td>


                                {{-- NO PRK --}}
                                <td
                                    class="px-4 py-3 border-r border-gray-100">

                                    {{ $prk->no_prk ?? '-' }}

                                </td>


                                {{-- UNSUR --}}
                                <td
                                    class="px-4 py-3 border-r border-gray-100">

                                    {{ $prk->unsur_1 ?? '-' }}

                                </td>


                                {{-- KEGIATAN --}}
                                <td
                                    class="px-4 py-3 border-r border-gray-100">

                                    <div class="max-w-xs whitespace-normal">

                                        {{ $prk->kegiatan ?? '-' }}

                                    </div>

                                </td>


                                {{-- BIDANG --}}
                                <td
                                    class="px-4 py-3 border-r border-gray-100">

                                    {{ $prk->bidang ?? '-' }}

                                </td>


                                {{-- NILAI PRK --}}
                                <td
                                    class="px-4 py-3 border-r border-gray-100 whitespace-nowrap">

                                    Rp
                                    {{ number_format($prk->nilai_prk_terbit_awal ?? 0, 0, ',', '.') }}

                                </td>


                                {{-- KONTRAK --}}
                                <td
                                    class="px-4 py-3 border-r border-gray-100 whitespace-nowrap">

                                    Rp
                                    {{ number_format($prk->kontrak_nilai ?? 0, 0, ',', '.') }}

                                </td>


                                {{-- REALISASI --}}
                                <td
                                    class="px-4 py-3 border-r border-gray-100 whitespace-nowrap">

                                    Rp
                                    {{ number_format($prk->realisasi_kontrak_nilai ?? 0, 0, ',', '.') }}

                                </td>


                                {{-- SISA ANGGARAN --}}
                                <td
                                    class="px-4 py-3 border-r border-gray-100 whitespace-nowrap">

                                    Rp
                                    {{ number_format($prk->sisa_anggaran_nilai ?? 0, 0, ',', '.') }}

                                </td>

                            </tr>

                        @endforeach


                        {{-- TOTAL --}}
                        <tr class="bg-gray-50 font-semibold">

                            <td
                                colspan="6"
                                class="px-4 py-4 text-right border-r border-gray-200">

                                TOTAL

                            </td>


                            <td
                                class="px-4 py-4 whitespace-nowrap">

                                Rp
                                {{ number_format($dataPrk->sum('nilai_prk_terbit_awal'), 0, ',', '.') }}

                            </td>


                            <td
                                class="px-4 py-4 whitespace-nowrap">

                                Rp
                                {{ number_format($dataPrk->sum('kontrak_nilai'), 0, ',', '.') }}

                            </td>


                            <td
                                class="px-4 py-4 whitespace-nowrap">

                                Rp
                                {{ number_format($dataPrk->sum('realisasi_kontrak_nilai'), 0, ',', '.') }}

                            </td>


                            <td
                                class="px-4 py-4 whitespace-nowrap">

                                Rp
                                {{ number_format($dataPrk->sum('sisa_anggaran_nilai'), 0, ',', '.') }}

                            </td>

                        </tr>

                    </tbody>

                </table>

            </div>

        </div>

    </div>


    {{-- SEARCH PRK --}}
    <script>

        document
            .getElementById('searchPRK')
            .addEventListener('keyup', function() {

                let keyword = this.value.toLowerCase();

                document
                    .querySelectorAll('#tablePRK tbody tr')
                    .forEach(function(row) {

                        // Jangan sembunyikan baris TOTAL
                        if (row.innerText.toLowerCase().includes('total')) {
                            return;
                        }

                        row.style.display =
                            row.innerText
                            .toLowerCase()
                            .includes(keyword)
                                ? ''
                                : 'none';

                    });

            });

    </script>

@endsection
