<?php

namespace App\Repositories\Eloquent;

use App\Models\Product;
use App\Repositories\Contracts\ProductRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class ProductRepository extends BaseRepository implements ProductRepositoryInterface
{
    public function __construct(Product $model)
    {
        parent::__construct($model);
    }

    public function getAll(int $perPage = 12, ?string $categorySlug = null, ?string $search = null, string $sortBy = 'latest'): LengthAwarePaginator
    {
        $query = $this->model->newQuery()
            ->with(['category', 'medicalService'])
            ->where('is_active', true);

        if ($categorySlug) {
            $query->whereHas('category', function ($q) use ($categorySlug) {
                $q->where('slug', $categorySlug);
            });
        }

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhere('medical_indications', 'like', "%{$search}%");
            });
        }

        switch ($sortBy) {
            case 'price_asc':
                $query->orderBy('price', 'asc');
                break;
            case 'price_desc':
                $query->orderBy('price', 'desc');
                break;
            case 'name_asc':
                $query->orderBy('name', 'asc');
                break;
            case 'latest':
            default:
                $query->latest();
                break;
        }

        return $query->paginate($perPage);
    }

    public function getFeatured(int $limit = 6): Collection
    {
        return $this->model->newQuery()
            ->with(['category'])
            ->where('is_active', true)
            ->where('is_featured', true)
            ->latest()
            ->limit($limit)
            ->get();
    }

    public function findById(int $id): ?Product
    {
        return $this->model->find($id);
    }

    public function findBySlug(string $slug): ?Product
    {
        return $this->model->newQuery()
            ->with(['category', 'medicalService', 'productImages'])
            ->where('slug', $slug)
            ->where('is_active', true)
            ->first();
    }

    public function getRelated(Product $product, int $limit = 4): Collection
    {
        return $this->model->newQuery()
            ->with(['category'])
            ->where('is_active', true)
            ->where('id', '!=', $product->id)
            ->where(function ($q) use ($product) {
                if ($product->category_id) {
                    $q->orWhere('category_id', $product->category_id);
                }
                if ($product->medical_service_id) {
                    $q->orWhere('medical_service_id', $product->medical_service_id);
                }
            })
            ->limit($limit)
            ->get();
    }
}
