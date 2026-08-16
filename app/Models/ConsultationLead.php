<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ConsultationLead extends Model
{
    use HasFactory;

    protected $fillable = [
        'branch_id',
        'medical_service_id',
        'full_name',
        'phone_number',
        'email',
        'complaint_type',
        'preferred_date',
        'notes',
        'attachment_path',
        'status',
        'ip_address',
    ];

    protected $casts = [
        'preferred_date' => 'date',
    ];

    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class);
    }

    public function medicalService(): BelongsTo
    {
        return $this->belongsTo(MedicalService::class);
    }
}
