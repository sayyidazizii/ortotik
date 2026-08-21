<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'medical_service_id',
        'category_id',
        'name',
        'slug',
        'sku',
        'price',
        'discount_price',
        'stock_status',
        'thumbnail',
        'excerpt',
        'description',
        'medical_indications',
        'specifications',
        'size_chart',
        'images',
        'is_featured',
        'is_active',
        'meta_title',
        'meta_description',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'discount_price' => 'decimal:2',
        'specifications' => 'array',
        'images' => 'array',
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function medicalService(): BelongsTo
    {
        return $this->belongsTo(MedicalService::class);
    }

    public function productImages(): HasMany
    {
        return $this->hasMany(ProductImage::class)->orderBy('order_position', 'asc');
    }

    public function getThumbnailUrlAttribute(): string
    {
        if (!empty($this->thumbnail)) {
            if (str_starts_with($this->thumbnail, 'http://') || str_starts_with($this->thumbnail, 'https://')) {
                return $this->thumbnail;
            }
            return '/' . ltrim($this->thumbnail, '/');
        }
        return '/images/client_update/image7.png';
    }

    public function getFormattedPriceAttribute(): string
    {
        if (!$this->price || $this->price <= 0) {
            return 'Hubungi Kami';
        }
        return 'Rp ' . number_format($this->price, 0, ',', '.');
    }

    public function getFormattedDiscountPriceAttribute(): ?string
    {
        return $this->discount_price && $this->discount_price > 0 ? 'Rp ' . number_format($this->discount_price, 0, ',', '.') : null;
    }

    public function getSpecificationsDataAttribute(): mixed
    {
        $specs = $this->specifications;
        if (is_array($specs)) {
            return $specs;
        }
        if (is_string($specs)) {
            $decoded = json_decode($specs, true);
            if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                return $decoded;
            }
            return $specs;
        }
        return null;
    }

    public function getHasSpecificationsAttribute(): bool
    {
        $specs = $this->specifications_data;
        if (is_array($specs)) {
            return count($specs) > 0;
        }
        if (is_string($specs)) {
            return strlen(trim(strip_tags($specs))) > 0;
        }
        return false;
    }

    public function getHasMedicalIndicationsAttribute(): bool
    {
        return !empty(trim(strip_tags($this->medical_indications ?? '')));
    }

    public function getHasSizeChartAttribute(): bool
    {
        return !empty(trim(strip_tags($this->size_chart ?? '')));
    }

    public function getStockStatusLabelAttribute(): string
    {
        return match($this->stock_status) {
            'in_stock', 'ready_stock' => 'Ready Stock',
            'pre_order' => 'Pre-Order',
            'custom_only' => 'Custom Made Only',
            'out_of_stock' => 'Stok Habis',
            default => 'Tersedia'
        };
    }

    public function getGalleryImagesAttribute(): array
    {
        $list = [];

        // 1. Primary Thumbnail
        if (!empty($this->thumbnail)) {
            $src = (str_starts_with($this->thumbnail, 'http://') || str_starts_with($this->thumbnail, 'https://')) 
                ? $this->thumbnail 
                : ('/' . ltrim($this->thumbnail, '/'));
            $list[] = $src;
        }

        // 2. Extra gallery images from JSON array
        if (is_array($this->images)) {
            foreach ($this->images as $img) {
                if (!empty($img)) {
                    $src = (str_starts_with($img, 'http://') || str_starts_with($img, 'https://')) 
                        ? $img 
                        : ('/' . ltrim($img, '/'));
                    if (!in_array($src, $list)) {
                        $list[] = $src;
                    }
                }
            }
        }

        // 3. Fallback if empty
        if (empty($list)) {
            $list[] = $this->thumbnail_url;
        }

        return $list;
    }

    public function getRawGalleryImagesAttribute(): array
    {
        if (is_array($this->images)) {
            return array_values(array_filter($this->images));
        }
        return [];
    }
}
