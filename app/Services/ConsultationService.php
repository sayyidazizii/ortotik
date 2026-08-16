<?php

namespace App\Services;

use App\Models\ConsultationLead;
use App\Repositories\Contracts\ConsultationLeadRepositoryInterface;
use App\Repositories\Contracts\BranchRepositoryInterface;
use App\Repositories\Contracts\MedicalServiceRepositoryInterface;
use Illuminate\Support\Facades\Log;

class ConsultationService
{
    public function __construct(
        protected ConsultationLeadRepositoryInterface $leadRepository,
        protected BranchRepositoryInterface $branchRepository,
        protected MedicalServiceRepositoryInterface $serviceRepository
    ) {}

    public function submitLead(array $data, ?string $ipAddress = null): ConsultationLead
    {
        $payload = [
            'branch_id' => $data['branch_id'] ?? null,
            'medical_service_id' => $data['medical_service_id'] ?? null,
            'full_name' => strip_tags(trim($data['full_name'])),
            'phone_number' => preg_replace('/[^0-9+]/', '', $data['phone_number']),
            'email' => isset($data['email']) ? filter_var(trim($data['email']), FILTER_SANITIZE_EMAIL) : null,
            'complaint_type' => strip_tags(trim($data['complaint_type'] ?? 'Konsultasi Umum')),
            'preferred_date' => $data['preferred_date'] ?? null,
            'notes' => isset($data['notes']) ? strip_tags(trim($data['notes'])) : null,
            'status' => 'new',
            'ip_address' => $ipAddress,
        ];

        $lead = $this->leadRepository->create($payload);

        Log::info("New consultation lead received: ID #{$lead->id} - {$lead->full_name} ({$lead->phone_number})");

        return $lead;
    }

    public function generateWhatsAppRedirectUrl(ConsultationLead $lead): string
    {
        $branch = $lead->branch ?? $this->branchRepository->getMainBranch();
        $targetWa = $branch ? $branch->whatsapp_number : '6281234567890';
        $cleanWa = preg_replace('/[^0-9]/', '', $targetWa);

        $msg = "Halo Admin Ortotik & Prostetik,\n\nSaya telah mengisi formulir konsultasi website:\n"
             . "• Nama: *{$lead->full_name}*\n"
             . "• Keluhan: *{$lead->complaint_type}*\n"
             . ($lead->preferred_date ? "• Rencana Kunjungan: *{$lead->preferred_date->format('d-m-Y')}*\n" : "")
             . ($branch ? "• Cabang: *{$branch->name}*\n" : "")
             . "\nMohon info ketersediaan jadwal konsultasi spesialis. Terima kasih!";

        return "https://wa.me/{$cleanWa}?text=" . urlencode($msg);
    }
}
