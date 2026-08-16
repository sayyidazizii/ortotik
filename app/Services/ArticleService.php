<?php

namespace App\Services;

use App\Repositories\Contracts\ArticleRepositoryInterface;
use App\Repositories\Contracts\CategoryRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class ArticleService
{
    public function __construct(
        protected ArticleRepositoryInterface $articleRepository,
        protected CategoryRepositoryInterface $categoryRepository
    ) {}

    public function getBlogList(int $perPage = 9, ?string $categorySlug = null, ?string $search = null): array
    {
        $articles = $this->articleRepository->getPublished($perPage, $categorySlug, $search);
        $categories = $this->categoryRepository->getByType('article');
        $selectedCategory = $categorySlug ? $this->categoryRepository->findBySlug($categorySlug) : null;
        $latestArticles = $this->articleRepository->getLatest(4);

        return [
            'articles' => $articles,
            'categories' => $categories,
            'selectedCategory' => $selectedCategory,
            'latestArticles' => $latestArticles,
            'currentSearch' => $search,
        ];
    }

    public function getArticleDetail(string $slug): ?array
    {
        $article = $this->articleRepository->findBySlug($slug);
        if (!$article) {
            return null;
        }

        $this->articleRepository->incrementViews($article);
        $latestArticles = $this->articleRepository->getLatest(4);
        $categories = $this->categoryRepository->getByType('article');

        return [
            'article' => $article,
            'latestArticles' => $latestArticles,
            'categories' => $categories,
        ];
    }
}
