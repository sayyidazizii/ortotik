@extends('admin.layouts.app')

@section('title', 'Dashboard Overview')
@section('header_title', 'Dashboard Overview')

@section('content')
<!-- Welcome Banner -->
<div class="bg-gradient-to-r from-medical-700 via-medical-600 to-tealmed-600 rounded-3xl p-6 sm:p-8 text-white shadow-lg relative overflow-hidden">
    <div class="relative z-10 space-y-2 max-w-2xl">
        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-white/10 backdrop-blur-md text-teal-300 text-xs font-bold border border-white/20">
            <i data-lucide="shield-check" class="w-3.5 h-3.5"></i>
            <span>Sistem Manajemen Klinik Medis</span>
        </span>
        <h2 class="text-2xl sm:text-3xl font-extrabold tracking-tight">Selamat Datang, {{ Auth::user()->name }}!</h2>
        <p class="text-xs sm:text-sm text-slate-200 leading-relaxed">
            Pantau pesan masuk konsultasi pasien baru, jadwalkan pemeriksaan ortopedi, dan kelola katalog produk medis klinik Anda.
        </p>
    </div>
</div>

<!-- 4 KPI Stat Widgets -->
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
    <!-- Card 1: New Leads -->
    <div class="bg-white rounded-2xl p-5 border border-slate-200 shadow-sm flex flex-col justify-between hover:shadow-md transition">
        <div class="flex items-center justify-between">
            <span class="text-xs font-bold uppercase tracking-wider text-slate-400">Pesan Pasien Baru</span>
            <div class="w-9 h-9 rounded-xl bg-rose-50 text-rose-600 flex items-center justify-center">
                <i data-lucide="user-plus" class="w-4 h-4"></i>
            </div>
        </div>
        <div class="mt-4">
            <span class="text-3xl font-black text-slate-900">{{ $newLeads }}</span>
            <p class="text-xs text-slate-500 mt-1">Perlu segera dihubungi via WA</p>
        </div>
        <div class="mt-3 pt-3 border-t border-slate-100 flex items-center justify-between text-xs">
            <span class="text-slate-400">Total Leads: <strong>{{ $totalLeads }}</strong></span>
            <a href="{{ route('admin.leads.index') }}?status=new" class="text-medical-600 font-bold hover:underline">Lihat &rarr;</a>
        </div>
    </div>

    <!-- Card 2: Contacted / Scheduled -->
    <div class="bg-white rounded-2xl p-5 border border-slate-200 shadow-sm flex flex-col justify-between hover:shadow-md transition">
        <div class="flex items-center justify-between">
            <span class="text-xs font-bold uppercase tracking-wider text-slate-400">Dalam Follow-Up</span>
            <div class="w-9 h-9 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center">
                <i data-lucide="calendar-clock" class="w-4 h-4"></i>
            </div>
        </div>
        <div class="mt-4">
            <span class="text-3xl font-black text-slate-900">{{ $contactedLeads + $scheduledLeads }}</span>
            <p class="text-xs text-slate-500 mt-1">{{ $scheduledLeads }} dijadwalkan ke klinik</p>
        </div>
        <div class="mt-3 pt-3 border-t border-slate-100 flex items-center justify-between text-xs">
            <span class="text-slate-400">Selesai: <strong>{{ $completedLeads }}</strong></span>
            <a href="{{ route('admin.leads.index') }}" class="text-medical-600 font-bold hover:underline">Kelola &rarr;</a>
        </div>
    </div>

    <!-- Card 3: Active Products -->
    <div class="bg-white rounded-2xl p-5 border border-slate-200 shadow-sm flex flex-col justify-between hover:shadow-md transition">
        <div class="flex items-center justify-between">
            <span class="text-xs font-bold uppercase tracking-wider text-slate-400">E-Katalog Produk</span>
            <div class="w-9 h-9 rounded-xl bg-sky-50 text-sky-600 flex items-center justify-center">
                <i data-lucide="package" class="w-4 h-4"></i>
            </div>
        </div>
        <div class="mt-4">
            <span class="text-3xl font-black text-slate-900">{{ $activeProducts }}</span>
            <p class="text-xs text-slate-500 mt-1">Dari total {{ $totalProducts }} produk terdaftar</p>
        </div>
        <div class="mt-3 pt-3 border-t border-slate-100 flex items-center justify-between text-xs">
            <span class="text-slate-400">Layanan: <strong>{{ $totalServices }} Pilar</strong></span>
            <a href="{{ route('admin.products.index') }}" class="text-medical-600 font-bold hover:underline">Katalog &rarr;</a>
        </div>
    </div>

    <!-- Card 4: Articles -->
    <div class="bg-white rounded-2xl p-5 border border-slate-200 shadow-sm flex flex-col justify-between hover:shadow-md transition">
        <div class="flex items-center justify-between">
            <span class="text-xs font-bold uppercase tracking-wider text-slate-400">Artikel Edukasi</span>
            <div class="w-9 h-9 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center">
                <i data-lucide="book-open" class="w-4 h-4"></i>
            </div>
        </div>
        <div class="mt-4">
            <span class="text-3xl font-black text-slate-900">{{ $totalArticles }}</span>
            <p class="text-xs text-slate-500 mt-1">Artikel aktif terpublikasi</p>
        </div>
        <div class="mt-3 pt-3 border-t border-slate-100 flex items-center justify-between text-xs">
            <span class="text-slate-400">Status: <strong>Live di Web</strong></span>
            <a href="{{ route('admin.articles.index') }}" class="text-medical-600 font-bold hover:underline">Tulis &rarr;</a>
        </div>
    </div>
</div>

<!-- Recent Leads Table -->
<div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
    <div class="p-5 sm:px-6 border-b border-slate-200 flex items-center justify-between">
        <div>
            <h3 class="font-extrabold text-base text-slate-900">Pesan Konsultasi Pasien Terbaru</h3>
            <p class="text-xs text-slate-400 mt-0.5">Daftar leads janji temu pasien yang masuk melalui formulir online.</p>
        </div>
        <a href="{{ route('admin.leads.index') }}" class="text-xs font-bold text-medical-600 hover:text-tealmed-600 bg-slate-50 hover:bg-slate-100 border border-slate-200 px-3.5 py-2 rounded-xl transition">
            Lihat Semua Leads ({{ $totalLeads }})
        </a>
    </div>

    @if($recentLeads->isEmpty())
    <div class="p-12 text-center text-slate-400 text-xs">
        <i data-lucide="inbox" class="w-8 h-8 mx-auto mb-2 text-slate-300"></i>
        <span>Belum ada pesan konsultasi yang masuk.</span>
    </div>
    @else
    <div class="overflow-x-auto">
        <table class="w-full text-left text-xs">
            <thead class="bg-slate-50 border-b border-slate-200 text-slate-500 font-bold uppercase tracking-wider text-[10px]">
                <tr>
                    <th class="py-3 px-6">Pasien / Kontak</th>
                    <th class="py-3 px-6">Keluhan Medis</th>
                    <th class="py-3 px-6">Cabang</th>
                    <th class="py-3 px-6">Rencana Tanggal</th>
                    <th class="py-3 px-6">Status</th>
                    <th class="py-3 px-6 text-right">Aksi Cepat</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @foreach($recentLeads as $lead)
                <tr class="hover:bg-slate-50/80 transition">
                    <td class="py-4 px-6">
                        <p class="font-bold text-slate-900">{{ $lead->full_name }}</p>
                        <p class="text-[11px] text-slate-400 font-mono">{{ $lead->phone_number }}</p>
                    </td>
                    <td class="py-4 px-6">
                        <span class="inline-block font-semibold text-slate-800">{{ $lead->complaint_type }}</span>
                        @if($lead->notes)
                        <p class="text-[11px] text-slate-400 truncate max-w-xs">{{ $lead->notes }}</p>
                        @endif
                    </td>
                    <td class="py-4 px-6 font-medium text-slate-600">
                        {{ $lead->branch->name ?? 'Pusat' }}
                    </td>
                    <td class="py-4 px-6 text-slate-500">
                        {{ $lead->preferred_date ? $lead->preferred_date->format('d M Y') : 'Fleksibel' }}
                    </td>
                    <td class="py-4 px-6">
                        @if($lead->status === 'new')
                            <span class="px-2.5 py-1 rounded-full bg-rose-50 text-rose-700 font-bold text-[10px] uppercase border border-rose-200">Baru</span>
                        @elseif($lead->status === 'contacted')
                            <span class="px-2.5 py-1 rounded-full bg-amber-50 text-amber-700 font-bold text-[10px] uppercase border border-amber-200">Dihubungi</span>
                        @elseif($lead->status === 'scheduled')
                            <span class="px-2.5 py-1 rounded-full bg-sky-50 text-sky-700 font-bold text-[10px] uppercase border border-sky-200">Dijadwalkan</span>
                        @elseif($lead->status === 'completed')
                            <span class="px-2.5 py-1 rounded-full bg-emerald-50 text-emerald-700 font-bold text-[10px] uppercase border border-emerald-200">Selesai</span>
                        @else
                            <span class="px-2.5 py-1 rounded-full bg-slate-100 text-slate-600 font-bold text-[10px] uppercase">{{ $lead->status }}</span>
                        @endif
                    </td>
                    <td class="py-4 px-6 text-right space-x-2">
                        @php
                            $cleanPhone = preg_replace('/[^0-9]/', '', $lead->phone_number);
                            if (str_starts_with($cleanPhone, '0')) {
                                $cleanPhone = '62' . substr($cleanPhone, 1);
                            }
                            $waMsg = "Halo Bpk/Ibu {$lead->full_name}, kami dari Klinik Ortotik & Prostetik menindaklanjuti permintaan konsultasi Anda untuk keluhan: {$lead->complaint_type}. Kapan waktu yang nyaman untuk pemeriksaan?";
                        @endphp
                        <a href="https://wa.me/{{ $cleanPhone }}?text={{ urlencode($waMsg) }}" target="_blank"
                            class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg bg-[#25D366] hover:bg-[#20ba5a] text-white font-bold text-[11px] shadow-sm transition">
                            <i data-lucide="message-circle" class="w-3.5 h-3.5"></i>
                            <span>Respon WA</span>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif
</div>
@endsection
