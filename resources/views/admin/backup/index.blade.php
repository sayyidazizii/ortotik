@extends('admin.layouts.app')

@section('title', 'Backup & Restore Database')
@section('header_title', 'Backup & Restore Database')

@section('content')
<div class="space-y-6" x-data="backupManager()">

    <!-- Header Title & Quick Actions -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h2 class="text-xl font-black text-slate-900">Backup & Restore Database</h2>
            <p class="text-xs text-slate-500 mt-0.5">Kelola pencadangan database MySQL (.sql) dan ekspor/impor format Excel (.xlsx / .csv) untuk proteksi dan migrasi data.</p>
        </div>
        <div class="flex flex-wrap items-center gap-2">
            <form action="{{ route('admin.backup.create') }}" method="POST" class="inline">
                @csrf
                <input type="hidden" name="type" value="mysql">
                <button type="submit" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-medical-600 hover:bg-medical-700 text-white text-xs font-bold transition shadow-sm hover:shadow">
                    <i data-lucide="database" class="w-4 h-4"></i>
                    <span>Backup MySQL Sekarang</span>
                </button>
            </form>

            <form action="{{ route('admin.backup.create') }}" method="POST" class="inline">
                @csrf
                <input type="hidden" name="type" value="excel_xlsx">
                <button type="submit" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-bold transition shadow-sm hover:shadow">
                    <i data-lucide="sheet" class="w-4 h-4"></i>
                    <span>Backup Excel Sekarang</span>
                </button>
            </form>
        </div>
    </div>

    <!-- Banner Link ke Sinkronisasi Lengkap .ZIP (Database + Aset Media) -->
    <div class="p-4 sm:p-5 rounded-2xl bg-gradient-to-r from-teal-900 to-slate-900 text-white shadow-md flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-xl bg-teal-500/20 text-teal-300 flex items-center justify-center shrink-0 border border-teal-500/30">
                <i data-lucide="folder-sync" class="w-5 h-5"></i>
            </div>
            <div>
                <h4 class="font-extrabold text-sm text-white">Butuh Sinkronisasi Lengkap Beserta Seluruh Foto & Aset?</h4>
                <p class="text-xs text-slate-300">Gunakan fitur Paket .ZIP untuk memindahkan Database + Folder Upload Storage + Gambar Publik ke server online.</p>
            </div>
        </div>
        <a href="{{ route('admin.settings.index', ['tab' => 'data_sync']) }}" class="px-4 py-2.5 rounded-xl bg-teal-500 hover:bg-teal-600 text-white font-bold text-xs shadow transition shrink-0 flex items-center justify-center gap-2">
            <i data-lucide="arrow-right" class="w-4 h-4"></i>
            <span>Buka Sinkronisasi Data & Aset</span>
        </a>
    </div>

    <!-- Database Overview Metrics -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        <!-- Database Name -->
        <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center shrink-0">
                <i data-lucide="database" class="w-6 h-6"></i>
            </div>
            <div class="overflow-hidden">
                <span class="text-[11px] font-bold uppercase tracking-wider text-slate-400">Database MySQL</span>
                <h4 class="text-base font-extrabold text-slate-900 truncate">{{ $summary['database'] }}</h4>
                <p class="text-[11px] text-slate-500 font-medium">Host: {{ $summary['host'] }}</p>
            </div>
        </div>

        <!-- Total Tables -->
        <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl bg-teal-50 text-teal-600 flex items-center justify-center shrink-0">
                <i data-lucide="table-2" class="w-6 h-6"></i>
            </div>
            <div>
                <span class="text-[11px] font-bold uppercase tracking-wider text-slate-400">Total Tabel</span>
                <h4 class="text-xl font-extrabold text-slate-900">{{ $summary['total_tables'] }} <span class="text-xs font-normal text-slate-500">tabel</span></h4>
                <p class="text-[11px] text-slate-500 font-medium">Driver: {{ strtoupper($summary['driver']) }}</p>
            </div>
        </div>

        <!-- Total Rows / Records -->
        <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center shrink-0">
                <i data-lucide="layers" class="w-6 h-6"></i>
            </div>
            <div>
                <span class="text-[11px] font-bold uppercase tracking-wider text-slate-400">Total Baris Data</span>
                <h4 class="text-xl font-extrabold text-slate-900">{{ number_format($summary['total_rows']) }} <span class="text-xs font-normal text-slate-500">records</span></h4>
                <p class="text-[11px] text-slate-500 font-medium">Tersimpan dalam database</p>
            </div>
        </div>

        <!-- Database Size -->
        <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl bg-purple-50 text-purple-600 flex items-center justify-center shrink-0">
                <i data-lucide="hard-drive" class="w-6 h-6"></i>
            </div>
            <div>
                <span class="text-[11px] font-bold uppercase tracking-wider text-slate-400">Ukuran Data</span>
                <h4 class="text-xl font-extrabold text-slate-900">{{ $summary['total_size_formatted'] }}</h4>
                <p class="text-[11px] text-slate-500 font-medium">Data & Index size</p>
            </div>
        </div>
    </div>

    <!-- Navigation Tabs for Operations -->
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
        <!-- Tab Navigation Bar -->
        <div class="flex border-b border-slate-200 bg-slate-50/70 overflow-x-auto text-xs font-bold">
            <button type="button" @click="activeTab = 'export_sql'"
                :class="activeTab === 'export_sql' ? 'border-b-2 border-medical-600 text-medical-700 bg-white shadow-sm' : 'text-slate-500 hover:text-slate-900 hover:bg-slate-100/60'"
                class="px-5 py-3.5 transition flex items-center gap-2 whitespace-nowrap">
                <i data-lucide="download" class="w-4 h-4 text-medical-600"></i>
                <span>Export MySQL (.sql)</span>
            </button>

            <button type="button" @click="activeTab = 'export_excel'"
                :class="activeTab === 'export_excel' ? 'border-b-2 border-emerald-600 text-emerald-700 bg-white shadow-sm' : 'text-slate-500 hover:text-slate-900 hover:bg-slate-100/60'"
                class="px-5 py-3.5 transition flex items-center gap-2 whitespace-nowrap">
                <i data-lucide="file-spreadsheet" class="w-4 h-4 text-emerald-600"></i>
                <span>Export Excel (.xlsx / .csv)</span>
            </button>

            <button type="button" @click="activeTab = 'import_sql'"
                :class="activeTab === 'import_sql' ? 'border-b-2 border-rose-600 text-rose-700 bg-white shadow-sm' : 'text-slate-500 hover:text-slate-900 hover:bg-slate-100/60'"
                class="px-5 py-3.5 transition flex items-center gap-2 whitespace-nowrap">
                <i data-lucide="upload" class="w-4 h-4 text-rose-600"></i>
                <span>Import / Restore MySQL (.sql)</span>
            </button>

            <button type="button" @click="activeTab = 'import_excel'"
                :class="activeTab === 'import_excel' ? 'border-b-2 border-teal-600 text-teal-700 bg-white shadow-sm' : 'text-slate-500 hover:text-slate-900 hover:bg-slate-100/60'"
                class="px-5 py-3.5 transition flex items-center gap-2 whitespace-nowrap">
                <i data-lucide="file-up" class="w-4 h-4 text-teal-600"></i>
                <span>Import Excel (.xlsx / .csv)</span>
            </button>

            <button type="button" @click="activeTab = 'server_sync'"
                :class="activeTab === 'server_sync' ? 'border-b-2 border-indigo-600 text-indigo-700 bg-white shadow-sm' : 'text-slate-500 hover:text-slate-900 hover:bg-slate-100/60'"
                class="px-5 py-3.5 transition flex items-center gap-2 whitespace-nowrap">
                <i data-lucide="cloud-download" class="w-4 h-4 text-indigo-600"></i>
                <span class="flex items-center gap-1.5">
                    <span>Tarik Data Server</span>
                    <span class="px-1.5 py-0.5 rounded text-[10px] bg-indigo-100 text-indigo-700 font-extrabold">Pull</span>
                </span>
            </button>
        </div>

        <!-- TAB CONTENT 1: EXPORT MYSQL (.SQL) -->
        <div x-show="activeTab === 'export_sql'" class="p-6 sm:p-8 space-y-6">
            <div class="border-b border-slate-100 pb-4">
                <h3 class="text-base font-extrabold text-slate-900 flex items-center gap-2 text-medical-600">
                    <i data-lucide="database" class="w-5 h-5"></i>
                    <span>Export Database MySQL (.sql)</span>
                </h3>
                <p class="text-xs text-slate-500 mt-1">
                    Buat file dump MySQL standar yang berisi struktur tabel (<code class="bg-slate-100 px-1 py-0.5 rounded text-[11px]">CREATE TABLE</code>) dan seluruh isi data (<code class="bg-slate-100 px-1 py-0.5 rounded text-[11px]">INSERT INTO</code>).
                </p>
            </div>

            <form action="{{ route('admin.backup.export-sql') }}" method="POST" class="space-y-6">
                @csrf
                
                <!-- Action Type: Download or Save to Server -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <label class="relative flex items-center p-4 rounded-xl border border-slate-200 cursor-pointer hover:border-medical-500 transition bg-slate-50/50 has-[:checked]:border-medical-600 has-[:checked]:bg-medical-50/30">
                        <input type="radio" name="action" value="download" checked class="text-medical-600 focus:ring-medical-500">
                        <div class="ml-3">
                            <span class="text-xs font-bold text-slate-900 block">Download Langsung (.sql)</span>
                            <span class="text-[11px] text-slate-500">Unduh file backup MySQL langsung ke komputer Anda.</span>
                        </div>
                    </label>

                    <label class="relative flex items-center p-4 rounded-xl border border-slate-200 cursor-pointer hover:border-medical-500 transition bg-slate-50/50 has-[:checked]:border-medical-600 has-[:checked]:bg-medical-50/30">
                        <input type="radio" name="action" value="save" class="text-medical-600 focus:ring-medical-500">
                        <div class="ml-3">
                            <span class="text-xs font-bold text-slate-900 block">Simpan ke Riwayat Server</span>
                            <span class="text-[11px] text-slate-500">Simpan file backup di server agar bisa direstore kapan saja.</span>
                        </div>
                    </label>
                </div>

                <!-- Table Selection -->
                <div class="space-y-3">
                    <div class="flex items-center justify-between">
                        <label class="text-xs font-bold text-slate-800 uppercase tracking-wider">
                            Pilih Tabel yang Ingin Di-backup
                        </label>
                        <div class="space-x-2 text-xs">
                            <button type="button" @click="selectAllTablesSql(true)" class="text-medical-600 hover:underline font-bold">Pilih Semua</button>
                            <span class="text-slate-300">|</span>
                            <button type="button" @click="selectAllTablesSql(false)" class="text-slate-500 hover:underline">Batalkan Pilihan</button>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-2.5 p-4 rounded-xl border border-slate-200 bg-slate-50/40 max-h-56 overflow-y-auto">
                        @foreach($tables as $tbl)
                        <label class="flex items-center gap-2 p-2 rounded-lg bg-white border border-slate-200/80 hover:border-slate-300 cursor-pointer text-xs transition">
                            <input type="checkbox" name="tables[]" value="{{ $tbl['name'] }}" x-model="selectedSqlTables" class="rounded text-medical-600 focus:ring-medical-500">
                            <div class="truncate">
                                <span class="font-bold text-slate-800 truncate block">{{ $tbl['name'] }}</span>
                                <span class="text-[10px] text-slate-400">{{ $tbl['rows'] }} baris</span>
                            </div>
                        </label>
                        @endforeach
                    </div>
                </div>

                <!-- Options -->
                <div class="flex flex-wrap gap-6 p-4 rounded-xl bg-slate-50 border border-slate-200 text-xs">
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" name="include_structure" value="1" checked class="rounded text-medical-600 focus:ring-medical-500">
                        <span class="font-semibold text-slate-700">Sertakan Struktur Tabel (<code class="text-[11px]">DROP & CREATE TABLE</code>)</span>
                    </label>
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" name="include_data" value="1" checked class="rounded text-medical-600 focus:ring-medical-500">
                        <span class="font-semibold text-slate-700">Sertakan Data Baris (<code class="text-[11px]">INSERT INTO</code>)</span>
                    </label>
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="inline-flex items-center gap-2 px-6 py-3 rounded-xl bg-medical-600 hover:bg-medical-700 text-white text-xs font-extrabold transition shadow-md hover:shadow-lg">
                        <i data-lucide="download" class="w-4 h-4"></i>
                        <span>Proses Export MySQL (.sql)</span>
                    </button>
                </div>
            </form>
        </div>

        <!-- TAB CONTENT 2: EXPORT EXCEL (.XLSX / .CSV) -->
        <div x-show="activeTab === 'export_excel'" class="p-6 sm:p-8 space-y-6">
            <div class="border-b border-slate-100 pb-4">
                <h3 class="text-base font-extrabold text-slate-900 flex items-center gap-2 text-emerald-600">
                    <i data-lucide="file-spreadsheet" class="w-5 h-5"></i>
                    <span>Export Database ke Format Excel & Spreadsheet</span>
                </h3>
                <p class="text-xs text-slate-500 mt-1">
                    Ekspor seluruh data atau tabel terpilih ke file Microsoft Excel (.xlsx multi-sheet) atau arsip file CSV (.zip / .csv).
                </p>
            </div>

            <form action="{{ route('admin.backup.export-excel') }}" method="POST" class="space-y-6">
                @csrf
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <!-- Format Excel .xlsx -->
                    <label class="relative flex flex-col p-4 rounded-xl border border-slate-200 cursor-pointer hover:border-emerald-500 transition bg-slate-50/50 has-[:checked]:border-emerald-600 has-[:checked]:bg-emerald-50/30">
                        <div class="flex items-center gap-2">
                            <input type="radio" name="format" value="xlsx" checked class="text-emerald-600 focus:ring-emerald-500">
                            <span class="text-xs font-bold text-slate-900">Microsoft Excel (.xlsx)</span>
                        </div>
                        <span class="text-[11px] text-slate-500 mt-2">Buku kerja Excel dengan multi-sheet untuk setiap tabel database.</span>
                    </label>

                    <!-- Format ZIP of CSVs -->
                    <label class="relative flex flex-col p-4 rounded-xl border border-slate-200 cursor-pointer hover:border-emerald-500 transition bg-slate-50/50 has-[:checked]:border-emerald-600 has-[:checked]:bg-emerald-50/30">
                        <div class="flex items-center gap-2">
                            <input type="radio" name="format" value="zip" class="text-emerald-600 focus:ring-emerald-500">
                            <span class="text-xs font-bold text-slate-900">ZIP File (.zip berisi CSV)</span>
                        </div>
                        <span class="text-[11px] text-slate-500 mt-2">Kumpulan file CSV per tabel dengan encoding UTF-8 BOM.</span>
                    </label>

                    <!-- Single Table CSV -->
                    <label class="relative flex flex-col p-4 rounded-xl border border-slate-200 cursor-pointer hover:border-emerald-500 transition bg-slate-50/50 has-[:checked]:border-emerald-600 has-[:checked]:bg-emerald-50/30">
                        <div class="flex items-center gap-2">
                            <input type="radio" name="format" value="csv" class="text-emerald-600 focus:ring-emerald-500">
                            <span class="text-xs font-bold text-slate-900">Single File CSV (.csv)</span>
                        </div>
                        <span class="text-[11px] text-slate-500 mt-2">Ekspor tabel tertentu langsung ke file .csv satuan.</span>
                    </label>
                </div>

                <!-- Scope: All Tables or Specific Table -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 items-start">
                    <div class="space-y-2">
                        <label class="block text-xs font-bold text-slate-800 uppercase tracking-wider">
                            Pilih Cakupan Tabel
                        </label>
                        <select name="table" x-model="excelTargetTable" class="w-full text-xs rounded-xl border border-slate-300 p-2.5 focus:border-emerald-500 focus:ring-emerald-500 bg-white">
                            <option value="all">-- Semua Tabel (Seluruh Database) --</option>
                            @foreach($tables as $tbl)
                            <option value="{{ $tbl['name'] }}">{{ $tbl['name'] }} ({{ $tbl['rows'] }} baris)</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="space-y-2">
                        <label class="block text-xs font-bold text-slate-800 uppercase tracking-wider">
                            Tindakan
                        </label>
                        <select name="action" class="w-full text-xs rounded-xl border border-slate-300 p-2.5 focus:border-emerald-500 focus:ring-emerald-500 bg-white">
                            <option value="download">Download File Langsung ke Komputer</option>
                            <option value="save">Simpan File Backup ke Server</option>
                        </select>
                    </div>
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="inline-flex items-center gap-2 px-6 py-3 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-extrabold transition shadow-md hover:shadow-lg">
                        <i data-lucide="file-spreadsheet" class="w-4 h-4"></i>
                        <span>Proses Export Excel</span>
                    </button>
                </div>
            </form>
        </div>

        <!-- TAB CONTENT 3: IMPORT / RESTORE MYSQL (.SQL) -->
        <div x-show="activeTab === 'import_sql'" class="p-6 sm:p-8 space-y-6">
            <div class="border-b border-slate-100 pb-4">
                <h3 class="text-base font-extrabold text-slate-900 flex items-center gap-2 text-rose-600">
                    <i data-lucide="upload" class="w-5 h-5"></i>
                    <span>Import & Restore Database MySQL (.sql)</span>
                </h3>
                <p class="text-xs text-slate-500 mt-1">
                    Upload file SQL dump untuk merestore seluruh tabel dan data ke dalam database.
                </p>
            </div>

            <!-- Caution Banner -->
            <div class="p-4 rounded-xl bg-amber-50 border border-amber-200 text-amber-900 text-xs flex items-start gap-3">
                <i data-lucide="alert-triangle" class="w-5 h-5 text-amber-600 shrink-0 mt-0.5"></i>
                <div class="space-y-1">
                    <strong class="font-extrabold block">Perhatian Sebelum Melakukan Restore:</strong>
                    <p class="text-amber-800">
                        Proses restore akan menjalankan perintah SQL dari file yang diunggah. Jika file berisi perintah <code class="bg-amber-100 px-1 py-0.5 rounded text-[11px]">DROP TABLE</code> atau <code class="bg-amber-100 px-1 py-0.5 rounded text-[11px]">TRUNCATE</code>, data lama akan digantikan. Pastikan Anda telah membuat backup data saat ini sebelum melanjutkan.
                    </p>
                </div>
            </div>

            <form action="{{ route('admin.backup.import-sql') }}" method="POST" enctype="multipart/form-data" @submit="confirmSqlRestore($event)" class="space-y-6">
                @csrf

                <div class="space-y-2">
                    <label class="block text-xs font-bold text-slate-800 uppercase tracking-wider">
                        Pilih File Backup MySQL (.sql)
                    </label>
                    <input type="file" name="sql_file" required accept=".sql,.txt"
                        class="w-full text-xs text-slate-600 file:mr-3 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-rose-50 file:text-rose-600 hover:file:bg-rose-100 cursor-pointer border border-slate-300 rounded-xl bg-slate-50 p-1.5 focus:outline-none focus:ring-2 focus:ring-rose-500">
                    <p class="text-[11px] text-slate-400">Ukuran file maksimal: 100 MB.</p>
                </div>

                <div class="p-4 rounded-xl bg-slate-50 border border-slate-200">
                    <label class="flex items-center gap-2 cursor-pointer text-xs font-semibold text-slate-700">
                        <input type="checkbox" required class="rounded text-rose-600 focus:ring-rose-500">
                        <span>Saya memahami risiko dan mengonfirmasi untuk merestore database dari file SQL ini.</span>
                    </label>
                </div>

                <div class="flex justify-end">
                    <button type="submit" :disabled="isRestoringSql" class="inline-flex items-center gap-2 px-6 py-3 rounded-xl bg-rose-600 hover:bg-rose-700 disabled:opacity-60 text-white text-xs font-extrabold transition shadow-md hover:shadow-lg">
                        <i data-lucide="refresh-cw" class="w-4 h-4" :class="isRestoringSql ? 'animate-spin' : ''"></i>
                        <span x-text="isRestoringSql ? 'Sedang Memproses Restore Database...' : 'Mulai Restore Database MySQL'"></span>
                    </button>
                </div>
            </form>
        </div>

        <!-- TAB CONTENT 4: IMPORT EXCEL (.XLSX / .CSV) -->
        <div x-show="activeTab === 'import_excel'" class="p-6 sm:p-8 space-y-6">
            <div class="border-b border-slate-100 pb-4">
                <h3 class="text-base font-extrabold text-slate-900 flex items-center gap-2 text-teal-600">
                    <i data-lucide="file-up" class="w-5 h-5"></i>
                    <span>Import Data dari File Excel (.xlsx / .csv / .zip)</span>
                </h3>
                <p class="text-xs text-slate-500 mt-1">
                    Unggah file Excel atau CSV untuk memasukkan data ke tabel tertentu atau seluruh tabel database.
                </p>
            </div>

            <form action="{{ route('admin.backup.import-excel') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf

                <div class="space-y-2">
                    <label class="block text-xs font-bold text-slate-800 uppercase tracking-wider">
                        Pilih File Excel / CSV / ZIP
                    </label>
                    <input type="file" name="excel_file" required accept=".xlsx,.csv,.zip"
                        class="w-full text-xs text-slate-600 file:mr-3 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-teal-50 file:text-teal-600 hover:file:bg-teal-100 cursor-pointer border border-slate-300 rounded-xl bg-slate-50 p-1.5 focus:outline-none focus:ring-2 focus:ring-teal-500">
                    <p class="text-[11px] text-slate-400">Format yang didukung: <strong>.xlsx</strong> (Excel OpenXML), <strong>.csv</strong> (Spreadsheet), <strong>.zip</strong> (Arsip CSV multi-tabel).</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <!-- Target Table -->
                    <div class="space-y-2">
                        <label class="block text-xs font-bold text-slate-800 uppercase tracking-wider">
                            Target Tabel Database
                        </label>
                        <select name="target_table" class="w-full text-xs rounded-xl border border-slate-300 p-2.5 focus:border-teal-500 focus:ring-teal-500 bg-white">
                            <option value="">-- Otomatis (Berdasarkan Nama Sheet / Nama File) --</option>
                            @foreach($tables as $tbl)
                            <option value="{{ $tbl['name'] }}">{{ $tbl['name'] }}</option>
                            @endforeach
                        </select>
                        <span class="text-[11px] text-slate-400 block">Pilih jika Anda mengunggah file CSV tunggal untuk tabel tertentu.</span>
                    </div>

                    <!-- Mode -->
                    <div class="space-y-2">
                        <label class="block text-xs font-bold text-slate-800 uppercase tracking-wider">
                            Metode Import Data
                        </label>
                        <select name="mode" class="w-full text-xs rounded-xl border border-slate-300 p-2.5 focus:border-teal-500 focus:ring-teal-500 bg-white">
                            <option value="append">Tambah Data Baru (Append / Sisipkan)</option>
                            <option value="replace">Kosongkan Tabel Lalu Isi Ulang (Truncate & Replace)</option>
                        </select>
                    </div>
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="inline-flex items-center gap-2 px-6 py-3 rounded-xl bg-teal-600 hover:bg-teal-700 text-white text-xs font-extrabold transition shadow-md hover:shadow-lg">
                        <i data-lucide="upload" class="w-4 h-4"></i>
                        <span>Mulai Import Data Excel</span>
                    </button>
                </div>
            </form>
        </div>

        <!-- TAB CONTENT 5: SERVER SYNC (PULL FROM RAILWAY TO LOCAL) -->
        <div x-show="activeTab === 'server_sync'" class="p-6 sm:p-8 space-y-6">
            <div class="border-b border-slate-100 pb-4">
                <div class="flex items-center gap-2 text-indigo-600">
                    <i data-lucide="cloud-download" class="w-5 h-5"></i>
                    <h3 class="text-base font-extrabold text-slate-900">
                        Sinkronisasi Otomatis Server Online (Railway) ➔ Localhost
                    </h3>
                </div>
                <p class="text-xs text-slate-500 mt-1">
                    Tarik data database MySQL dan seluruh aset gambar/media (<code class="bg-slate-100 px-1 py-0.5 rounded text-[11px]">storage/app/public</code>) dari server produksi online ke komputer lokal Anda dengan proses bertahap anti-timeout dan indikator progress real-time.
                </p>
            </div>

            <!-- Notice & How it Works -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="p-4 rounded-xl bg-indigo-50/70 border border-indigo-100 space-y-1.5">
                    <div class="flex items-center gap-2 font-bold text-xs text-indigo-900">
                        <i data-lucide="database" class="w-4 h-4 text-indigo-600"></i>
                        <span>1. Database MySQL Ringan & Cepat</span>
                    </div>
                    <p class="text-[11px] text-indigo-800 leading-relaxed">
                        Data riil seperti leads konsultasi, produk, cabang, dan pengaturan terbaru diunduh dan diimpor dalam hitungan detik.
                    </p>
                </div>

                <div class="p-4 rounded-xl bg-purple-50/70 border border-purple-100 space-y-1.5">
                    <div class="flex items-center gap-2 font-bold text-xs text-purple-900">
                        <i data-lucide="images" class="w-4 h-4 text-purple-600"></i>
                        <span>2. File Aset Terpisah (Anti Timeout)</span>
                    </div>
                    <p class="text-[11px] text-purple-800 leading-relaxed">
                        Foto produk dan aset media diunduh dalam tahapan terpisah sehingga tidak menyebabkan koneksi web terputus.
                    </p>
                </div>

                <div class="p-4 rounded-xl bg-emerald-50/70 border border-emerald-100 space-y-1.5">
                    <div class="flex items-center gap-2 font-bold text-xs text-emerald-900">
                        <i data-lucide="gauge" class="w-4 h-4 text-emerald-600"></i>
                        <span>3. Progress Bar & Log Real-Time</span>
                    </div>
                    <p class="text-[11px] text-emerald-800 leading-relaxed">
                        Pantau persentase loading, kecepatan transfer, waktu berjalan, dan status tiap tahapan secara langsung.
                    </p>
                </div>
            </div>

            <!-- Configuration Form -->
            <div class="space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <!-- Server URL -->
                    <div class="space-y-2">
                        <label class="block text-xs font-bold text-slate-800 uppercase tracking-wider">
                            URL Server Online Produksi / Railway
                        </label>
                        <input type="url" x-model="syncServerUrl" :disabled="syncState === 'running'" required
                            placeholder="https://ortotik-production.up.railway.app"
                            class="w-full text-xs rounded-xl border border-slate-300 p-2.5 focus:border-indigo-500 focus:ring-indigo-500 bg-white font-mono disabled:bg-slate-100">
                        <p class="text-[11px] text-slate-400">Masukkan domain web Railway Anda (contoh: <code class="bg-slate-100 px-1 py-0.5 rounded">https://ortotik-production.up.railway.app</code>).</p>
                    </div>

                    <!-- Secret Token -->
                    <div class="space-y-2">
                        <div class="flex items-center justify-between">
                            <label class="block text-xs font-bold text-slate-800 uppercase tracking-wider">
                                Secret Sync Token
                            </label>
                            <span class="text-[11px] text-slate-400 font-mono">SYNC_SECRET_TOKEN</span>
                        </div>
                        <div class="relative">
                            <input :type="showSyncToken ? 'text' : 'password'" x-model="syncSecretToken" :disabled="syncState === 'running'" required
                                placeholder="Masukkan token rahasia sinkronisasi..."
                                class="w-full text-xs rounded-xl border border-slate-300 p-2.5 pr-10 focus:border-indigo-500 focus:ring-indigo-500 bg-white font-mono disabled:bg-slate-100">
                            <button type="button" @click="showSyncToken = !showSyncToken" class="absolute right-3 top-2.5 text-slate-400 hover:text-slate-600">
                                <i data-lucide="eye" class="w-4 h-4" x-show="!showSyncToken"></i>
                                <i data-lucide="eye-off" class="w-4 h-4" x-show="showSyncToken"></i>
                            </button>
                        </div>
                        <p class="text-[11px] text-slate-400">Harus sama dengan nilai variabel <code class="text-indigo-600 font-bold">SYNC_SECRET_TOKEN</code> di file <code class="bg-slate-100 px-1 py-0.5 rounded">.env</code> server.</p>
                    </div>
                </div>

                <!-- Test Connection Button & Result Box -->
                <div class="space-y-3">
                    <div class="flex items-center gap-3">
                        <button type="button" @click="testConnection()" :disabled="isTestingSync || syncState === 'running'"
                            class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-slate-100 hover:bg-slate-200 disabled:opacity-50 text-slate-700 text-xs font-bold transition">
                            <i data-lucide="wifi" class="w-3.5 h-3.5" :class="isTestingSync ? 'animate-pulse text-indigo-600' : ''"></i>
                            <span x-text="isTestingSync ? 'Menguji Koneksi...' : 'Uji Koneksi ke Server'"></span>
                        </button>
                    </div>

                    <!-- Connection Test Result Box -->
                    <template x-if="syncTestResult">
                        <div :class="syncTestResult.success ? 'bg-emerald-50 border-emerald-200 text-emerald-900' : 'bg-rose-50 border-rose-200 text-rose-900'"
                             class="p-4 rounded-xl border text-xs space-y-2">
                            <div class="flex items-center gap-2 font-bold">
                                <i data-lucide="check-circle" class="w-4 h-4 text-emerald-600" x-show="syncTestResult.success"></i>
                                <i data-lucide="alert-circle" class="w-4 h-4 text-rose-600" x-show="!syncTestResult.success"></i>
                                <span x-text="syncTestResult.message"></span>
                            </div>
                            <template x-if="syncTestResult.server_info && syncTestResult.server_info.data">
                                <div class="grid grid-cols-2 sm:grid-cols-4 gap-2 pt-2 border-t border-emerald-200/60 text-[11px]">
                                    <div><span class="text-emerald-700 font-semibold">Tabel Database:</span> <span class="font-bold font-mono" x-text="syncTestResult.server_info.data.database_tables"></span></div>
                                    <div><span class="text-emerald-700 font-semibold">Total Baris:</span> <span class="font-bold font-mono" x-text="syncTestResult.server_info.data.database_rows"></span></div>
                                    <div><span class="text-emerald-700 font-semibold">Ukuran DB:</span> <span class="font-bold font-mono" x-text="syncTestResult.server_info.data.database_size"></span></div>
                                    <div><span class="text-emerald-700 font-semibold">Aset Storage:</span> <span class="font-bold font-mono" x-text="syncTestResult.server_info.data.assets_count + ' file (' + syncTestResult.server_info.data.assets_size + ')'"></span></div>
                                </div>
                            </template>
                        </div>
                    </template>
                </div>

                <!-- Sync Scope Checkboxes -->
                <div class="p-4 rounded-xl bg-slate-50 border border-slate-200 space-y-3">
                    <span class="text-xs font-bold text-slate-800 uppercase tracking-wider block">Pilih Komponen yang Ingin Ditarik & Disinkronkan:</span>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 text-xs">
                        <label class="flex items-start gap-2.5 p-3 rounded-lg bg-white border border-slate-200 cursor-pointer hover:border-indigo-400 transition" :class="syncState === 'running' ? 'opacity-60 pointer-events-none' : ''">
                            <input type="checkbox" x-model="syncDbSelected" :disabled="syncState === 'running'" class="mt-0.5 rounded text-indigo-600 focus:ring-indigo-500">
                            <div>
                                <span class="font-bold text-slate-900 block">Database MySQL Lengkap (.sql)</span>
                                <span class="text-[11px] text-slate-500">Menimpa database local dengan seluruh isi tabel riil dari server online.</span>
                            </div>
                        </label>

                        <label class="flex items-start gap-2.5 p-3 rounded-lg bg-white border border-slate-200 cursor-pointer hover:border-indigo-400 transition" :class="syncState === 'running' ? 'opacity-60 pointer-events-none' : ''">
                            <input type="checkbox" x-model="syncAssetsSelected" :disabled="syncState === 'running'" class="mt-0.5 rounded text-indigo-600 focus:ring-indigo-500">
                            <div>
                                <span class="font-bold text-slate-900 block">Aset Media & Gambar (<code class="text-[10px]">storage/app/public</code>)</span>
                                <span class="text-[11px] text-slate-500">Mengunduh seluruh foto produk, gambar artikel, banner hero, dan file upload dari server.</span>
                            </div>
                        </label>
                    </div>
                </div>

                <!-- Confirmation Checkbox -->
                <div class="p-4 rounded-xl bg-amber-50 border border-amber-200">
                    <label class="flex items-center gap-2 cursor-pointer text-xs font-semibold text-amber-900">
                        <input type="checkbox" x-model="syncConfirmed" :disabled="syncState === 'running'" required class="rounded text-indigo-600 focus:ring-indigo-500">
                        <span>Saya mengonfirmasi untuk menimpa data dan aset media di local saya dengan versi terbaru dari server online.</span>
                    </label>
                </div>

                <!-- LIVE PROGRESS & STATUS DASHBOARD (Shown when sync is active / completed / errored) -->
                <div x-show="syncState !== 'idle'" x-transition class="p-5 sm:p-6 rounded-2xl border bg-slate-900 text-white space-y-5 shadow-lg">
                    <!-- Header with Title & Percentage -->
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 border-b border-slate-800 pb-4">
                        <div class="flex items-center gap-3">
                            <div class="w-9 h-9 rounded-xl flex items-center justify-center font-bold text-sm"
                                :class="{
                                    'bg-indigo-500 text-white animate-pulse': syncState === 'running',
                                    'bg-emerald-500 text-white': syncState === 'success',
                                    'bg-rose-500 text-white': syncState === 'error'
                                }">
                                <i data-lucide="loader-2" class="w-5 h-5 animate-spin" x-show="syncState === 'running'"></i>
                                <i data-lucide="check" class="w-5 h-5" x-show="syncState === 'success'"></i>
                                <i data-lucide="alert-triangle" class="w-5 h-5" x-show="syncState === 'error'"></i>
                            </div>
                            <div>
                                <h4 class="text-xs sm:text-sm font-extrabold text-white flex items-center gap-2">
                                    <span x-text="syncState === 'running' ? 'Sedang Melakukan Sinkronisasi Bertahap...' : (syncState === 'success' ? 'Sinkronisasi Selesai 100%' : 'Sinkronisasi Gagal')"></span>
                                </h4>
                                <p class="text-[11px] text-slate-400 font-mono mt-0.5" x-text="stepStatusText"></p>
                            </div>
                        </div>
                        <div class="flex items-center gap-3">
                            <div class="text-right">
                                <span class="text-[10px] text-slate-400 uppercase font-bold block">Waktu Berjalan</span>
                                <span class="text-xs font-mono font-bold text-indigo-300" x-text="formatSeconds(syncElapsedSeconds)"></span>
                            </div>
                            <div class="px-3.5 py-1.5 rounded-xl bg-slate-800 border border-slate-700 font-mono font-extrabold text-sm text-indigo-400">
                                <span x-text="progressPercent"></span>%
                            </div>
                        </div>
                    </div>

                    <!-- Visual Progress Bar -->
                    <div class="space-y-1.5">
                        <div class="w-full bg-slate-800 rounded-full h-3.5 p-0.5 overflow-hidden border border-slate-700/80">
                            <div class="h-full rounded-full transition-all duration-500 ease-out flex items-center justify-end pr-2 text-[9px] font-mono font-bold"
                                :class="{
                                    'bg-gradient-to-r from-indigo-500 via-sky-500 to-indigo-400 animate-pulse': syncState === 'running',
                                    'bg-gradient-to-r from-emerald-500 to-teal-400': syncState === 'success',
                                    'bg-gradient-to-r from-rose-600 to-rose-400': syncState === 'error'
                                }"
                                :style="'width: ' + progressPercent + '%'">
                            </div>
                        </div>
                    </div>

                    <!-- 4-Step Checklist Indicator -->
                    <div class="grid grid-cols-1 sm:grid-cols-4 gap-2 text-xs">
                        <!-- Step 1 -->
                        <div class="p-2.5 rounded-xl border flex items-center gap-2"
                            :class="currentStep > 1 ? 'bg-emerald-950/40 border-emerald-500/30 text-emerald-300' : (currentStep === 1 ? 'bg-indigo-950/60 border-indigo-500/50 text-indigo-200' : 'bg-slate-800/40 border-slate-800 text-slate-500')">
                            <i data-lucide="check-circle" class="w-4 h-4 text-emerald-400 shrink-0" x-show="currentStep > 1"></i>
                            <i data-lucide="loader-2" class="w-4 h-4 text-indigo-400 animate-spin shrink-0" x-show="currentStep === 1 && syncState === 'running'"></i>
                            <i data-lucide="circle" class="w-4 h-4 text-slate-600 shrink-0" x-show="currentStep < 1"></i>
                            <span class="text-[11px] font-semibold truncate">1. Uji Koneksi</span>
                        </div>

                        <!-- Step 2 -->
                        <div class="p-2.5 rounded-xl border flex items-center gap-2"
                            :class="currentStep > 2 ? 'bg-emerald-950/40 border-emerald-500/30 text-emerald-300' : (currentStep === 2 ? 'bg-indigo-950/60 border-indigo-500/50 text-indigo-200' : 'bg-slate-800/40 border-slate-800 text-slate-500')">
                            <i data-lucide="check-circle" class="w-4 h-4 text-emerald-400 shrink-0" x-show="currentStep > 2"></i>
                            <i data-lucide="loader-2" class="w-4 h-4 text-indigo-400 animate-spin shrink-0" x-show="currentStep === 2 && syncState === 'running'"></i>
                            <i data-lucide="circle" class="w-4 h-4 text-slate-600 shrink-0" x-show="currentStep < 2"></i>
                            <span class="text-[11px] font-semibold truncate">2. Sinkron Database</span>
                        </div>

                        <!-- Step 3 -->
                        <div class="p-2.5 rounded-xl border flex items-center gap-2"
                            :class="currentStep > 3 ? 'bg-emerald-950/40 border-emerald-500/30 text-emerald-300' : (currentStep === 3 ? 'bg-indigo-950/60 border-indigo-500/50 text-indigo-200' : 'bg-slate-800/40 border-slate-800 text-slate-500')">
                            <i data-lucide="check-circle" class="w-4 h-4 text-emerald-400 shrink-0" x-show="currentStep > 3"></i>
                            <i data-lucide="loader-2" class="w-4 h-4 text-indigo-400 animate-spin shrink-0" x-show="currentStep === 3 && syncState === 'running'"></i>
                            <i data-lucide="circle" class="w-4 h-4 text-slate-600 shrink-0" x-show="currentStep < 3"></i>
                            <span class="text-[11px] font-semibold truncate">3. Sinkron Aset</span>
                        </div>

                        <!-- Step 4 -->
                        <div class="p-2.5 rounded-xl border flex items-center gap-2"
                            :class="syncState === 'success' ? 'bg-emerald-950/40 border-emerald-500/30 text-emerald-300' : 'bg-slate-800/40 border-slate-800 text-slate-500'">
                            <i data-lucide="check-circle" class="w-4 h-4 text-emerald-400 shrink-0" x-show="syncState === 'success'"></i>
                            <i data-lucide="circle" class="w-4 h-4 text-slate-600 shrink-0" x-show="syncState !== 'success'"></i>
                            <span class="text-[11px] font-semibold truncate">4. Selesai</span>
                        </div>
                    </div>

                    <!-- Live Activity Console -->
                    <div class="space-y-1.5">
                        <div class="flex items-center justify-between text-[10px] text-slate-400 uppercase font-bold px-1">
                            <span>Log Aktivitas Real-Time</span>
                            <span class="font-mono" x-text="syncLogs.length + ' event'"></span>
                        </div>
                        <div id="sync-console-output" class="h-36 overflow-y-auto bg-slate-950 p-3 rounded-xl border border-slate-800 font-mono text-[11px] space-y-1 leading-relaxed text-slate-300">
                            <template x-for="(log, idx) in syncLogs" :key="idx">
                                <div class="flex items-start gap-2">
                                    <span class="text-slate-500 shrink-0" x-text="'[' + log.time + ']'"></span>
                                    <span :class="{
                                        'text-emerald-400 font-semibold': log.type === 'success',
                                        'text-rose-400 font-semibold': log.type === 'error',
                                        'text-amber-400': log.type === 'warning',
                                        'text-slate-300': log.type === 'info'
                                    }" x-text="log.text"></span>
                                </div>
                            </template>
                        </div>
                    </div>

                    <!-- Error Diagnostic Card (When error occurs) -->
                    <template x-if="syncError">
                        <div class="p-4 rounded-xl bg-rose-950/60 border border-rose-500/50 text-rose-200 text-xs space-y-3">
                            <div class="flex items-center gap-2 font-bold text-rose-300 text-sm">
                                <i data-lucide="alert-octagon" class="w-5 h-5 text-rose-400 shrink-0"></i>
                                <span x-text="syncError.title"></span>
                            </div>
                            <p class="text-[11px] leading-relaxed text-rose-200" x-text="syncError.detail"></p>

                            <template x-if="syncError.suggestions && syncError.suggestions.length > 0">
                                <div class="pt-2 border-t border-rose-800/60 space-y-1 text-[11px]">
                                    <span class="font-bold text-rose-300 uppercase tracking-wider block text-[10px]">💡 Saran Solusi & Pemecahan Masalah:</span>
                                    <ul class="list-disc list-inside space-y-1 text-rose-100">
                                        <template x-for="(sug, sIdx) in syncError.suggestions" :key="sIdx">
                                            <li x-text="sug"></li>
                                        </template>
                                    </ul>
                                </div>
                            </template>
                        </div>
                    </template>

                    <!-- Success Summary Card -->
                    <template x-if="syncSuccessSummary">
                        <div class="p-4 rounded-xl bg-emerald-950/60 border border-emerald-500/40 text-emerald-200 text-xs space-y-2">
                            <div class="flex items-center gap-2 font-bold text-emerald-300 text-sm">
                                <i data-lucide="badge-check" class="w-5 h-5 text-emerald-400 shrink-0"></i>
                                <span>Sinkronisasi Sukses Sempurna!</span>
                            </div>
                            <p class="text-[11px] text-emerald-100 leading-relaxed">
                                Seluruh data database MySQL dan berkas aset media dari server online Railway telah diperbarui ke local Anda dalam waktu <strong class="font-mono text-white" x-text="syncSuccessSummary.duration"></strong>.
                            </p>
                        </div>
                    </template>
                </div>

                <!-- Submit / Action Buttons -->
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 pt-2">
                    <p class="text-[11px] text-slate-400">
                        💡 <strong>Tips:</strong> Anda juga bisa menjalankan sinkronisasi via terminal: <code class="bg-slate-100 px-1.5 py-0.5 rounded font-mono text-indigo-600 font-bold">php artisan server:pull</code>
                    </p>
                    <div class="flex items-center gap-2">
                        <button type="button" @click="startStepSync()" :disabled="syncState === 'running'"
                            class="inline-flex items-center justify-center gap-2 px-6 py-3 rounded-xl bg-indigo-600 hover:bg-indigo-700 disabled:opacity-60 text-white text-xs font-extrabold transition shadow-md hover:shadow-lg">
                            <i data-lucide="cloud-download" class="w-4 h-4" :class="syncState === 'running' ? 'animate-bounce' : ''"></i>
                            <span x-text="syncState === 'running' ? 'Sedang Mensinkronkan Bertahap...' : (syncState === 'success' ? '🔄 Sinkronkan Ulang' : '🚀 Mulai Sinkronisasi Bertahap Sekarang')"></span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- STORED BACKUP HISTORY TABLE -->
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden space-y-4 p-6 sm:p-8">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 border-b border-slate-100 pb-4">
            <div>
                <h3 class="text-base font-extrabold text-slate-900 flex items-center gap-2">
                    <i data-lucide="folder-archive" class="w-5 h-5 text-medical-600"></i>
                    <span>Riwayat File Backup di Server</span>
                </h3>
                <p class="text-xs text-slate-500 mt-0.5">Daftar file pencadangan yang tersimpan di direktori server (<code class="bg-slate-100 px-1 py-0.5 rounded text-[11px]">storage/app/backups</code>).</p>
            </div>

            @if(count($backups) > 0)
            <form action="{{ route('admin.backup.clean-all') }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus SEMUA file backup di server?')" class="inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="inline-flex items-center gap-1.5 px-3.5 py-2 rounded-xl text-rose-600 hover:bg-rose-50 border border-rose-200 text-xs font-bold transition">
                    <i data-lucide="trash-2" class="w-3.5 h-3.5"></i>
                    <span>Bersihkan Semua Backup</span>
                </button>
            </form>
            @endif
        </div>

        @if(count($backups) > 0)
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs border-collapse">
                <thead>
                    <tr class="border-b border-slate-200 bg-slate-50/80 text-[11px] font-bold text-slate-500 uppercase tracking-wider">
                        <th class="py-3 px-4">Nama File</th>
                        <th class="py-3 px-4">Tipe Format</th>
                        <th class="py-3 px-4">Ukuran</th>
                        <th class="py-3 px-4">Waktu Dibuat</th>
                        <th class="py-3 px-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 font-medium">
                    @foreach($backups as $file)
                    <tr class="hover:bg-slate-50/70 transition">
                        <td class="py-3.5 px-4">
                            <div class="flex items-center gap-2.5">
                                <div class="w-8 h-8 rounded-lg bg-slate-100 text-slate-600 flex items-center justify-center shrink-0">
                                    <i data-lucide="{{ $file['icon'] }}" class="w-4 h-4"></i>
                                </div>
                                <span class="font-bold text-slate-900 truncate max-w-xs">{{ $file['filename'] }}</span>
                            </div>
                        </td>
                        <td class="py-3.5 px-4">
                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[11px] font-bold bg-slate-100 text-slate-700">
                                {{ $file['type'] }}
                            </span>
                        </td>
                        <td class="py-3.5 px-4 font-mono font-semibold text-slate-600">
                            {{ $file['formatted_size'] }}
                        </td>
                        <td class="py-3.5 px-4">
                            <span class="text-slate-900 block font-semibold">{{ $file['created_at'] }}</span>
                            <span class="text-[11px] text-slate-400">{{ $file['created_human'] }}</span>
                        </td>
                        <td class="py-3.5 px-4 text-right">
                            <div class="inline-flex items-center gap-1.5">
                                <!-- Download Button -->
                                <a href="{{ route('admin.backup.download', $file['filename']) }}"
                                    class="p-2 rounded-xl bg-medical-50 text-medical-600 hover:bg-medical-100 transition"
                                    title="Download File">
                                    <i data-lucide="download" class="w-4 h-4"></i>
                                </a>

                                <!-- Restore Button (for SQL or Excel) -->
                                <form action="{{ route('admin.backup.restore', $file['filename']) }}" method="POST" class="inline"
                                    onsubmit="return confirm('PERINGATAN: Apakah Anda yakin ingin merestore database dari file `{{ $file['filename'] }}`?')">
                                    @csrf
                                    <button type="submit"
                                        class="p-2 rounded-xl bg-emerald-50 text-emerald-600 hover:bg-emerald-100 transition"
                                        title="Restore Database dari File Ini">
                                        <i data-lucide="refresh-cw" class="w-4 h-4"></i>
                                    </button>
                                </form>

                                <!-- Delete Button -->
                                <form action="{{ route('admin.backup.destroy', $file['filename']) }}" method="POST" class="inline"
                                    onsubmit="return confirm('Hapus file backup `{{ $file['filename'] }}`?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="p-2 rounded-xl bg-rose-50 text-rose-600 hover:bg-rose-100 transition"
                                        title="Hapus File">
                                        <i data-lucide="trash-2" class="w-4 h-4"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
        <div class="text-center py-10 px-4 bg-slate-50 rounded-2xl border border-dashed border-slate-200">
            <div class="w-12 h-12 rounded-2xl bg-slate-100 text-slate-400 mx-auto flex items-center justify-center mb-3">
                <i data-lucide="archive" class="w-6 h-6"></i>
            </div>
            <h4 class="text-xs font-bold text-slate-800">Belum ada file backup di server</h4>
            <p class="text-[11px] text-slate-500 max-w-sm mx-auto mt-1">
                Gunakan tombol di atas atau fitur export untuk membuat pencadangan data pertama Anda.
            </p>
        </div>
        @endif
    </div>

    <!-- DATABASE TABLES BREAKDOWN (COLLAPSIBLE) -->
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden" x-data="{ showTables: false }">
        <button type="button" @click="showTables = !showTables" class="w-full p-6 flex items-center justify-between hover:bg-slate-50 transition text-left">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-slate-100 text-slate-700 flex items-center justify-center font-bold">
                    <i data-lucide="database" class="w-5 h-5"></i>
                </div>
                <div>
                    <h3 class="text-sm font-extrabold text-slate-900">Rincian Seluruh Tabel Database ({{ count($tables) }} Tabel)</h3>
                    <p class="text-xs text-slate-500">Klik untuk melihat status jumlah baris, ukuran tabel, dan opsi export per tabel.</p>
                </div>
            </div>
            <div class="flex items-center gap-2 text-slate-400">
                <span class="text-xs font-bold" x-text="showTables ? 'Tutup Rincian' : 'Buka Rincian'"></span>
                <i data-lucide="chevron-down" class="w-4 h-4 transition-transform duration-200" :class="showTables ? 'rotate-180' : ''"></i>
            </div>
        </button>

        <div x-show="showTables" x-collapse class="border-t border-slate-200 p-6 space-y-4">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs border-collapse">
                    <thead>
                        <tr class="border-b border-slate-200 bg-slate-50 text-[11px] font-bold text-slate-500 uppercase tracking-wider">
                            <th class="py-2.5 px-4">Nama Tabel</th>
                            <th class="py-2.5 px-4">Engine</th>
                            <th class="py-2.5 px-4">Jumlah Baris</th>
                            <th class="py-2.5 px-4">Ukuran Data</th>
                            <th class="py-2.5 px-4">Collation</th>
                            <th class="py-2.5 px-4 text-right">Quick Export</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @foreach($tables as $tbl)
                        <tr class="hover:bg-slate-50 transition">
                            <td class="py-3 px-4 font-bold text-slate-900 font-mono">{{ $tbl['name'] }}</td>
                            <td class="py-3 px-4 text-slate-500">{{ $tbl['engine'] }}</td>
                            <td class="py-3 px-4 font-semibold text-slate-800">{{ number_format($tbl['rows']) }}</td>
                            <td class="py-3 px-4 text-slate-600 font-mono">{{ $tbl['formatted_size'] }}</td>
                            <td class="py-3 px-4 text-[11px] text-slate-400 font-mono">{{ $tbl['collation'] }}</td>
                            <td class="py-3 px-4 text-right space-x-1.5">
                                <form action="{{ route('admin.backup.export-excel') }}" method="POST" class="inline">
                                    @csrf
                                    <input type="hidden" name="table" value="{{ $tbl['name'] }}">
                                    <input type="hidden" name="format" value="xlsx">
                                    <button type="submit" title="Export {{ $tbl['name'] }} ke Excel (.xlsx)" class="px-2.5 py-1 rounded-lg bg-emerald-50 text-emerald-700 hover:bg-emerald-100 text-[11px] font-bold transition">
                                        Excel (.xlsx)
                                    </button>
                                </form>
                                <form action="{{ route('admin.backup.export-excel') }}" method="POST" class="inline">
                                    @csrf
                                    <input type="hidden" name="table" value="{{ $tbl['name'] }}">
                                    <input type="hidden" name="format" value="csv">
                                    <button type="submit" title="Export {{ $tbl['name'] }} ke CSV" class="px-2.5 py-1 rounded-lg bg-teal-50 text-teal-700 hover:bg-teal-100 text-[11px] font-bold transition">
                                        CSV
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

<script>
    function backupManager() {
        return {
            activeTab: '{{ request('tab', session('active_tab', 'export_sql')) }}',
            isRestoringSql: false,
            excelTargetTable: 'all',
            selectedSqlTables: @json(array_column($tables, 'name')),
            
            // Server Sync properties
            syncServerUrl: '{{ config('services.sync.server_url') ?: env('SYNC_SERVER_URL', '') }}',
            syncSecretToken: '{{ config('services.sync.secret_token') ?: env('SYNC_SECRET_TOKEN', '') }}',
            showSyncToken: false,
            isTestingSync: false,
            syncTestResult: null,

            // Step-by-step sync state
            syncDbSelected: true,
            syncAssetsSelected: true,
            syncConfirmed: false,
            syncState: 'idle', // 'idle' | 'running' | 'success' | 'error'
            currentStep: 0,
            progressPercent: 0,
            stepStatusText: '',
            syncError: null,
            syncSuccessSummary: null,
            syncLogs: [],
            syncTimer: null,
            syncElapsedSeconds: 0,

            selectAllTablesSql(status) {
                if (status) {
                    this.selectedSqlTables = @json(array_column($tables, 'name'));
                } else {
                    this.selectedSqlTables = [];
                }
            },

            confirmSqlRestore(event) {
                if (!confirm('PERINGATAN TINGGI:\n\nRestore database akan menjalankan query dari file yang Anda upload dan dapat menimpa data yang ada.\n\nApakah Anda yakin ingin melanjutkan?')) {
                    event.preventDefault();
                    return false;
                }
                this.isRestoringSql = true;
            },

            addLog(text, type = 'info') {
                const now = new Date();
                const time = now.toTimeString().split(' ')[0];
                this.syncLogs.push({ time, text, type });
                this.$nextTick(() => {
                    const consoleEl = document.getElementById('sync-console-output');
                    if (consoleEl) consoleEl.scrollTop = consoleEl.scrollHeight;
                });
            },

            formatSeconds(sec) {
                const m = Math.floor(sec / 60);
                const s = sec % 60;
                return (m < 10 ? '0' : '') + m + ':' + (s < 10 ? '0' : '') + s;
            },

            async testConnection() {
                if (!this.syncServerUrl || !this.syncSecretToken) {
                    alert('Harap isi URL Server dan Secret Token terlebih dahulu.');
                    return;
                }

                this.isTestingSync = true;
                this.syncTestResult = null;

                try {
                    const response = await fetch('{{ route('admin.backup.sync-test') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify({
                            server_url: this.syncServerUrl,
                            secret_token: this.syncSecretToken
                        })
                    });

                    const data = await response.json();
                    this.syncTestResult = data;
                } catch (err) {
                    this.syncTestResult = {
                        success: false,
                        message: 'Gagal terhubung ke server atau terjadi error jaringan: ' + err.message
                    };
                } finally {
                    this.isTestingSync = false;
                    this.$nextTick(() => {
                        if (window.lucide) window.lucide.createIcons();
                    });
                }
            },

            async startStepSync() {
                if (!this.syncServerUrl || !this.syncSecretToken) {
                    alert('Harap isi URL Server dan Secret Token terlebih dahulu.');
                    return;
                }
                if (!this.syncDbSelected && !this.syncAssetsSelected) {
                    alert('Pilih minimal satu opsi yang ingin disinkronkan (Database atau Aset Media).');
                    return;
                }
                if (!this.syncConfirmed) {
                    alert('Harap centang kotak konfirmasi sebelum memulai sinkronisasi.');
                    return;
                }

                if (!confirm('PERINGATAN SINKRONISASI SERVER:\n\nProses ini akan mengunduh database dan/atau aset dari server online dan MENIMPA data di local Anda secara bertahap.\n\nApakah Anda yakin ingin melanjutkan?')) {
                    return;
                }

                this.syncState = 'running';
                this.syncError = null;
                this.syncSuccessSummary = null;
                this.syncLogs = [];
                this.syncElapsedSeconds = 0;
                this.progressPercent = 5;
                this.currentStep = 1;
                this.stepStatusText = 'Menguji koneksi dan mengambil data statistik server...';

                if (this.syncTimer) clearInterval(this.syncTimer);
                this.syncTimer = setInterval(() => {
                    this.syncElapsedSeconds++;
                }, 1000);

                this.addLog('🚀 Memulai sinkronisasi server bertahap (Anti-Timeout)...');
                this.addLog('🌐 Menghubungi target: ' + this.syncServerUrl);

                let currentCsrf = '{{ csrf_token() }}';

                try {
                    // TAHAP 1: Test Connection & Get Summary
                    this.addLog('⏳ [Tahap 1/3] Menguji autentikasi dan status kesehatan server...');
                    const testRes = await fetch('{{ route('admin.backup.sync-test') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': currentCsrf,
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify({
                            server_url: this.syncServerUrl,
                            secret_token: this.syncSecretToken
                        })
                    });

                    if (testRes.status === 419) {
                        throw new Error('Sesi web Anda telah kedaluwarsa. Silakan refresh halaman ini.');
                    }

                    const testData = await testRes.json();
                    if (!testData.success) {
                        throw new Error(testData.message || 'Gagal terhubung ke server target.');
                    }

                    const serverData = testData.server_info?.data || {};
                    this.addLog('✅ [Tahap 1/3] Terhubung! Database: ' + (serverData.database_size || '-') + ' (' + (serverData.database_tables || '-') + ' tabel), Aset: ' + (serverData.assets_size || '-') + ' (' + (serverData.assets_count || 0) + ' berkas)', 'success');
                    this.progressPercent = 20;

                    let dbResult = null;
                    let assetsResult = null;

                    // TAHAP 2: Sync Database (if selected)
                    if (this.syncDbSelected) {
                        this.currentStep = 2;
                        this.stepStatusText = 'Mengunduh dan mengimpor struktur & data database MySQL...';
                        this.addLog('🗄️ [Tahap 2/3] Mengunduh arsip database SQL dari server...');

                        const dbRes = await fetch('{{ route('admin.backup.sync-step-db') }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': currentCsrf,
                                'Accept': 'application/json'
                            },
                            body: JSON.stringify({
                                server_url: this.syncServerUrl,
                                secret_token: this.syncSecretToken
                            })
                        });

                        if (dbRes.status === 419) {
                            throw new Error('Sesi kedaluwarsa (419) saat mengimpor database. Silakan refresh halaman.');
                        }

                        const dbData = await dbRes.json();
                        if (!dbData.success) {
                            const err = new Error(dbData.message || 'Gagal sinkronisasi database.');
                            err.errorInfo = dbData.error_info;
                            throw err;
                        }

                        if (dbData.csrf_token) {
                            currentCsrf = dbData.csrf_token;
                        }

                        dbResult = dbData;
                        this.addLog('✅ [Tahap 2/3] Database MySQL berhasil disinkronkan (' + (dbData.queries_executed || 0) + ' query dieksekusi dalam ' + dbData.duration_seconds + 's, ukuran: ' + (dbData.download_size_formatted || '-') + ')', 'success');
                        this.progressPercent = this.syncAssetsSelected ? 60 : 95;
                    } else {
                        this.addLog('⏭️ [Tahap 2/3] Sinkronisasi database dilewati sesuai pilihan.');
                    }

                    // TAHAP 3: Sync Assets (if selected)
                    if (this.syncAssetsSelected) {
                        this.currentStep = 3;
                        this.stepStatusText = 'Mengunduh dan menyalin berkas aset media ke storage local...';
                        this.addLog('🖼️ [Tahap 3/3] Mengunduh dan mengekstrak berkas aset media dari server...');

                        const assetsRes = await fetch('{{ route('admin.backup.sync-step-assets') }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': currentCsrf,
                                'Accept': 'application/json'
                            },
                            body: JSON.stringify({
                                server_url: this.syncServerUrl,
                                secret_token: this.syncSecretToken
                            })
                        });

                        if (assetsRes.status === 419) {
                            throw new Error('Database telah berhasil diimpor, tetapi sesi halaman perlu diperbarui. Silakan refresh halaman dan pilih "Aset Media & Gambar" saja.');
                        }

                        const assetsData = await assetsRes.json();
                        if (!assetsData.success) {
                            const err = new Error(assetsData.message || 'Gagal sinkronisasi berkas aset.');
                            err.errorInfo = assetsData.error_info;
                            throw err;
                        }

                        if (assetsData.csrf_token) {
                            currentCsrf = assetsData.csrf_token;
                        }

                        assetsResult = assetsData;
                        this.addLog('✅ [Tahap 3/3] Berkas aset media berhasil disinkronkan (' + (assetsData.assets_count || 0) + ' file disalin dalam ' + assetsData.duration_seconds + 's, ukuran: ' + (assetsData.download_size_formatted || '-') + ')', 'success');
                        this.progressPercent = 95;
                    } else {
                        this.addLog('⏭️ [Tahap 3/3] Sinkronisasi aset media dilewati sesuai pilihan.');
                    }

                    // TAHAP 4: Finalize & Complete
                    this.currentStep = 4;
                    this.progressPercent = 100;
                    this.stepStatusText = 'Sinkronisasi berhasil selesai 100%!';
                    this.syncState = 'success';
                    clearInterval(this.syncTimer);

                    this.syncSuccessSummary = {
                        duration: this.formatSeconds(this.syncElapsedSeconds),
                        dbQueries: dbResult ? dbResult.queries_executed : null,
                        dbDuration: dbResult ? dbResult.duration_seconds : null,
                        assetsCount: assetsResult ? assetsResult.assets_count : null,
                        assetsDuration: assetsResult ? assetsResult.duration_seconds : null,
                    };

                    this.addLog('🎉 SINKRONISASI BERHASIL 100%! Localhost Anda kini telah diperbarui secara penuh dengan data & aset server produksi.', 'success');

                } catch (err) {
                    if (this.syncTimer) clearInterval(this.syncTimer);
                    this.syncState = 'error';
                    this.stepStatusText = 'Sinkronisasi terhenti karena terjadi error.';
                    this.syncError = {
                        title: err.errorInfo?.title || 'Gagal Melakukan Sinkronisasi',
                        detail: err.errorInfo?.detail || err.message,
                        raw_message: err.errorInfo?.raw_message || err.message,
                        suggestions: err.errorInfo?.suggestions || [
                            'Pastikan URL Server dan SYNC_SECRET_TOKEN sudah benar.',
                            'Periksa apakah server Railway dalam kondisi aktif (Running).',
                            'Anda juga dapat mencoba perintah terminal: php artisan server:pull'
                        ]
                    };
                    this.addLog('❌ ERROR: ' + (err.errorInfo?.detail || err.message), 'error');
                } finally {
                    this.$nextTick(() => {
                        if (window.lucide) window.lucide.createIcons();
                    });
                }
            }
        }
    }
</script>
@endsection
