<?php

namespace App\Http\Controllers;

/**
 * ContactController
 *
 * Manages the contact page – both displaying the form (GET) and handling
 * the form submission (POST).  The original snippet only returned the
 * view; below we keep that method and add a typical `store` method with
 * validation, flash messaging, and a redirect.
 */
class ContactController extends Controller
{
    /**
     * Show the contact form.
     *
     * GET /contact
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Render the Blade view located at resources/views/pages/contact.blade.php
        // No data is required, but you could pass old input or config values here.
        return view('pages.contact');
    }

    /**
     * Process the submitted contact form.
     *
     * POST /contact
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(\Illuminate\Http\Request $request)
    {
        // -----------------------------------------------------------------
        // 1️⃣  Validate the incoming payload.
        // -----------------------------------------------------------------
        $validated = $request->validate([
            // Nama: required, max 255 characters
            'name'  => ['required', 'string', 'max:255'],

            // Email: required, valid e‑mail format, max 255 characters
            'email' => ['required', 'string', 'email', 'max:255'],

            // Pesan: required, min 10 characters to avoid empty messages
            'message' => ['required', 'string', 'min:10'],
        ]);

        // -----------------------------------------------------------------
        // 2️⃣  (Optional) Persist the contact request.
        // -----------------------------------------------------------------
        // If you have a `ContactMessage` model you could do:
        // ContactMessage::create($validated);
        // For now we just simulate the action.

        // -----------------------------------------------------------------
        // 3️⃣  Flash a success message to the session.
        // -----------------------------------------------------------------
        $request->session()->flash(
            'status',
            'Terima kasih! Pesan Anda telah berhasil dikirim.'
        );

        // -----------------------------------------------------------------
        // 4️⃣  Redirect back to the contact page (or to a thank‑you page).
        // -----------------------------------------------------------------
        return redirect()->route('contact.index');
    }
}