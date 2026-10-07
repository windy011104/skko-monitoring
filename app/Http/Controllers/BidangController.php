<?php

namespace App\Http\Controllers;

use App\Models\Bidang;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BidangController extends Controller
{
    public function index(): View
    {
        $bidangs = Bidang::latest()->get();

        return view('bidang.index', compact('bidangs'));
    }

    public function create(): View
    {
        return view('bidang.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'nama_bidang' => ['required', 'string', 'max:255', 'unique:bidangs,nama_bidang'],
            'keterangan' => ['nullable', 'string'],
        ]);

        $validated['is_active'] = $request->boolean('is_active');

        Bidang::create($validated);

        return redirect()
            ->route('bidang.index')
            ->with('success', 'Bidang berhasil ditambahkan.');
    }

    public function edit(Bidang $bidang): View
    {
        return view('bidang.edit', compact('bidang'));
    }

    public function update(Request $request, Bidang $bidang): RedirectResponse
    {
        $validated = $request->validate([
            'nama_bidang' => [
                'required',
                'string',
                'max:255',
                'unique:bidangs,nama_bidang,' . $bidang->id,
            ],
            'keterangan' => ['nullable', 'string'],
        ]);

        $validated['is_active'] = $request->boolean('is_active');

        $bidang->update($validated);

        return redirect()
            ->route('bidang.index')
            ->with('success', 'Bidang berhasil diperbarui.');
    }

    public function destroy(Bidang $bidang): RedirectResponse
    {
        if ($bidang->users()->exists()) {
            return redirect()
                ->route('bidang.index')
                ->with('error', 'Bidang tidak dapat dihapus karena masih digunakan oleh user.');
        }

        $bidang->delete();

        return redirect()
            ->route('bidang.index')
            ->with('success', 'Bidang berhasil dihapus.');
    }
}
