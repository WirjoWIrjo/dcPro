<?php

namespace App\Http\Controllers;

use App\Models\FacilitySystem;
use Illuminate\Http\Request;

/**
 * FacilityController
 *
 * This controller for managing facility system CRUD operations.
 * It handles the Infrastructure page data display and management.
 */
class FacilityController extends Controller
{
    /**
     * This function for displaying all facility systems with pagination.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $systems = FacilitySystem::orderByDesc('created_at')
                                ->paginate(12);

        return view('pages.infrastructure', compact('systems'));
    }

    /**
     * This function for showing a single system detail.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function show(int $id)
    {
        $system = FacilitySystem::findOrFail($id);
        return view('pages.system-show', compact('system'));
    }

    /**
     * This function for showing the system creation form.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('pages.system-create');
    }

    /**
     * This function for storing a new system to database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Step 1: Validate the incoming data.
        $validated = $request->validate([
            'system_category' => ['required', 'string', 'max:100'],
            'equipment_name'   => ['required', 'string', 'max:255'],
            'description'      => ['nullable', 'string'],
            'status'           => ['required', 'in:Active,Inactive,Maintenance'],
        ]);

        // Step 2: Save the new record.
        FacilitySystem::create($validated);

        // Step 3: Redirect back with success message.
        session()->flash('success', 'Sistem baru berhasil ditambahkan.');
        return redirect()->route('facilities.index');
    }

    /**
     * This function for showing the system edit form.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function edit(int $id)
    {
        $system = FacilitySystem::findOrFail($id);
        return view('pages.system-edit', compact('system'));
    }

    /**
     * This function for updating an existing system.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int                     $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, int $id)
    {
        // Step 1: Validate the incoming data.
        $validated = $request->validate([
            'system_category' => ['required', 'string', 'max:100'],
            'equipment_name'   => ['required', 'string', 'max:255'],
            'description'      => ['nullable', 'string'],
            'status'           => ['required', 'in:Active,Inactive,Maintenance'],
        ]);

        // Step 2: Find and update the record.
        $system = FacilitySystem::findOrFail($id);
        $system->update($validated);

        // Step 3: Redirect back with success message.
        session()->flash('success', 'Data sistem berhasil diperbarui.');
        return redirect()->route('facilities.index');
    }

    /**
     * This function for deleting a system from database.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(int $id)
    {
        $system = FacilitySystem::findOrFail($id);
        $system->delete();

        session()->flash('success', 'Sistem berhasil dihapus.');
        return redirect()->route('facilities.index');
    }
}
