<?php

namespace App\Repositories\Eloquent;

use App\Models\Category;
use App\Repositories\Contracts\CategoryRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class CategoryRepository extends BaseRepository implements CategoryRepositoryInterface
{
    public function __construct(Category $model)
    {
        parent::__construct($model);
    }

    public function getByType(string $type): Collection
    {
        return $this->model->newQuery()
            ->where('type', $type)
            ->orderBy('order_position', 'asc')
            ->get();
    }

    public function findById(int $id): ?Category
    {
        return $this->model->find($id);
    }

    public function findBySlug(string $slug): ?Category
    {
        return $this->model->newQuery()
            ->where('slug', $slug)
            ->first();
    }
}
