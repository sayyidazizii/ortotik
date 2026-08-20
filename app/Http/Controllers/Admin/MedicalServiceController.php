<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MedicalService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;

class MedicalServiceController extends Controller
{
    public function index(): View
    {
        $services = MedicalService::orderBy('order_position')->get();
        return view('admin.services.index', compact('services'));
    }

    public function create(): View
    {
        return view('admin.services.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name'                 => ['nullable', 'string', 'max:255'],
            'title'                => ['nullable', 'string', 'max:255'],
            'icon'                 => ['nullable', 'string', 'max:100'],
            'icon_name'            => ['nullable', 'string', 'max:100'],
            'image_file'           => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp,svg,gif', 'max:5120'],
            'thumbnail'            => ['nullable', 'string', 'max:500'],
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

        $thumbnail = null;
        if ($request->hasFile('image_file')) {
            $path = $request->file('image_file')->store('services', 'public');
            $thumbnail = 'storage/' . $path;
        } elseif ($request->filled('thumbnail')) {
            $thumbnail = $request->input('thumbnail');
        }

        $serviceData = [
            'title'          => $title,
            'slug'           => $uniqueSlug,
            'summary'        => $validated['summary'] ?? $validated['short_description'] ?? '',
            'content'        => $validated['content'] ?? $validated['description'] ?? '',
            'thumbnail'      => $thumbnail,
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
        return view('admin.services.edit', compact('service'));
    }

    public function update(Request $request, int $id): RedirectResponse
    {
        $service = MedicalService::findOrFail($id);

        $validated = $request->validate([
            'name'                 => ['nullable', 'string', 'max:255'],
            'title'                => ['nullable', 'string', 'max:255'],
            'icon'                 => ['nullable', 'string', 'max:100'],
            'icon_name'            => ['nullable', 'string', 'max:100'],
            'image_file'           => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp,svg,gif', 'max:5120'],
            'thumbnail'            => ['nullable', 'string', 'max:500'],
            'short_description'    => ['nullable', 'string', 'max:500'],
            'summary'              => ['nullable', 'string', 'max:500'],
            'description'          => ['nullable', 'string'],
            'content'              => ['nullable', 'string'],
            'consultation_process' => ['nullable', 'string'],
            'order_position'       => ['nullable', 'integer', 'min:0'],
        ]);

        if ($request->hasFile('image_file')) {
            if ($service->thumbnail && str_starts_with($service->thumbnail, 'storage/')) {
                $oldRelPath = str_replace('storage/', '', $service->thumbnail);
                if (Storage::disk('public')->exists($oldRelPath)) {
                    Storage::disk('public')->delete($oldRelPath);
                }
            }

            $path = $request->file('image_file')->store('services', 'public');
            $service->thumbnail = 'storage/' . $path;
        } elseif ($request->filled('thumbnail')) {
            $service->thumbnail = $request->input('thumbnail');
        }

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

        if ($service->thumbnail && str_starts_with($service->thumbnail, 'storage/')) {
            $oldRelPath = str_replace('storage/', '', $service->thumbnail);
            if (Storage::disk('public')->exists($oldRelPath)) {
                Storage::disk('public')->delete($oldRelPath);
            }
        }

        $service->delete();

        return redirect()->route('admin.services.index')->with('success', 'Layanan medis ' . $title . ' berhasil dihapus.');
    }
}
