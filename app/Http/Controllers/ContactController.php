<?php

namespace App\Http\Controllers;

use App\Repositories\Contracts\BranchRepositoryInterface;
use App\Repositories\Contracts\SiteSettingRepositoryInterface;
use Illuminate\View\View;

class ContactController extends Controller
{
    public function __construct(
        protected BranchRepositoryInterface $branchRepository,
        protected SiteSettingRepositoryInterface $settingRepository
    ) {}

    public function index(): View
    {
        $branches = $this->branchRepository->getActiveBranches();
        $settings = $this->settingRepository->getAll()->pluck('value', 'key');
        return view('pages.contact', compact('branches', 'settings'));
    }
}
