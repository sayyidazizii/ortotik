<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'type',
        'description',
        'order_position',
    ];

    protected $casts = [
        'order_position' => 'integer',
    ];

    public function medicalServices(): HasMany
    {
        return $this->hasMany(MedicalService::class);
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    public function articles(): HasMany
    {
        return $this->hasMany(Article::class);
    }
}
