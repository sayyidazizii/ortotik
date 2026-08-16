@extends('layouts.app')

@section('title', 'Formulir Jadwal Konsultasi Medis - Klinik Ortotik')

@section('content')
<div class="bg-medical-700 text-white py-14">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center space-y-3">
        <span class="text-tealmed-400 font-bold text-xs uppercase tracking-widest block">JANJI TEMU KLINIK</span>
        <h1 class="text-3xl sm:text-5xl font-black tracking-tight">Formulir Konsultasi Pasien</h1>
        <p class="text-slate-200 text-sm max-w-xl mx-auto">Isi formulir singkat di bawah ini. Tim kami akan segera mengonfirmasi jadwal janji temu Anda dan meneruskan ke WhatsApp resmi.</p>
    </div>
</div>

<div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="bg-white rounded-3xl p-8 sm:p-12 border border-slate-200 shadow-xl space-y-8">
        @if ($errors->any())
        <div class="p-4 rounded-2xl bg-red-50 border border-red-200 text-red-700 text-xs space-y-1">
            <strong>Mohon perbaiki data berikut:</strong>
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
                <input type="text" name="full_name" value="{{ old('full_name') }}" required placeholder="Contoh: Budi Setiawan" class="w-full px-4 py-3.5 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-medical-700">
            </div>

            <!-- Phone Number & Email -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">No. WhatsApp / HP <span class="text-red-500">*</span></label>
                    <input type="tel" name="phone_number" value="{{ old('phone_number') }}" required placeholder="Contoh: 081234567890" class="w-full px-4 py-3.5 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-medical-700">
                </div>
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">Email (Opsional)</label>
                    <input type="email" name="email" value="{{ old('email') }}" placeholder="budi@example.com" class="w-full px-4 py-3.5 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-medical-700">
                </div>
            </div>

            <!-- Complaint Type & Service -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">Jenis Keluhan / Kebutuhan <span class="text-red-500">*</span></label>
                    <select name="complaint_type" required class="w-full px-4 py-3.5 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-medical-700">
                        <option value="">-- Pilih Jenis Keluhan --</option>
                        <option value="Kaki Palsu Bawah Lutut">Kaki Palsu Bawah Lutut</option>
                        <option value="Kaki Palsu Atas Lutut">Kaki Palsu Atas Lutut</option>
                        <option value="Tangan Palsu (Prostesis Tangan)">Tangan Palsu</option>
                        <option value="Koreksi Kaki O / X (Anak/Dewasa)">Koreksi Kaki O / Kaki X</option>
                        <option value="Korset Skoliosis 3D (Non-Operasi)">Korset Skoliosis 3D</option>
                        <option value="Custom Insole Medis (Flatfoot / Nyeri Tumit)">Custom Insole Medis</option>
                        <option value="Drop Foot AFO / Stroke">Drop Foot (AFO) / Pasca Stroke</option>
                        <option value="Cedera Ligamen Lutut (ACL/PCL/OA)">Cedera Lutut (ACL / OA)</option>
                        <option value="Konsultasi Lainnya">Keluhan Lainnya</option>
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">Pilihan Cabang Klinik</label>
                    <select name="branch_id" class="w-full px-4 py-3.5 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-medical-700">
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
                <input type="date" name="preferred_date" value="{{ old('preferred_date', date('Y-m-d', strtotime('+1 day'))) }}" class="w-full px-4 py-3.5 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-medical-700">
            </div>

            <!-- Notes -->
            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">Catatan Tambahan / Riwayat Medis Singkat</label>
                <textarea name="notes" rows="3" placeholder="Ceritakan riwayat amputasi, hasil rontgen, atau usia pasien..." class="w-full px-4 py-3.5 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-medical-700">{{ old('notes') }}</textarea>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="w-full py-4 rounded-2xl bg-gradient-to-r from-medical-700 to-tealmed-600 hover:from-medical-800 hover:to-tealmed-700 text-white font-extrabold text-base shadow-xl transition transform hover:-translate-y-0.5 flex items-center justify-center gap-2">
                <i data-lucide="send" class="w-5 h-5"></i>
                <span>Kirim Formulir & Lanjut ke WhatsApp</span>
            </button>
        </form>
    </div>
</div>
@endsection
