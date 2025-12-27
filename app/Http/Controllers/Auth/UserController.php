<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Halaman index (list user + modal edit & delete)
     */
    public function index()
    {
        $users = User::latest()->get();
        return view('manajemen-user.index', compact('users'));
    }

    /**
     * Halaman input user baru
     */
    public function create()
    {
        return view('manajemen-user.input');
    }

    /**
     * Simpan user baru (dari halaman input)
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'     => 'required|string|max:255',
            'username' => 'required|string|max:100|unique:users,username',
            'email'    => 'required|email|unique:users,email',
            'role'     => 'required|in:admin,pegawai',
            'status'   => 'required|in:aktif,nonaktif',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $validated['password'] = Hash::make($validated['password']);

        User::create($validated);

        // Redirect ke halaman index
        return redirect()->route('users.index')
            ->with('success', 'User berhasil ditambahkan');
    }

    /**
     * Update user (modal edit di index)
     */
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name'     => 'required|string|max:255',
            'username' => 'required|string|max:100|unique:users,username,' . $user->id,
            'email'    => 'required|email|unique:users,email,' . $user->id,
            'role'     => 'required|in:admin,pegawai',
            'status'   => 'required|in:aktif,nonaktif',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        if ($request->filled('password')) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        $user->update($validated);

        return redirect()->back()
            ->with('success', 'User berhasil diperbarui');
    }

    /**
     * Hapus user (modal delete di index)
     */
    public function destroy(User $user)
{
    if (Auth::check() && Auth::user()->id === $user->id) {
        return redirect()->back()
            ->with('error', 'Tidak dapat menghapus akun sendiri');
    }

    $user->delete();

    return redirect()->back()
        ->with('success', 'User berhasil dihapus');
}
}
