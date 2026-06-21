<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        return view('pages.contact');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'    => ['required', 'string', 'max:255'],
            'email'   => ['required', 'string', 'email', 'max:255'],
            'message' => ['required', 'string', 'min:10'],
        ]);

        $request->session()->flash(
            'status',
            'Terima kasih! Pesan Anda telah berhasil dikirim.'
        );

        return redirect()->route('contact.index');
    }
}
