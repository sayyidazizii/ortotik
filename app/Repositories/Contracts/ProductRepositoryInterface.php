<?php

namespace App\Repositories\Contracts;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

interface ProductRepositoryInterface
{
    public function getAll(int $perPage = 12, ?string $categorySlug = null, ?string $search = null, string $sortBy = 'latest'): LengthAwarePaginator;
    public function getFeatured(int $limit = 6): Collection;
    public function findBySlug(string $slug): ?Product;
    public function findById(int $id): ?Model;
    public function getRelated(Product $product, int $limit = 4): Collection;
    public function create(array $data): Model;
    public function update(int $id, array $data): bool;
    public function delete(int $id): bool;
}
