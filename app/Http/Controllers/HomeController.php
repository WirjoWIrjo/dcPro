<?php

namespace App\Http\Controllers;

use App\Models\DcHighlight;
use Illuminate\Http\Request;

/**
 * HomeController
 *
 * This controller for managing the public home page display.
 * It handles fetching highlights data and passing to the view.
 */
class HomeController extends Controller
{
    /**
     * This function for displaying the public home page.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Fetch all highlights ordered by newest first.
        $highlights = DcHighlight::orderByDesc('created_at')->get();

        return view('pages.home', compact('highlights'));
    }

    /**
     * This function for showing the highlight creation form.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('pages.home-create');
    }

    /**
     * This function for storing a new highlight to database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Step 1: Validate the incoming data.
        $validated = $request->validate([
            'icon'         => ['required', 'string', 'max:100'],
            'metric_name'  => ['required', 'string', 'max:255'],
            'metric_value' => ['required', 'string', 'max:100'],
        ]);

        // Step 2: Save the new highlight.
        DcHighlight::create($validated);

        // Step 3: Redirect back with success message.
        session()->flash('success', 'Highlight baru berhasil ditambahkan.');
        return redirect()->route('home.index');
    }

    /**
     * This function for showing the highlight edit form.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function edit(int $id)
    {
        $highlight = DcHighlight::findOrFail($id);
        return view('pages.home-edit', compact('highlight'));
    }

    /**
     * This function for updating an existing highlight.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int                       $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, int $id)
    {
        // Step 1: Validate the incoming data.
        $validated = $request->validate([
            'icon'         => ['required', 'string', 'max:100'],
            'metric_name'  => ['required', 'string', 'max:255'],
            'metric_value' => ['required', 'string', 'max:100'],
        ]);

        // Step 2: Find and update the record.
        $highlight = DcHighlight::findOrFail($id);
        $highlight->update($validated);

        // Step 3: Redirect back with success message.
        session()->flash('success', 'Highlight berhasil diperbarui.');
        return redirect()->route('home.index');
    }

    /**
     * This function for deleting a highlight from database.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(int $id)
    {
        $highlight = DcHighlight::findOrFail($id);
        $highlight->delete();

        session()->flash('success', 'Highlight berhasil dihapus.');
        return redirect()->route('home.index');
    }

    /**
     * This function for displaying a single highlight detail.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function show(int $id)
    {
        $highlight = DcHighlight::findOrFail($id);
        return view('pages.home-show', compact('highlight'));
    }
}
