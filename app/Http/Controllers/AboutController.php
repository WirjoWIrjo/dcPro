<?php

namespace App\Http\Controllers;   // ← The controller lives in the default Laravel Controllers namespace

/**
 * AboutController
 *
 * Handles requests for the static “About” page.
 * By convention we keep simple pages that only return a view in a dedicated controller
 * instead of defining a closure route. This makes it easy to extend later
 * (e.g., add data, middleware, or authorisation).
 */
class AboutController extends Controller
{
    /**
     * Show the "About" page.
     *
     * @return \Illuminate\View\View  The Blade view located at resources/views/pages/about.blade.php
     */
    public function index()
    {
        // Return the view. No data is needed for this static page,
        // but you could pass an associative array here if you ever need it.
        return view('pages.about');
    }
}