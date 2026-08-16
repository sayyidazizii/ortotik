<?php

namespace App\Repositories\Eloquent;

use App\Models\Branch;
use App\Repositories\Contracts\BranchRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class BranchRepository extends BaseRepository implements BranchRepositoryInterface
{
    public function __construct(Branch $model)
    {
        parent::__construct($model);
    }

    public function getActiveBranches(): Collection
    {
        return $this->model->newQuery()
            ->where('is_active', true)
            ->orderBy('is_main_branch', 'desc')
            ->orderBy('name', 'asc')
            ->get();
    }

    public function findById(int $id): ?Branch
    {
        return $this->model->find($id);
    }

    public function getMainBranch(): ?Branch
    {
        return $this->model->newQuery()
            ->where('is_active', true)
            ->where('is_main_branch', true)
            ->first() ?? $this->model->newQuery()->where('is_active', true)->first();
    }
}
