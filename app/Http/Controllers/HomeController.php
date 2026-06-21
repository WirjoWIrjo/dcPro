<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Admin\Traits\DemoMode;
use App\Models\DcHighlight;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    use DemoMode;
    public function index()
    {
        $highlights = DcHighlight::orderByDesc('created_at')->get();
        return view('pages.home', compact('highlights'));
    }

    public function create()
    {
        return view('pages.home-create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'icon'         => ['required', 'string', 'max:100'],
            'metric_name'  => ['required', 'string', 'max:255'],
            'metric_value' => ['required', 'string', 'max:100'],
        ]);

        DcHighlight::create($validated + ['is_demo' => $this->isDemoRecord()]);

        session()->flash('success', 'Highlight baru berhasil ditambahkan.');
        return redirect()->route('home.index');
    }

    public function edit(int $id)
    {
        $highlight = DcHighlight::findOrFail($id);
        return view('pages.home-edit', compact('highlight'));
    }

    public function update(Request $request, int $id)
    {
        $validated = $request->validate([
            'icon'         => ['required', 'string', 'max:100'],
            'metric_name'  => ['required', 'string', 'max:255'],
            'metric_value' => ['required', 'string', 'max:100'],
        ]);

        $highlight = DcHighlight::findOrFail($id);
        $validated['is_demo'] = $this->isDemoRecord();
        $highlight->update($validated);

        session()->flash('success', 'Highlight berhasil diperbarui.');
        return redirect()->route('home.index');
    }

    public function destroy(int $id)
    {
        $highlight = DcHighlight::findOrFail($id);
        $highlight->delete();

        session()->flash('success', 'Highlight berhasil dihapus.');
        return redirect()->route('home.index');
    }

    public function show(int $id)
    {
        $highlight = DcHighlight::findOrFail($id);
        return view('pages.home-show', compact('highlight'));
    }
}
