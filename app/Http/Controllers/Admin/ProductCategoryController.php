<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class ProductCategoryController extends Controller
{
    public function index(Request $request): View
    {
        $search = $request->query('search');
        $query = Category::where('type', 'product')
            ->withCount('products')
            ->orderBy('order_position', 'asc')
            ->orderBy('name', 'asc');

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        $categories = $query->paginate(15)->withQueryString();
        $totalCategories = Category::where('type', 'product')->count();
        $totalProducts = \App\Models\Product::count();

        return view('admin.product-categories.index', compact('categories', 'search', 'totalCategories', 'totalProducts'));
    }

    public function create(): View
    {
        return view('admin.product-categories.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name'           => 'required|string|max:150',
            'slug'           => 'nullable|string|max:191|unique:categories,slug',
            'description'    => 'nullable|string|max:1000',
            'order_position' => 'nullable|integer|min:0',
        ]);

        $slug = $request->filled('slug')
            ? Str::slug($request->input('slug'))
            : Str::slug($request->input('name'));

        // Ensure unique slug
        $originalSlug = $slug;
        $count = 1;
        while (Category::where('slug', $slug)->exists()) {
            $slug = "{$originalSlug}-{$count}";
            $count++;
        }

        Category::create([
            'name'           => $request->input('name'),
            'slug'           => $slug,
            'type'           => 'product',
            'description'    => $request->input('description'),
            'order_position' => $request->input('order_position', 0) ?? 0,
        ]);

        return redirect()->route('admin.product-categories.index')
            ->with('success', "Kategori produk \"{$request->input('name')}\" berhasil ditambahkan.");
    }

    public function edit(int $id): View
    {
        $category = Category::where('type', 'product')->findOrFail($id);
        return view('admin.product-categories.edit', compact('category'));
    }

    public function update(Request $request, int $id): RedirectResponse
    {
        $category = Category::where('type', 'product')->findOrFail($id);

        $request->validate([
            'name'           => 'required|string|max:150',
            'slug'           => 'nullable|string|max:191|unique:categories,slug,' . $id,
            'description'    => 'nullable|string|max:1000',
            'order_position' => 'nullable|integer|min:0',
        ]);

        $slug = $request->filled('slug')
            ? Str::slug($request->input('slug'))
            : Str::slug($request->input('name'));

        // Ensure unique slug
        $originalSlug = $slug;
        $count = 1;
        while (Category::where('slug', $slug)->where('id', '!=', $id)->exists()) {
            $slug = "{$originalSlug}-{$count}";
            $count++;
        }

        $category->update([
            'name'           => $request->input('name'),
            'slug'           => $slug,
            'description'    => $request->input('description'),
            'order_position' => $request->input('order_position', 0) ?? 0,
        ]);

        return redirect()->route('admin.product-categories.index')
            ->with('success', "Kategori produk \"{$category->name}\" berhasil diperbarui.");
    }

    public function destroy(int $id): RedirectResponse
    {
        $category = Category::where('type', 'product')->withCount('products')->findOrFail($id);

        if ($category->products_count > 0) {
            return redirect()->route('admin.product-categories.index')
                ->with('error', "Kategori \"{$category->name}\" tidak dapat dihapus karena masih digunakan oleh {$category->products_count} produk. Silakan ubah kategori produk terkait terlebih dahulu.");
        }

        $name = $category->name;
        $category->delete();

        return redirect()->route('admin.product-categories.index')
            ->with('success', "Kategori produk \"{$name}\" berhasil dihapus.");
    }
}
