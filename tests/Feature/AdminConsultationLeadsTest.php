<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\ConsultationLead;
use App\Models\Branch;
use Illuminate\Support\Facades\Hash;

class AdminConsultationLeadsTest extends TestCase
{
    protected User $admin;

    protected function setUp(): void
    {
        parent::setUp();

        $this->admin = User::firstOrCreate(
            ['email' => 'admin@ortotik.co.id'],
            [
                'name' => 'Super Administrator Ortotik',
                'password' => Hash::make('PasswordOrtotik2026!'),
                'role' => 'superadmin',
            ]
        );
    }

    public function test_admin_can_view_leads_index_page(): void
    {
        $response = $this->actingAs($this->admin)->get('/admin/leads');
        $response->assertStatus(200);
        $response->assertSee('CRM & Leads Konsultasi Pasien');
        $response->assertSee('Semua Leads');
    }

    public function test_admin_can_filter_leads_by_status(): void
    {
        $response = $this->actingAs($this->admin)->get('/admin/leads?status=new');
        $response->assertStatus(200);
        $response->assertSee('Baru Masuk');
    }

    public function test_admin_can_view_lead_detail_page(): void
    {
        $lead = ConsultationLead::first();
        if (!$lead) {
            $branch = Branch::first();
            $lead = ConsultationLead::create([
                'branch_id' => $branch?->id,
                'full_name' => 'Budi Santoso',
                'phone_number' => '081234567899',
                'complaint_type' => 'Kaki Palsu Bawah Lutut',
                'status' => 'new',
            ]);
        }

        $response = $this->actingAs($this->admin)->get('/admin/leads/' . $lead->id);
        $response->assertStatus(200);
        $response->assertSee($lead->full_name);
        $response->assertSee('Hubungi via WhatsApp Resmi');
    }

    public function test_admin_can_update_lead_status_and_notes(): void
    {
        $lead = ConsultationLead::first();
        if (!$lead) {
            $branch = Branch::first();
            $lead = ConsultationLead::create([
                'branch_id' => $branch?->id,
                'full_name' => 'Budi Santoso',
                'phone_number' => '081234567899',
                'complaint_type' => 'Kaki Palsu Bawah Lutut',
                'status' => 'new',
            ]);
        }

        $response = $this->actingAs($this->admin)->patch('/admin/leads/' . $lead->id . '/status', [
            'status' => 'scheduled',
            'notes' => 'Pasien telah dikonfirmasi datang tgl 22 Agustus 2026 jam 10 pagi',
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('consultation_leads', [
            'id' => $lead->id,
            'status' => 'scheduled',
            'notes' => 'Pasien telah dikonfirmasi datang tgl 22 Agustus 2026 jam 10 pagi',
        ]);
    }
}
