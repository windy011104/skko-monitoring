<?php

namespace App\Http\Controllers;

use App\Models\SkkoTerbit2026;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Carbon\Carbon;

class SkkoTerbit2026Controller extends Controller
{
    /**
     * Mengecek apakah user boleh mengakses data SKKO.
     * Admin boleh mengakses semua data.
     * User hanya boleh mengakses data sesuai bidangnya.
     */
    private function authorizeData(SkkoTerbit2026 $skko): void
    {
        if (!auth()->user()->isAdmin()) {
            abort_unless(
                $skko->bidang_id === auth()->user()->bidang_id,
                403
            );
        }
    }

    /**
     * Menampilkan data SKKO
     */
    public function index()
    {
        if (auth()->user()->isAdmin()) {
            $dataSkko = SkkoTerbit2026::latest()->get();
        } else {
            $dataSkko = SkkoTerbit2026::where(
                'bidang_id',
                auth()->user()->bidang_id
            )->latest()->get();
        }

        return view('skko.index', compact('dataSkko'));
    }

    /**
     * Menampilkan form tambah SKKO
     */
    public function create()
    {
        return view('skko.create');
    }

    /**
     * Menyimpan data SKKO
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'NO_SKKO' => 'required|string|max:255',
            'POS_ANGGARAN' => 'nullable|string|max:255',
            'TYPE_SKKO' => 'nullable|string|max:255',
            'JENIS_BIAYA_OPERASI' => 'nullable|string|max:255',
            'FUNGSI' => 'nullable|string|max:255',
            'UNSUR' => 'nullable|string|max:255',
            'SUB_UNSUR' => 'nullable|string|max:255',
            'URAIAN' => 'nullable|string',
            'NO_PRK_LKAO' => 'nullable|string|max:255',

            'AWAL_TERBIT_TANGGAL' => 'nullable|date',
            'AWAL_TERBIT_NILAI' => 'nullable|numeric',

            'REV_1_NO_SKKO' => 'nullable|string|max:255',
            'REV_1_TANGGAL' => 'nullable|date',
            'REV_1_NILAI' => 'nullable|numeric',

            'REV_2_NO_SKKO' => 'nullable|string|max:255',
            'REV_2_TANGGAL' => 'nullable|date',
            'REV_2_NILAI' => 'nullable|numeric',

            'REV_3_NO_SKKO' => 'nullable|string|max:255',
            'REV_3_TANGGAL' => 'nullable|date',
            'REV_3_NILAI' => 'nullable|numeric',

            'REV_4_NO_SKKO' => 'nullable|string|max:255',
            'REV_4_TANGGAL' => 'nullable|date',
            'REV_4_NILAI' => 'nullable|numeric',

            'SKKO_TERBIT_NO_SKKO' => 'nullable|string|max:255',
            'SKKO_TERBIT_TANGGAL' => 'nullable|date',
            'SKKO_TERBIT_NILAI' => 'nullable|numeric',
        ]);

        // Bidang otomatis mengikuti user yang sedang login
        $validated['bidang_id'] = auth()->user()->bidang_id;

        SkkoTerbit2026::create($validated);

        return redirect()
            ->route('skko.index')
            ->with('success', 'Data SKKO berhasil ditambahkan.');
    }

    /**
     * Menampilkan detail SKKO
     */
    public function show(SkkoTerbit2026 $skko)
    {
        $this->authorizeData($skko);

        return view('skko.show', compact('skko'));
    }

    /**
     * Menampilkan form edit
     */
    public function edit(SkkoTerbit2026 $skko)
    {
        $this->authorizeData($skko);

        return view('skko.edit', compact('skko'));
    }

    /**
     * Mengupdate data SKKO
     */
    public function update(Request $request, SkkoTerbit2026 $skko)
    {
        $this->authorizeData($skko);

        $validated = $request->validate([
            'NO_SKKO' => 'required|string|max:255',
            'POS_ANGGARAN' => 'nullable|string|max:255',
            'TYPE_SKKO' => 'nullable|string|max:255',
            'JENIS_BIAYA_OPERASI' => 'nullable|string|max:255',
            'FUNGSI' => 'nullable|string|max:255',
            'UNSUR' => 'nullable|string|max:255',
            'SUB_UNSUR' => 'nullable|string|max:255',
            'URAIAN' => 'nullable|string',
            'NO_PRK_LKAO' => 'nullable|string|max:255',

            'AWAL_TERBIT_TANGGAL' => 'nullable|date',
            'AWAL_TERBIT_NILAI' => 'nullable|numeric',

            'REV_1_NO_SKKO' => 'nullable|string|max:255',
            'REV_1_TANGGAL' => 'nullable|date',
            'REV_1_NILAI' => 'nullable|numeric',

            'REV_2_NO_SKKO' => 'nullable|string|max:255',
            'REV_2_TANGGAL' => 'nullable|date',
            'REV_2_NILAI' => 'nullable|numeric',

            'REV_3_NO_SKKO' => 'nullable|string|max:255',
            'REV_3_TANGGAL' => 'nullable|date',
            'REV_3_NILAI' => 'nullable|numeric',

            'REV_4_NO_SKKO' => 'nullable|string|max:255',
            'REV_4_TANGGAL' => 'nullable|date',
            'REV_4_NILAI' => 'nullable|numeric',

            'SKKO_TERBIT_NO_SKKO' => 'nullable|string|max:255',
            'SKKO_TERBIT_TANGGAL' => 'nullable|date',
            'SKKO_TERBIT_NILAI' => 'nullable|numeric',
        ]);

        $skko->update($validated);

        return redirect()
            ->route('skko.index')
            ->with('success', 'Data SKKO berhasil diperbarui.');
    }

    /**
     * Import data SKKO dari Excel
     */
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:xlsx,xls,csv|max:10240',
        ]);

        $file = $request->file('file');

        try {
            $spreadsheet = IOFactory::load($file->getRealPath());
            $worksheet = $spreadsheet->getActiveSheet();

            $rows = $worksheet->toArray(null, true, true, true);

            $imported = 0;

            foreach ($rows as $index => $row) {

                // Lewati baris header
                if ($index <= 4) {
                    continue;
                }

                // Lewati baris kosong
                if (empty(array_filter($row))) {
                    continue;
                }

                SkkoTerbit2026::create([
                    // Bidang otomatis mengikuti user yang login
                    'bidang_id' => auth()->user()->bidang_id,

                    'NO' => $this->cleanNumber($row['A'] ?? null),
                    'POS_ANGGARAN' => $row['B'] ?? null,
                    'TYPE_SKKO' => $row['C'] ?? null,
                    'JENIS_BIAYA_OPERASI' => $row['D'] ?? null,
                    'FUNGSI' => $row['E'] ?? null,
                    'UNSUR' => $row['F'] ?? null,
                    'SUB_UNSUR' => $row['G'] ?? null,
                    'NO_SKKO' => $row['H'] ?? null,
                    'URAIAN' => $row['I'] ?? null,
                    'NO_PRK_LKAO' => $row['J'] ?? null,

                    'AWAL_TERBIT_TANGGAL' => $this->excelDate($row['K'] ?? null),
                    'AWAL_TERBIT_NILAI' => $this->cleanMoney($row['L'] ?? null),

                    'REV_1_NO_SKKO' => $row['M'] ?? null,
                    'REV_1_TANGGAL' => $this->excelDate($row['N'] ?? null),
                    'REV_1_NILAI' => $this->cleanMoney($row['O'] ?? null),

                    'REV_2_NO_SKKO' => $row['P'] ?? null,
                    'REV_2_TANGGAL' => $this->excelDate($row['Q'] ?? null),
                    'REV_2_NILAI' => $this->cleanMoney($row['R'] ?? null),

                    'REV_3_NO_SKKO' => $row['S'] ?? null,
                    'REV_3_TANGGAL' => $this->excelDate($row['T'] ?? null),
                    'REV_3_NILAI' => $this->cleanMoney($row['U'] ?? null),

                    'REV_4_NO_SKKO' => $row['V'] ?? null,
                    'REV_4_TANGGAL' => $this->excelDate($row['W'] ?? null),
                    'REV_4_NILAI' => $this->cleanMoney($row['X'] ?? null),

                    'SKKO_TERBIT_NO_SKKO' => $row['Y'] ?? null,
                    'SKKO_TERBIT_TANGGAL' => $this->excelDate($row['Z'] ?? null),
                    'SKKO_TERBIT_NILAI' => $this->cleanMoney($row['AA'] ?? null),
                ]);

                $imported++;
            }

            return redirect()
                ->route('skko.index')
                ->with(
                    'success',
                    "Berhasil mengimport {$imported} data SKKO dari Excel."
                );

        } catch (\Exception $e) {

            return redirect()
                ->route('skko.index')
                ->with('error', 'Import gagal: ' . $e->getMessage());
        }
    }

    /**
     * Membersihkan nilai angka biasa
     */
    private function cleanNumber($value)
    {
        if ($value === null || $value === '') {
            return null;
        }

        return (int) str_replace(',', '', $value);
    }

    /**
     * Membersihkan nilai uang
     */
    private function cleanMoney($value)
    {
        if ($value === null || $value === '') {
            return null;
        }

        if (is_numeric($value)) {
            return $value;
        }

        return (float) str_replace(',', '', $value);
    }

    /**
     * Mengubah tanggal Excel menjadi format database
     */
    private function excelDate($value)
    {
        if ($value === null || $value === '') {
            return null;
        }

        try {
            if (is_numeric($value)) {
                return Carbon::instance(
                    \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($value)
                )->format('Y-m-d');
            }

            return Carbon::createFromFormat(
                'd/m/Y',
                trim($value)
            )->format('Y-m-d');

        } catch (\Exception $e) {
            return null;
        }
    }

    /**
     * Menghapus data SKKO
     */
    public function destroy(SkkoTerbit2026 $skko)
    {
        $this->authorizeData($skko);

        $skko->delete();

        return redirect()
            ->route('skko.index')
            ->with('success', 'Data SKKO berhasil dihapus.');
    }
}
