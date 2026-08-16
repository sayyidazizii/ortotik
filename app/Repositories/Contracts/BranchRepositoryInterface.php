<?php

namespace App\Repositories\Contracts;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use App\Models\Branch;

interface BranchRepositoryInterface
{
    public function getActiveBranches(): Collection;
    public function findById(int $id): ?Model;
    public function getMainBranch(): ?Branch;
    public function create(array $data): Model;
    public function update(int $id, array $data): bool;
    public function delete(int $id): bool;
}
