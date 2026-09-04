<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_the_application_returns_a_successful_response(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);

        $responseServices = $this->get('/services');
        $responseServices->assertStatus(200);
        $responseServices->assertSee('Layanan Orthosis Prosthesis');
        $responseServices->assertSee('& Alat Bantu Ortopedi');

        $responseCustom = $this->get('/custom-products');
        $responseCustom->assertStatus(200);
        $responseCustom->assertSee('Casting gips secara presisi');
    }
}
