<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ConsultationLead;
use App\Models\Branch;
use App\Services\ConsultationService;
use App\Repositories\Contracts\ConsultationLeadRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class ConsultationLeadController extends Controller
{
    public function __construct(
        protected ConsultationLeadRepositoryInterface $leadRepository,
        protected ConsultationService $consultationService
    ) {}

    /**
     * Display a listing of patient consultation leads.
     */
    public function index(Request $request): View
    {
        $status = $request->query('status');
        $search = $request->query('search');
        $branchId = $request->query('branch_id');

        $query = ConsultationLead::with(['branch', 'medicalService'])->latest();

        if ($status && in_array($status, ['new', 'contacted', 'scheduled', 'completed', 'cancelled'], true)) {
            $query->where('status', $status);
        }

        if ($branchId) {
            $query->where('branch_id', $branchId);
        }

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('full_name', 'like', "%{$search}%")
                  ->orWhere('phone_number', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('complaint_type', 'like', "%{$search}%")
                  ->orWhere('notes', 'like', "%{$search}%");
            });
        }

        $leads = $query->paginate(15)->withQueryString();

        // Metric Counts
        $statusCounts = [
            'total' => ConsultationLead::count(),
            'new' => ConsultationLead::where('status', 'new')->count(),
            'contacted' => ConsultationLead::where('status', 'contacted')->count(),
            'scheduled' => ConsultationLead::where('status', 'scheduled')->count(),
            'completed' => ConsultationLead::where('status', 'completed')->count(),
            'cancelled' => ConsultationLead::where('status', 'cancelled')->count(),
        ];

        $branches = Branch::where('is_active', true)->get();

        return view('admin.leads.index', compact('leads', 'statusCounts', 'branches', 'status', 'search', 'branchId'));
    }

    /**
     * Display the specified consultation lead details.
     */
    public function show(int $id): View
    {
        $lead = ConsultationLead::with(['branch', 'medicalService'])->findOrFail($id);
        $waReplyUrl = $this->consultationService->generateAdminFollowUpWhatsAppUrl($lead);

        return view('admin.leads.show', compact('lead', 'waReplyUrl'));
    }

    /**
     * Update the specified lead's status and notes.
     */
    public function updateStatus(Request $request, int $id): RedirectResponse
    {
        $request->validate([
            'status' => ['required', 'string', 'in:new,contacted,scheduled,completed,cancelled'],
            'notes' => ['nullable', 'string', 'max:2000'],
        ]);

        $lead = ConsultationLead::findOrFail($id);
        
        $updateData = ['status' => $request->input('status')];
        if ($request->has('notes')) {
            $updateData['notes'] = $request->input('notes');
        }

        $lead->update($updateData);

        return back()->with('success', 'Status konsultasi pasien ' . $lead->full_name . ' berhasil diperbarui ke [' . strtoupper($lead->status) . '].');
    }

    /**
     * Remove the specified lead from storage.
     */
    public function destroy(int $id): RedirectResponse
    {
        $lead = ConsultationLead::findOrFail($id);
        $name = $lead->full_name;
        $lead->delete();

        return redirect()->route('admin.leads.index')->with('success', 'Data konsultasi pasien ' . $name . ' berhasil dihapus.');
    }
}
