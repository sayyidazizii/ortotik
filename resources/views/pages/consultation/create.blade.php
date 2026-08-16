@extends('layouts.app')

@section('title', 'Formulir Jadwal Konsultasi Medis - Klinik Ortotik')
@section('meta_description', 'Jadwalkan konsultasi evaluasi awal keluhan kaki palsu, skoliosis, flatfoot, atau kelainan gerak tubuh bersama klinisi spesialis.')

@section('content')

<!-- Header Banner -->
<div class="bg-hero-soft py-12 lg:py-16 border-b border-sky-100">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center space-y-3">
        <span class="text-medical-600 font-extrabold text-xs uppercase tracking-widest block">PENDAFTARAN JANJI TEMU</span>
        <h1 class="text-3xl sm:text-4xl font-black text-slate-900 tracking-tight">Formulir Konsultasi Pasien</h1>
        <p class="text-slate-600 text-sm max-w-xl mx-auto leading-relaxed">
            Isi formulir singkat di bawah ini. Tim klinisi kami akan mengonfirmasi jadwal janji temu dan mengirimkan rincian konsultasi ke WhatsApp Anda.
        </p>
    </div>
</div>

<div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="bg-white rounded-3xl p-8 sm:p-12 border border-slate-200/80 shadow-card space-y-8">
        
        @if ($errors->any())
        <div class="p-4 rounded-2xl bg-red-50 border border-red-200 text-red-700 text-xs space-y-1">
            <strong>Mohon lengkapi atau perbaiki data berikut:</strong>
            <ul class="list-disc list-inside">
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
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">Nama Lengkap Pasien / Wali <span class="text-red-500">*</span></label>
                <input type="text" name="full_name" value="{{ old('full_name') }}" required placeholder="Contoh: Budi Setiawan"
                    class="w-full px-4 py-3.5 rounded-xl border border-slate-200 text-xs focus:outline-none focus:ring-2 focus:ring-medical-500">
            </div>

            <!-- Phone Number & Email -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">No. WhatsApp / HP <span class="text-red-500">*</span></label>
                    <input type="tel" name="phone_number" value="{{ old('phone_number') }}" required placeholder="Contoh: 081234567890"
                        class="w-full px-4 py-3.5 rounded-xl border border-slate-200 text-xs focus:outline-none focus:ring-2 focus:ring-medical-500">
                </div>
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">Email (Opsional)</label>
                    <input type="email" name="email" value="{{ old('email') }}" placeholder="budi@example.com"
                        class="w-full px-4 py-3.5 rounded-xl border border-slate-200 text-xs focus:outline-none focus:ring-2 focus:ring-medical-500">
                </div>
            </div>

            <!-- Complaint Type & Branch -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">Jenis Keluhan / Kebutuhan <span class="text-red-500">*</span></label>
                    <select name="complaint_type" required class="w-full px-4 py-3.5 rounded-xl border border-slate-200 text-xs font-semibold focus:outline-none focus:ring-2 focus:ring-medical-500">
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
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">Pilihan Cabang Klinik</label>
                    <select name="branch_id" class="w-full px-4 py-3.5 rounded-xl border border-slate-200 text-xs font-semibold focus:outline-none focus:ring-2 focus:ring-medical-500">
                        <option value="">-- Pilih Cabang Terdekat --</option>
                        @foreach($branches as $b)
                        <option value="{{ $b->id }}" {{ (old('branch_id') == $b->id || request('branch_id') == $b->id) ? 'selected' : '' }}>{{ $b->name }} ({{ $b->city }})</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <!-- Preferred Date -->
            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">Rencana Tanggal Kunjungan</label>
                <input type="date" name="preferred_date" value="{{ old('preferred_date', date('Y-m-d', strtotime('+1 day'))) }}"
                    class="w-full px-4 py-3.5 rounded-xl border border-slate-200 text-xs focus:outline-none focus:ring-2 focus:ring-medical-500">
            </div>

            <!-- Notes -->
            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">Catatan Tambahan / Riwayat Medis</label>
                <textarea name="notes" rows="3" placeholder="Ceritakan riwayat amputasi, hasil rontgen, atau usia pasien..."
                    class="w-full px-4 py-3.5 rounded-xl border border-slate-200 text-xs focus:outline-none focus:ring-2 focus:ring-medical-500">{{ old('notes') }}</textarea>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="w-full py-4 rounded-xl bg-medical-600 hover:bg-medical-700 text-white font-extrabold text-xs uppercase tracking-wider shadow-md hover:shadow-lg transition transform hover:-translate-y-0.5 flex items-center justify-center gap-2">
                <i data-lucide="send" class="w-4 h-4"></i>
                <span>Kirim Formulir & Buka WhatsApp</span>
            </button>
        </form>

    </div>
</div>

@endsection
