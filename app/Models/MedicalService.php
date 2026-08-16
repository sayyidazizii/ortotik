<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MedicalService extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'title',
        'slug',
        'summary',
        'content',
        'thumbnail',
        'banner_image',
        'icon_name',
        'indications',
        'meta_title',
        'meta_description',
        'order_position',
        'is_active',
    ];

    protected $casts = [
        'indications' => 'array',
        'is_active' => 'boolean',
        'order_position' => 'integer',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    public function leads(): HasMany
    {
        return $this->hasMany(ConsultationLead::class);
    }
}
