@extends('admin.layouts.app')

@section('title', 'Detail Konsultasi Pasien - ' . $lead->full_name)
@section('header_title', 'Detail Leads Konsultasi Pasien')

@section('content')
<div class="max-w-5xl space-y-6">

    <!-- Top Navigation Back -->
    <div class="flex items-center justify-between">
        <a href="{{ route('admin.leads.index') }}" class="text-xs font-bold text-slate-500 hover:text-medical-600 inline-flex items-center gap-1.5 transition">
            <i data-lucide="arrow-left" class="w-4 h-4"></i>
            <span>Kembali ke Daftar Leads</span>
        </a>

        <div class="flex items-center gap-2">
            <a href="{{ $waReplyUrl }}" target="_blank"
                class="px-4 py-2 bg-[#25D366] hover:bg-[#20ba5a] text-white font-bold text-xs rounded-xl shadow-sm inline-flex items-center gap-2 transition">
                <i data-lucide="message-circle" class="w-4 h-4"></i>
                <span>Hubungi via WhatsApp Resmi</span>
            </a>
        </div>
    </div>

    <!-- Main Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        
        <!-- Left: Patient Profile & Clinical Details (2 Cols) -->
        <div class="lg:col-span-2 space-y-6">
            
            <!-- Patient Profile Card -->
            <div class="bg-white rounded-2xl border border-slate-200 p-6 shadow-sm space-y-6">
                <div class="flex items-start justify-between border-b border-slate-100 pb-5">
                    <div class="flex items-center gap-4">
                        <div class="w-14 h-14 rounded-2xl bg-gradient-to-tr from-medical-500 to-tealmed-500 flex items-center justify-center text-white font-extrabold text-xl shadow">
                            {{ strtoupper(substr($lead->full_name, 0, 2)) }}
                        </div>
                        <div>
                            <h2 class="text-xl font-black text-slate-900 leading-tight">{{ $lead->full_name }}</h2>
                            <p class="text-xs text-slate-400 mt-0.5">Leads masuk: {{ $lead->created_at->format('d F Y, H:i') }} WIB</p>
                        </div>
                    </div>

                    <div>
                        @if($lead->status === 'new')
                            <span class="px-3 py-1 rounded-full bg-rose-50 text-rose-700 font-extrabold text-xs uppercase border border-rose-200">● Baru Masuk</span>
                        @elseif($lead->status === 'contacted')
                            <span class="px-3 py-1 rounded-full bg-amber-50 text-amber-700 font-extrabold text-xs uppercase border border-amber-200">● Sedang Dihubungi</span>
                        @elseif($lead->status === 'scheduled')
                            <span class="px-3 py-1 rounded-full bg-sky-50 text-sky-700 font-extrabold text-xs uppercase border border-sky-200">● Dijadwalkan</span>
                        @elseif($lead->status === 'completed')
                            <span class="px-3 py-1 rounded-full bg-emerald-50 text-emerald-700 font-extrabold text-xs uppercase border border-emerald-200">● Selesai</span>
                        @else
                            <span class="px-3 py-1 rounded-full bg-slate-100 text-slate-600 font-extrabold text-xs uppercase">{{ $lead->status }}</span>
                        @endif
                    </div>
                </div>

                <!-- Info Attributes Grid -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-xs">
                    <div class="p-4 rounded-xl bg-slate-50 border border-slate-100 space-y-1">
                        <span class="font-bold text-slate-400 uppercase text-[10px] tracking-wider">No. Telepon / WhatsApp</span>
                        <p class="text-sm font-extrabold text-slate-800 font-mono">{{ $lead->phone_number }}</p>
                    </div>

                    <div class="p-4 rounded-xl bg-slate-50 border border-slate-100 space-y-1">
                        <span class="font-bold text-slate-400 uppercase text-[10px] tracking-wider">Email Pasien</span>
                        <p class="text-sm font-semibold text-slate-800">{{ $lead->email ?? 'Tidak dicantumkan' }}</p>
                    </div>

                    <div class="p-4 rounded-xl bg-slate-50 border border-slate-100 space-y-1">
                        <span class="font-bold text-slate-400 uppercase text-[10px] tracking-wider">Pilihan Cabang Klinik</span>
                        <p class="text-sm font-extrabold text-slate-800">{{ $lead->branch->name ?? 'Cabang Pusat' }}</p>
                    </div>

                    <div class="p-4 rounded-xl bg-slate-50 border border-slate-100 space-y-1">
                        <span class="font-bold text-slate-400 uppercase text-[10px] tracking-wider">Rencana Kunjungan</span>
                        <p class="text-sm font-extrabold text-slate-800">{{ $lead->preferred_date ? $lead->preferred_date->format('l, d F Y') : 'Waktu Fleksibel' }}</p>
                    </div>
                </div>

                <!-- Complaint Details -->
                <div class="space-y-2 pt-2">
                    <span class="font-bold text-slate-400 uppercase text-[10px] tracking-wider">Jenis Keluhan / Kebutuhan Medis</span>
                    <div class="p-4 rounded-xl bg-medical-50/60 border border-medical-100">
                        <h4 class="font-extrabold text-sm text-medical-900">{{ $lead->complaint_type }}</h4>
                    </div>
                </div>

                <!-- Notes from Patient -->
                <div class="space-y-2">
                    <span class="font-bold text-slate-400 uppercase text-[10px] tracking-wider">Catatan Pasien / Riwayat Medis</span>
                    <div class="p-4 rounded-xl bg-slate-50 border border-slate-200 text-xs text-slate-700 leading-relaxed min-h-[80px]">
                        @if($lead->notes)
                            {{ $lead->notes }}
                        @else
                            <span class="text-slate-400 italic">Tidak ada catatan tambahan yang diberikan oleh pasien.</span>
                        @endif
                    </div>
                </div>
            </div>

            <!-- WhatsApp Template Preview Card -->
            <div class="bg-white rounded-2xl border border-slate-200 p-6 shadow-sm space-y-3">
                <h3 class="font-extrabold text-sm text-slate-900 flex items-center gap-2">
                    <i data-lucide="message-square" class="w-4 h-4 text-[#25D366]"></i>
                    <span>Pesan Template WhatsApp Resmi</span>
                </h3>
                <p class="text-xs text-slate-500">Template pesan otomatis yang akan terbuka saat menekan tombol Chat WhatsApp:</p>
                
                <div class="p-4 rounded-xl bg-slate-900 text-emerald-300 font-mono text-xs whitespace-pre-wrap leading-relaxed border border-slate-800">Halo Bpk/Ibu *{{ $lead->full_name }}*,

Kami dari Tim Medis *Klinik Ortotik & Prostetik Indonesia* menindaklanjuti permintaan konsultasi Anda melalui website resmi.

📋 *Ringkasan Permintaan:*
• Keluhan: {{ $lead->complaint_type }}
@if($lead->preferred_date)• Rencana Tanggal: {{ $lead->preferred_date->format('d F Y') }}@endif
@if($lead->branch)• Pilihan Cabang: {{ $lead->branch->name }}@endif

Apakah ada waktu yang nyaman untuk kami bantu jadwalkan pemeriksaan langsung dengan spesialis kami?

Salam sehat,
Tim Medis Klinik Ortotik & Prostetik</div>
            </div>
        </div>

        <!-- Right: Status Follow-Up & Action Card (1 Col) -->
        <div class="space-y-6">
            
            <!-- Update Status Card -->
            <div class="bg-white rounded-2xl border border-slate-200 p-6 shadow-sm space-y-5">
                <h3 class="font-extrabold text-sm text-slate-900">Perbarui Status Follow-up</h3>

                <form action="{{ route('admin.leads.status', $lead->id) }}" method="POST" class="space-y-4">
                    @csrf
                    @method('PATCH')

                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Status Konsultasi</label>
                        <select name="status" class="w-full px-3 py-2.5 rounded-xl border border-slate-200 text-xs font-bold focus:outline-none focus:ring-2 focus:ring-medical-500">
                            <option value="new" {{ $lead->status === 'new' ? 'selected' : '' }}>● BARU MASUK</option>
                            <option value="contacted" {{ $lead->status === 'contacted' ? 'selected' : '' }}>● SEDANG DIHUBUNGI</option>
                            <option value="scheduled" {{ $lead->status === 'scheduled' ? 'selected' : '' }}>● DIJADWALKAN KE KLINIK</option>
                            <option value="completed" {{ $lead->status === 'completed' ? 'selected' : '' }}>● SELESAI / FITTING</option>
                            <option value="cancelled" {{ $lead->status === 'cancelled' ? 'selected' : '' }}>● DIBATALKAN</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Catatan Internal / Follow-up</label>
                        <textarea name="notes" rows="4" placeholder="Contoh: Pasien dikonfirmasi datang tgl 20 Ags jam 10 pagi untuk casting korset..."
                            class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-xs focus:outline-none focus:ring-2 focus:ring-medical-500">{{ old('notes', $lead->notes) }}</textarea>
                    </div>

                    <button type="submit"
                        class="w-full py-2.5 px-4 rounded-xl bg-medical-600 hover:bg-medical-700 text-white font-bold text-xs shadow-sm transition">
                        Simpan Perubahan
                    </button>
                </form>
            </div>

            <!-- Delete Lead Card -->
            <div class="bg-rose-50/60 rounded-2xl border border-rose-200 p-6 space-y-3">
                <h4 class="font-extrabold text-xs text-rose-800 uppercase tracking-wider">Hapus Data Leads</h4>
                <p class="text-xs text-rose-600 leading-relaxed">Tindakan ini akan menghapus data riwayat konsultasi pasien ini dari database secara permanen.</p>
                
                <form action="{{ route('admin.leads.destroy', $lead->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data konsultasi ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="w-full py-2 px-4 rounded-xl bg-white hover:bg-rose-600 text-rose-600 hover:text-white border border-rose-300 font-bold text-xs transition">
                        Hapus Data Pasien
                    </button>
                </form>
            </div>

        </div>

    </div>

</div>
@endsection
