<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreConsultationRequest;
use App\Services\ConsultationService;
use App\Repositories\Contracts\BranchRepositoryInterface;
use App\Repositories\Contracts\MedicalServiceRepositoryInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ConsultationController extends Controller
{
    public function __construct(
        protected ConsultationService $consultationService,
        protected BranchRepositoryInterface $branchRepository,
        protected MedicalServiceRepositoryInterface $serviceRepository
    ) {}

    public function create(): View
    {
        $branches = $this->branchRepository->getActiveBranches();
        $services = $this->serviceRepository->getActiveServices();
        return view('pages.consultation.create', compact('branches', 'services'));
    }

    public function store(StoreConsultationRequest $request): RedirectResponse
    {
        $lead = $this->consultationService->submitLead(
            $request->validated(),
            $request->ip()
        );

        $waRedirectUrl = $this->consultationService->generateWhatsAppRedirectUrl($lead);

        return redirect()->away($waRedirectUrl);
    }
}
