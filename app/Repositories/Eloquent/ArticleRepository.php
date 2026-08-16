<?php

namespace App\Repositories\Eloquent;

use App\Models\Article;
use App\Repositories\Contracts\ArticleRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class ArticleRepository extends BaseRepository implements ArticleRepositoryInterface
{
    public function __construct(Article $model)
    {
        parent::__construct($model);
    }

    public function getPublished(int $perPage = 9, ?string $categorySlug = null, ?string $search = null): LengthAwarePaginator
    {
        $query = $this->model->newQuery()
            ->with(['category', 'user'])
            ->where('is_published', true)
            ->latest('published_at');

        if ($categorySlug) {
            $query->whereHas('category', function ($q) use ($categorySlug) {
                $q->where('slug', $categorySlug);
            });
        }

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('summary', 'like', "%{$search}%")
                  ->orWhere('content', 'like', "%{$search}%");
            });
        }

        return $query->paginate($perPage);
    }

    public function getLatest(int $limit = 3): Collection
    {
        return $this->model->newQuery()
            ->with(['category', 'user'])
            ->where('is_published', true)
            ->latest('published_at')
            ->limit($limit)
            ->get();
    }

    public function findById(int $id): ?Article
    {
        return $this->model->find($id);
    }

    public function findBySlug(string $slug): ?Article
    {
        return $this->model->newQuery()
            ->with(['category', 'user'])
            ->where('slug', $slug)
            ->where('is_published', true)
            ->first();
    }

    public function incrementViews(Article $article): void
    {
        $article->increment('views_count');
    }
}
