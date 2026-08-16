<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreConsultationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'full_name' => ['required', 'string', 'max:150'],
            'phone_number' => ['required', 'string', 'max:30'],
            'email' => ['nullable', 'email', 'max:150'],
            'complaint_type' => ['required', 'string', 'max:150'],
            'preferred_date' => ['nullable', 'date', 'after_or_equal:today'],
            'branch_id' => ['nullable', 'exists:branches,id'],
            'medical_service_id' => ['nullable', 'exists:medical_services,id'],
            'notes' => ['nullable', 'string', 'max:1000'],
        ];
    }

    /**
     * Custom messages for validation errors.
     */
    public function messages(): array
    {
        return [
            'full_name.required' => 'Nama lengkap wajib diisi.',
            'phone_number.required' => 'Nomor WhatsApp/Telepon wajib diisi.',
            'complaint_type.required' => 'Jenis keluhan wajib dipilih.',
            'preferred_date.after_or_equal' => 'Tanggal rencana konsultasi tidak boleh di masa lalu.',
        ];
    }
}
