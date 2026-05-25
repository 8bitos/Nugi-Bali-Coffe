<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Show login form
     */
    public function showLogin()
    {
        if (Auth::check()) {
            return Auth::user()->role === 'admin'
                ? redirect()->route('admin.menu.index')
                : redirect()->route('home');
        }

        return view('auth.login');
    }

    /**
     * Handle login
     */
    public function login(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        if (Auth::attempt($validated)) {
            $user = Auth::user();
            
            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard')->with('success', 'Login berhasil sebagai Admin');
            } else {
                return redirect()->route('home')->with('success', 'Login berhasil');
            }
        }

        return back()->withErrors(['email' => 'Email atau password salah'])->onlyInput('email');
    }

    /**
     * Show register form
     */
    public function showRegister()
    {
        return view('auth.register');
    }

    /**
     * Handle register
     */
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $validated['password'] = Hash::make($validated['password']);
        $validated['role'] = 'pelanggan';

        User::create($validated);

        return redirect()->route('auth.login')->with('success', 'Registrasi berhasil. Silakan login.');
    }

    /**
     * Handle logout
     */
    public function logout()
    {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect()->route('home')->with('success', 'Logout berhasil');
    }

    /**
     * Admin login
     */
    public function showAdminLogin()
    {
        if (Auth::check()) {
            return Auth::user()->role === 'admin'
                ? redirect()->route('admin.menu.index')
                : redirect()->route('home');
        }

        return view('auth.admin-login');
    }

    /**
     * Admin login handler
     */
    public function adminLogin(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        if (Auth::attempt($validated)) {
            $user = Auth::user();
            
            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard')->with('success', 'Login sebagai Admin berhasil');
            } else {
                Auth::logout();
                return back()->withErrors(['email' => 'Anda bukan admin'])->onlyInput('email');
            }
        }

        return back()->withErrors(['email' => 'Email atau password salah'])->onlyInput('email');
    }
}
