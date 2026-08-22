@extends('layouts.app')

@section('title', 'Hubungi Kami - pediOcare')
@section('meta_description', 'Kunjungi klinik resmi pediOcare di Sleman, Yogyakarta atau hubungi WhatsApp 0856 9792 2194 untuk konsultasi langsung.')

@section('content')

@php
    $heroContactBg = $settings['hero_contact_image'] ?? asset('images/client_update/image4.png');
    if (!str_starts_with($heroContactBg, 'http') && !str_starts_with($heroContactBg, '/')) {
        $heroContactBg = asset($heroContactBg);
    }

    $branchesList = [];
    foreach ($branches as $branch) {
        $rawEmbed = $branch->google_maps_embed;
        $mapsSrc = null;

        // 1. If rawEmbed contains an iframe src="...", extract it
        if (!empty($rawEmbed) && preg_match('/src=["\']([^"\']+)["\']/i', $rawEmbed, $matches)) {
            $extractedSrc = $matches[1];
            // Only use if it is a valid embed link (not a blocked shortlink)
            if (!str_contains($extractedSrc, 'maps.app.goo.gl') && !str_contains($extractedSrc, 'goo.gl/maps')) {
                $mapsSrc = $extractedSrc;
            }
        } 
        // 2. If rawEmbed is a direct URL and contains maps/embed
        elseif (!empty($rawEmbed) && filter_var($rawEmbed, FILTER_VALIDATE_URL) && str_contains($rawEmbed, 'maps/embed')) {
            $mapsSrc = $rawEmbed;
        }

        // 3. Fallback: Generate standard Google Maps search embed URL (100% reliable, never blocked in iframe)
        if (empty($mapsSrc)) {
            $cleanAddress = preg_replace('/\s+/', ' ', trim($branch->address ?? ''));
            $searchQuery = trim(($branch->name ? $branch->name . ', ' : '') . ($cleanAddress ? $cleanAddress . ', ' : '') . ($branch->city ?? ''));
            if (empty($searchQuery)) {
                $searchQuery = $branch->city ?? 'Indonesia';
            }
            $mapsSrc = "https://maps.google.com/maps?q=" . urlencode($searchQuery) . "&t=&z=15&ie=UTF8&iwloc=&output=embed";
        }

        // Direct Share / Direction URL
        $directMapsUrl = $branch->google_maps_url;
        if (empty($directMapsUrl) && !empty($rawEmbed) && filter_var($rawEmbed, FILTER_VALIDATE_URL)) {
            $directMapsUrl = $rawEmbed;
        }
        if (empty($directMapsUrl)) {
            $directMapsUrl = "https://www.google.com/maps/search/?api=1&query=" . urlencode(($branch->name ?? '') . ' ' . ($branch->address ?? '') . ' ' . ($branch->city ?? ''));
        }

        $cleanWA = preg_replace('/[^0-9]/', '', $branch->whatsapp_number ?? '');
        if (str_starts_with($cleanWA, '0')) {
            $cleanWA = '62' . substr($cleanWA, 1);
        }

        $branchImg = $branch->image;
        if ($branchImg && !str_starts_with($branchImg, 'http') && !str_starts_with($branchImg, '/')) {
            $branchImg = asset($branchImg);
        }

        $branchesList[] = [
            'id' => $branch->id,
            'name' => $branch->name,
            'city' => $branch->city,
            'address' => trim(preg_replace('/\s+/', ' ', $branch->address ?? '')),
            'phone' => $branch->phone_number,
            'whatsapp' => $branch->whatsapp_number,
            'clean_wa' => $cleanWA,
            'email' => $branch->email,
            'opening_hours' => $branch->opening_hours ?? 'Senin - Sabtu: 08:30 - 17:00 WIB',
            'maps_src' => $mapsSrc,
            'maps_url' => $directMapsUrl,
            'image' => $branchImg,
            'is_main' => (bool)$branch->is_main_branch,
        ];
    }

    if (empty($branchesList)) {
        $defaultClinicAddr = $settings['clinic_address'] ?? ($settings['footer_address'] ?? 'Jl. Kaliurang KM 8.5, Sinduharjo, Ngaglik, Sleman, D.I. Yogyakarta 55581, Indonesia');
        $defaultMapsSrc = "https://maps.google.com/maps?q=" . urlencode($defaultClinicAddr) . "&t=&z=15&ie=UTF8&iwloc=&output=embed";

        $branchesList[] = [
            'id' => 1,
            'name' => ($settings['clinic_name'] ?? 'pediOcare') . ' - Klinik Pusat',
            'city' => $settings['clinic_city'] ?? 'Sleman, D.I. Yogyakarta',
            'address' => $defaultClinicAddr,
            'phone' => $settings['phone_number'] ?? ($settings['hotline_whatsapp'] ?? '0856 9792 2194'),
            'whatsapp' => $settings['hotline_whatsapp'] ?? '0856 9792 2194',
            'clean_wa' => preg_replace('/[^0-9]/', '', $settings['hotline_whatsapp'] ?? '085697922194'),
            'email' => $settings['contact_email'] ?? 'info@pediocare.id',
            'opening_hours' => 'Senin - Sabtu: 08:30 - 17:00 WIB',
            'maps_src' => $defaultMapsSrc,
            'maps_url' => "https://maps.google.com/?q=" . urlencode($defaultClinicAddr),
            'image' => null,
            'is_main' => true,
        ];
    }

    $initialIndex = 0;
    if (request('branch_id')) {
        foreach ($branchesList as $idx => $b) {
            if ($b['id'] == request('branch_id')) {
                $initialIndex = $idx;
                break;
            }
        }
    }
@endphp

<!-- Hero Section -->
<section class="relative py-8 md:py-12 px-margin-mobile md:px-margin-desktop overflow-hidden bg-cover bg-center flex items-center justify-center fade-in-up" 
         style="background-image: linear-gradient(rgba(13, 28, 47, 0.8), rgba(13, 28, 47, 0.8)), url('{{ $heroContactBg }}');">
    <div class="max-w-container-max mx-auto text-center relative z-10 space-y-2">
        <span class="inline-flex items-center gap-1.5 px-3 py-0.5 rounded-full bg-surface-white/10 text-primary-fixed border border-surface-white/20 text-[11px] font-semibold uppercase tracking-wider backdrop-blur-sm">
            <span class="w-1.5 h-1.5 rounded-full bg-primary-fixed animate-pulse"></span>
            {{ $settings['hero_contact_badge'] ?? 'Pelayanan & Lokasi Cabang' }}
        </span>
        <h1 class="text-2xl sm:text-3xl font-bold text-surface-white tracking-tight leading-tight">
            {{ $settings['hero_contact_title'] ?? 'Hubungi & Kunjungi Kami' }}
        </h1>
        <p class="font-body-md text-surface-white/90 max-w-xl mx-auto leading-relaxed text-xs sm:text-sm">
            {{ $settings['hero_contact_subtitle'] ?? 'Kunjungi klinik kami terdekat atau buat janji temu konsultasi bersama spesialis kami.' }}
        </p>
    </div>
</section>

<!-- Main Contact & Compact Branch Slider Section -->
<section class="py-8 md:py-12 px-margin-mobile md:px-margin-desktop bg-surface-container-low relative overflow-hidden"
         x-data="{
             currentIndex: {{ $initialIndex }},
             branches: @js($branchesList),
             selectedBranchId: {{ $branchesList[$initialIndex]['id'] ?? 1 }},
             touchStartX: 0,
             touchEndX: 0,
             selectBranch(index) {
                 this.currentIndex = index;
                 this.selectedBranchId = this.branches[index].id;
                 const branchSelect = document.getElementById('form-branch-select');
                 if (branchSelect) {
                     branchSelect.value = this.selectedBranchId;
                 }
             },
             nextBranch() {
                 this.currentIndex = (this.currentIndex + 1) % this.branches.length;
                 this.selectedBranchId = this.branches[this.currentIndex].id;
                 const branchSelect = document.getElementById('form-branch-select');
                 if (branchSelect) {
                     branchSelect.value = this.selectedBranchId;
                 }
             },
             prevBranch() {
                 this.currentIndex = (this.currentIndex - 1 + this.branches.length) % this.branches.length;
                 this.selectedBranchId = this.branches[this.currentIndex].id;
                 const branchSelect = document.getElementById('form-branch-select');
                 if (branchSelect) {
                     branchSelect.value = this.selectedBranchId;
                 }
             },
             handleTouchStart(e) {
                 this.touchStartX = e.changedTouches[0].screenX;
             },
             handleTouchEnd(e) {
                 this.touchEndX = e.changedTouches[0].screenX;
                 if (this.touchStartX - this.touchEndX > 45) {
                     this.nextBranch();
                 } else if (this.touchEndX - this.touchStartX > 45) {
                     this.prevBranch();
                 }
             }
         }">
    
    <div class="max-w-container-max mx-auto grid grid-cols-1 lg:grid-cols-12 gap-6 lg:gap-8 relative z-10 items-start">
        
        <!-- Left Column: Compact Branch Slider & Map -->
        <div class="lg:col-span-6 flex flex-col gap-4">
            
            <!-- Compact Unified Branch Card -->
            <div class="bg-surface-white rounded-2xl shadow-1 border border-outline-variant/30 overflow-hidden flex flex-col transition-all duration-300"
                 @touchstart="handleTouchStart($event)" 
                 @touchend="handleTouchEnd($event)">
                
                <!-- Card Header: Title, Tab Pills & Arrow Controls -->
                <div class="p-4 sm:p-5 border-b border-outline-variant/20 bg-gradient-to-r from-surface-white via-surface-container-low/30 to-surface-white">
                    <div class="flex items-center justify-between gap-2 mb-3">
                        <div class="flex items-center gap-2">
                            <span class="p-1.5 rounded-lg bg-primary/10 text-primary flex items-center justify-center">
                                <span class="material-symbols-outlined text-lg" style="font-variation-settings: 'FILL' 1;">location_on</span>
                            </span>
                            <div>
                                <h2 class="text-sm sm:text-base font-bold text-on-surface leading-tight">Lokasi Cabang Klinik</h2>
                                <p class="text-[11px] text-on-surface-variant">Pilih cabang terdekat dari lokasi Anda</p>
                            </div>
                        </div>

                        <!-- Prev/Next Mini Controls -->
                        <template x-if="branches.length > 1">
                            <div class="flex items-center gap-1 bg-surface-container-low p-1 rounded-xl border border-outline-variant/25">
                                <button @click="prevBranch()" 
                                        type="button"
                                        class="w-7 h-7 rounded-lg bg-surface-white hover:bg-primary hover:text-white text-on-surface transition shadow-xs flex items-center justify-center cursor-pointer" 
                                        aria-label="Cabang Sebelumnya">
                                    <span class="material-symbols-outlined text-base">chevron_left</span>
                                </button>
                                <span class="text-[11px] font-bold text-on-surface px-1.5" x-text="`${currentIndex + 1}/${branches.length}`"></span>
                                <button @click="nextBranch()" 
                                        type="button"
                                        class="w-7 h-7 rounded-lg bg-surface-white hover:bg-primary hover:text-white text-on-surface transition shadow-xs flex items-center justify-center cursor-pointer" 
                                        aria-label="Cabang Selanjutnya">
                                    <span class="material-symbols-outlined text-base">chevron_right</span>
                                </button>
                            </div>
                        </template>
                    </div>

                    <!-- Interactive Branch Tabs -->
                    <div class="flex items-center gap-2 overflow-x-auto pb-0.5 no-scrollbar">
                        <template x-for="(b, idx) in branches" :key="b.id">
                            <button type="button"
                                    @click="selectBranch(idx)"
                                    class="px-3 py-1.5 rounded-xl text-xs font-bold whitespace-nowrap transition-all flex items-center gap-1.5 border cursor-pointer"
                                    :class="currentIndex === idx 
                                        ? 'bg-primary text-white border-primary shadow-sm' 
                                        : 'bg-surface-white text-on-surface hover:bg-slate-100 border-outline-variant/30'">
                                <span class="material-symbols-outlined text-xs" style="font-variation-settings: 'FILL' 1;">location_on</span>
                                <span x-text="b.city"></span>
                                <span x-show="b.is_main" class="text-[9px] bg-white/20 text-white px-1.5 py-0.5 rounded font-extrabold ml-0.5">Pusat</span>
                            </button>
                        </template>
                    </div>
                </div>

                <!-- Active Branch Details (Compact) -->
                <div class="p-4 sm:p-5 space-y-3.5 bg-surface-white">
                    <div class="flex items-start justify-between gap-3">
                        <div>
                            <div class="flex items-center gap-1.5 mb-1">
                                <span class="text-[10px] font-bold text-primary uppercase tracking-wider bg-primary/10 px-2 py-0.5 rounded" 
                                      x-text="`Cabang ${branches[currentIndex].city}`"></span>
                                <template x-if="branches[currentIndex].is_main">
                                    <span class="text-[10px] font-bold text-white bg-primary px-2 py-0.5 rounded">Kantor Pusat</span>
                                </template>
                            </div>
                            <h3 class="text-sm sm:text-base font-bold text-on-surface" x-text="branches[currentIndex].name"></h3>
                        </div>
                    </div>

                    <!-- Address & Hours in 2 lines -->
                    <div class="space-y-1.5 text-xs text-on-surface-variant">
                        <div class="flex items-start gap-2">
                            <span class="material-symbols-outlined text-primary text-base shrink-0 mt-0.5" style="font-variation-settings: 'FILL' 1;">pin_drop</span>
                            <span class="leading-relaxed" x-text="branches[currentIndex].address"></span>
                        </div>
                        <div class="flex items-center gap-2" x-show="branches[currentIndex].opening_hours">
                            <span class="material-symbols-outlined text-primary text-base shrink-0" style="font-variation-settings: 'FILL' 1;">schedule</span>
                            <span x-text="branches[currentIndex].opening_hours"></span>
                        </div>
                    </div>

                    <!-- Compact Action Buttons: Phone, WhatsApp, Directions -->
                    <div class="pt-1 flex flex-wrap items-center gap-2 text-xs font-bold">
                        <template x-if="branches[currentIndex].phone">
                            <a :href="`tel:${branches[currentIndex].phone.replace(/[^0-9]/g, '')}`" 
                               class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg bg-surface-container hover:bg-surface-container-high text-on-surface transition border border-outline-variant/30">
                                <span class="material-symbols-outlined text-sm text-primary">call</span>
                                <span x-text="branches[currentIndex].phone"></span>
                            </a>
                        </template>

                        <template x-if="branches[currentIndex].clean_wa">
                            <a :href="`https://wa.me/${branches[currentIndex].clean_wa}`" 
                               target="_blank" 
                               class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg bg-[#25D366]/10 hover:bg-[#25D366] text-[#128C7E] hover:text-white transition border border-[#25D366]/30">
                                <span class="material-symbols-outlined text-sm">chat</span>
                                <span>WhatsApp</span>
                            </a>
                        </template>
                    </div>
                </div>

                <!-- Integrated Compact Map Embed -->
                <div class="relative w-full h-56 sm:h-64 bg-slate-100 border-t border-outline-variant/20">
                    <iframe 
                        :key="branches[currentIndex].id"
                        :title="`Peta Lokasi ${branches[currentIndex].name}`"
                        :src="branches[currentIndex].maps_src" 
                        class="w-full h-full border-0" 
                        allowfullscreen="" 
                        loading="lazy" 
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                    <div class="absolute bottom-2.5 right-2.5 z-10">
                        <a :href="branches[currentIndex].maps_url" target="_blank" 
                           class="bg-white/95 hover:bg-white text-on-surface text-[10px] font-bold px-2.5 py-1 rounded-md shadow-sm border border-slate-200 inline-flex items-center gap-1 backdrop-blur-xs transition">
                            <span class="material-symbols-outlined text-xs text-primary">open_in_new</span>
                            Buka di Google Maps
                        </a>
                    </div>
                </div>

                <!-- Slide Dots Indicator -->
                <template x-if="branches.length > 1">
                    <div class="p-2.5 bg-surface-white flex items-center justify-center gap-1.5 border-t border-outline-variant/15">
                        <template x-for="(b, idx) in branches" :key="b.id">
                            <button type="button" 
                                    @click="selectBranch(idx)" 
                                    :aria-label="`Pilih cabang ${b.city}`"
                                    class="h-1.5 rounded-full transition-all duration-300 cursor-pointer"
                                    :class="currentIndex === idx ? 'w-5 bg-primary' : 'w-1.5 bg-slate-300 hover:bg-slate-400'">
                            </button>
                        </template>
                    </div>
                </template>
            </div>

        </div>

        <!-- Right Column: Compact Appointment Form -->
        <div class="lg:col-span-6">
            <div class="bg-surface-white rounded-2xl p-5 sm:p-6 shadow-2 border border-outline-variant/30 relative overflow-hidden">
                <div class="absolute top-0 left-0 w-full h-1 bg-primary"></div>
                
                <div class="flex items-center justify-between mb-2">
                    <span class="text-[10px] font-bold text-primary uppercase tracking-wider bg-primary/10 px-2.5 py-0.5 rounded-full inline-block">
                        Formulir Reservasi
                    </span>
                </div>
                <h2 class="text-lg sm:text-xl font-bold text-primary mb-1">
                    Buat Janji Temu Konsultasi
                </h2>
                <p class="font-body-md text-xs text-on-surface-variant mb-5 leading-relaxed">
                    Jadwalkan konsultasi langsung dengan klinisi spesialis kami di cabang pilihan Anda.
                </p>

                @if ($errors->any())
                <div class="p-3 mb-4 bg-red-50 border-l-4 border-error text-xs text-red-700 rounded-xl space-y-1">
                    <p class="font-bold">Periksa kembali formulir:</p>
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <form action="{{ route('consultation.store') }}" method="POST" class="flex flex-col gap-3.5">
                    @csrf
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        <div>
                            <label class="block text-xs font-bold text-on-surface mb-1">Nama Lengkap *</label>
                            <input class="w-full rounded-xl border border-outline-variant/60 bg-surface-white focus:border-primary focus:ring-1 focus:ring-primary px-3.5 py-2 text-xs transition" 
                                   placeholder="Nama pasien" type="text" name="full_name" value="{{ old('full_name') }}" required/>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-on-surface mb-1">Nomor WhatsApp *</label>
                            <input class="w-full rounded-xl border border-outline-variant/60 bg-surface-white focus:border-primary focus:ring-1 focus:ring-primary px-3.5 py-2 text-xs transition" 
                                   placeholder="08123456789" type="tel" name="phone_number" value="{{ old('phone_number') }}" required/>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        <div>
                            <label class="block text-xs font-bold text-on-surface mb-1">Layanan yang Dibutuhkan *</label>
                            <select class="w-full rounded-xl border border-outline-variant/60 bg-surface-white focus:border-primary focus:ring-1 focus:ring-primary px-3.5 py-2 text-xs text-on-surface-variant transition" 
                                    name="complaint_type" required>
                                <option value="" disabled selected>Pilih layanan...</option>
                                <option value="Prostetik" {{ old('complaint_type') == 'Prostetik' ? 'selected' : '' }}>Kaki/Tangan Palsu (Prostetik)</option>
                                <option value="Ortotik" {{ old('complaint_type') == 'Ortotik' ? 'selected' : '' }}>Alat Bantu Ortopedi / Brace</option>
                                <option value="Scoliosis" {{ old('complaint_type') == 'Scoliosis' ? 'selected' : '' }}>Pusat Koreksi Skoliosis 3D</option>
                                <option value="Fisioterapi" {{ old('complaint_type') == 'Fisioterapi' ? 'selected' : '' }}>Fisioterapi & Gait Training</option>
                                <option value="Konsultasi" {{ old('complaint_type') == 'Konsultasi' ? 'selected' : '' }}>Konsultasi Medis</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-on-surface mb-1">Tanggal Rencana</label>
                            <input class="w-full rounded-xl border border-outline-variant/60 bg-surface-white focus:border-primary focus:ring-1 focus:ring-primary px-3.5 py-2 text-xs transition" 
                                   type="date" name="preferred_date" value="{{ old('preferred_date', date('Y-m-d')) }}"/>
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-on-surface mb-1">Pilih Cabang Klinik *</label>
                        <select class="w-full rounded-xl border border-outline-variant/60 bg-surface-white focus:border-primary focus:ring-1 focus:ring-primary px-3.5 py-2 text-xs text-on-surface transition" 
                                name="branch_id" 
                                id="form-branch-select"
                                @change="
                                    const bId = parseInt($event.target.value);
                                    const idx = branches.findIndex(b => b.id === bId);
                                    if (idx !== -1) selectBranch(idx);
                                ">
                            <template x-for="b in branches" :key="b.id">
                                <option :value="b.id" :selected="selectedBranchId === b.id" x-text="`${b.name} (${b.city})`"></option>
                            </template>
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-on-surface mb-1">Catatan / Keluhan (Opsional)</label>
                        <textarea class="w-full rounded-xl border border-outline-variant/60 bg-surface-white focus:border-primary focus:ring-1 focus:ring-primary px-3.5 py-2 text-xs h-20 transition" 
                                  placeholder="Ceritakan keluhan atau kebutuhan Anda..." name="notes">{{ old('notes') }}</textarea>
                    </div>

                    <button class="w-full bg-[#E5A500] hover:bg-[#CC9200] text-surface-white px-5 py-3 rounded-xl text-xs sm:text-sm font-bold transition-all flex items-center justify-center gap-2 shadow-sm hover:shadow-md cursor-pointer mt-1" type="submit">
                        <span class="material-symbols-outlined text-base">calendar_month</span> Jadwalkan Konsultasi Sekarang
                    </button>
                </form>
            </div>
        </div>

    </div>
</section>

@endsection
