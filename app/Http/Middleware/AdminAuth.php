<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AdminAuth
{
    public function handle(Request $request, Closure $next)
    {
        if (!Session::has('admin_id')) {
            return redirect()->route('admin.login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $user = \App\Models\User::find(Session::get('admin_id'));
        if (!$user || $user->role !== 'admin') {
            Session::forget('admin_id');
            return redirect()->route('admin.login')->with('error', 'Akses ditolak. Hanya admin yang diizinkan.');
        }

        view()->share('adminUser', $user);

        return $next($request);
    }
}
