<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('admin.auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return back()->withErrors(['email' => 'Email atau password salah.'])->withInput($request->only('email'));
        }

        if (!in_array($user->role, ['admin', 'owner'])) {
            return back()->withErrors(['email' => 'Anda tidak memiliki akses admin.'])->withInput($request->only('email'));
        }

        Session::put('admin_id', $user->id);

        return redirect()->route('admin.dashboard')->with('success', 'Selamat datang, ' . $user->name . '!');
    }

    public function logout()
    {
        Session::forget('admin_id');

        return redirect()->route('admin.login')->with('success', 'Anda telah berhasil logout.');
    }
}
