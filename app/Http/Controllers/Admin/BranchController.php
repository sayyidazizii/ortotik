<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

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
            'name' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string'],
            'city' => ['required', 'string', 'max:100'],
            'phone_number' => ['required', 'string', 'max:50'],
            'whatsapp_number' => ['required', 'string', 'max:50'],
            'google_maps_url' => ['nullable', 'url', 'max:500'],
            'google_maps_embed' => ['nullable', 'string'],
            'opening_hours' => ['nullable', 'string', 'max:255'],
        ]);

        $validated['is_main_branch'] = $request->boolean('is_main_branch');
        $validated['is_active'] = $request->boolean('is_active');

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
            'name' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string'],
            'city' => ['required', 'string', 'max:100'],
            'phone_number' => ['required', 'string', 'max:50'],
            'whatsapp_number' => ['required', 'string', 'max:50'],
            'google_maps_url' => ['nullable', 'url', 'max:500'],
            'google_maps_embed' => ['nullable', 'string'],
            'opening_hours' => ['nullable', 'string', 'max:255'],
        ]);

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

        $name = $branch->name;
        $branch->delete();

        return redirect()->route('admin.branches.index')->with('success', 'Cabang klinik ' . $name . ' berhasil dihapus.');
    }
}
