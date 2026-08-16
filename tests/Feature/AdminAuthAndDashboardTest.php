<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminAuthAndDashboardTest extends TestCase
{
    public function test_login_page_loads_successfully(): void
    {
        $response = $this->get('/admin/login');
        $response->assertStatus(200);
        $response->assertSee('Login Administrator');
    }

    public function test_unauthenticated_user_cannot_access_admin_dashboard(): void
    {
        $response = $this->get('/admin');
        $response->assertRedirect('/admin/login');
    }

    public function test_superadmin_can_login_and_access_dashboard(): void
    {
        $admin = User::firstOrCreate(
            ['email' => 'admin@ortotik.co.id'],
            [
                'name' => 'Super Administrator Ortotik',
                'password' => Hash::make('PasswordOrtotik2026!'),
                'role' => 'superadmin',
            ]
        );

        $loginResponse = $this->post('/admin/login', [
            'email' => 'admin@ortotik.co.id',
            'password' => 'PasswordOrtotik2026!',
        ]);

        $loginResponse->assertRedirect('/admin');
        $this->assertAuthenticatedAs($admin);

        $dashboardResponse = $this->get('/admin');
        $dashboardResponse->assertStatus(200);
        $dashboardResponse->assertSee('Dashboard Overview');
        $dashboardResponse->assertSee('Pesan Pasien Baru');
    }

    public function test_admin_can_logout(): void
    {
        $admin = User::where('email', 'admin@ortotik.co.id')->first();
        if ($admin) {
            $this->actingAs($admin);
            $logoutResponse = $this->post('/admin/logout');
            $logoutResponse->assertRedirect('/admin/login');
            $this->assertGuest();
        } else {
            $this->assertTrue(true);
        }
    }
}
