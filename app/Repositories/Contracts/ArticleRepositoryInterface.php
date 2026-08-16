<?php

namespace App\Repositories\Contracts;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;
use App\Models\Article;

interface ArticleRepositoryInterface
{
    public function getPublished(int $perPage = 9, ?string $categorySlug = null, ?string $search = null): LengthAwarePaginator;
    public function getLatest(int $limit = 3): Collection;
    public function findBySlug(string $slug): ?Article;
    public function findById(int $id): ?Model;
    public function incrementViews(Article $article): void;
    public function create(array $data): Model;
    public function update(int $id, array $data): bool;
    public function delete(int $id): bool;
}
