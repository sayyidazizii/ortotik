<?php

namespace App\Services;

use App\Repositories\Contracts\MedicalServiceRepositoryInterface;
use App\Repositories\Contracts\CustomProductRepositoryInterface;
use App\Repositories\Contracts\TestimonialRepositoryInterface;
use App\Repositories\Contracts\BranchRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class MedicalServiceService
{
    public function __construct(
        protected MedicalServiceRepositoryInterface $serviceRepository,
        protected CustomProductRepositoryInterface $customProductRepository,
        protected TestimonialRepositoryInterface $testimonialRepository,
        protected BranchRepositoryInterface $branchRepository
    ) {}

    public function getAllServices(): Collection
    {
        return $this->serviceRepository->getActiveServices();
    }

    public function getServiceDetail(string $slug): ?array
    {
        $service = $this->serviceRepository->findBySlug($slug);
        if (!$service) {
            return null;
        }

        $allServices = $this->serviceRepository->getActiveServices();
        $branches = $this->branchRepository->getActiveBranches();

        return [
            'service' => $service,
            'allServices' => $allServices,
            'branches' => $branches,
        ];
    }

    public function getCustomProducts(): Collection
    {
        return $this->customProductRepository->getActiveCustomProducts();
    }
}
