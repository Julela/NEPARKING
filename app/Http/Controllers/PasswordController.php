<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use App\Models\User;

class PasswordController extends Controller
{
    public function index()
    {
        return view('ganti_password.index');
    }

    public function gantiPassword(Request $request, $id)
    {
        // dd($request->all(), $id);
        $user = User::findOrFail($id);
    
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore($user->id), // Pastikan email unik kecuali user saat ini
            ],
            'password' => 'nullable|min:8|required_with:password_confirmation|same:password_confirmation',
        ], [
            'name.required' => 'Nama wajib diisi!',
            'email.required' => 'Email wajib diisi!',
            'email.email' => 'Format email tidak valid!',
            'email.unique' => 'Email ini sudah digunakan oleh pengguna lain!',
            'password.min' => 'Password minimal harus 8 karakter!',
            'password.required_with' => 'Konfirmasi password wajib diisi jika password diubah!',
            'password.same' => 'Password dan konfirmasi password harus sama!',
        ]);
        
    
        try {
            $user->name = $request->name;
            $user->email = $request->email;
    
            if ($request->filled('password')) {
                $user->password = Hash::make($request->password);
            }
    
            $user->save();
    
            return redirect()->back()->with('success', 'Data berhasil diperbarui!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan, silakan coba lagi!');
        }
    }
    
}
