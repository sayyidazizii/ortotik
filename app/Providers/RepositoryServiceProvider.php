<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Contracts\CategoryRepositoryInterface;
use App\Repositories\Eloquent\CategoryRepository;
use App\Repositories\Contracts\MedicalServiceRepositoryInterface;
use App\Repositories\Eloquent\MedicalServiceRepository;
use App\Repositories\Contracts\ProductRepositoryInterface;
use App\Repositories\Eloquent\ProductRepository;
use App\Repositories\Contracts\CustomProductRepositoryInterface;
use App\Repositories\Eloquent\CustomProductRepository;
use App\Repositories\Contracts\BranchRepositoryInterface;
use App\Repositories\Eloquent\BranchRepository;
use App\Repositories\Contracts\ArticleRepositoryInterface;
use App\Repositories\Eloquent\ArticleRepository;
use App\Repositories\Contracts\ConsultationLeadRepositoryInterface;
use App\Repositories\Eloquent\ConsultationLeadRepository;
use App\Repositories\Contracts\TestimonialRepositoryInterface;
use App\Repositories\Eloquent\TestimonialRepository;
use App\Repositories\Contracts\SiteSettingRepositoryInterface;
use App\Repositories\Eloquent\SiteSettingRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(CategoryRepositoryInterface::class, CategoryRepository::class);
        $this->app->bind(MedicalServiceRepositoryInterface::class, MedicalServiceRepository::class);
        $this->app->bind(ProductRepositoryInterface::class, ProductRepository::class);
        $this->app->bind(CustomProductRepositoryInterface::class, CustomProductRepository::class);
        $this->app->bind(BranchRepositoryInterface::class, BranchRepository::class);
        $this->app->bind(ArticleRepositoryInterface::class, ArticleRepository::class);
        $this->app->bind(ConsultationLeadRepositoryInterface::class, ConsultationLeadRepository::class);
        $this->app->bind(TestimonialRepositoryInterface::class, TestimonialRepository::class);
        $this->app->bind(SiteSettingRepositoryInterface::class, SiteSettingRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
