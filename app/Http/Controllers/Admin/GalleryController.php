<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;

/**
 * GalleryController
 *
 * This controller for managing gallery CRUD operations in admin panel.
 */
class GalleryController extends Controller
{
    /**
     * This function for displaying all gallery items with pagination.
     */
    public function index()
    {
        $galleries = Gallery::latest()->paginate(12);
        return view('admin.galleries.index', compact('galleries'));
    }

    /**
     * This function for showing the gallery creation form.
     */
    public function create()
    {
        return view('admin.galleries.create');
    }

    /**
     * This function for storing a new gallery item with image upload.
     *
     * @param  \Illuminate\Http\Request  $request
     */
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
            $file->move(public_path('uploads/galleries'), $filename);
            $validated['image'] = 'uploads/galleries/' . $filename;
        }

        Gallery::create($validated);

        return redirect()->route('admin.galleries.index')->with('success', 'Galeri berhasil ditambahkan.');
    }

    /**
     * This function for displaying a single gallery item detail.
     */
    public function show(Gallery $gallery)
    {
        return view('admin.galleries.show', compact('gallery'));
    }

    /**
     * This function for showing the gallery edit form.
     */
    public function edit(Gallery $gallery)
    {
        return view('admin.galleries.edit', compact('gallery'));
    }

    /**
     * This function for updating an existing gallery item.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Gallery       $gallery
     */
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
            $file->move(public_path('uploads/galleries'), $filename);
            $validated['image'] = 'uploads/galleries/' . $filename;
        }

        $gallery->update($validated);

        return redirect()->route('admin.galleries.index')->with('success', 'Galeri berhasil diperbarui.');
    }

    /**
     * This function for deleting a gallery item and its image.
     *
     * @param  \App\Models\Gallery  $gallery
     */
    public function destroy(Gallery $gallery)
    {
        if ($gallery->image && file_exists(public_path($gallery->image))) {
            unlink(public_path($gallery->image));
        }

        $gallery->delete();

        return redirect()->route('admin.galleries.index')->with('success', 'Galeri berhasil dihapus.');
    }
}
