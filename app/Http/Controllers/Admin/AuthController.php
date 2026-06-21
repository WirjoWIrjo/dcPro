<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

/**
 * AuthController
 *
 * This controller for handling admin authentication.
 * It manages login and logout using Laravel session.
 */
class AuthController extends Controller
{
    /**
     * This function for displaying the admin login form.
     *
     * @return \Illuminate\View\View
     */
    public function showLogin()
    {
        return view('admin.auth.login');
    }

    /**
     * This function for processing admin login authentication.
     * It validates credentials and stores admin_id in session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(Request $request)
    {
        // Step 1: Validate the incoming credentials.
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Step 2: Find user by email.
        $user = User::where('email', $request->email)->first();

        // Step 3: Verify password using Hash check.
        if (!$user || !Hash::check($request->password, $user->password)) {
            return back()->withErrors(['email' => 'Email atau password salah.'])->withInput($request->only('email'));
        }

        // Step 4: Check if user has admin role.
        if ($user->role !== 'admin') {
            return back()->withErrors(['email' => 'Anda tidak memiliki akses admin.'])->withInput($request->only('email'));
        }

        // Step 5: Store admin_id in session.
        Session::put('admin_id', $user->id);

        return redirect()->route('admin.dashboard')->with('success', 'Selamat datang, ' . $user->name . '!');
    }

    /**
     * This function for processing admin logout.
     * It removes admin_id from session.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout()
    {
        Session::forget('admin_id');

        return redirect()->route('admin.login')->with('success', 'Anda telah berhasil logout.');
    }
}
