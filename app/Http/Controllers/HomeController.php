<?php

namespace App\Http\Controllers;

use App\Services\ProductService;
use App\Services\MedicalServiceService;
use App\Repositories\Contracts\TestimonialRepositoryInterface;
use App\Repositories\Contracts\BranchRepositoryInterface;
use App\Repositories\Contracts\ArticleRepositoryInterface;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function __construct(
        protected ProductService $productService,
        protected MedicalServiceService $medicalService,
        protected TestimonialRepositoryInterface $testimonialRepository,
        protected BranchRepositoryInterface $branchRepository,
        protected ArticleRepositoryInterface $articleRepository
    ) {}

    public function index(): View
    {
        $services = $this->medicalService->getAllServices();
        $featuredProducts = $this->productService->getFeaturedProducts(6);
        $customProducts = $this->medicalService->getCustomProducts();
        $testimonials = $this->testimonialRepository->getFeatured(3);
        $branches = $this->branchRepository->getActiveBranches();
        $latestArticles = $this->articleRepository->getLatest(3);

        return view('pages.home', compact(
            'services',
            'featuredProducts',
            'customProducts',
            'testimonials',
            'branches',
            'latestArticles'
        ));
    }
}
