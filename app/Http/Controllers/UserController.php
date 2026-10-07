<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Bidang;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UserController extends Controller
{
    /**
     * Pastikan hanya admin yang bisa mengakses manajemen user.
     */
    private function authorizeAdmin(): void
    {
        abort_unless(
            auth()->check() && auth()->user()->isAdmin(),
            403
        );
    }

    /**
     * Menampilkan daftar user.
     */
    public function index(): View
    {
        $this->authorizeAdmin();

        $users = User::latest()->get();

        return view('users.index', compact('users'));
    }

    /**
     * Menampilkan form tambah user.
     */
   public function create(): View
    {
        $this->authorizeAdmin();

        $bidangs = Bidang::where('is_active', true)
            ->orderBy('nama_bidang')
            ->get();

        return view('users.create', compact('bidangs'));
    }

    /**
     * Menyimpan user baru.
     */
    public function store(Request $request): RedirectResponse
    {
        $this->authorizeAdmin();

        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:users,username'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:6'],
            'role' => ['required', 'in:admin,user'],
            'bidang_id' => ['required', 'exists:bidangs,id'],
            'unit_kerja' => ['nullable', 'string', 'max:255'],
            'jabatan' => ['nullable', 'string', 'max:255'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $data['is_active'] = $request->boolean('is_active');

        User::create($data);

        return redirect()
            ->route('users.index')
            ->with('success', 'User berhasil ditambahkan.');
    }

    /**
     * Menampilkan form edit user.
     */
    public function edit(User $user): View
    {
        $this->authorizeAdmin();

        $bidangs = Bidang::where('is_active', true)
            ->orderBy('nama_bidang')
            ->get();

        return view('users.edit', compact('user', 'bidangs'));
    }

    /**
     * Memperbarui user.
     */
    public function update(Request $request, User $user): RedirectResponse
    {
        $this->authorizeAdmin();

        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => [
                'required',
                'string',
                'max:255',
                'unique:users,username,' . $user->id,
            ],
            'email' => [
                'required',
                'email',
                'max:255',
                'unique:users,email,' . $user->id,
            ],
            'password' => ['nullable', 'string', 'min:6'],
            'role' => ['required', 'in:admin,user'],
            'bidang_id' => ['required', 'exists:bidangs,id'],
            'unit_kerja' => ['nullable', 'string', 'max:255'],
            'jabatan' => ['nullable', 'string', 'max:255'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $data['is_active'] = $request->boolean('is_active');

        /*
         * Jika password kosong saat edit,
         * password lama tetap digunakan.
         */
        if (empty($data['password'])) {
            unset($data['password']);
        }

        $user->update($data);

        return redirect()
            ->route('users.index')
            ->with('success', 'User berhasil diperbarui.');
    }

    /**
     * Menghapus user.
     */
    public function destroy(User $user): RedirectResponse
    {
        $this->authorizeAdmin();

        /*
         * Admin tidak boleh menghapus akun sendiri.
         */
        if ($user->id === auth()->id()) {
            return redirect()
                ->route('users.index')
                ->with('error', 'Anda tidak dapat menghapus akun sendiri.');
        }

        $user->delete();

        return redirect()
            ->route('users.index')
            ->with('success', 'User berhasil dihapus.');
    }
}
