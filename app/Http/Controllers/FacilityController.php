<?php

namespace App\Http\Controllers;

use App\Models\FacilitySystem;          // Eloquent model that represents a data‑center system
use Illuminate\Http\Request;             // Handles incoming HTTP request data
use Illuminate\Support\Facades\Redirect; // Optional, for explicit redirects

/**
 * FacilityController
 *
 * Handles CRUD operations for the **Facility System** resource that is
 * displayed on the “Infrastructure” page (`pages.infrastructure`).
 *
 * The original snippet only listed all systems.  Below we keep that
 * functionality and extend the controller with a few useful actions:
 *   • `index()` – list (paginated) systems.
 *   • `show()`  – view details of a single system.
 *   • `create()` / `store()` – show a creation form and persist a new record.
 *   • `edit()` / `update()` – edit an existing record.
 *   • `destroy()` – delete a system (soft‑delete or hard‑delete as you prefer).
 *
 * All methods return Blade views located under `resources/views/pages/…`
 * (you can rename the view folder to suit your convention).
 */
class FacilityController extends Controller
{
    /**
     * Display a paginated list of all facility systems.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Retrieve systems ordered by newest first and paginate (12 per page).
        // Pagination prevents loading thousands of rows in one request.
        $systems = FacilitySystem::orderByDesc('created_at')
                                ->paginate(12);

        // Pass the paginated collection to the view.
        // In the Blade file you can render pagination links with `$systems->links()`.
        return view('pages.infrastructure', compact('systems'));
    }

    /**
     * Show a single system's details.
     *
     * @param  int  $id  The primary key of the FacilitySystem.
     * @return \Illuminate\View\View
     */
    public function show(int $id)
    {
        // `findOrFail` will automatically throw a 404 if the record does not exist.
        $system = FacilitySystem::findOrFail($id);

        // You can create a dedicated view (e.g., pages.system-show) or reuse the
        // infrastructure view in a “detail” mode.
        return view('pages.system-show', compact('system'));
    }

    /**
     * Show the form to create a new facility system.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        // If you need lookup data (e.g., categories) you can fetch them here.
        // $categories = FacilityCategory::all();
        // return view('pages.system-create', compact('categories'));

        return view('pages.system-create');
    }

    /**
     * Store a newly created system in the database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // -----------------------------------------------------------------
        // 1️⃣ Validate incoming data.
        // -----------------------------------------------------------------
        $validated = $request->validate([
            'system_category' => ['required', 'string', 'max:100'],
            'equipment_name'   => ['required', 'string', 'max:255'],
            'description'      => ['nullable', 'string'],
            'status'           => ['required', 'in:Active,Inactive,Maintenance'],
        ]);

        // -----------------------------------------------------------------
        // 2️⃣ Persist the new record.
        // -----------------------------------------------------------------
        FacilitySystem::create($validated);

        // -----------------------------------------------------------------
        // 3️⃣ Flash a success message and redirect.
        // -----------------------------------------------------------------
        session()->flash('success', 'Sistem baru berhasil ditambahkan.');
        return redirect()->route('facilities.index');
    }

    /**
     * Show the form for editing an existing system.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function edit(int $id)
    {
        $system = FacilitySystem::findOrFail($id);
        // $categories = FacilityCategory::all(); // if you have categories
        // return view('pages.system-edit', compact('system', 'categories'));

        return view('pages.system-edit', compact('system'));
    }

    /**
     * Update the specified system in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int                     $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, int $id)
    {
        // -----------------------------------------------------------------
        // 1️⃣ Validate the incoming data (same rules as store).
        // -----------------------------------------------------------------
        $validated = $request->validate([
            'system_category' => ['required', 'string', 'max:100'],
            'equipment_name'   => ['required', 'string', 'max:255'],
            'description'      => ['nullable', 'string'],
            'status'           => ['required', 'in:Active,Inactive,Maintenance'],
        ]);

        // -----------------------------------------------------------------
        // 2️⃣ Find the record and apply updates.
        // -----------------------------------------------------------------
        $system = FacilitySystem::findOrFail($id);
        $system->update($validated);

        // -----------------------------------------------------------------
        // 3️⃣ Flash a success message and redirect back to the list.
        // -----------------------------------------------------------------
        session()->flash('success', 'Data sistem berhasil diperbarui.');
        return redirect()->route('facilities.index');
    }

    /**
     * Remove the specified system from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(int $id)
    {
        // If the model uses SoftDeletes you could call `$system->delete()`.
        // For a hard delete, use `forceDelete()`.
        $system = FacilitySystem::findOrFail($id);
        $system->delete();

        session()->flash('success', 'Sistem berhasil dihapus.');
        return redirect()->route('facilities.index');
    }
}