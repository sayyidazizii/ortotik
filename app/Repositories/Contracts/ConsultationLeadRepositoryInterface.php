<?php

namespace App\Repositories\Contracts;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;

interface ConsultationLeadRepositoryInterface
{
    public function getAll(int $perPage = 15, ?string $status = null, ?string $search = null): LengthAwarePaginator;
    public function findById(int $id): ?Model;
    public function create(array $data): Model;
    public function updateStatus(int $id, string $status): bool;
    public function countByStatus(): array;
}
