<?php

namespace App\Services;

use App\Models\Product;
use App\Repositories\Contracts\ProductRepositoryInterface;
use App\Repositories\Contracts\CategoryRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class ProductService
{
    public function __construct(
        protected ProductRepositoryInterface $productRepository,
        protected CategoryRepositoryInterface $categoryRepository
    ) {}

    public function getCatalog(int $perPage = 12, ?string $categorySlug = null, ?string $search = null, string $sortBy = 'latest'): array
    {
        $products = $this->productRepository->getAll($perPage, $categorySlug, $search, $sortBy);
        $categories = $this->categoryRepository->getByType('product');
        $selectedCategory = $categorySlug ? $this->categoryRepository->findBySlug($categorySlug) : null;

        return [
            'products' => $products,
            'categories' => $categories,
            'selectedCategory' => $selectedCategory,
            'currentSearch' => $search,
            'currentSort' => $sortBy,
        ];
    }

    public function getFeaturedProducts(int $limit = 6): Collection
    {
        return $this->productRepository->getFeatured($limit);
    }

    public function getProductDetail(string $slug): ?array
    {
        $product = $this->productRepository->findBySlug($slug);
        if (!$product) {
            return null;
        }

        $relatedProducts = $this->productRepository->getRelated($product, 4);

        // Generate WhatsApp inquiry text
        $waMessage = "Halo Admin Ortotik, saya tertarik dengan produk:\n\n*{$product->name}*\nHarga: {$product->formatted_price}\nLink: " . url("/products/{$product->slug}") . "\n\nApakah stok tersedia dan bagaimana prosedur konsultasinya?";
        $waUrl = "https://wa.me/" . config('app.whatsapp_number', '6281234567890') . "?text=" . urlencode($waMessage);

        return [
            'product' => $product,
            'relatedProducts' => $relatedProducts,
            'waUrl' => $waUrl,
        ];
    }
}
