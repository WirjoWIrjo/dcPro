<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\Traits\DemoMode;
use App\Models\CompanyProfile;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    use DemoMode;
    public function edit()
    {
        $profile = CompanyProfile::firstOrCreate([], [
            'company_name' => 'DataCenterPro',
        ]);

        return view('admin.profile.edit', compact('profile'));
    }

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
            $validated['is_demo'] = $this->isDemoRecord();
            $profile->update($validated);
        } else {
            CompanyProfile::create($validated + ['is_demo' => $this->isDemoRecord()]);
        }

        return redirect()->route('admin.profile.edit')->with('success', 'Profil perusahaan berhasil diperbarui.');
    }
}
