<?php

namespace App\Http\Controllers;

use App\Models\FacilitySystem;
use Illuminate\Http\Request;

class FacilityController extends Controller
{
    public function index()
    {
        $systems = FacilitySystem::orderByDesc('created_at')->paginate(12);
        return view('pages.infrastructure', compact('systems'));
    }

    public function show(int $id)
    {
        $system = FacilitySystem::findOrFail($id);
        return view('pages.system-show', compact('system'));
    }

    public function create()
    {
        return view('pages.system-create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'system_category' => ['required', 'string', 'max:100'],
            'equipment_name'   => ['required', 'string', 'max:255'],
            'description'      => ['nullable', 'string'],
            'status'           => ['required', 'in:Active,Inactive,Maintenance'],
        ]);

        FacilitySystem::create($validated + ['is_demo' => true]);

        session()->flash('success', 'Sistem baru berhasil ditambahkan.');
        return redirect()->route('facilities.index');
    }

    public function edit(int $id)
    {
        $system = FacilitySystem::findOrFail($id);
        return view('pages.system-edit', compact('system'));
    }

    public function update(Request $request, int $id)
    {
        $validated = $request->validate([
            'system_category' => ['required', 'string', 'max:100'],
            'equipment_name'   => ['required', 'string', 'max:255'],
            'description'      => ['nullable', 'string'],
            'status'           => ['required', 'in:Active,Inactive,Maintenance'],
        ]);

        $system = FacilitySystem::findOrFail($id);
        $validated['is_demo'] = true;
        $system->update($validated);

        session()->flash('success', 'Data sistem berhasil diperbarui.');
        return redirect()->route('facilities.index');
    }

    public function destroy(int $id)
    {
        $system = FacilitySystem::findOrFail($id);
        $system->delete();

        session()->flash('success', 'Sistem berhasil dihapus.');
        return redirect()->route('facilities.index');
    }
}
