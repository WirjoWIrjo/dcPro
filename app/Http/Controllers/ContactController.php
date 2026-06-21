<?php

namespace App\Http\Controllers;

/**
 * ContactController
 *
 * This controller for managing the contact page display and form submission.
 */
class ContactController extends Controller
{
    /**
     * This function for displaying the contact form.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('pages.contact');
    }

    /**
     * This function for processing the submitted contact form.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(\Illuminate\Http\Request $request)
    {
        // Step 1: Validate the incoming data.
        $validated = $request->validate([
            'name'    => ['required', 'string', 'max:255'],
            'email'   => ['required', 'string', 'email', 'max:255'],
            'message' => ['required', 'string', 'min:10'],
        ]);

        // Step 2: Flash success message to session.
        $request->session()->flash(
            'status',
            'Terima kasih! Pesan Anda telah berhasil dikirim.'
        );

        // Step 3: Redirect back to contact page.
        return redirect()->route('contact.index');
    }
}
