<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User; // Tambahkan ini
use Illuminate\Support\Facades\Hash; // Tambahkan ini

class AuthController extends Controller
{
    // --- LOGIN ---
    public function showLoginForm()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // LOGIKA PENTING: Cek Role
            if (Auth::user()->role === 'admin') {
                return redirect()->route('admin.index'); // Admin ke Dashboard
            }
            
            return redirect('/'); // User Biasa ke Home
        }

        return back()->with('error', 'Email atau Password salah!');
    }

    // --- REGISTER (Baru) ---
    public function showRegisterForm()
    {
        return view('register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6'
        ]);

        // Buat User Baru (Otomatis role 'user')
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'user' 
        ]);

        // Langsung Login setelah daftar
        Auth::login($user);

        return redirect('/')->with('success', 'Selamat datang, ' . $user->name . '!');
    }

    // --- LOGOUT ---
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}