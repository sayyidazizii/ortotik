<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index(Request $request): View
    {
        $search = $request->query('search');
        $categoryId = $request->query('category_id');
        $stockStatus = $request->query('stock_status');

        $query = Product::with('category')->latest();

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('sku', 'like', "%{$search}%")
                  ->orWhere('short_description', 'like', "%{$search}%")
                  ->orWhere('excerpt', 'like', "%{$search}%");
            });
        }

        if ($categoryId) {
            $query->where('category_id', $categoryId);
        }

        if ($stockStatus) {
            $query->where('stock_status', $stockStatus);
        }

        $products = $query->paginate(12)->withQueryString();
        $categories = Category::where('type', 'product')->get();

        return view('admin.products.index', compact('products', 'categories', 'search', 'categoryId', 'stockStatus'));
    }

    public function create(): View
    {
        $categories = Category::where('type', 'product')->get();
        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name'                => ['required', 'string', 'max:255'],
            'category_id'         => ['required', 'exists:categories,id'],
            'sku'                 => ['nullable', 'string', 'max:100', 'unique:products,sku'],
            'price'               => ['nullable', 'numeric', 'min:0'],
            'discount_price'      => ['nullable', 'numeric', 'min:0'],
            'stock_status'        => ['required', 'in:in_stock,pre_order,out_of_stock,ready_stock,custom_only'],
            'is_active'           => ['boolean'],
            'is_featured'         => ['boolean'],
            'is_custom_order'     => ['boolean'],
            'excerpt'             => ['nullable', 'string', 'max:500'],
            'short_description'   => ['nullable', 'string', 'max:500'],
            'description'         => ['required', 'string'],
            'medical_indications' => ['nullable', 'string'],
            'medical_indication'  => ['nullable', 'string'],
            'material_spec'       => ['nullable', 'string'],
            'warranty_period'     => ['nullable', 'string', 'max:100'],
            'image_file'          => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp,svg,gif', 'max:5120'],
            'thumbnail'           => ['nullable', 'string', 'max:500'],
            'main_image_path'     => ['nullable', 'string', 'max:500'],
        ]);

        if ($validated['stock_status'] === 'ready_stock') {
            $validated['stock_status'] = 'in_stock';
        } elseif ($validated['stock_status'] === 'custom_only') {
            $validated['stock_status'] = 'pre_order';
        }

        // Handle Image Upload
        if ($request->hasFile('image_file')) {
            $path = $request->file('image_file')->store('products', 'public');
            $validated['thumbnail'] = 'storage/' . $path;
        } elseif ($request->filled('thumbnail')) {
            $validated['thumbnail'] = $request->input('thumbnail');
        } elseif ($request->filled('main_image_path')) {
            $validated['thumbnail'] = $request->input('main_image_path');
        }

        $slug = Str::slug($validated['name']);
        $uniqueSlug = $slug;
        $counter = 1;
        while (Product::where('slug', $uniqueSlug)->exists()) {
            $uniqueSlug = $slug . '-' . $counter++;
        }
        $validated['slug'] = $uniqueSlug;
        $validated['excerpt'] = $validated['excerpt'] ?? $validated['short_description'] ?? '';
        $validated['medical_indications'] = $validated['medical_indications'] ?? $validated['medical_indication'] ?? null;
        $validated['is_active'] = $request->boolean('is_active', true);
        $validated['is_featured'] = $request->boolean('is_featured', false);

        Product::create($validated);

        return redirect()->route('admin.products.index')->with('success', 'Produk medis berhasil ditambahkan ke e-katalog.');
    }

    public function edit(int $id): View
    {
        $product = Product::findOrFail($id);
        $categories = Category::where('type', 'product')->get();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, int $id): RedirectResponse
    {
        $product = Product::findOrFail($id);

        $validated = $request->validate([
            'name'                => ['required', 'string', 'max:255'],
            'category_id'         => ['required', 'exists:categories,id'],
            'sku'                 => ['nullable', 'string', 'max:100', 'unique:products,sku,' . $product->id],
            'price'               => ['nullable', 'numeric', 'min:0'],
            'discount_price'      => ['nullable', 'numeric', 'min:0'],
            'stock_status'        => ['required', 'in:in_stock,pre_order,out_of_stock,ready_stock,custom_only'],
            'excerpt'             => ['nullable', 'string', 'max:500'],
            'short_description'   => ['nullable', 'string', 'max:500'],
            'description'         => ['required', 'string'],
            'medical_indications' => ['nullable', 'string'],
            'medical_indication'  => ['nullable', 'string'],
            'material_spec'       => ['nullable', 'string'],
            'warranty_period'     => ['nullable', 'string', 'max:100'],
            'image_file'          => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp,svg,gif', 'max:5120'],
            'thumbnail'           => ['nullable', 'string', 'max:500'],
            'main_image_path'     => ['nullable', 'string', 'max:500'],
        ]);

        if ($validated['stock_status'] === 'ready_stock') {
            $validated['stock_status'] = 'in_stock';
        } elseif ($validated['stock_status'] === 'custom_only') {
            $validated['stock_status'] = 'pre_order';
        }

        // Handle Image Upload
        if ($request->hasFile('image_file')) {
            // Delete old file if stored locally
            if ($product->thumbnail && str_starts_with($product->thumbnail, 'storage/')) {
                $oldRelPath = str_replace('storage/', '', $product->thumbnail);
                if (Storage::disk('public')->exists($oldRelPath)) {
                    Storage::disk('public')->delete($oldRelPath);
                }
            }

            $path = $request->file('image_file')->store('products', 'public');
            $validated['thumbnail'] = 'storage/' . $path;
        } elseif ($request->filled('thumbnail')) {
            $validated['thumbnail'] = $request->input('thumbnail');
        } elseif ($request->filled('main_image_path')) {
            $validated['thumbnail'] = $request->input('main_image_path');
        }

        if ($product->name !== $validated['name']) {
            $slug = Str::slug($validated['name']);
            $uniqueSlug = $slug;
            $counter = 1;
            while (Product::where('slug', $uniqueSlug)->where('id', '!=', $product->id)->exists()) {
                $uniqueSlug = $slug . '-' . $counter++;
            }
            $validated['slug'] = $uniqueSlug;
        }

        $validated['excerpt'] = $validated['excerpt'] ?? $validated['short_description'] ?? $product->excerpt;
        $validated['medical_indications'] = $validated['medical_indications'] ?? $validated['medical_indication'] ?? $product->medical_indications;
        $validated['is_active'] = $request->boolean('is_active');
        $validated['is_featured'] = $request->boolean('is_featured');

        $product->update($validated);

        return redirect()->route('admin.products.index')->with('success', 'Data produk ' . $product->name . ' berhasil diperbarui.');
    }

    public function destroy(int $id): RedirectResponse
    {
        $product = Product::findOrFail($id);
        $name = $product->name;
        
        if ($product->thumbnail && str_starts_with($product->thumbnail, 'storage/')) {
            $oldRelPath = str_replace('storage/', '', $product->thumbnail);
            if (Storage::disk('public')->exists($oldRelPath)) {
                Storage::disk('public')->delete($oldRelPath);
            }
        }

        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Produk ' . $name . ' berhasil dihapus dari e-katalog.');
    }
}
