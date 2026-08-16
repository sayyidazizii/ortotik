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
        Schema::create('consultation_leads', function (Blueprint $table) {
            $table->id();
            $table->foreignId('branch_id')->nullable()->constrained('branches')->nullOnDelete();
            $table->foreignId('medical_service_id')->nullable()->constrained('medical_services')->nullOnDelete();
            $table->string('full_name', 150);
            $table->string('phone_number', 50);
            $table->string('email', 150)->nullable();
            $table->string('complaint_type', 150);
            $table->date('preferred_date')->nullable();
            $table->text('notes')->nullable();
            $table->string('attachment_path')->nullable();
            $table->enum('status', ['new', 'contacted', 'scheduled', 'completed', 'cancelled'])->default('new');
            $table->string('ip_address', 45)->nullable();
            $table->timestamps();

            $table->index(['status', 'created_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('consultation_leads');
    }
};
