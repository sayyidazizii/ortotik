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
        'gallery_images',
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
        'gallery_images' => 'array',
        'is_active' => 'boolean',
        'order_position' => 'integer',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function getNameAttribute(): string
    {
        return $this->title ?? '';
    }

    public function getShortDescriptionAttribute(): string
    {
        return $this->summary ?? '';
    }

    public function getDescriptionAttribute(): string
    {
        return $this->content ?? '';
    }

    public function getIconAttribute(): ?string
    {
        return $this->icon_name ?? 'activity';
    }

    /**
     * Resolve single thumbnail image URL.
     */
    public function getThumbnailUrlAttribute(): string
    {
        if (!empty($this->thumbnail)) {
            if (str_starts_with($this->thumbnail, 'http://') || str_starts_with($this->thumbnail, 'https://')) {
                return $this->thumbnail;
            }
            return asset(ltrim($this->thumbnail, '/'));
        }

        $slider = $this->slider_images;
        return $slider[0] ?? asset('images/client_update/image4.png');
    }

    /**
     * Resolve all slider image URLs for frontend & sliders.
     */
    public function getSliderImagesAttribute(): array
    {
        $images = [];

        if (!empty($this->thumbnail)) {
            $images[] = $this->resolveImageUrl($this->thumbnail);
        }

        if (is_array($this->gallery_images)) {
            foreach ($this->gallery_images as $img) {
                if (!empty($img)) {
                    $resolved = $this->resolveImageUrl($img);
                    if (!in_array($resolved, $images)) {
                        $images[] = $resolved;
                    }
                }
            }
        }

        if (empty($images)) {
            $images = $this->getDefaultDummyImages();
        }

        return $images;
    }

    /**
     * Get raw slider paths stored in database.
     */
    public function getRawSliderImagesAttribute(): array
    {
        $raw = [];
        if (is_array($this->gallery_images)) {
            foreach ($this->gallery_images as $img) {
                if (!empty($img)) {
                    $raw[] = $img;
                }
            }
        }
        return $raw;
    }

    /**
     * Helper to resolve local/remote path into full URL.
     */
    protected function resolveImageUrl(string $path): string
    {
        if (str_starts_with($path, 'http://') || str_starts_with($path, 'https://')) {
            return $path;
        }
        return asset(ltrim($path, '/'));
    }

    /**
     * Distinct dummy images based on service slug or id.
     */
    public function getDefaultDummyImages(): array
    {
        $slug = strtolower($this->slug ?? '');

        if (str_contains($slug, 'prosthet')) {
            return [
                asset('images/client_update/image3.png'),
                asset('images/client_update/image1.png'),
                asset('images/client_update/image5.png'),
            ];
        }

        if (str_contains($slug, 'bracing') || str_contains($slug, 'orthos') || str_contains($slug, 'support')) {
            return [
                asset('images/client_update/image7.png'),
                asset('images/client_update/image4.png'),
                asset('images/client_update/image2.png'),
            ];
        }

        if (str_contains($slug, 'scoliosis') || str_contains($slug, 'spine')) {
            return [
                asset('images/client_update/image6.png'),
                asset('images/client_update/image2.png'),
                asset('images/client_update/image4.png'),
            ];
        }

        if (str_contains($slug, 'physio') || str_contains($slug, 'rehab') || str_contains($slug, 'gait')) {
            return [
                asset('images/client_update/image5.png'),
                asset('images/client_update/image1.png'),
                asset('images/client_update/image7.png'),
            ];
        }

        return [
            asset('images/client_update/image4.png'),
            asset('images/client_update/image3.png'),
            asset('images/client_update/image6.png'),
        ];
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
