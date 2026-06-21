<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\Traits\DemoMode;
use App\Models\Gallery;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    use DemoMode;
    public function index()
    {
        $galleries = Gallery::latest()->paginate(12);
        return view('admin.galleries.index', compact('galleries'));
    }

    public function create()
    {
        return view('admin.galleries.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'image' => ['required', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
            'caption' => ['nullable', 'string', 'max:500'],
            'category' => ['nullable', 'string', 'max:100'],
        ]);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $uploadPath = public_path('uploads/galleries');
            if (!is_dir($uploadPath)) {
                mkdir($uploadPath, 0755, true);
            }
            $file->move($uploadPath, $filename);
            $validated['image'] = 'uploads/galleries/' . $filename;
        }

        Gallery::create($validated + ['is_demo' => $this->isDemoRecord()]);

        return redirect()->route('admin.galleries.index')->with('success', 'Galeri berhasil ditambahkan.');
    }

    public function show(Gallery $gallery)
    {
        return view('admin.galleries.show', compact('gallery'));
    }

    public function edit(Gallery $gallery)
    {
        return view('admin.galleries.edit', compact('gallery'));
    }

    public function update(Request $request, Gallery $gallery)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
            'caption' => ['nullable', 'string', 'max:500'],
            'category' => ['nullable', 'string', 'max:100'],
        ]);

        if ($request->hasFile('image')) {
            if ($gallery->image && file_exists(public_path($gallery->image))) {
                unlink(public_path($gallery->image));
            }
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $uploadPath = public_path('uploads/galleries');
            if (!is_dir($uploadPath)) {
                mkdir($uploadPath, 0755, true);
            }
            $file->move($uploadPath, $filename);
            $validated['image'] = 'uploads/galleries/' . $filename;
        }

        $validated['is_demo'] = $this->isDemoRecord();
        $gallery->update($validated);

        return redirect()->route('admin.galleries.index')->with('success', 'Galeri berhasil diperbarui.');
    }

    public function destroy(Gallery $gallery)
    {
        if ($gallery->image && file_exists(public_path($gallery->image))) {
            unlink(public_path($gallery->image));
        }

        $gallery->delete();

        return redirect()->route('admin.galleries.index')->with('success', 'Galeri berhasil dihapus.');
    }
}
