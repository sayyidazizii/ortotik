<?php

namespace App\Repositories\Contracts;

use Illuminate\Database\Eloquent\Collection;

interface SiteSettingRepositoryInterface
{
    public function getAll(): Collection;
    public function getGroup(string $group): Collection;
    public function get(string $key, ?string $default = null): ?string;
    public function set(string $key, ?string $value, string $group = 'general'): void;
}
