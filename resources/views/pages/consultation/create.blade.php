@extends('layouts.app')

@section('title', 'Formulir Konsultasi Pasien - pediOcare')
@section('meta_description', 'Jadwalkan konsultasi evaluasi awal keluhan kaki palsu, skoliosis, flatfoot, atau kelainan gerak tubuh bersama praktisi spesialis pediOcare.')

@section('content')

<!-- Header Banner -->
<div class="bg-surface-container-low border-b border-outline-variant/30 py-16 px-4 sm:px-6 lg:px-8 text-center">
    <div class="max-w-container-max mx-auto space-y-3">
        <span class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full bg-primary/10 text-primary text-xs font-semibold uppercase tracking-wider">
            <span class="w-2 h-2 rounded-full bg-primary"></span>
            Smart Appointment Booking
        </span>
        <h1 class="text-3xl sm:text-4xl font-headline-xl font-bold tracking-tight text-on-background leading-tight">
            Formulir Janji Temu Konsultasi Pasien
        </h1>
        <p class="text-on-surface-variant text-base sm:text-lg max-w-xl mx-auto leading-relaxed">
            Isi formulir singkat di bawah ini. Tim klinisi kami akan mengonfirmasi jadwal janji temu dan mengirimkan rincian konsultasi ke WhatsApp Anda.
        </p>
    </div>
</div>

<div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
    <div class="bg-surface-white rounded-3xl border border-outline-variant/30 p-8 sm:p-12 space-y-8 shadow-2 relative overflow-hidden">
        <div class="absolute top-0 left-0 w-full h-1.5 bg-primary"></div>
        
        @if ($errors->any())
        <div class="p-4 bg-red-50 border-l-4 border-error text-on-surface text-xs space-y-1 rounded-xl">
            <strong class="text-error block font-bold">Mohon lengkapi atau perbaiki data berikut:</strong>
            <ul class="list-disc list-inside text-red-700">
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
                <label class="block text-xs font-semibold uppercase tracking-wider text-on-surface mb-2">Nama Lengkap Pasien / Wali *</label>
                <input type="text" name="full_name" value="{{ old('full_name') }}" required placeholder="Contoh: Budi Setiawan"
                    class="w-full px-4 py-3.5 bg-surface-white border border-outline-variant/60 rounded-xl text-sm text-on-surface placeholder:text-outline focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition">
            </div>

            <!-- Phone Number & Email -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div>
                    <label class="block text-xs font-semibold uppercase tracking-wider text-on-surface mb-2">No. WhatsApp / HP *</label>
                    <input type="tel" name="phone_number" value="{{ old('phone_number') }}" required placeholder="Contoh: 081234567890"
                        class="w-full px-4 py-3.5 bg-surface-white border border-outline-variant/60 rounded-xl text-sm text-on-surface placeholder:text-outline focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition">
                </div>
                <div>
                    <label class="block text-xs font-semibold uppercase tracking-wider text-on-surface mb-2">Email (Opsional)</label>
                    <input type="email" name="email" value="{{ old('email') }}" placeholder="budi@example.com"
                        class="w-full px-4 py-3.5 bg-surface-white border border-outline-variant/60 rounded-xl text-sm text-on-surface placeholder:text-outline focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition">
                </div>
            </div>

            <!-- Complaint Type & Branch -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div>
                    <label class="block text-xs font-semibold uppercase tracking-wider text-on-surface mb-2">Jenis Keluhan / Kebutuhan *</label>
                    <select name="complaint_type" required class="w-full px-4 py-3.5 bg-surface-white border border-outline-variant/60 rounded-xl text-sm text-on-surface font-medium focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition">
                        <option value="">-- Pilih Jenis Keluhan --</option>
                        <option value="Prostetik" {{ old('complaint_type') == 'Prostetik' ? 'selected' : '' }}>Kaki / Tangan Palsu (Prostetik)</option>
                        <option value="Ortotik" {{ old('complaint_type') == 'Ortotik' ? 'selected' : '' }}>Brace / Penyangga Ortopedi</option>
                        <option value="Scoliosis" {{ old('complaint_type') == 'Scoliosis' ? 'selected' : '' }}>Pusat Koreksi Skoliosis 3D</option>
                        <option value="Insole" {{ old('complaint_type') == 'Insole' ? 'selected' : '' }}>Custom Insole Medis (Flatfoot)</option>
                        <option value="Fisioterapi" {{ old('complaint_type') == 'Fisioterapi' ? 'selected' : '' }}>Fisioterapi & Gait Training</option>
                        <option value="Konsultasi" {{ old('complaint_type') == 'Konsultasi' ? 'selected' : '' }}>Konsultasi & Pemeriksaan Medis</option>
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-semibold uppercase tracking-wider text-on-surface mb-2">Pilihan Cabang Klinik</label>
                    <select name="branch_id" class="w-full px-4 py-3.5 bg-surface-white border border-outline-variant/60 rounded-xl text-sm text-on-surface font-medium focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition">
                        <option value="">-- Pilih Cabang Terdekat --</option>
                        @foreach($branches as $b)
                        <option value="{{ $b->id }}" {{ (old('branch_id') == $b->id || request('branch_id') == $b->id) ? 'selected' : '' }}>{{ $b->name }} ({{ $b->city }})</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <!-- Preferred Date -->
            <div>
                <label class="block text-xs font-semibold uppercase tracking-wider text-on-surface mb-2">Rencana Tanggal Kunjungan</label>
                <input type="date" name="preferred_date" value="{{ old('preferred_date', date('Y-m-d', strtotime('+1 day'))) }}"
                    class="w-full px-4 py-3.5 bg-surface-white border border-outline-variant/60 rounded-xl text-sm text-on-surface focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition">
            </div>

            <!-- Notes -->
            <div>
                <label class="block text-xs font-semibold uppercase tracking-wider text-on-surface mb-2">Catatan Tambahan / Riwayat Medis</label>
                <textarea name="notes" rows="3" placeholder="Ceritakan riwayat amputasi, hasil rontgen, atau usia pasien..."
                    class="w-full px-4 py-3.5 bg-surface-white border border-outline-variant/60 rounded-xl text-sm text-on-surface placeholder:text-outline focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition">{{ old('notes') }}</textarea>
            </div>

            <!-- Submit Button (Amber CTA) -->
            <button type="submit" class="w-full h-14 bg-[#E5A500] hover:bg-[#CC9200] text-surface-white font-semibold text-base rounded-xl transition flex items-center justify-center gap-2.5 shadow-lg hover:shadow-xl cursor-pointer">
                <span class="material-symbols-outlined text-xl">send</span>
                <span>Kirim Formulir & Lanjut ke WhatsApp</span>
            </button>
        </form>

    </div>
</div>

@endsection
