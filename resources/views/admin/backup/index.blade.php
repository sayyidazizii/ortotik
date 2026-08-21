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
                    Tarik data database MySQL dan seluruh aset gambar/media (<code class="bg-slate-100 px-1 py-0.5 rounded text-[11px]">storage/app/public</code>) dari server produksi online ke komputer lokal Anda dengan 1-klik sebelum mulai development.
                </p>
            </div>

            <!-- Notice & How it Works -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="p-4 rounded-xl bg-indigo-50/70 border border-indigo-100 space-y-1.5">
                    <div class="flex items-center gap-2 font-bold text-xs text-indigo-900">
                        <i data-lucide="database" class="w-4 h-4 text-indigo-600"></i>
                        <span>1. Database MySQL Sinkron</span>
                    </div>
                    <p class="text-[11px] text-indigo-800 leading-relaxed">
                        Data riil seperti leads konsultasi, produk, cabang, dan pengaturan terbaru di server akan disalin ke database local.
                    </p>
                </div>

                <div class="p-4 rounded-xl bg-purple-50/70 border border-purple-100 space-y-1.5">
                    <div class="flex items-center gap-2 font-bold text-xs text-purple-900">
                        <i data-lucide="images" class="w-4 h-4 text-purple-600"></i>
                        <span>2. File Aset & Gambar Utuh</span>
                    </div>
                    <p class="text-[11px] text-purple-800 leading-relaxed">
                        Foto produk, gambar artikel, dan banner yang diunggah di server online akan diunduh dan dipasang ke storage local.
                    </p>
                </div>

                <div class="p-4 rounded-xl bg-emerald-50/70 border border-emerald-100 space-y-1.5">
                    <div class="flex items-center gap-2 font-bold text-xs text-emerald-900">
                        <i data-lucide="shield-check" class="w-4 h-4 text-emerald-600"></i>
                        <span>3. Bebas Push Git Kapan Saja</span>
                    </div>
                    <p class="text-[11px] text-emerald-800 leading-relaxed">
                        Setelah local sinkron dengan server, Anda bisa leluasa coding dan melakukan <code class="bg-emerald-100 text-emerald-900 px-1 py-0.5 rounded text-[10px]">git push</code> tanpa khawatir merusak data online.
                    </p>
                </div>
            </div>

            <form action="{{ route('admin.backup.sync-pull') }}" method="POST" @submit="confirmServerSync($event)" class="space-y-6">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <!-- Server URL -->
                    <div class="space-y-2">
                        <label class="block text-xs font-bold text-slate-800 uppercase tracking-wider">
                            URL Server Online Produksi / Railway
                        </label>
                        <input type="url" name="server_url" x-model="syncServerUrl" required
                            placeholder="https://ortotik-production.up.railway.app"
                            class="w-full text-xs rounded-xl border border-slate-300 p-2.5 focus:border-indigo-500 focus:ring-indigo-500 bg-white font-mono">
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
                            <input :type="showSyncToken ? 'text' : 'password'" name="secret_token" x-model="syncSecretToken" required
                                placeholder="Masukkan token rahasia sinkronisasi..."
                                class="w-full text-xs rounded-xl border border-slate-300 p-2.5 pr-10 focus:border-indigo-500 focus:ring-indigo-500 bg-white font-mono">
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
                        <button type="button" @click="testConnection()" :disabled="isTestingSync"
                            class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-bold transition">
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
                        <label class="flex items-start gap-2.5 p-3 rounded-lg bg-white border border-slate-200 cursor-pointer hover:border-indigo-400 transition">
                            <input type="checkbox" name="sync_database" value="1" checked class="mt-0.5 rounded text-indigo-600 focus:ring-indigo-500">
                            <div>
                                <span class="font-bold text-slate-900 block">Database MySQL Lengkap (.sql)</span>
                                <span class="text-[11px] text-slate-500">Menimpa database local dengan seluruh isi tabel riil dari server online.</span>
                            </div>
                        </label>

                        <label class="flex items-start gap-2.5 p-3 rounded-lg bg-white border border-slate-200 cursor-pointer hover:border-indigo-400 transition">
                            <input type="checkbox" name="sync_assets" value="1" checked class="mt-0.5 rounded text-indigo-600 focus:ring-indigo-500">
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
                        <input type="checkbox" required class="rounded text-indigo-600 focus:ring-indigo-500">
                        <span>Saya mengonfirmasi untuk menimpa data dan aset media di local saya dengan versi terbaru dari server online.</span>
                    </label>
                </div>

                <!-- Submit Button -->
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                    <p class="text-[11px] text-slate-400">
                        💡 <strong>Tips:</strong> Anda juga bisa menjalankan perintah terminal: <code class="bg-slate-100 px-1.5 py-0.5 rounded font-mono text-indigo-600 font-bold">php artisan server:pull</code>
                    </p>
                    <button type="submit" :disabled="isPullingSync"
                        class="inline-flex items-center justify-center gap-2 px-6 py-3 rounded-xl bg-indigo-600 hover:bg-indigo-700 disabled:opacity-60 text-white text-xs font-extrabold transition shadow-md hover:shadow-lg">
                        <i data-lucide="cloud-download" class="w-4 h-4" :class="isPullingSync ? 'animate-bounce' : ''"></i>
                        <span x-text="isPullingSync ? 'Sedang Mengunduh & Mensinkronkan...' : 'Tarik & Sinkronkan Data Server Sekarang'"></span>
                    </button>
                </div>
            </form>
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
            isPullingSync: false,
            syncTestResult: null,

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

            confirmServerSync(event) {
                if (!confirm('PERINGATAN SINKRONISASI SERVER:\n\nProses ini akan mengunduh database dan aset dari server online dan MENIMPA database serta aset di local Anda.\n\nApakah Anda yakin ingin melanjutkan?')) {
                    event.preventDefault();
                    return false;
                }
                this.isPullingSync = true;
            }
        }
    }
</script>
@endsection
