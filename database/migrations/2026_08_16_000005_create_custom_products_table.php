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
        Schema::create('custom_products', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            $table->string('slug', 255)->unique();
            $table->string('category_type', 100); // prosthetic_leg, prosthetic_arm, scoliosis_brace, insole, orthopedic_shoes
            $table->string('thumbnail')->nullable();
            $table->text('summary')->nullable();
            $table->longText('description');
            $table->json('indications')->nullable();
            $table->json('features')->nullable();
            $table->json('workflow_steps')->nullable();
            $table->boolean('is_active')->default(true);
            $table->string('meta_title')->nullable();
            $table->string('meta_description', 255)->nullable();
            $table->timestamps();

            $table->index(['category_type', 'is_active']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('custom_products');
    }
};
