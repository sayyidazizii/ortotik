<?php

namespace App\Repositories\Eloquent;

use App\Models\CustomProduct;
use App\Repositories\Contracts\CustomProductRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class CustomProductRepository extends BaseRepository implements CustomProductRepositoryInterface
{
    public function __construct(CustomProduct $model)
    {
        parent::__construct($model);
    }

    public function getActiveCustomProducts(): Collection
    {
        return $this->model->newQuery()
            ->where('is_active', true)
            ->latest()
            ->get();
    }

    public function findById(int $id): ?CustomProduct
    {
        return $this->model->find($id);
    }

    public function findBySlug(string $slug): ?CustomProduct
    {
        return $this->model->newQuery()
            ->where('slug', $slug)
            ->where('is_active', true)
            ->first();
    }
}
