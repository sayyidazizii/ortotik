<?php

namespace App\Http\Controllers;

use App\Services\ArticleService;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ArticleController extends Controller
{
    public function __construct(
        protected ArticleService $articleService
    ) {}

    public function index(Request $request): View
    {
        $categorySlug = $request->query('category');
        $search = $request->query('search');

        $data = $this->articleService->getBlogList(9, $categorySlug, $search);

        return view('pages.articles.index', $data);
    }

    public function show(string $slug): View
    {
        $data = $this->articleService->getArticleDetail($slug);
        if (!$data) {
            abort(404, 'Artikel tidak ditemukan');
        }

        return view('pages.articles.show', $data);
    }
}
