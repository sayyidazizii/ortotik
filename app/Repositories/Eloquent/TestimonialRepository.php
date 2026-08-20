<?php

namespace App\Repositories\Eloquent;

use App\Models\Testimonial;
use App\Repositories\Contracts\TestimonialRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class TestimonialRepository extends BaseRepository implements TestimonialRepositoryInterface
{
    public function __construct(Testimonial $model)
    {
        parent::__construct($model);
    }

    public function getActive(): Collection
    {
        return $this->model->newQuery()
            ->where('is_active', true)
            ->latest()
            ->get();
    }

    public function findById(int $id): ?Testimonial
    {
        return $this->model->find($id);
    }

    public function getFeatured(int $limit = 6): Collection
    {
        $featured = $this->model->newQuery()
            ->where('is_active', true)
            ->where('is_featured', true)
            ->latest()
            ->limit($limit)
            ->get();

        if ($featured->isEmpty()) {
            $featured = $this->model->newQuery()
                ->where('is_active', true)
                ->latest()
                ->limit($limit)
                ->get();
        }

        return $featured;
    }
}
