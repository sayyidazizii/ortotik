<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use App\Models\MedicalService;
use App\Models\Article;
use App\Models\Branch;
use Illuminate\Support\Facades\Hash;

class AdminCmsContentManagementTest extends TestCase
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

    public function test_admin_can_access_products_crud(): void
    {
        $category = Category::firstOrCreate(
            ['slug' => 'ortotik-kaki'],
            ['name' => 'Ortotik Kaki & Ankle', 'type' => 'product']
        );

        // Index
        $response = $this->actingAs($this->admin)->get('/admin/products');
        $response->assertStatus(200);

        // Create
        $response = $this->actingAs($this->admin)->get('/admin/products/create');
        $response->assertStatus(200);

        // Store
        $postData = [
            'name' => 'AFO Dynamic Carbon Test',
            'category_id' => $category->id,
            'sku' => 'AFO-TEST-' . uniqid(),
            'price' => 3500000,
            'stock_status' => 'ready_stock',
            'short_description' => 'AFO carbon ringan untuk drop foot',
            'description' => 'Spesifikasi detail produk uji coba',
            'is_active' => '1',
        ];

        $storeResponse = $this->actingAs($this->admin)->post('/admin/products', $postData);
        $storeResponse->assertRedirect('/admin/products');
        $this->assertDatabaseHas('products', ['name' => 'AFO Dynamic Carbon Test']);
    }

    public function test_admin_can_access_services_crud(): void
    {
        $response = $this->actingAs($this->admin)->get('/admin/services');
        $response->assertStatus(200);

        $response = $this->actingAs($this->admin)->get('/admin/services/create');
        $response->assertStatus(200);

        $postData = [
            'name' => 'Home Visit & Casting Medis Test',
            'icon' => 'home',
            'short_description' => 'Layanan home visit ke rumah pasien',
            'description' => 'Deskripsi lengkap home visit',
            'order_position' => 9,
            'is_active' => '1',
        ];

        $storeResponse = $this->actingAs($this->admin)->post('/admin/services', $postData);
        $storeResponse->assertRedirect('/admin/services');
        $this->assertDatabaseHas('medical_services', ['title' => 'Home Visit & Casting Medis Test']);
    }

    public function test_admin_can_access_articles_crud(): void
    {
        $response = $this->actingAs($this->admin)->get('/admin/articles');
        $response->assertStatus(200);

        $response = $this->actingAs($this->admin)->get('/admin/articles/create');
        $response->assertStatus(200);

        $postData = [
            'title' => 'Panduan Perawatan Kaki Palsu Test',
            'summary' => 'Ringkasan panduan perawatan prostesis',
            'content' => '<p>Isi artikel edukasi medis lengkap.</p>',
            'read_time' => '4 menit baca',
            'is_published' => '1',
        ];

        $storeResponse = $this->actingAs($this->admin)->post('/admin/articles', $postData);
        $storeResponse->assertRedirect('/admin/articles');
        $this->assertDatabaseHas('articles', ['title' => 'Panduan Perawatan Kaki Palsu Test']);
    }

    public function test_admin_can_access_branches_page(): void
    {
        $response = $this->actingAs($this->admin)->get('/admin/branches');
        $response->assertStatus(200);
    }

    public function test_admin_can_access_settings(): void
    {
        $response = $this->actingAs($this->admin)->get('/admin/settings');
        $response->assertStatus(200);

        $response = $this->actingAs($this->admin)->put('/admin/settings', [
            'clinic_name' => 'Klinik Ortotik & Prostetik Indonesia Update',
            'hotline_whatsapp' => '081234567890',
        ]);
        $response->assertRedirect('/admin/settings');
        $this->assertDatabaseHas('site_settings', [
            'key' => 'clinic_name',
            'value' => 'Klinik Ortotik & Prostetik Indonesia Update',
        ]);
    }
}
