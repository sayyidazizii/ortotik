<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use App\Models\Branch;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;

class SiteSettingController extends Controller
{
    public function index(Request $request): View
    {
        $settings = SiteSetting::all()->keyBy('key');
        $activeTab = $request->query('tab', 'hero_home');
        $mainBranch = Branch::where('is_main_branch', true)->first() ?? Branch::first();
        return view('admin.settings.index', compact('settings', 'activeTab', 'mainBranch'));
    }

    public function update(Request $request): RedirectResponse
    {
        $request->validate([
            // Home Hero Background Media (Image or Video)
            'hero_home_media_file'       => 'nullable|file|mimes:jpeg,png,jpg,webp,svg,gif,mp4,webm,ogg,mov,avi|max:51200',
            'hero_home_media'            => 'nullable|string|max:1000',
            'hero_home_media_type'       => 'nullable|string|in:image,video',

            // Hero Doctors & Badges
            'hero_doctor_image_file'     => 'nullable|image|mimes:jpeg,png,jpg,webp,svg,gif|max:5120',
            'hero_doctor_image'          => 'nullable|string|max:500',
            'hero_doctor_badge'          => 'nullable|string|max:100',
            'hero_doctor_name'           => 'nullable|string|max:150',
            'hero_doctor_title'          => 'nullable|string|max:200',
            'hero_doctor_alt'            => 'nullable|string|max:255',
            'hero_doctors_json'          => 'nullable|string',
            'hero_doctor_files.*'        => 'nullable|image|mimes:jpeg,png,jpg,webp,svg,gif|max:5120',
            
            // Hero Page Banner Image Files
            'hero_services_image_file'   => 'nullable|image|mimes:jpeg,png,jpg,webp,svg,gif|max:5120',
            'hero_about_image_file'      => 'nullable|image|mimes:jpeg,png,jpg,webp,svg,gif|max:5120',
            'hero_contact_image_file'    => 'nullable|image|mimes:jpeg,png,jpg,webp,svg,gif|max:5120',
            'hero_products_image_file'   => 'nullable|image|mimes:jpeg,png,jpg,webp,svg,gif|max:5120',
            'hero_articles_image_file'   => 'nullable|image|mimes:jpeg,png,jpg,webp,svg,gif|max:5120',

            // Hero Badges
            'hero_badge_1_title'         => 'nullable|string|max:100',
            'hero_badge_1_subtitle'      => 'nullable|string|max:100',
            'hero_badge_2_title'         => 'nullable|string|max:100',
            'hero_badge_2_subtitle'      => 'nullable|string|max:100',
            
            // Narration & Descriptions
            'hero_home_description'      => 'nullable|string|max:3000',
            'about_company_description'  => 'nullable|string|max:3000',

            // Clinic Identity & Contact
            'clinic_name'                => 'nullable|string|max:255',
            'clinic_tagline'             => 'nullable|string|max:255',
            'phone_number'               => 'nullable|string|max:50',
            'hotline_whatsapp'           => 'nullable|string|max:50',
            'contact_email'              => 'nullable|email|max:100',
            'opening_hours'              => 'nullable|string|max:255',
            
            // Address & Google Maps
            'clinic_city'                => 'nullable|string|max:100',
            'clinic_address'             => 'nullable|string|max:500',
            'footer_address'             => 'nullable|string|max:500',
            'google_maps_url'            => 'nullable|string|max:1000',
            'google_maps_embed'          => 'nullable|string|max:3000',
            
            // Footer & Social
            'footer_description'         => 'nullable|string|max:1000',
            'footer_copyright'           => 'nullable|string|max:255',
            'instagram_url'              => 'nullable|string|max:255',
            'youtube_url'                => 'nullable|string|max:255',
            'facebook_url'               => 'nullable|string|max:255',
            'tiktok_url'                 => 'nullable|string|max:255',
            
            // SEO
            'meta_title'                 => 'nullable|string|max:255',
            'meta_description'           => 'nullable|string|max:1000',
            'meta_keywords'              => 'nullable|string|max:500',
        ]);

        // 1. Handle Home Hero Background Media (Image or Video)
        if ($request->hasFile('hero_home_media_file')) {
            $file = $request->file('hero_home_media_file');
            $extension = strtolower($file->getClientOriginalExtension());
            $isVideo = in_array($extension, ['mp4', 'webm', 'ogg', 'mov', 'avi']);
            $path = $file->store('banners', 'public');
            
            SiteSetting::updateOrCreate(
                ['key' => 'hero_home_media'],
                ['value' => 'storage/' . $path, 'group' => 'hero']
            );

            SiteSetting::updateOrCreate(
                ['key' => 'hero_home_media_type'],
                ['value' => $isVideo ? 'video' : 'image', 'group' => 'hero']
            );
        } elseif ($request->filled('hero_home_media')) {
            $url = $request->input('hero_home_media');
            $isVideo = (bool) preg_match('/\.(mp4|webm|ogg|mov)$/i', $url);
            if ($request->filled('hero_home_media_type')) {
                $mediaType = $request->input('hero_home_media_type');
            } else {
                $mediaType = $isVideo ? 'video' : 'image';
            }

            SiteSetting::updateOrCreate(
                ['key' => 'hero_home_media'],
                ['value' => $url, 'group' => 'hero']
            );

            SiteSetting::updateOrCreate(
                ['key' => 'hero_home_media_type'],
                ['value' => $mediaType, 'group' => 'hero']
            );
        }

        // 2. Handle Multiple Hero Doctors JSON & Files
        if ($request->filled('hero_doctors_json')) {
            $doctors = json_decode($request->input('hero_doctors_json'), true);
            if (is_array($doctors)) {
                if ($request->hasFile('hero_doctor_files')) {
                    foreach ($request->file('hero_doctor_files') as $idx => $docFile) {
                        if ($docFile && isset($doctors[$idx])) {
                            $path = $docFile->store('settings', 'public');
                            $doctors[$idx]['image'] = 'storage/' . $path;
                        }
                    }
                }

                $cleanDoctors = [];
                foreach ($doctors as $doc) {
                    if (!empty($doc['name']) || !empty($doc['image'])) {
                        $cleanDoctors[] = [
                            'name'  => $doc['name'] ?? 'Tenaga Medis Spesialis',
                            'title' => $doc['title'] ?? 'Praktisi Ortotik & Prostetik',
                            'badge' => $doc['badge'] ?? 'Tim Klinis Spesialis',
                            'image' => $doc['image'] ?? asset('images/client_update/image5.png'),
                        ];
                    }
                }

                if (!empty($cleanDoctors)) {
                    SiteSetting::updateOrCreate(
                        ['key' => 'hero_doctors'],
                        ['value' => json_encode($cleanDoctors, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE), 'group' => 'hero']
                    );

                    SiteSetting::updateOrCreate(['key' => 'hero_doctor_name'], ['value' => $cleanDoctors[0]['name'], 'group' => 'hero']);
                    SiteSetting::updateOrCreate(['key' => 'hero_doctor_title'], ['value' => $cleanDoctors[0]['title'], 'group' => 'hero']);
                    SiteSetting::updateOrCreate(['key' => 'hero_doctor_badge'], ['value' => $cleanDoctors[0]['badge'], 'group' => 'hero']);
                    SiteSetting::updateOrCreate(['key' => 'hero_doctor_image'], ['value' => $cleanDoctors[0]['image'], 'group' => 'hero']);
                }
            }
        }

        // 3. Handle Page Hero Banner Image Uploads
        $pageImageKeys = [
            'hero_services_image' => 'hero_services_image_file',
            'hero_about_image'    => 'hero_about_image_file',
            'hero_contact_image'  => 'hero_contact_image_file',
            'hero_products_image' => 'hero_products_image_file',
            'hero_articles_image' => 'hero_articles_image_file',
        ];

        foreach ($pageImageKeys as $settingKey => $fileInputName) {
            if ($request->hasFile($fileInputName)) {
                $file = $request->file($fileInputName);
                $path = $file->store('banners', 'public');
                SiteSetting::updateOrCreate(
                    ['key' => $settingKey],
                    ['value' => 'storage/' . $path, 'group' => 'hero_pages']
                );
            } elseif ($request->filled($settingKey)) {
                SiteSetting::updateOrCreate(
                    ['key' => $settingKey],
                    ['value' => $request->input($settingKey), 'group' => 'hero_pages']
                );
            }
        }

        // 4. Handle Remaining Text Fields
        $fields = $request->except(array_merge(
            ['_token', '_method', 'hero_doctor_files', 'hero_doctors_json', 'hero_home_media_file', 'hero_home_media', 'hero_home_media_type'],
            array_values($pageImageKeys),
            array_keys($pageImageKeys)
        ));

        foreach ($fields as $key => $value) {
            $group = 'general';
            if (str_starts_with($key, 'hero_page_') || str_starts_with($key, 'hero_services_') || str_starts_with($key, 'hero_about_') || str_starts_with($key, 'hero_contact_') || str_starts_with($key, 'hero_products_') || str_starts_with($key, 'hero_articles_')) {
                $group = 'hero_pages';
            } elseif (str_starts_with($key, 'hero_')) {
                $group = 'hero';
            } elseif (str_contains($key, 'url') || str_contains($key, 'social') || str_contains($key, 'instagram') || str_contains($key, 'youtube') || str_contains($key, 'facebook') || str_contains($key, 'tiktok')) {
                $group = 'social';
            } elseif (str_contains($key, 'meta')) {
                $group = 'seo';
            } elseif (str_contains($key, 'maps') || str_contains($key, 'contact') || str_contains($key, 'hotline') || str_contains($key, 'phone') || str_contains($key, 'email') || str_contains($key, 'address') || str_contains($key, 'city') || str_contains($key, 'hours')) {
                $group = 'contact';
            } elseif (str_contains($key, 'footer')) {
                $group = 'footer';
            }

            SiteSetting::updateOrCreate(
                ['key' => $key],
                ['value' => $value, 'group' => $group]
            );
        }

        // 5. Sync with Main Branch for single branch consistency
        $mainBranch = Branch::where('is_main_branch', true)->first();
        if ($mainBranch) {
            if ($request->filled('clinic_name')) $mainBranch->name = $request->input('clinic_name') . ' (Pusat)';
            if ($request->filled('clinic_city')) $mainBranch->city = $request->input('clinic_city');
            if ($request->filled('clinic_address')) $mainBranch->address = $request->input('clinic_address');
            if ($request->filled('phone_number')) $mainBranch->phone_number = $request->input('phone_number');
            if ($request->filled('hotline_whatsapp')) $mainBranch->whatsapp_number = $request->input('hotline_whatsapp');
            if ($request->filled('contact_email')) $mainBranch->email = $request->input('contact_email');
            if ($request->filled('opening_hours')) $mainBranch->opening_hours = $request->input('opening_hours');
            if ($request->filled('google_maps_url')) $mainBranch->google_maps_url = $request->input('google_maps_url');
            if ($request->filled('google_maps_embed')) $mainBranch->google_maps_embed = $request->input('google_maps_embed');
            $mainBranch->save();
        }

        $activeTab = $request->input('current_tab', 'hero_home');
        return redirect()->route('admin.settings.index', ['tab' => $activeTab])->with('success', 'Pengaturan situs, visual hero media, dan banner berhasil diperbarui.');
    }
}
