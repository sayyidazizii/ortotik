<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;

class BranchController extends Controller
{
    public function index(): View
    {
        $branches = Branch::latest()->get();
        return view('admin.branches.index', compact('branches'));
    }

    public function create(): View
    {
        return view('admin.branches.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name'              => ['required', 'string', 'max:255'],
            'address'           => ['required', 'string'],
            'city'              => ['required', 'string', 'max:100'],
            'phone_number'      => ['required', 'string', 'max:50'],
            'whatsapp_number'   => ['required', 'string', 'max:50'],
            'email'             => ['nullable', 'email', 'max:100'],
            'google_maps_url'   => ['nullable', 'url', 'max:500'],
            'google_maps_embed' => ['nullable', 'string'],
            'opening_hours'     => ['nullable', 'string', 'max:255'],
            'image_file'        => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp,svg,gif', 'max:5120'],
            'image'             => ['nullable', 'string', 'max:500'],
        ]);

        if ($request->hasFile('image_file')) {
            $path = $request->file('image_file')->store('branches', 'public');
            $validated['image'] = 'storage/' . $path;
        }

        $validated['is_main_branch'] = $request->boolean('is_main_branch');
        $validated['is_active'] = $request->boolean('is_active', true);

        // If marked as main branch, demote others
        if ($validated['is_main_branch']) {
            Branch::where('is_main_branch', true)->update(['is_main_branch' => false]);
        }

        Branch::create($validated);

        return redirect()->route('admin.branches.index')->with('success', 'Cabang klinik baru berhasil ditambahkan.');
    }

    public function edit(int $id): View
    {
        $branch = Branch::findOrFail($id);
        return view('admin.branches.edit', compact('branch'));
    }

    public function update(Request $request, int $id): RedirectResponse
    {
        $branch = Branch::findOrFail($id);

        $validated = $request->validate([
            'name'              => ['required', 'string', 'max:255'],
            'address'           => ['required', 'string'],
            'city'              => ['required', 'string', 'max:100'],
            'phone_number'      => ['required', 'string', 'max:50'],
            'whatsapp_number'   => ['required', 'string', 'max:50'],
            'email'             => ['nullable', 'email', 'max:100'],
            'google_maps_url'   => ['nullable', 'url', 'max:500'],
            'google_maps_embed' => ['nullable', 'string'],
            'opening_hours'     => ['nullable', 'string', 'max:255'],
            'image_file'        => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp,svg,gif', 'max:5120'],
            'image'             => ['nullable', 'string', 'max:500'],
        ]);

        if ($request->hasFile('image_file')) {
            if ($branch->image && str_starts_with($branch->image, 'storage/')) {
                $oldRelPath = str_replace('storage/', '', $branch->image);
                if (Storage::disk('public')->exists($oldRelPath)) {
                    Storage::disk('public')->delete($oldRelPath);
                }
            }

            $path = $request->file('image_file')->store('branches', 'public');
            $validated['image'] = 'storage/' . $path;
        }

        $validated['is_main_branch'] = $request->boolean('is_main_branch');
        $validated['is_active'] = $request->boolean('is_active');

        if ($validated['is_main_branch'] && !$branch->is_main_branch) {
            Branch::where('id', '!=', $branch->id)->update(['is_main_branch' => false]);
        }

        $branch->update($validated);

        return redirect()->route('admin.branches.index')->with('success', 'Informasi cabang ' . $branch->name . ' berhasil diperbarui.');
    }

    public function destroy(int $id): RedirectResponse
    {
        $branch = Branch::findOrFail($id);
        if ($branch->is_main_branch) {
            return back()->with('error', 'Cabang utama tidak dapat dihapus. Silakan set cabang utama lain terlebih dahulu.');
        }

        if ($branch->image && str_starts_with($branch->image, 'storage/')) {
            $oldRelPath = str_replace('storage/', '', $branch->image);
            if (Storage::disk('public')->exists($oldRelPath)) {
                Storage::disk('public')->delete($oldRelPath);
            }
        }

        $name = $branch->name;
        $branch->delete();

        return redirect()->route('admin.branches.index')->with('success', 'Cabang klinik ' . $name . ' berhasil dihapus.');
    }
}
