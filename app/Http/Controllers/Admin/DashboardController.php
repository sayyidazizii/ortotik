<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ConsultationLead;
use App\Models\Product;
use App\Models\Article;
use App\Models\MedicalService;
use Illuminate\View\View;
use Carbon\Carbon;

class DashboardController extends Controller
{
    /**
     * Display the Executive Admin Dashboard Overview.
     */
    public function index(): View
    {
        $today = Carbon::today();

        // Metrics
        $totalLeads = ConsultationLead::count();
        $todayLeads = ConsultationLead::whereDate('created_at', $today)->count();
        $newLeads = ConsultationLead::where('status', 'new')->count();
        $contactedLeads = ConsultationLead::where('status', 'contacted')->count();
        $scheduledLeads = ConsultationLead::where('status', 'scheduled')->count();
        $completedLeads = ConsultationLead::where('status', 'completed')->count();

        $totalProducts = Product::count();
        $activeProducts = Product::where('is_active', true)->count();
        $totalArticles = Article::count();
        $totalServices = MedicalService::count();

        // 6 Latest Consultation Leads needing attention
        $recentLeads = ConsultationLead::with('branch')
            ->latest()
            ->take(6)
            ->get();

        return view('admin.dashboard', compact(
            'totalLeads',
            'todayLeads',
            'newLeads',
            'contactedLeads',
            'scheduledLeads',
            'completedLeads',
            'totalProducts',
            'activeProducts',
            'totalArticles',
            'totalServices',
            'recentLeads'
        ));
    }
}
