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
        return $this->model->newQuery()
            ->with(['category', 'products'])
            ->where('slug', $slug)
            ->where('is_active', true)
            ->first();
    }
}
