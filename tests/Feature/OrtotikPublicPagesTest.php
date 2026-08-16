<?php

namespace Tests\Feature;

use Tests\TestCase;

class OrtotikPublicPagesTest extends TestCase
{
    public function test_homepage_loads_successfully(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSee('ORTOTIK');
        $response->assertSee('5 Pilar Layanan Medis Kami');
    }

    public function test_products_catalog_loads_successfully(): void
    {
        $response = $this->get('/products');
        $response->assertStatus(200);
        $response->assertSee('E-Katalog Produk Medis');
    }

    public function test_product_detail_page_loads_successfully(): void
    {
        $response = $this->get('/products/donjoy-armor-knee-brace');
        $response->assertStatus(200);
        $response->assertSee('DonJoy Armor');
        $response->assertSee('WhatsApp');
    }

    public function test_services_page_loads_successfully(): void
    {
        $response = $this->get('/services');
        $response->assertStatus(200);
        $response->assertSee('5 Pilar Layanan Medis Kami');
    }

    public function test_custom_products_page_loads_successfully(): void
    {
        $response = $this->get('/custom-products');
        $response->assertStatus(200);
        $response->assertSee('Custom-Made');
    }

    public function test_articles_page_loads_successfully(): void
    {
        $response = $this->get('/articles');
        $response->assertStatus(200);
        $response->assertSee('Artikel');
    }

    public function test_consultation_form_loads_and_submits_successfully(): void
    {
        $response = $this->get('/consultation');
        $response->assertStatus(200);
        $response->assertSee('Formulir Konsultasi Pasien');

        $postResponse = $this->post('/consultation', [
            'full_name' => 'Ahmad Rizki',
            'phone_number' => '081298765432',
            'email' => 'ahmad@example.com',
            'complaint_type' => 'Kaki Palsu Bawah Lutut',
            'notes' => 'Ingin konsultasi pembuatan kaki palsu carbon',
        ]);

        $postResponse->assertRedirect();
        $this->assertDatabaseHas('consultation_leads', [
            'full_name' => 'Ahmad Rizki',
            'complaint_type' => 'Kaki Palsu Bawah Lutut',
        ]);
    }

    public function test_contact_page_loads_successfully(): void
    {
        $response = $this->get('/contact');
        $response->assertStatus(200);
        $response->assertSee('Kunjungi Klinik Kami');
    }
}
