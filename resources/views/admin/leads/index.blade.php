@extends('admin.layouts.app')

@section('title', 'Manajemen Leads Konsultasi Pasien')
@section('header_title', 'CRM & Leads Konsultasi Pasien')

@section('content')
<div class="space-y-6">

    <!-- Status Tabs Filter Bar -->
    <div class="flex items-center gap-2 overflow-x-auto pb-2 text-xs font-bold">
        <a href="{{ route('admin.leads.index') }}"
            class="px-4 py-2.5 rounded-xl transition whitespace-nowrap flex items-center gap-2 {{ empty($status) ? 'bg-slate-900 text-white shadow-md' : 'bg-white text-slate-600 hover:bg-slate-50 border border-slate-200' }}">
            <span>Semua Leads</span>
            <span class="px-2 py-0.5 rounded-full text-[10px] {{ empty($status) ? 'bg-white/20 text-white' : 'bg-slate-100 text-slate-700' }}">{{ $statusCounts['total'] }}</span>
        </a>

        <a href="{{ route('admin.leads.index', ['status' => 'new', 'branch_id' => $branchId, 'search' => $search]) }}"
            class="px-4 py-2.5 rounded-xl transition whitespace-nowrap flex items-center gap-2 {{ $status === 'new' ? 'bg-rose-600 text-white shadow-md' : 'bg-white text-slate-600 hover:bg-rose-50 border border-slate-200' }}">
            <span>Baru Masuk</span>
            <span class="px-2 py-0.5 rounded-full text-[10px] {{ $status === 'new' ? 'bg-white/20 text-white' : 'bg-rose-100 text-rose-700' }}">{{ $statusCounts['new'] }}</span>
        </a>

        <a href="{{ route('admin.leads.index', ['status' => 'contacted', 'branch_id' => $branchId, 'search' => $search]) }}"
            class="px-4 py-2.5 rounded-xl transition whitespace-nowrap flex items-center gap-2 {{ $status === 'contacted' ? 'bg-amber-600 text-white shadow-md' : 'bg-white text-slate-600 hover:bg-amber-50 border border-slate-200' }}">
            <span>Sedang Dihubungi</span>
            <span class="px-2 py-0.5 rounded-full text-[10px] {{ $status === 'contacted' ? 'bg-white/20 text-white' : 'bg-amber-100 text-amber-700' }}">{{ $statusCounts['contacted'] }}</span>
        </a>

        <a href="{{ route('admin.leads.index', ['status' => 'scheduled', 'branch_id' => $branchId, 'search' => $search]) }}"
            class="px-4 py-2.5 rounded-xl transition whitespace-nowrap flex items-center gap-2 {{ $status === 'scheduled' ? 'bg-sky-600 text-white shadow-md' : 'bg-white text-slate-600 hover:bg-sky-50 border border-slate-200' }}">
            <span>Dijadwalkan</span>
            <span class="px-2 py-0.5 rounded-full text-[10px] {{ $status === 'scheduled' ? 'bg-white/20 text-white' : 'bg-sky-100 text-sky-700' }}">{{ $statusCounts['scheduled'] }}</span>
        </a>

        <a href="{{ route('admin.leads.index', ['status' => 'completed', 'branch_id' => $branchId, 'search' => $search]) }}"
            class="px-4 py-2.5 rounded-xl transition whitespace-nowrap flex items-center gap-2 {{ $status === 'completed' ? 'bg-emerald-600 text-white shadow-md' : 'bg-white text-slate-600 hover:bg-emerald-50 border border-slate-200' }}">
            <span>Selesai Konsultasi</span>
            <span class="px-2 py-0.5 rounded-full text-[10px] {{ $status === 'completed' ? 'bg-white/20 text-white' : 'bg-emerald-100 text-emerald-700' }}">{{ $statusCounts['completed'] }}</span>
        </a>

        <a href="{{ route('admin.leads.index', ['status' => 'cancelled', 'branch_id' => $branchId, 'search' => $search]) }}"
            class="px-4 py-2.5 rounded-xl transition whitespace-nowrap flex items-center gap-2 {{ $status === 'cancelled' ? 'bg-slate-700 text-white shadow-md' : 'bg-white text-slate-600 hover:bg-slate-50 border border-slate-200' }}">
            <span>Dibatalkan</span>
            <span class="px-2 py-0.5 rounded-full text-[10px] {{ $status === 'cancelled' ? 'bg-white/20 text-white' : 'bg-slate-100 text-slate-700' }}">{{ $statusCounts['cancelled'] }}</span>
        </a>
    </div>

    <!-- Search & Filter Controls -->
    <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm">
        <form action="{{ route('admin.leads.index') }}" method="GET" class="grid grid-cols-1 sm:grid-cols-12 gap-4 items-center">
            @if($status)
            <input type="hidden" name="status" value="{{ $status }}">
            @endif

            <!-- Search Input -->
            <div class="sm:col-span-6 relative">
                <i data-lucide="search" class="w-4 h-4 text-slate-400 absolute left-3.5 top-3.5"></i>
                <input type="text" name="search" value="{{ $search }}" placeholder="Cari nama pasien, no WhatsApp, keluhan medis..."
                    class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-slate-200 text-xs focus:outline-none focus:ring-2 focus:ring-medical-500">
            </div>

            <!-- Branch Dropdown Filter -->
            <div class="sm:col-span-4">
                <select name="branch_id" class="w-full px-3 py-2.5 rounded-xl border border-slate-200 text-xs focus:outline-none focus:ring-2 focus:ring-medical-500">
                    <option value="">-- Semua Cabang Klinik --</option>
                    @foreach($branches as $b)
                    <option value="{{ $b->id }}" {{ $branchId == $b->id ? 'selected' : '' }}>{{ $b->name }} ({{ $b->city }})</option>
                    @endforeach
                </select>
            </div>

            <!-- Filter Buttons -->
            <div class="sm:col-span-2 flex gap-2">
                <button type="submit" class="flex-1 py-2.5 px-3 rounded-xl bg-medical-600 hover:bg-medical-700 text-white font-bold text-xs shadow-sm transition">
                    Filter
                </button>
                @if($search || $branchId || $status)
                <a href="{{ route('admin.leads.index') }}" title="Reset Filter" class="p-2.5 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-600 transition flex items-center justify-center">
                    <i data-lucide="rotate-ccw" class="w-4 h-4"></i>
                </a>
                @endif
            </div>
        </form>
    </div>

    <!-- Leads Data Table Card -->
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
        @if($leads->isEmpty())
        <div class="p-16 text-center text-slate-400 text-xs space-y-2">
            <i data-lucide="inbox" class="w-10 h-10 mx-auto text-slate-300"></i>
            <p class="font-semibold text-slate-600">Tidak ada data leads konsultasi ditemukan.</p>
            <p class="text-slate-400 text-[11px]">Coba ubah kata kunci pencarian atau filter status Anda.</p>
        </div>
        @else
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead class="bg-slate-50 border-b border-slate-200 text-slate-500 font-bold uppercase tracking-wider text-[10px]">
                    <tr>
                        <th class="py-3.5 px-6">Pasien / Kontak</th>
                        <th class="py-3.5 px-6">Kebutuhan Medis</th>
                        <th class="py-3.5 px-6">Cabang & Jadwal</th>
                        <th class="py-3.5 px-6">Status Follow-up</th>
                        <th class="py-3.5 px-6">Waktu Masuk</th>
                        <th class="py-3.5 px-6 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @foreach($leads as $lead)
                    <tr class="hover:bg-slate-50/80 transition">
                        <!-- Patient Info -->
                        <td class="py-4 px-6">
                            <div class="space-y-0.5">
                                <a href="{{ route('admin.leads.show', $lead->id) }}" class="font-bold text-slate-900 hover:text-medical-600 text-sm">
                                    {{ $lead->full_name }}
                                </a>
                                <p class="text-slate-500 font-mono text-[11px] flex items-center gap-1">
                                    <i data-lucide="phone" class="w-3 h-3 text-slate-400"></i>
                                    <span>{{ $lead->phone_number }}</span>
                                </p>
                                @if($lead->email)
                                <p class="text-slate-400 text-[10px]">{{ $lead->email }}</p>
                                @endif
                            </div>
                        </td>

                        <!-- Complaint & Notes -->
                        <td class="py-4 px-6 max-w-xs">
                            <span class="inline-block font-semibold text-slate-800 bg-slate-100 px-2 py-0.5 rounded text-[11px]">
                                {{ $lead->complaint_type }}
                            </span>
                            @if($lead->notes)
                            <p class="text-[11px] text-slate-500 mt-1 line-clamp-2 italic">"{{ $lead->notes }}"</p>
                            @endif
                        </td>

                        <!-- Branch & Date -->
                        <td class="py-4 px-6">
                            <p class="font-semibold text-slate-700">{{ $lead->branch->name ?? 'Pusat' }}</p>
                            <p class="text-[11px] text-slate-500 flex items-center gap-1 mt-0.5">
                                <i data-lucide="calendar" class="w-3 h-3 text-slate-400"></i>
                                <span>{{ $lead->preferred_date ? $lead->preferred_date->format('d M Y') : 'Fleksibel' }}</span>
                            </p>
                        </td>

                        <!-- Status & Inline Update -->
                        <td class="py-4 px-6">
                            <form action="{{ route('admin.leads.status', $lead->id) }}" method="POST" class="inline-block">
                                @csrf
                                @method('PATCH')
                                <select name="status" onchange="this.form.submit()"
                                    class="text-[11px] font-bold px-2.5 py-1 rounded-full border cursor-pointer focus:outline-none transition
                                    {{ $lead->status === 'new' ? 'bg-rose-50 text-rose-700 border-rose-200' : '' }}
                                    {{ $lead->status === 'contacted' ? 'bg-amber-50 text-amber-700 border-amber-200' : '' }}
                                    {{ $lead->status === 'scheduled' ? 'bg-sky-50 text-sky-700 border-sky-200' : '' }}
                                    {{ $lead->status === 'completed' ? 'bg-emerald-50 text-emerald-700 border-emerald-200' : '' }}
                                    {{ $lead->status === 'cancelled' ? 'bg-slate-100 text-slate-600 border-slate-200' : '' }}">
                                    <option value="new" {{ $lead->status === 'new' ? 'selected' : '' }}>● BARU MASUK</option>
                                    <option value="contacted" {{ $lead->status === 'contacted' ? 'selected' : '' }}>● DIHUBUNGI</option>
                                    <option value="scheduled" {{ $lead->status === 'scheduled' ? 'selected' : '' }}>● DIJADWALKAN</option>
                                    <option value="completed" {{ $lead->status === 'completed' ? 'selected' : '' }}>● SELESAI</option>
                                    <option value="cancelled" {{ $lead->status === 'cancelled' ? 'selected' : '' }}>● DIBATALKAN</option>
                                </select>
                            </form>
                        </td>

                        <!-- Created Time -->
                        <td class="py-4 px-6 text-slate-500 whitespace-nowrap">
                            <p class="font-medium">{{ $lead->created_at->format('d M Y') }}</p>
                            <p class="text-[10px] text-slate-400">{{ $lead->created_at->format('H:i') }} WIB ({{ $lead->created_at->diffForHumans() }})</p>
                        </td>

                        <!-- Action Buttons -->
                        <td class="py-4 px-6 text-right whitespace-nowrap">
                            <div class="inline-flex items-center gap-1.5">
                                @php
                                    $phone = preg_replace('/[^0-9]/', '', $lead->phone_number);
                                    if (str_starts_with($phone, '0')) {
                                        $phone = '62' . substr($phone, 1);
                                    }
                                    $waText = "Halo Bpk/Ibu *{$lead->full_name}*, kami dari Klinik Ortotik & Prostetik Indonesia menindaklanjuti formulir konsultasi Anda untuk keluhan: *{$lead->complaint_type}*. Kapan waktu yang nyaman untuk pemeriksaan?";
                                @endphp

                                <!-- WhatsApp Button -->
                                <a href="https://wa.me/{{ $phone }}?text={{ urlencode($waText) }}" target="_blank" title="Respon WhatsApp Pasien"
                                    class="p-2 rounded-xl bg-[#25D366] hover:bg-[#20ba5a] text-white transition shadow-sm inline-flex items-center gap-1">
                                    <i data-lucide="message-circle" class="w-3.5 h-3.5"></i>
                                    <span class="text-[11px] font-bold">Chat WA</span>
                                </a>

                                <!-- Detail Link -->
                                <a href="{{ route('admin.leads.show', $lead->id) }}" title="Lihat Detail Lengkap"
                                    class="p-2 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 transition">
                                    <i data-lucide="eye" class="w-3.5 h-3.5"></i>
                                </a>

                                <!-- Delete Form -->
                                <form action="{{ route('admin.leads.destroy', $lead->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data konsultasi {{ $lead->full_name }}?')" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" title="Hapus Data" class="p-2 rounded-xl text-slate-400 hover:text-rose-600 hover:bg-rose-50 transition">
                                        <i data-lucide="trash-2" class="w-3.5 h-3.5"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="p-5 border-t border-slate-100">
            {{ $leads->links() }}
        </div>
        @endif
    </div>

</div>
@endsection
