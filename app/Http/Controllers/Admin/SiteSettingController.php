<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;

class SiteSettingController extends Controller
{
    public function index(): View
    {
        $settings = SiteSetting::all()->keyBy('key');
        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request): RedirectResponse
    {
        $request->validate([
            'hero_doctor_image_file' => 'nullable|image|mimes:jpeg,png,jpg,webp,svg,gif|max:5120',
            'hero_doctor_image'      => 'nullable|string|max:500',
            'hero_doctor_badge'      => 'nullable|string|max:100',
            'hero_doctor_name'       => 'nullable|string|max:150',
            'hero_doctor_title'      => 'nullable|string|max:200',
            'hero_doctor_alt'        => 'nullable|string|max:255',
            'hero_badge_1_title'     => 'nullable|string|max:100',
            'hero_badge_1_subtitle'  => 'nullable|string|max:100',
            'hero_badge_2_title'     => 'nullable|string|max:100',
            'hero_badge_2_subtitle'  => 'nullable|string|max:100',
            'clinic_name'            => 'nullable|string|max:255',
            'clinic_tagline'         => 'nullable|string|max:255',
            'hotline_whatsapp'       => 'nullable|string|max:50',
            'contact_email'          => 'nullable|email|max:100',
            'instagram_url'          => 'nullable|string|max:255',
            'youtube_url'            => 'nullable|string|max:255',
            'footer_address'         => 'nullable|string|max:500',
            'meta_description'       => 'nullable|string|max:1000',
        ]);

        // 1. Handle Doctor / Hero Image Upload
        if ($request->hasFile('hero_doctor_image_file')) {
            $file = $request->file('hero_doctor_image_file');
            
            // Delete old file if exists in storage
            $oldImage = SiteSetting::where('key', 'hero_doctor_image')->value('value');
            if ($oldImage && !str_starts_with($oldImage, 'http') && Storage::disk('public')->exists($oldImage)) {
                Storage::disk('public')->delete($oldImage);
            }

            $path = $file->store('settings', 'public');
            SiteSetting::updateOrCreate(
                ['key' => 'hero_doctor_image'],
                ['value' => $path, 'group' => 'hero']
            );
        } elseif ($request->filled('hero_doctor_image')) {
            SiteSetting::updateOrCreate(
                ['key' => 'hero_doctor_image'],
                ['value' => $request->input('hero_doctor_image'), 'group' => 'hero']
            );
        }

        // 2. Handle Text Fields
        $fields = $request->except(['_token', '_method', 'hero_doctor_image_file', 'hero_doctor_image']);

        foreach ($fields as $key => $value) {
            $group = 'general';
            if (str_starts_with($key, 'hero_')) {
                $group = 'hero';
            } elseif (str_contains($key, 'url') || str_contains($key, 'social') || str_contains($key, 'instagram') || str_contains($key, 'youtube')) {
                $group = 'social';
            } elseif (str_contains($key, 'meta')) {
                $group = 'seo';
            } elseif (str_contains($key, 'contact') || str_contains($key, 'hotline') || str_contains($key, 'email') || str_contains($key, 'address')) {
                $group = 'contact';
            }

            SiteSetting::updateOrCreate(
                ['key' => $key],
                ['value' => $value, 'group' => $group]
            );
        }

        return redirect()->route('admin.settings.index')->with('success', 'Pengaturan situs dan visual beranda berhasil diperbarui.');
    }
}

