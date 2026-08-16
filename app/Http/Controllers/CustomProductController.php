<?php

namespace App\Http\Controllers;

use App\Repositories\Contracts\CustomProductRepositoryInterface;
use App\Repositories\Contracts\BranchRepositoryInterface;
use Illuminate\View\View;

class CustomProductController extends Controller
{
    public function __construct(
        protected CustomProductRepositoryInterface $customProductRepository,
        protected BranchRepositoryInterface $branchRepository
    ) {}

    public function index(): View
    {
        $customProducts = $this->customProductRepository->getActiveCustomProducts();
        $mainBranch = $this->branchRepository->getMainBranch();
        return view('pages.custom-products.index', compact('customProducts', 'mainBranch'));
    }

    public function show(string $slug): View
    {
        $product = $this->customProductRepository->findBySlug($slug);
        if (!$product) {
            abort(404, 'Produk custom tidak ditemukan');
        }

        $allCustomProducts = $this->customProductRepository->getActiveCustomProducts();
        return view('pages.custom-products.show', compact('product', 'allCustomProducts'));
    }
}
