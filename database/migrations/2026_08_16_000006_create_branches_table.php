<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('branches', function (Blueprint $table) {
            $table->id();
            $table->string('name', 150);
            $table->string('city', 100);
            $table->text('address');
            $table->string('phone_number', 50);
            $table->string('whatsapp_number', 50);
            $table->string('email', 150)->nullable();
            $table->text('google_maps_url')->nullable();
            $table->text('google_maps_embed')->nullable();
            $table->string('opening_hours', 150)->default('Senin - Sabtu: 08:30 - 17:00 WIB');
            $table->string('image')->nullable();
            $table->boolean('is_main_branch')->default(false);
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->index('is_active');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('branches');
    }
};
