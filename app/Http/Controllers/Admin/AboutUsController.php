<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class AboutUsController extends Controller
{
    public function index(): View
    {
        $settings = SiteSetting::all()->keyBy('key');
        return view('admin.about.index', compact('settings'));
    }

    public function update(Request $request): RedirectResponse
    {
        $request->validate([
            // Hero
            'hero_about_image_file'       => 'nullable|image|mimes:jpeg,png,jpg,webp,svg,gif|max:5120',
            'hero_about_image'            => 'nullable|string',
            'hero_about_badge'            => 'nullable|string|max:255',
            'hero_about_title'            => 'nullable|string|max:255',
            'hero_about_subtitle'         => 'nullable|string|max:1000',

            // Vision & Story
            'clinic_name'                 => 'nullable|string|max:255',
            'clinic_tagline'              => 'nullable|string|max:255',
            'about_company_description'   => 'nullable|string|max:5000',

            // 3 USP Points
            'about_usp_1'                 => 'nullable|string|max:500',
            'about_usp_2'                 => 'nullable|string|max:500',
            'about_usp_3'                 => 'nullable|string|max:500',

            // 2 Badges
            'about_badge_1_value'         => 'nullable|string|max:100',
            'about_badge_1_label'         => 'nullable|string|max:255',
            'about_badge_2_value'         => 'nullable|string|max:100',
            'about_badge_2_label'         => 'nullable|string|max:255',

            // Activity Slider Images
            'about_activity_files.*'      => 'nullable|image|mimes:jpeg,png,jpg,webp,svg,gif|max:5120',
            'retained_about_activity_images' => 'nullable|array',

            // Modern Fabrication Section
            'about_fabrication_badge'     => 'nullable|string|max:255',
            'about_fabrication_title'     => 'nullable|string|max:255',
            'about_fabrication_desc'      => 'nullable|string|max:2000',
            'about_fabrication_file'      => 'nullable|image|mimes:jpeg,png,jpg,webp,svg,gif|max:5120',
            'about_fabrication_image'     => 'nullable|string',
            'about_fab_feature_1_icon'    => 'nullable|string|max:100',
            'about_fab_feature_1_text'    => 'nullable|string|max:255',
            'about_fab_feature_2_icon'    => 'nullable|string|max:100',
            'about_fab_feature_2_text'    => 'nullable|string|max:255',

            // Core Values
            'about_values_json'           => 'nullable|string',

            // CTA Banner
            'about_cta_title'             => 'nullable|string|max:255',
            'about_cta_desc'              => 'nullable|string|max:1000',
            'about_cta_btn_text'          => 'nullable|string|max:100',
            'about_cta_wa_text'           => 'nullable|string|max:100',
        ]);

        // 1. Hero Background Banner Image
        if ($request->hasFile('hero_about_image_file')) {
            $path = $request->file('hero_about_image_file')->store('banners', 'public');
            SiteSetting::updateOrCreate(
                ['key' => 'hero_about_image'],
                ['value' => 'storage/' . $path, 'group' => 'hero_pages']
            );
        } elseif ($request->filled('hero_about_image')) {
            SiteSetting::updateOrCreate(
                ['key' => 'hero_about_image'],
                ['value' => $request->input('hero_about_image'), 'group' => 'hero_pages']
            );
        }

        // 2. Modern Fabrication Image
        if ($request->hasFile('about_fabrication_file')) {
            $path = $request->file('about_fabrication_file')->store('settings/fabrication', 'public');
            SiteSetting::updateOrCreate(
                ['key' => 'about_fabrication_image'],
                ['value' => 'storage/' . $path, 'group' => 'about']
            );
        } elseif ($request->filled('about_fabrication_image')) {
            SiteSetting::updateOrCreate(
                ['key' => 'about_fabrication_image'],
                ['value' => $request->input('about_fabrication_image'), 'group' => 'about']
            );
        }

        // 3. Activity Slider Images (Multi-image)
        $activityImages = $request->input('retained_about_activity_images', []);
        if (!is_array($activityImages)) {
            $activityImages = [];
        }
        if ($request->hasFile('about_activity_files')) {
            foreach ($request->file('about_activity_files') as $file) {
                if ($file->isValid()) {
                    $path = $file->store('settings/activity', 'public');
                    $activityImages[] = 'storage/' . $path;
                }
            }
        }
        if ($request->has('retained_about_activity_images') || $request->hasFile('about_activity_files')) {
            SiteSetting::updateOrCreate(
                ['key' => 'about_activity_images'],
                ['value' => json_encode(array_values($activityImages), JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE), 'group' => 'about']
            );
        }

        // 4. Core Values JSON
        if ($request->has('about_values_json')) {
            $rawVals = $request->input('about_values_json');
            if (!empty($rawVals)) {
                SiteSetting::updateOrCreate(
                    ['key' => 'about_values'],
                    ['value' => $rawVals, 'group' => 'about']
                );
            }
        }

        // 5. Remaining Text Fields
        $fields = $request->except([
            '_token', '_method', 'hero_about_image_file', 'about_fabrication_file',
            'about_activity_files', 'retained_about_activity_images', 'about_values_json'
        ]);

        foreach ($fields as $key => $value) {
            $group = 'about';
            if (in_array($key, ['clinic_name', 'clinic_tagline'])) {
                $group = 'general';
            } elseif (str_starts_with($key, 'hero_')) {
                $group = 'hero_pages';
            }

            SiteSetting::updateOrCreate(
                ['key' => $key],
                ['value' => $value, 'group' => $group]
            );
        }

        return redirect()->route('admin.about.index')->with('success', 'Seluruh elemen dan foto halaman Tentang Kami berhasil diperbarui.');
    }
}