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
    $users = User::latest()->paginate(10); // 10 data per halaman
    return view('admin.manajemen-user.index', compact('users'));
}


    /**
     * Halaman input user baru
     */
    public function create()
    {
        return view('admin.manajemen-user.input');
    }

    /**
     * Simpan user baru (dari halaman input)
     */
    public function store(Request $request)
{
    $validated = $request->validate([
        'name'     => 'required|string|min:3',
        'username' => 'required|string|min:3|unique:users,username',
        'email'    => 'required|email|unique:users,email',
        'role'     => 'required|in:admin,pegawai',
        'status'   => 'required|in:aktif,nonaktif',
        'password' => [
    'required',
    'string',
    'min:8',
    'confirmed',
    'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).+$/',
    ], [
        'required' => ':attribute wajib diisi',
        'email'    => 'Format email tidak valid',
        'min'      => ':attribute minimal :min karakter',
        'unique'   => ':attribute sudah digunakan',
        'confirmed'=> 'Konfirmasi password tidak cocok',
    ]]);

    User::create([
        'name'     => $validated['name'],
        'username' => $validated['username'],
        'email'    => $validated['email'],
        'role'     => $validated['role'],
        'status'   => $validated['status'],
        'password' => Hash::make($validated['password']),
    ]);

    return redirect()
        ->route('users.create')
        ->with('success', 'Pengguna berhasil ditambahkan');
}

    /**
     * Update user (modal edit di index)
     */
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'role'     => 'required|in:admin,pegawai',
            'status'   => 'required|in:aktif,nonaktif',
            'password' => [
    'required',
    'string',
    'min:8',
    'confirmed',
    'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).+$/',
],

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
