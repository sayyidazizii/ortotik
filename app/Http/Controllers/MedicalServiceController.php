<?php

namespace App\Http\Controllers;

use App\Services\MedicalServiceService;
use Illuminate\View\View;

class MedicalServiceController extends Controller
{
    public function __construct(
        protected MedicalServiceService $medicalService
    ) {}

    public function index(): View
    {
        $services = $this->medicalService->getAllServices();
        return view('pages.services.index', compact('services'));
    }

    public function show(string $slug): View
    {
        $data = $this->medicalService->getServiceDetail($slug);
        if (!$data) {
            abort(404, 'Layanan medis tidak ditemukan');
        }

        return view('pages.services.show', $data);
    }
}
