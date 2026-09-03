<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class AdminProfilController extends Controller
{
    public function index()
    {
        $admin = Auth::user();

        if (!$admin) {
            return redirect()->route('login');
        }

        return view('admin.profil', compact('admin'));
    }


    /**
     * Update data profil + foto
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login');
        }

        $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($user->id),
            ],

            'jabatan' => [
                'nullable',
                'string',
                'max:255',
            ],

            'foto' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],
        ]);


        $user->name = $request->name;
        $user->email = $request->email;
        $user->jabatan = $request->jabatan;


        /*
        |--------------------------------------------------------------------------
        | FOTO PROFIL
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('foto')) {

            // Hapus foto lama
            if (
                $user->foto &&
                Storage::disk('public')->exists($user->foto)
            ) {
                Storage::disk('public')->delete($user->foto);
            }


            // Simpan foto baru
            $path = $request->file('foto')
                ->store('profil', 'public');

            $user->foto = $path;
        }


        $user->save();


        return back()->with(
            'success',
            'Profil berhasil diperbarui!'
        );
    }


    /**
     * Update password
     */
    public function updatePassword(Request $request)
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login');
        }


        $request->validate([
            'password_lama' => [
                'required',
                'current_password',
            ],

            'password' => [
                'required',
                'string',
                'min:8',
                'confirmed',
            ],
        ]);


        $user->password = Hash::make(
            $request->password
        );

        $user->save();


        return back()->with(
            'success',
            'Password berhasil diubah!'
        );
    }
}