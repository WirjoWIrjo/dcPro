<?php

namespace App\Http\Controllers;

use App\Models\DcHighlight;                // Eloquent model for the “highlight” cards on the home page
use Illuminate\Http\Request;                // Handles incoming request data
use Illuminate\Support\Facades\Redirect;    // Optional helper for explicit redirects

/**
 * HomeController
 *
 * Controls everything that is displayed on the public home page
 * (`pages.home`).  The original snippet only fetched **all** highlights
 * and passed them to the view.  Below we keep that simple index method
 * and extend the controller with a full set of CRUD actions so the
 * highlights can be managed from an admin area.
 *
 * All methods return Blade views located under `resources/views/pages/…`
 * (feel free to rename the view folder to suit your project layout).
 */
class HomeController extends Controller
{
    /**
     * Show the public home page.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Retrieve every highlight.  If you expect many rows you may
        // want to paginate (e.g. ->paginate(6)) to keep the page fast.
        $highlights = DcHighlight::orderByDesc('created_at')->get();

        // Pass the collection to the view.
        // In the Blade file you can iterate with @foreach($highlights as $item).
        return view('pages.home', compact('highlights'));
    }

    /**
     * Show a form to create a new highlight.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        // You might want to pass additional data (e.g., available icons)
        // to the view for a richer UI.
        return view('pages.home-create');
    }

    /**
     * Store a newly created highlight.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // -----------------------------------------------------------------
        // 1️⃣ Validate the incoming payload.
        // -----------------------------------------------------------------
        $validated = $request->validate([
            'icon'         => ['required', 'string', 'max:100'], // e.g. "bi-graph-up"
            'metric_name'  => ['required', 'string', 'max:255'],
            'metric_value' => ['required', 'string', 'max:100'],
        ]);

        // -----------------------------------------------------------------
        // 2️⃣ Persist the new highlight.
        // -----------------------------------------------------------------
        DcHighlight::create($validated);

        // -----------------------------------------------------------------
        // 3️⃣ Flash a success message and redirect back to the home index.
        // -----------------------------------------------------------------
        session()->flash('success', 'Highlight baru berhasil ditambahkan.');
        return redirect()->route('home.index');
    }

    /**
     * Show the edit form for a single highlight.
     *
     * @param  int  $id  Primary key of the highlight.
     * @return \Illuminate\View\View
     */
    public function edit(int $id)
    {
        $highlight = DcHighlight::findOrFail($id);
        return view('pages.home-edit', compact('highlight'));
    }

    /**
     * Update an existing highlight.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int                       $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, int $id)
    {
        // -----------------------------------------------------------------
        // 1️⃣ Validate the data (same rules as store).
        // -----------------------------------------------------------------
        $validated = $request->validate([
            'icon'         => ['required', 'string', 'max:100'],
            'metric_name'  => ['required', 'string', 'max:255'],
            'metric_value' => ['required', 'string', 'max:100'],
        ]);

        // -----------------------------------------------------------------
        // 2️⃣ Locate the record and apply the changes.
        // -----------------------------------------------------------------
        $highlight = DcHighlight::findOrFail($id);
        $highlight->update($validated);

        // -----------------------------------------------------------------
        // 3️⃣ Flash a success message and redirect.
        // -----------------------------------------------------------------
        session()->flash('success', 'Highlight berhasil diperbarui.');
        return redirect()->route('home.index');
    }

    /**
     * Delete a highlight.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(int $id)
    {
        $highlight = DcHighlight::findOrFail($id);
        $highlight->delete(); // If using SoftDeletes, this will be a soft delete.

        session()->flash('success', 'Highlight berhasil dihapus.');
        return redirect()->route('home.index');
    }

    /**
     * (Optional) Show a single highlight in a dedicated view.
     * Useful for admin preview or public detail pages.
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