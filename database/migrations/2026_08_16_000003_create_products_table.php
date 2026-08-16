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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('medical_service_id')->nullable()->constrained('medical_services')->nullOnDelete();
            $table->foreignId('category_id')->nullable()->constrained('categories')->nullOnDelete();
            $table->string('name', 255);
            $table->string('slug', 255)->unique();
            $table->string('sku', 100)->nullable();
            $table->decimal('price', 15, 2)->default(0.00);
            $table->decimal('discount_price', 15, 2)->nullable();
            $table->enum('stock_status', ['in_stock', 'pre_order', 'out_of_stock'])->default('in_stock');
            $table->string('thumbnail')->nullable();
            $table->text('excerpt')->nullable();
            $table->longText('description');
            $table->text('medical_indications')->nullable();
            $table->json('specifications')->nullable();
            $table->text('size_chart')->nullable();
            $table->json('images')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_active')->default(true);
            $table->string('meta_title')->nullable();
            $table->string('meta_description', 255)->nullable();
            $table->timestamps();

            $table->index(['is_active', 'is_featured']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
