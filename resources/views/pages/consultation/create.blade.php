@extends('layouts.app')

@section('title', 'Formulir Konsultasi Pasien - Precision Orthotics & Prosthetics')
@section('meta_description', 'Jadwalkan konsultasi evaluasi awal keluhan kaki palsu, skoliosis, flatfoot, atau kelainan gerak tubuh bersama klinisi spesialis.')

@section('content')

<!-- Header Banner with Editorial Typography -->
<div class="bg-canvas border-b border-hairline-soft py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-[1440px] mx-auto text-center space-y-2">
        <span class="text-xs text-mute font-semibold uppercase tracking-widest block">Appointment Booking</span>
        <h1 class="text-3xl sm:text-5xl font-medium tracking-tight text-ink uppercase font-sans">
            Formulir Konsultasi Pasien
        </h1>
        <p class="text-mute text-sm max-w-xl mx-auto leading-relaxed">
            Isi formulir singkat di bawah ini. Tim klinisi kami akan mengonfirmasi jadwal janji temu dan mengirimkan rincian konsultasi ke WhatsApp Anda.
        </p>
    </div>
</div>

<div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="bg-canvas border border-hairline-soft p-8 sm:p-12 space-y-8">
        
        @if ($errors->any())
        <div class="p-4 bg-soft-cloud border-l-4 border-sale text-ink text-xs space-y-1">
            <strong class="text-sale">Mohon lengkapi atau perbaiki data berikut:</strong>
            <ul class="list-disc list-inside text-mute">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('consultation.store') }}" method="POST" class="space-y-6">
            @csrf

            <!-- Full Name -->
            <div>
                <label class="block text-xs font-semibold uppercase tracking-wider text-ink mb-2">Nama Lengkap Pasien / Wali <span class="text-sale">*</span></label>
                <input type="text" name="full_name" value="{{ old('full_name') }}" required placeholder="Contoh: Budi Setiawan"
                    class="w-full px-4 py-3 bg-soft-cloud border border-hairline-soft rounded-none text-xs text-ink placeholder-mute focus:outline-none focus:bg-canvas focus:ring-1 focus:ring-ink">
            </div>

            <!-- Phone Number & Email -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-semibold uppercase tracking-wider text-ink mb-2">No. WhatsApp / HP <span class="text-sale">*</span></label>
                    <input type="tel" name="phone_number" value="{{ old('phone_number') }}" required placeholder="Contoh: 081234567890"
                        class="w-full px-4 py-3 bg-soft-cloud border border-hairline-soft rounded-none text-xs text-ink placeholder-mute focus:outline-none focus:bg-canvas focus:ring-1 focus:ring-ink">
                </div>
                <div>
                    <label class="block text-xs font-semibold uppercase tracking-wider text-ink mb-2">Email (Opsional)</label>
                    <input type="email" name="email" value="{{ old('email') }}" placeholder="budi@example.com"
                        class="w-full px-4 py-3 bg-soft-cloud border border-hairline-soft rounded-none text-xs text-ink placeholder-mute focus:outline-none focus:bg-canvas focus:ring-1 focus:ring-ink">
                </div>
            </div>

            <!-- Complaint Type & Branch -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-semibold uppercase tracking-wider text-ink mb-2">Jenis Keluhan / Kebutuhan <span class="text-sale">*</span></label>
                    <select name="complaint_type" required class="w-full px-4 py-3 bg-soft-cloud border border-hairline-soft rounded-none text-xs text-ink font-medium focus:outline-none focus:bg-canvas focus:ring-1 focus:ring-ink">
                        <option value="">-- Pilih Jenis Keluhan --</option>
                        <option value="Kaki Palsu Bawah Lutut">Kaki Palsu Bawah Lutut</option>
                        <option value="Kaki Palsu Atas Lutut">Kaki Palsu Atas Lutut</option>
                        <option value="Tangan Palsu (Prostesis Tangan)">Tangan Palsu</option>
                        <option value="Koreksi Kaki O / X (Anak/Dewasa)">Koreksi Kaki O / Kaki X</option>
                        <option value="Korset Skoliosis 3D (Non-Operasi)">Korset Skoliosis 3D</option>
                        <option value="Custom Insole Medis (Flatfoot / Nyeri Tumit)">Custom Insole Medis (Flatfoot)</option>
                        <option value="Drop Foot AFO / Stroke">Drop Foot (AFO) / Pasca Stroke</option>
                        <option value="Cedera Ligamen Lutut (ACL/PCL/OA)">Cedera Lutut (ACL / OA)</option>
                        <option value="Konsultasi Lainnya">Keluhan Lainnya</option>
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-semibold uppercase tracking-wider text-ink mb-2">Pilihan Cabang Klinik</label>
                    <select name="branch_id" class="w-full px-4 py-3 bg-soft-cloud border border-hairline-soft rounded-none text-xs text-ink font-medium focus:outline-none focus:bg-canvas focus:ring-1 focus:ring-ink">
                        <option value="">-- Pilih Cabang Terdekat --</option>
                        @foreach($branches as $b)
                        <option value="{{ $b->id }}" {{ (old('branch_id') == $b->id || request('branch_id') == $b->id) ? 'selected' : '' }}>{{ $b->name }} ({{ $b->city }})</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <!-- Preferred Date -->
            <div>
                <label class="block text-xs font-semibold uppercase tracking-wider text-ink mb-2">Rencana Tanggal Kunjungan</label>
                <input type="date" name="preferred_date" value="{{ old('preferred_date', date('Y-m-d', strtotime('+1 day'))) }}"
                    class="w-full px-4 py-3 bg-soft-cloud border border-hairline-soft rounded-none text-xs text-ink focus:outline-none focus:bg-canvas focus:ring-1 focus:ring-ink">
            </div>

            <!-- Notes -->
            <div>
                <label class="block text-xs font-semibold uppercase tracking-wider text-ink mb-2">Catatan Tambahan / Riwayat Medis</label>
                <textarea name="notes" rows="3" placeholder="Ceritakan riwayat amputasi, hasil rontgen, atau usia pasien..."
                    class="w-full px-4 py-3 bg-soft-cloud border border-hairline-soft rounded-none text-xs text-ink placeholder-mute focus:outline-none focus:bg-canvas focus:ring-1 focus:ring-ink">{{ old('notes') }}</textarea>
            </div>

            <!-- Submit Button ({component.button-primary}: black pill) -->
            <button type="submit" class="w-full h-12 bg-ink hover:bg-charcoal text-canvas font-medium text-sm rounded-full btn-pill-tap transition flex items-center justify-center gap-2">
                <i data-lucide="send" class="w-4 h-4"></i>
                <span>Kirim Formulir & Lanjut ke WhatsApp</span>
            </button>
        </form>

    </div>
</div>

@endsection
