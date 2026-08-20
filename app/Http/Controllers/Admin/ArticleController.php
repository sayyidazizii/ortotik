<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    public function index(Request $request): View
    {
        $search = $request->query('search');
        $categoryId = $request->query('category_id');

        $query = Article::with(['user', 'category'])->latest();

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('summary', 'like', "%{$search}%");
            });
        }

        if ($categoryId) {
            $query->where('category_id', $categoryId);
        }

        $articles = $query->paginate(10)->withQueryString();
        $categories = Category::where('type', 'article')->get();

        return view('admin.articles.index', compact('articles', 'categories', 'search', 'categoryId'));
    }

    public function create(): View
    {
        $categories = Category::where('type', 'article')->get();
        return view('admin.articles.create', compact('categories'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title'               => ['required', 'string', 'max:255'],
            'category_id'         => ['nullable', 'exists:categories,id'],
            'image_file'          => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp,svg,gif', 'max:5120'],
            'thumbnail'           => ['nullable', 'string', 'max:500'],
            'featured_image_path' => ['nullable', 'string', 'max:500'],
            'summary'             => ['required', 'string', 'max:500'],
            'content'             => ['required', 'string'],
            'read_time'           => ['nullable'],
        ]);

        // Handle Image Upload
        if ($request->hasFile('image_file')) {
            $path = $request->file('image_file')->store('articles', 'public');
            $validated['thumbnail'] = 'storage/' . $path;
        } elseif ($request->filled('thumbnail')) {
            $validated['thumbnail'] = $request->input('thumbnail');
        } elseif ($request->filled('featured_image_path')) {
            $validated['thumbnail'] = $request->input('featured_image_path');
        }

        $slug = Str::slug($validated['title']);
        $uniqueSlug = $slug;
        $counter = 1;
        while (Article::where('slug', $uniqueSlug)->exists()) {
            $uniqueSlug = $slug . '-' . $counter++;
        }

        $validated['slug'] = $uniqueSlug;
        $validated['user_id'] = Auth::id() ?? 1;
        $validated['is_featured'] = $request->boolean('is_featured');
        $validated['is_published'] = $request->boolean('is_published');
        $validated['published_at'] = $validated['is_published'] ? now() : null;
        $validated['read_time'] = isset($validated['read_time']) ? (int) preg_replace('/[^0-9]/', '', (string)$validated['read_time']) ?: 3 : 3;

        Article::create($validated);

        return redirect()->route('admin.articles.index')->with('success', 'Artikel edukasi klinis berhasil diterbitkan.');
    }

    public function edit(int $id): View
    {
        $article = Article::findOrFail($id);
        $categories = Category::where('type', 'article')->get();
        return view('admin.articles.edit', compact('article', 'categories'));
    }

    public function update(Request $request, int $id): RedirectResponse
    {
        $article = Article::findOrFail($id);

        $validated = $request->validate([
            'title'               => ['required', 'string', 'max:255'],
            'category_id'         => ['nullable', 'exists:categories,id'],
            'image_file'          => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp,svg,gif', 'max:5120'],
            'thumbnail'           => ['nullable', 'string', 'max:500'],
            'featured_image_path' => ['nullable', 'string', 'max:500'],
            'summary'             => ['required', 'string', 'max:500'],
            'content'             => ['required', 'string'],
            'read_time'           => ['nullable'],
        ]);

        // Handle Image Upload
        if ($request->hasFile('image_file')) {
            if ($article->thumbnail && str_starts_with($article->thumbnail, 'storage/')) {
                $oldRelPath = str_replace('storage/', '', $article->thumbnail);
                if (Storage::disk('public')->exists($oldRelPath)) {
                    Storage::disk('public')->delete($oldRelPath);
                }
            }

            $path = $request->file('image_file')->store('articles', 'public');
            $validated['thumbnail'] = 'storage/' . $path;
        } elseif ($request->filled('thumbnail')) {
            $validated['thumbnail'] = $request->input('thumbnail');
        } elseif ($request->filled('featured_image_path')) {
            $validated['thumbnail'] = $request->input('featured_image_path');
        }

        if ($article->title !== $validated['title']) {
            $slug = Str::slug($validated['title']);
            $uniqueSlug = $slug;
            $counter = 1;
            while (Article::where('slug', $uniqueSlug)->where('id', '!=', $article->id)->exists()) {
                $uniqueSlug = $slug . '-' . $counter++;
            }
            $validated['slug'] = $uniqueSlug;
        }

        $wasPublished = $article->is_published;
        $validated['is_featured'] = $request->boolean('is_featured');
        $validated['is_published'] = $request->boolean('is_published');
        if (isset($validated['read_time'])) {
            $validated['read_time'] = (int) preg_replace('/[^0-9]/', '', (string)$validated['read_time']) ?: 3;
        }
        
        if ($validated['is_published'] && !$wasPublished) {
            $validated['published_at'] = now();
        }

        $article->update($validated);

        return redirect()->route('admin.articles.index')->with('success', 'Artikel edukasi ' . $article->title . ' berhasil diperbarui.');
    }

    public function destroy(int $id): RedirectResponse
    {
        $article = Article::findOrFail($id);
        $title = $article->title;

        if ($article->thumbnail && str_starts_with($article->thumbnail, 'storage/')) {
            $oldRelPath = str_replace('storage/', '', $article->thumbnail);
            if (Storage::disk('public')->exists($oldRelPath)) {
                Storage::disk('public')->delete($oldRelPath);
            }
        }

        $article->delete();

        return redirect()->route('admin.articles.index')->with('success', 'Artikel ' . $title . ' berhasil dihapus.');
    }
}
