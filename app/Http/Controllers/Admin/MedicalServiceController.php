<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MedicalService;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;

class MedicalServiceController extends Controller
{
    public function index(): View
    {
        $services = MedicalService::with('category')->orderBy('order_position')->get();
        return view('admin.services.index', compact('services'));
    }

    public function create(): View
    {
        $categories = Category::where('type', 'service')->orderBy('order_position')->get();
        return view('admin.services.create', compact('categories'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'category_id'          => ['nullable', 'exists:categories,id'],
            'name'                 => ['nullable', 'string', 'max:255'],
            'title'                => ['nullable', 'string', 'max:255'],
            'icon'                 => ['nullable', 'string', 'max:100'],
            'icon_name'            => ['nullable', 'string', 'max:100'],
            'image_file'           => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp,svg,gif', 'max:5120'],
            'slider_files.*'       => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp,svg,gif', 'max:5120'],
            'thumbnail'            => ['nullable', 'string', 'max:1000'],
            'slider_urls'          => ['nullable', 'array'],
            'slider_urls.*'        => ['nullable', 'string', 'max:1000'],
            'short_description'    => ['nullable', 'string', 'max:500'],
            'summary'              => ['nullable', 'string', 'max:500'],
            'description'          => ['nullable', 'string'],
            'content'              => ['nullable', 'string'],
            'consultation_process' => ['nullable', 'string'],
            'order_position'       => ['nullable', 'integer', 'min:0'],
        ]);

        $title = $validated['title'] ?? $validated['name'] ?? 'Layanan Medis Baru';
        $slug = Str::slug($title);
        $uniqueSlug = $slug;
        $counter = 1;
        while (MedicalService::where('slug', $uniqueSlug)->exists()) {
            $uniqueSlug = $slug . '-' . $counter++;
        }

        // 1. Handle Main Thumbnail
        $thumbnail = null;
        if ($request->hasFile('image_file')) {
            $path = $request->file('image_file')->store('services', 'public');
            $thumbnail = 'storage/' . $path;
        } elseif (!empty($validated['thumbnail']) && !str_starts_with($validated['thumbnail'], 'data:image')) {
            $thumbnail = $validated['thumbnail'];
        }

        // 2. Handle Slider Photos
        $galleryImages = [];
        if ($request->hasFile('slider_files')) {
            foreach ($request->file('slider_files') as $file) {
                if ($file->isValid()) {
                    $slidePath = $file->store('services/slider', 'public');
                    $galleryImages[] = 'storage/' . $slidePath;
                }
            }
        }

        // Add additional slider URLs if passed
        if (!empty($validated['slider_urls']) && is_array($validated['slider_urls'])) {
            foreach ($validated['slider_urls'] as $url) {
                if (!empty($url) && !in_array($url, $galleryImages) && !str_starts_with($url, 'data:image')) {
                    $galleryImages[] = $url;
                }
            }
        }

        $serviceData = [
            'category_id'    => $validated['category_id'] ?? null,
            'title'          => $title,
            'slug'           => $uniqueSlug,
            'summary'        => $validated['summary'] ?? $validated['short_description'] ?? '',
            'content'        => $validated['content'] ?? $validated['description'] ?? '',
            'thumbnail'      => $thumbnail,
            'gallery_images' => !empty($galleryImages) ? $galleryImages : null,
            'icon_name'      => $validated['icon_name'] ?? $validated['icon'] ?? 'activity',
            'order_position' => $validated['order_position'] ?? 0,
            'is_active'      => $request->boolean('is_active', true),
        ];

        MedicalService::create($serviceData);

        return redirect()->route('admin.services.index')->with('success', 'Layanan medis baru berhasil ditambahkan.');
    }

    public function edit(int $id): View
    {
        $service = MedicalService::findOrFail($id);
        $categories = Category::where('type', 'service')->orderBy('order_position')->get();
        return view('admin.services.edit', compact('service', 'categories'));
    }

    public function update(Request $request, int $id): RedirectResponse
    {
        $service = MedicalService::findOrFail($id);

        $validated = $request->validate([
            'category_id'              => ['nullable', 'exists:categories,id'],
            'name'                     => ['nullable', 'string', 'max:255'],
            'title'                    => ['nullable', 'string', 'max:255'],
            'icon'                     => ['nullable', 'string', 'max:100'],
            'icon_name'                => ['nullable', 'string', 'max:100'],
            'image_file'               => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp,svg,gif', 'max:5120'],
            'slider_files.*'           => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp,svg,gif', 'max:5120'],
            'thumbnail'                => ['nullable', 'string', 'max:1000'],
            'retained_slider_images'   => ['nullable', 'array'],
            'retained_slider_images.*' => ['nullable', 'string', 'max:1000'],
            'slider_urls'              => ['nullable', 'array'],
            'slider_urls.*'            => ['nullable', 'string', 'max:1000'],
            'short_description'        => ['nullable', 'string', 'max:500'],
            'summary'                  => ['nullable', 'string', 'max:500'],
            'description'              => ['nullable', 'string'],
            'content'              => ['nullable', 'string'],
            'consultation_process'     => ['nullable', 'string'],
            'order_position'           => ['nullable', 'integer', 'min:0'],
        ]);

        // 1. Handle Main Thumbnail Update
        if ($request->hasFile('image_file')) {
            if ($service->thumbnail && str_starts_with($service->thumbnail, 'storage/')) {
                $oldRelPath = str_replace('storage/', '', $service->thumbnail);
                if (Storage::disk('public')->exists($oldRelPath)) {
                    Storage::disk('public')->delete($oldRelPath);
                }
            }

            $path = $request->file('image_file')->store('services', 'public');
            $service->thumbnail = 'storage/' . $path;
        } elseif ($request->filled('thumbnail') && !str_starts_with($request->input('thumbnail'), 'data:image')) {
            $service->thumbnail = $request->input('thumbnail');
        }

        // 2. Handle Retained and Deleted Existing Slider Photos
        $currentGallery = is_array($service->gallery_images) ? $service->gallery_images : [];
        $retainedImages = $request->input('retained_slider_images', []);
        if (!is_array($retainedImages)) {
            $retainedImages = [];
        }

        // Delete removed storage files
        foreach ($currentGallery as $oldImg) {
            if (!in_array($oldImg, $retainedImages)) {
                if (str_starts_with($oldImg, 'storage/')) {
                    $oldRelPath = str_replace('storage/', '', $oldImg);
                    if (Storage::disk('public')->exists($oldRelPath)) {
                        Storage::disk('public')->delete($oldRelPath);
                    }
                }
            }
        }

        $galleryImages = array_values(array_filter($retainedImages, function ($img) {
            return !empty($img) && !str_starts_with($img, 'data:image');
        }));

        // 3. Handle Newly Uploaded Slider Photos
        if ($request->hasFile('slider_files')) {
            foreach ($request->file('slider_files') as $file) {
                if ($file->isValid()) {
                    $slidePath = $file->store('services/slider', 'public');
                    $galleryImages[] = 'storage/' . $slidePath;
                }
            }
        }

        // Add additional slider URLs if passed
        if (!empty($validated['slider_urls']) && is_array($validated['slider_urls'])) {
            foreach ($validated['slider_urls'] as $url) {
                if (!empty($url) && !in_array($url, $galleryImages) && !str_starts_with($url, 'data:image')) {
                    $galleryImages[] = $url;
                }
            }
        }

        $service->gallery_images = !empty($galleryImages) ? $galleryImages : null;

        $title = $validated['title'] ?? $validated['name'] ?? $service->title;
        if ($service->title !== $title) {
            $slug = Str::slug($title);
            $uniqueSlug = $slug;
            $counter = 1;
            while (MedicalService::where('slug', $uniqueSlug)->where('id', '!=', $service->id)->exists()) {
                $uniqueSlug = $slug . '-' . $counter++;
            }
            $service->slug = $uniqueSlug;
        }

        $service->category_id = $validated['category_id'] ?? null;
        $service->title = $title;
        $service->summary = $validated['summary'] ?? $validated['short_description'] ?? $service->summary;
        $service->content = $validated['content'] ?? $validated['description'] ?? $service->content;
        $service->icon_name = $validated['icon_name'] ?? $validated['icon'] ?? $service->icon_name;
        $service->order_position = $validated['order_position'] ?? $service->order_position;
        $service->is_active = $request->boolean('is_active');
        $service->save();

        return redirect()->route('admin.services.index')->with('success', 'Layanan medis ' . $service->title . ' berhasil diperbarui.');
    }

    public function destroy(int $id): RedirectResponse
    {
        $service = MedicalService::findOrFail($id);
        $title = $service->title;

        // Clean up thumbnail
        if ($service->thumbnail && str_starts_with($service->thumbnail, 'storage/')) {
            $oldRelPath = str_replace('storage/', '', $service->thumbnail);
            if (Storage::disk('public')->exists($oldRelPath)) {
                Storage::disk('public')->delete($oldRelPath);
            }
        }

        // Clean up slider images
        if (is_array($service->gallery_images)) {
            foreach ($service->gallery_images as $img) {
                if (str_starts_with($img, 'storage/')) {
                    $relPath = str_replace('storage/', '', $img);
                    if (Storage::disk('public')->exists($relPath)) {
                        Storage::disk('public')->delete($relPath);
                    }
                }
            }
        }

        $service->delete();

        return redirect()->route('admin.services.index')->with('success', 'Layanan medis ' . $title . ' berhasil dihapus.');
    }
}
