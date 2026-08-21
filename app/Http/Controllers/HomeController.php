<?php

namespace App\Http\Controllers;

use App\Services\ProductService;
use App\Services\MedicalServiceService;
use App\Repositories\Contracts\TestimonialRepositoryInterface;
use App\Repositories\Contracts\BranchRepositoryInterface;
use App\Repositories\Contracts\ArticleRepositoryInterface;
use App\Repositories\Contracts\SiteSettingRepositoryInterface;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function __construct(
        protected ProductService $productService,
        protected MedicalServiceService $medicalService,
        protected TestimonialRepositoryInterface $testimonialRepository,
        protected BranchRepositoryInterface $branchRepository,
        protected ArticleRepositoryInterface $articleRepository,
        protected SiteSettingRepositoryInterface $settingRepository
    ) {}

    public function index(): View
    {
        $services = $this->medicalService->getAllServices();
        $featuredProducts = $this->productService->getFeaturedProducts(8);
        $customProducts = $this->medicalService->getCustomProducts();
        $testimonials = $this->testimonialRepository->getFeatured(3);
        $branches = $this->branchRepository->getActiveBranches();
        $latestArticles = $this->articleRepository->getLatest(3);
        $settings = $this->settingRepository->getAll()->pluck('value', 'key');

        return view('pages.home', compact(
            'services',
            'featuredProducts',
            'customProducts',
            'testimonials',
            'branches',
            'latestArticles',
            'settings'
        ));
    }
}
