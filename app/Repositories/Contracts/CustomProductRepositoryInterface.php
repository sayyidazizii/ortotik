<?php

namespace App\Repositories\Contracts;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use App\Models\CustomProduct;

interface CustomProductRepositoryInterface
{
    public function getActiveCustomProducts(): Collection;
    public function findBySlug(string $slug): ?CustomProduct;
    public function findById(int $id): ?Model;
    public function create(array $data): Model;
    public function update(int $id, array $data): bool;
    public function delete(int $id): bool;
}
