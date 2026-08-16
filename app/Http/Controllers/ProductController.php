<?php

namespace App\Http\Controllers;

use App\Services\ProductService;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function __construct(
        protected ProductService $productService
    ) {}

    public function index(Request $request): View
    {
        $categorySlug = $request->query('category');
        $search = $request->query('search');
        $sortBy = $request->query('sort', 'latest');

        $data = $this->productService->getCatalog(12, $categorySlug, $search, $sortBy);

        return view('pages.products.index', $data);
    }

    public function show(string $slug): View
    {
        $data = $this->productService->getProductDetail($slug);
        if (!$data) {
            abort(404, 'Produk tidak ditemukan');
        }

        return view('pages.products.show', $data);
    }
}
