<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CompanyProfile;
use Illuminate\Http\Request;

/**
 * ProfileController
 *
 * This controller for managing company profile in admin panel.
 */
class ProfileController extends Controller
{
    /**
     * This function for displaying the company profile edit form.
     *
     * @return \Illuminate\View\View
     */
    public function edit()
    {
        $profile = CompanyProfile::firstOrCreate([], [
            'company_name' => 'DataCenterPro',
        ]);

        return view('admin.profile.edit', compact('profile'));
    }

    /**
     * This function for updating the company profile.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        $validated = $request->validate([
            'company_name' => ['required', 'string', 'max:255'],
            'vision' => ['nullable', 'string'],
            'mission' => ['nullable', 'string'],
            'address' => ['nullable', 'string'],
            'phone' => ['nullable', 'string', 'max:50'],
            'email' => ['nullable', 'email', 'max:255'],
            'website' => ['nullable', 'url', 'max:255'],
            'description' => ['nullable', 'string'],
            'logo' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);

        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/profile'), $filename);
            $validated['logo'] = 'uploads/profile/' . $filename;
        }

        $profile = CompanyProfile::first();
        if ($profile) {
            $profile->update($validated);
        } else {
            CompanyProfile::create($validated);
        }

        return redirect()->route('admin.profile.edit')->with('success', 'Profil perusahaan berhasil diperbarui.');
    }
}
