<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'category_type',
        'thumbnail',
        'summary',
        'description',
        'indications',
        'features',
        'workflow_steps',
        'is_active',
        'meta_title',
        'meta_description',
    ];

    protected $casts = [
        'indications' => 'array',
        'features' => 'array',
        'workflow_steps' => 'array',
        'is_active' => 'boolean',
    ];
}
