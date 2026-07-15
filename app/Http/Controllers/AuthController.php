<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Biodata;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        if (! Auth::attempt($credentials, $request->boolean('remember'))) {
            throw ValidationException::withMessages([
                'email' => 'Email atau kata sandi salah.',
            ]);
        }

        $request->session()->regenerate();
        $user = Auth::user();

        // Redirect langsung tanpa intended agar terhindar dari riwayat halaman error
        if ($user->isAdmin()) {
            return redirect('/admin/laporan');
        }

        return redirect('/warga/riwayat');
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        // Validasi data akun dan data kependudukan (biodata)
        $request->validate([
            'name'     => ['required', 'string', 'max:100'],
            'email'    => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8'], // Tanpa confirmed agar cocok dengan form Anda
            'nik'      => ['required', 'numeric', 'digits:16', 'unique:biodatas,nik'],
            'no_hp'    => ['required', 'string', 'max:15'],
            'alamat'   => ['required', 'string'],
        ]);

        // Database transaction: memastikan kedua tabel terisi atau batalkan semuanya jika ada salah satu yang gagal
        DB::transaction(function () use ($request) {
            // 1. Buat User baru dengan role default warga
            $user = User::create([
                'name'     => $request->name,
                'email'    => $request->email,
                'password' => Hash::make($request->password),
                'role'     => 'warga',
            ]);

            // 2. Buat data biodata yang terhubung dengan id user di atas
            Biodata::create([
                'user_id' => $user->id,
                'nik'     => $request->nik,
                'nama'    => $request->name,
                'alamat'  => $request->alamat,
                'no_hp'   => $request->no_hp,
            ]);

            // 3. Otomatis login setelah pendaftaran berhasil
            Auth::login($user);
        });

        return redirect('/warga/layanan/pilih')->with('success', 'Akun dan biodata Anda berhasil didaftarkan!');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}