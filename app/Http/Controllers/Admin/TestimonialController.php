<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;

class TestimonialController extends Controller
{
    public function index(Request $request): View
    {
        $search = $request->query('search');
        $status = $request->query('status');

        $query = Testimonial::latest();

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('patient_name', 'like', "%{$search}%")
                  ->orWhere('patient_info', 'like', "%{$search}%")
                  ->orWhere('service_used', 'like', "%{$search}%")
                  ->orWhere('testimony', 'like', "%{$search}%");
            });
        }

        if ($status === 'active') {
            $query->where('is_active', true);
        } elseif ($status === 'inactive') {
            $query->where('is_active', false);
        } elseif ($status === 'featured') {
            $query->where('is_featured', true);
        }

        $testimonials = $query->paginate(12)->withQueryString();
        $totalTestimonials = Testimonial::count();
        $activeTestimonials = Testimonial::where('is_active', true)->count();
        $featuredTestimonials = Testimonial::where('is_featured', true)->count();

        return view('admin.testimonials.index', compact(
            'testimonials',
            'search',
            'status',
            'totalTestimonials',
            'activeTestimonials',
            'featuredTestimonials'
        ));
    }

    public function create(): View
    {
        return view('admin.testimonials.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'patient_name' => 'required|string|max:150',
            'patient_info' => 'nullable|string|max:100',
            'service_used' => 'required|string|max:150',
            'testimony'    => 'required|string|max:2000',
            'rating'       => 'required|integer|min:1|max:5',
            'photo_file'   => 'nullable|image|mimes:jpeg,png,jpg,webp,svg|max:5120',
            'photo'        => 'nullable|string|max:500',
            'is_featured'  => 'nullable|boolean',
            'is_active'    => 'nullable|boolean',
        ]);

        $photoPath = $request->input('photo');
        if ($request->hasFile('photo_file')) {
            $file = $request->file('photo_file');
            $path = $file->store('testimonials', 'public');
            $photoPath = 'storage/' . $path;
        }

        Testimonial::create([
            'patient_name' => $request->input('patient_name'),
            'patient_info' => $request->input('patient_info'),
            'service_used' => $request->input('service_used'),
            'testimony'    => $request->input('testimony'),
            'rating'       => $request->input('rating', 5),
            'photo'        => $photoPath,
            'is_featured'  => $request->boolean('is_featured', false),
            'is_active'    => $request->boolean('is_active', true),
        ]);

        return redirect()->route('admin.testimonials.index')
            ->with('success', "Testimoni dari \"{$request->input('patient_name')}\" berhasil ditambahkan.");
    }

    public function edit(int $id): View
    {
        $testimonial = Testimonial::findOrFail($id);
        return view('admin.testimonials.edit', compact('testimonial'));
    }

    public function update(Request $request, int $id): RedirectResponse
    {
        $testimonial = Testimonial::findOrFail($id);

        $request->validate([
            'patient_name' => 'required|string|max:150',
            'patient_info' => 'nullable|string|max:100',
            'service_used' => 'required|string|max:150',
            'testimony'    => 'required|string|max:2000',
            'rating'       => 'required|integer|min:1|max:5',
            'photo_file'   => 'nullable|image|mimes:jpeg,png,jpg,webp,svg|max:5120',
            'photo'        => 'nullable|string|max:500',
            'is_featured'  => 'nullable|boolean',
            'is_active'    => 'nullable|boolean',
        ]);

        $photoPath = $request->input('photo', $testimonial->photo);
        if ($request->hasFile('photo_file')) {
            $file = $request->file('photo_file');
            $path = $file->store('testimonials', 'public');
            $photoPath = 'storage/' . $path;
        }

        $testimonial->update([
            'patient_name' => $request->input('patient_name'),
            'patient_info' => $request->input('patient_info'),
            'service_used' => $request->input('service_used'),
            'testimony'    => $request->input('testimony'),
            'rating'       => $request->input('rating', 5),
            'photo'        => $photoPath,
            'is_featured'  => $request->boolean('is_featured', false),
            'is_active'    => $request->boolean('is_active', true),
        ]);

        return redirect()->route('admin.testimonials.index')
            ->with('success', "Testimoni dari \"{$testimonial->patient_name}\" berhasil diperbarui.");
    }

    public function toggleActive(int $id): RedirectResponse
    {
        $testimonial = Testimonial::findOrFail($id);
        $testimonial->is_active = !$testimonial->is_active;
        $testimonial->save();

        $statusText = $testimonial->is_active ? 'diaktifkan dan tampil di website' : 'dinonaktifkan';
        return back()->with('success', "Status testimoni \"{$testimonial->patient_name}\" berhasil {$statusText}.");
    }

    public function toggleFeatured(int $id): RedirectResponse
    {
        $testimonial = Testimonial::findOrFail($id);
        $testimonial->is_featured = !$testimonial->is_featured;
        $testimonial->save();

        $statusText = $testimonial->is_featured ? 'dijadikan unggulan di Beranda' : 'dilepas dari unggulan';
        return back()->with('success', "Testimoni \"{$testimonial->patient_name}\" berhasil {$statusText}.");
    }

    public function destroy(int $id): RedirectResponse
    {
        $testimonial = Testimonial::findOrFail($id);
        $name = $testimonial->patient_name;
        $testimonial->delete();

        return redirect()->route('admin.testimonials.index')
            ->with('success', "Testimoni dari \"{$name}\" berhasil dihapus.");
    }
}
