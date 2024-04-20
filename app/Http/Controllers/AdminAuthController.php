<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('Back.auth.login');
    }
    public function showRegisterForm()
    {
        return view('Back.auth.register');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::guard('admin')->attempt($credentials)) {
            return redirect()->intended(route('admin.dashboard')); // Change 'admin.dashboard' to your admin dashboard route
        }

        return back()->withErrors(['email' => 'Invalid credentials']);
    }
    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:admins,email',
            'password' => 'required|string|min:8',
        ]);

        // Create a new admin user
        $admin = Admin::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password']),
        ]);

        // Log in the newly registered admin user
        Auth::guard('admin')->login($admin);

        return redirect()->intended(route('admin.dashboard')); // Change 'admin.dashboard' to your admin dashboard route
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();

        return redirect(url('/'));
    }

}
