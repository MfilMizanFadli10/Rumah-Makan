<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // =========================
    // DATA USER
    // =========================
    public function index()
    {
        $users = User::latest()->get();

        return view('admin.user.index', compact('users'));
    }


    // =========================
    // FORM TAMBAH USER
    // =========================
    public function create()
    {
        return view('admin.user.create');
    }


    // =========================
    // SIMPAN USER
    // =========================
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'role' => 'required|in:admin,user',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        return redirect()
            ->route('admin.user')
            ->with('success', 'User berhasil ditambahkan.');
    }


    // =========================
    // FORM EDIT USER
    // =========================
    public function edit($id)
    {
        $user = User::findOrFail($id);

        return view('admin.user.edit', compact('user'));
    }


    // =========================
    // UPDATE USER
    // =========================
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'role' => 'required|in:admin,user',
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()
            ->route('admin.user')
            ->with('success', 'User berhasil diperbarui.');
    }


    // =========================
    // HAPUS USER
    // =========================
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        $user->delete();

        return redirect()
            ->route('admin.user')
            ->with('success', 'User berhasil dihapus.');
    }
}