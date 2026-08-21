<?php

namespace App\Repositories\Eloquent;

use App\Models\MedicalService;
use App\Repositories\Contracts\MedicalServiceRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class MedicalServiceRepository extends BaseRepository implements MedicalServiceRepositoryInterface
{
    public function __construct(MedicalService $model)
    {
        parent::__construct($model);
    }

    public function getActiveServices(): Collection
    {
        return $this->model->newQuery()
            ->with(['category'])
            ->where('is_active', true)
            ->orderBy('order_position', 'asc')
            ->get();
    }

    public function findById(int $id): ?MedicalService
    {
        return $this->model->find($id);
    }

    public function findBySlug(string $slug): ?MedicalService
    {
        $query = $this->model->newQuery()
            ->with(['category', 'products'])
            ->where('is_active', true);

        if ($slug === 'bracing-supports') {
            $query->where(function ($q) {
                $q->where('slug', 'bracing-supports')
                  ->orWhere('slug', 'bracing-orthopaedic-supports-orthosis');
            });
        } elseif ($slug === 'neuro-robotic') {
            $query->where(function ($q) {
                $q->where('slug', 'neuro-robotic')
                  ->orWhere('slug', 'neuro-robotic-rehabilitation');
            });
        } else {
            $query->where('slug', $slug);
        }

        return $query->first();
    }
}
