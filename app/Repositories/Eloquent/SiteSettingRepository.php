<?php

namespace App\Repositories\Eloquent;

use App\Models\SiteSetting;
use App\Repositories\Contracts\SiteSettingRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class SiteSettingRepository extends BaseRepository implements SiteSettingRepositoryInterface
{
    public function __construct(SiteSetting $model)
    {
        parent::__construct($model);
    }

    public function getAll(): Collection
    {
        return $this->model->all();
    }

    public function getGroup(string $group): Collection
    {
        return $this->model->newQuery()->where('group', $group)->get();
    }

    public function get(string $key, ?string $default = null): ?string
    {
        return SiteSetting::get($key, $default);
    }

    public function set(string $key, ?string $value, string $group = 'general'): void
    {
        SiteSetting::set($key, $value, $group);
    }
}
