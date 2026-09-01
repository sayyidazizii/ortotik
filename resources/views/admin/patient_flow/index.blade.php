@extends('admin.layouts.app')

@section('title', 'Manajemen Alur Pasien')
@section('header_title', 'Alur Pasien (9 Tahapan Pelayanan)')

@section('content')
@php
    $patientFlowRaw = $settings['patient_flow_steps']->value ?? null;
    $initialPatientFlow = [];
    if (!empty($patientFlowRaw)) {
        $decoded = is_array($patientFlowRaw) ? $patientFlowRaw : json_decode($patientFlowRaw, true);
        if (is_array($decoded) && count($decoded) > 0) {
            $initialPatientFlow = $decoded;
        }
    }
    if (empty($initialPatientFlow)) {
        $initialPatientFlow = [
            ['step' => '01', 'title' => 'Pemeriksaan', 'sub' => 'assessment', 'icon' => 'clinical_notes', 'desc' => 'Pemeriksaan fisik komprehensif oleh tim Ortotis-Prostetis tersertifikasi, anamnesis riwayat medis, serta evaluasi kondisi ekstremitas/stump dan kebutuhan fungsional pasien.'],
            ['step' => '02', 'title' => 'Diagnosis, preskripsi', 'sub' => 'prescription', 'icon' => 'prescriptions', 'desc' => 'Penetapan diagnosis klinis ortotik-prostetik dan penentuan rekomendasi spesifikasi desain alat bantu, jenis soket, serta pemilihan komponen yang tepat.'],
            ['step' => '03', 'title' => 'Pengukuran', 'sub' => 'measurement', 'icon' => 'straighten', 'desc' => 'Pengambilan ukuran dan parameter anatomis secara mendalam, presisi, dan teliti guna menjamin kesesuaian dimensi alat bantu dengan proporsi tubuh pasien.'],
            ['step' => '04', 'title' => 'Pencetakan', 'sub' => 'casting', 'icon' => 'view_in_ar', 'desc' => 'Pengambilan cetakan negatif anatomi tubuh pasien menggunakan gips medis (Plaster of Paris) atau pemindaian optik 3D scanner berakurasi sub-milimeter.'],
            ['step' => '05', 'title' => 'Rektifikasi', 'sub' => 'rectification', 'icon' => 'architecture', 'desc' => 'Modifikasi dan penyelarasan model cetakan positif untuk mendistribusikan tekanan secara biomekanis benar pada area sensitif dan area penumpu beban.'],
            ['step' => '06', 'title' => 'Fabrikasi', 'sub' => 'fabrication', 'icon' => 'precision_manufacturing', 'desc' => 'Proses pembuatan soket, struktur kerangka, dan perakitan komponen mekanik menggunakan material medis terbaik seperti serat karbon dan resin fleksibel.'],
            ['step' => '07', 'title' => 'Pengepasan', 'sub' => 'fitting', 'icon' => 'tune', 'desc' => 'Sesi uji coba langsung pada pasien untuk memastikan fitting pas, distribusi tekanan merata, kenyamanan maksimal, serta penyetelan kelurusan dinamis (dynamic alignment).'],
            ['step' => '08', 'title' => 'Penyerahan', 'sub' => 'delivery & check out', 'icon' => 'inventory_2', 'desc' => 'Pemeriksaan akhir mutu alat bantu, penyerahan resmi kepada pasien, serta edukasi intensif tata cara pemakaian dan pemeliharaan mandiri.'],
            ['step' => '09', 'title' => 'Evaluasi & tindak lanjut', 'sub' => 'follow up', 'icon' => 'published_with_changes', 'desc' => 'Pemantauan rutin dan evaluasi berkala untuk memastikan kenyamanan jangka panjang, adaptasi fungsi, serta jaminan garansi fitting 100% dari pediOcare.']
        ];
    }
@endphp

<div class="max-w-5xl space-y-6" x-data="patientFlowManager(@js($initialPatientFlow))">

    <!-- Page Header & Live Link -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h2 class="text-xl font-black text-slate-900">Manajemen Alur Pasien (9 Tahapan Pelayanan)</h2>
            <p class="text-xs text-slate-500 mt-0.5">Kelola urutan dan deskripsi prosedur klinis terstandar dari asesmen awal hingga evaluasi tindak lanjut berkala.</p>
        </div>
        <div class="flex items-center gap-2.5">
            <a href="{{ route('custom-products.index') }}" target="_blank" class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl bg-slate-900 hover:bg-slate-800 text-white text-xs font-bold transition shadow-sm">
                <i data-lucide="external-link" class="w-3.5 h-3.5"></i>
                <span>Lihat Live Alur Pasien</span>
            </a>
        </div>
    </div>

    @if (session('success'))
    <div class="p-4 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-xs flex items-center gap-2.5 shadow-sm">
        <i data-lucide="check-circle-2" class="w-4 h-4 text-emerald-600 shrink-0"></i>
        <span class="font-semibold">{{ session('success') }}</span>
    </div>
    @endif

    @if ($errors->any())
    <div class="p-4 rounded-2xl bg-rose-50 border border-rose-200 text-rose-800 text-xs space-y-1">
        <strong class="font-bold">Mohon perbaiki kesalahan berikut:</strong>
        <ul class="list-disc list-inside mt-1">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('admin.patient-flow.update') }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')

        <input type="hidden" name="patient_flow_steps_json" :value="JSON.stringify(steps)">

        <!-- Header Section Info -->
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 sm:p-8 space-y-4">
            <div class="border-b border-slate-100 pb-3 flex items-center gap-2 text-medical-600">
                <i data-lucide="layout-template" class="w-5 h-5"></i>
                <h3 class="text-base font-extrabold text-slate-900">Header Alur Pasien</h3>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div class="space-y-1.5">
                    <label class="block text-xs font-bold text-slate-700 uppercase">Badge Header</label>
                    <input type="text" name="patient_flow_badge" value="{{ $settings['patient_flow_badge']->value ?? 'Standar Pelayanan Kemenkes RI' }}" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-xs bg-white focus:ring-2 focus:ring-medical-500 font-semibold">
                </div>
                <div class="space-y-1.5">
                    <label class="block text-xs font-bold text-slate-700 uppercase">Judul Utama</label>
                    <input type="text" name="patient_flow_title" value="{{ $settings['patient_flow_title']->value ?? '9 Tahapan Alur Pasien' }}" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-xs bg-white focus:ring-2 focus:ring-medical-500 font-bold">
                </div>
                <div class="sm:col-span-2 space-y-1.5">
                    <label class="block text-xs font-bold text-slate-700 uppercase">Deskripsi Penjelasan</label>
                    <textarea name="patient_flow_subtitle" rows="2" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-xs bg-white focus:ring-2 focus:ring-medical-500 leading-relaxed">{{ $settings['patient_flow_subtitle']->value ?? 'Alur prosedur pelayanan klinis terstandar dari asesmen awal hingga tindak lanjut berkala untuk menjamin akurasi biomekanik, kenyamanan, dan mobilitas mandiri.' }}</textarea>
                </div>
            </div>
        </div>

        <!-- 9 Steps Editor Card -->
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 sm:p-8 space-y-6">
            <div class="border-b border-slate-100 pb-4 flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                <div>
                    <div class="flex items-center gap-2 text-medical-600">
                        <i data-lucide="route" class="w-5 h-5"></i>
                        <h3 class="text-base font-extrabold text-slate-900">Daftar Tahapan Prosedur Medis</h3>
                    </div>
                    <p class="text-xs text-slate-500 mt-1">
                        Urutkan dengan tombol panah naik/turun atau ubah nomor, judul, istilah medis, dan penjelasannya.
                    </p>
                </div>
                <div class="flex items-center gap-2 shrink-0">
                    <button type="button" @click="resetDefaultSteps()" class="px-3.5 py-2 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-bold transition flex items-center gap-1.5">
                        <i data-lucide="rotate-ccw" class="w-3.5 h-3.5"></i>
                        <span>Reset Default Kemenkes</span>
                    </button>
                    <button type="button" @click="addStep()" class="px-4 py-2 rounded-xl bg-medical-600 hover:bg-medical-700 text-white text-xs font-bold transition shadow-sm flex items-center gap-1.5">
                        <i data-lucide="plus" class="w-4 h-4"></i>
                        <span>Tambah Tahap</span>
                    </button>
                </div>
            </div>

            <!-- Steps Loop -->
            <div class="space-y-4">
                <template x-for="(st, idx) in steps" :key="idx">
                    <div class="p-5 rounded-2xl border border-slate-200 bg-slate-50/70 space-y-4 transition hover:border-medical-400 hover:shadow-xs">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <span class="w-8 h-8 rounded-xl bg-medical-600 text-white font-black text-xs flex items-center justify-center shadow-xs" x-text="st.step || (idx + 1 < 10 ? '0' + (idx + 1) : idx + 1)"></span>
                                <h4 class="text-sm font-bold text-slate-900 flex items-center gap-1.5">
                                    <span x-text="st.title || 'Tahapan ' + (idx + 1)"></span>
                                    <span class="text-xs text-medical-600 font-normal italic" x-text="st.sub ? '(' + st.sub + ')' : ''"></span>
                                </h4>
                            </div>
                            <div class="flex items-center gap-1">
                                <button type="button" @click="moveStep(idx, -1)" :disabled="idx === 0" class="p-1.5 rounded-lg text-slate-400 hover:text-slate-700 hover:bg-slate-200 transition disabled:opacity-30 disabled:hover:bg-transparent" title="Pindah Ke Atas">
                                    <i data-lucide="arrow-up" class="w-3.5 h-3.5"></i>
                                </button>
                                <button type="button" @click="moveStep(idx, 1)" :disabled="idx === steps.length - 1" class="p-1.5 rounded-lg text-slate-400 hover:text-slate-700 hover:bg-slate-200 transition disabled:opacity-30 disabled:hover:bg-transparent" title="Pindah Ke Bawah">
                                    <i data-lucide="arrow-down" class="w-3.5 h-3.5"></i>
                                </button>
                                <button type="button" @click="removeStep(idx)" :disabled="steps.length <= 1" class="p-1.5 rounded-lg text-rose-500 hover:bg-rose-50 transition disabled:opacity-30" title="Hapus Tahap">
                                    <i data-lucide="trash-2" class="w-3.5 h-3.5"></i>
                                </button>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-3.5">
                            <div class="space-y-1">
                                <label class="block text-[11px] font-bold text-slate-600 uppercase">Judul Tahap *</label>
                                <input type="text" x-model="st.title" class="w-full px-3.5 py-2 rounded-xl border border-slate-200 text-xs bg-white focus:ring-2 focus:ring-medical-500 font-semibold" placeholder="Contoh: Pemeriksaan">
                            </div>
                            <div class="space-y-1">
                                <label class="block text-[11px] font-bold text-slate-600 uppercase">Istilah Medis / Subtitle</label>
                                <input type="text" x-model="st.sub" class="w-full px-3.5 py-2 rounded-xl border border-slate-200 text-xs bg-white focus:ring-2 focus:ring-medical-500 italic" placeholder="Contoh: assessment">
                            </div>
                            <div class="space-y-1">
                                <label class="block text-[11px] font-bold text-slate-600 uppercase">Ikon Material Symbol</label>
                                <input type="text" x-model="st.icon" class="w-full px-3.5 py-2 rounded-xl border border-slate-200 text-xs bg-white focus:ring-2 focus:ring-medical-500 font-mono" placeholder="Contoh: clinical_notes">
                            </div>
                            <div class="sm:col-span-3 space-y-1">
                                <label class="block text-[11px] font-bold text-slate-600 uppercase">Deskripsi Penjelasan Prosedur Klinis *</label>
                                <textarea x-model="st.desc" rows="2" class="w-full px-3.5 py-2 rounded-xl border border-slate-200 text-xs bg-white focus:ring-2 focus:ring-medical-500 leading-relaxed" placeholder="Penjelasan detail tahapan..."></textarea>
                            </div>
                        </div>
                    </div>
                </template>
            </div>
        </div>

        <!-- Sticky Submit Footer -->
        <div class="bg-white rounded-2xl border border-slate-200 p-4 sm:p-6 shadow-sm flex items-center justify-between sticky bottom-4 z-30">
            <span class="text-xs text-slate-500 hidden sm:inline">Perubahan alur pasien akan langsung tersinkronkan pada website publik.</span>
            <button type="submit" class="w-full sm:w-auto px-8 py-3.5 rounded-xl bg-medical-600 hover:bg-medical-700 text-white font-bold text-sm shadow-md transition flex items-center justify-center gap-2">
                <i data-lucide="save" class="w-4 h-4"></i>
                <span>Simpan Alur Pasien</span>
            </button>
        </div>

    </form>
</div>

<script>
function patientFlowManager(initialSteps) {
    return {
        steps: initialSteps || [],

        init() {
            this.$nextTick(() => { if (window.lucide) window.lucide.createIcons(); });
        },

        addStep() {
            const nextNum = this.steps.length + 1;
            const stepStr = nextNum < 10 ? '0' + nextNum : '' + nextNum;
            this.steps.push({
                step: stepStr,
                title: 'Tahap Baru ' + nextNum,
                sub: '',
                icon: 'check_circle',
                desc: 'Deskripsi tahapan alur pasien baru...'
            });
            this.$nextTick(() => { if (window.lucide) window.lucide.createIcons(); });
        },

        removeStep(index) {
            if (this.steps.length > 1) {
                if (confirm('Hapus tahapan ini?')) {
                    this.steps.splice(index, 1);
                    this.steps.forEach((item, idx) => {
                        const num = idx + 1;
                        item.step = num < 10 ? '0' + num : '' + num;
                    });
                    this.$nextTick(() => { if (window.lucide) window.lucide.createIcons(); });
                }
            }
        },

        moveStep(index, direction) {
            const targetIndex = index + direction;
            if (targetIndex >= 0 && targetIndex < this.steps.length) {
                const temp = this.steps[index];
                this.steps[index] = this.steps[targetIndex];
                this.steps[targetIndex] = temp;
                this.steps.forEach((item, idx) => {
                    const num = idx + 1;
                    item.step = num < 10 ? '0' + num : '' + num;
                });
                this.$nextTick(() => { if (window.lucide) window.lucide.createIcons(); });
            }
        },

        resetDefaultSteps() {
            if (confirm('Kembalikan ke 9 Tahapan Baku Standar Kemenkes RI?')) {
                this.steps = [
                    {step: '01', title: 'Pemeriksaan', sub: 'assessment', icon: 'clinical_notes', desc: 'Pemeriksaan fisik komprehensif oleh tim Ortotis-Prostetis tersertifikasi, anamnesis riwayat medis, serta evaluasi kondisi ekstremitas/stump dan kebutuhan fungsional pasien.'},
                    {step: '02', title: 'Diagnosis, preskripsi', sub: 'prescription', icon: 'prescriptions', desc: 'Penetapan diagnosis klinis ortotik-prostetik dan penentuan rekomendasi spesifikasi desain alat bantu, jenis soket, serta pemilihan komponen yang tepat.'},
                    {step: '03', title: 'Pengukuran', sub: 'measurement', icon: 'straighten', desc: 'Pengambilan ukuran dan parameter anatomis secara mendalam, presisi, dan teliti guna menjamin kesesuaian dimensi alat bantu dengan proporsi tubuh pasien.'},
                    {step: '04', title: 'Pencetakan', sub: 'casting', icon: 'view_in_ar', desc: 'Pengambilan cetakan negatif anatomi tubuh pasien menggunakan gips medis (Plaster of Paris) atau pemindaian optik 3D scanner berakurasi sub-milimeter.'},
                    {step: '05', title: 'Rektifikasi', sub: 'rectification', icon: 'architecture', desc: 'Modifikasi dan penyelarasan model cetakan positif untuk mendistribusikan tekanan secara biomekanis benar pada area sensitif dan area penumpu beban.'},
                    {step: '06', title: 'Fabrikasi', sub: 'fabrication', icon: 'precision_manufacturing', desc: 'Proses pembuatan soket, struktur kerangka, dan perakitan komponen mekanik menggunakan material medis terbaik seperti serat karbon dan resin fleksibel.'},
                    {step: '07', title: 'Pengepasan', sub: 'fitting', icon: 'tune', desc: 'Sesi uji coba langsung pada pasien untuk memastikan fitting pas, distribusi tekanan merata, kenyamanan maksimal, serta penyetelan kelurusan dinamis (dynamic alignment).'},
                    {step: '08', title: 'Penyerahan', sub: 'delivery & check out', icon: 'inventory_2', desc: 'Pemeriksaan akhir mutu alat bantu, penyerahan resmi kepada pasien, serta edukasi intensif tata cara pemakaian dan pemeliharaan mandiri.'},
                    {step: '09', title: 'Evaluasi & tindak lanjut', sub: 'follow up', icon: 'published_with_changes', desc: 'Pemantauan rutin dan evaluasi berkala untuk memastikan kenyamanan jangka panjang, adaptasi fungsi, serta jaminan garansi fitting 100% dari pediOcare.'}
                ];
                this.$nextTick(() => { if (window.lucide) window.lucide.createIcons(); });
            }
        }
    };
}
</script>
@endsection