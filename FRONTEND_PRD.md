# Product Requirement Document (PRD) - Frontend: Ortotik Website

## 1. Overview & Objective
Membangun frontend website Company Profile & E-Katalog Medis Ortotik & Prostetik berbasis **Laravel 12 Blade + Tailwind CSS + Alpine.js**. Tampilan harus profesional, clean, berstandar medis (medical grade), cepat diakses, responsif di semua perangkat, dan berorientasi konversi penjualan/konsultasi via WhatsApp.

---

## 2. Tech Stack & Styling Guidelines
- **Template Engine**: Laravel 12 Blade
- **CSS Framework**: Tailwind CSS
- **Interactivity**: Alpine.js (Dropdown, Mobile Menu, Filter Produk, Image Modal, Tab Switcher)
- **Icons**: Lucide Icons
- **Color Palette**:
  - Primary: *Medical Blue / Navy* (`#0F4C81` atau `#1E3A8A`)
  - Secondary: *Teal / Cyan* (`#0D9488` atau `#06B6D4`)
  - Neutral: Slate gray (`#F8FAFC`, `#64748B`, `#0F172A`)
  - Accent/CTA: *Emerald Green* untuk WhatsApp (`#25D366`)

---

## 3. Public User Interface Architecture

### 3.1. Header & Global Navigation
- **Top Bar**: Informasi jam operasional (Senin-Jumat 09:00-17:00), No. Telepon kantor, Email, dan link Media Sosial.
- **Main Navbar (Sticky)**:
  - **Logo Ortotik**: Brand identity kiri atas.
  - **Menu Links**:
    - **Beranda** (`/`)
    - **Layanan / Services** (`/services`): Dropdown: *Prosthetics, Bracing & Supports, Scoliosis Center, Physiotherapy, Neuro Robotic*.
    - **Produk Ready Stock** (`/products`): Dropdown / Mega menu berdasarkan kategori anatomi tubuh.
    - **Produk Custom Made** (`/custom-products`): Kaki Palsu, Tangan Palsu, Insole, Sepatu Ortopedi, Korset Skoliosis.
    - **Tentang Kami** (`/about-us`)
    - **Artikel / News** (`/news`)
    - **Hubungi Kami** (`/contact`)
  - **CTA Button**: Tombol "Konsultasi WhatsApp" (warna hijau mencolok).

---

### 3.2. Homepage Structure (`/`)
1. **Hero Section**:
   - Background Video / Slider Gambar beresolusi tinggi (Pasien bergerak aktif, alat prostetik presisi).
   - Headline: *"Reborn Your Life With Us - Solusi Ortotik & Prostetik Modern"*.
   - 2 Tombol CTA: *"Lihat Katalog Produk"* (scroll/redirect ke `/products`) dan *"Konsultasi Spesialis"* (Direct WhatsApp).
2. **Ringkasan Profil Perusahaan (About Snippet)**:
   - Pengenalan singkat kredibilitas PT Ortotik Indonesia, legalitas Kemenkes, tenaga ahli bersertifikasi.
3. **Layanan Utama (Our 5 Pillars Services Grid)**:
   - 5 Card Interaktif:
     1. *Prosthetic* (Kaki & Tangan Palsu berteknologi tinggi).
     2. *Bracing & Supports* (Penyangga ortopedi sendi & tulang).
     3. *Scoliosis Center* (Klinisi & korset koreksi skoliosis).
     4. *Physiotherapy* (Pemulihan gerak dan muskuloskeletal).
     5. *Neuro Robotic* (Rehabilitasi medis berbasis robotik).
4. **Katalog Produk Unggulan (Featured Products)**:
   - Card produk ready stock: Foto, Judul, Kategori Anatomi, Harga (IDR), Tombol "Detail" & "Beli via WA".
5. **Kategori Custom Made Products**:
   - Showcase alat khusus pasien (Kustomisasi ukuran dan spesifikasi).
6. **Kenapa Memilih Kami (Value Proposition)**:
   - 4 Pilar: Custom Fit Presisi, Material Medis Standar Global, Klinisi Bersertifikat, Garansi Kenyamanan.
7. **Testimoni Pasien (Success Stories)**:
   - Slider ulasan pasien nyata dengan foto alat & kutipan kepuasan.
8. **Artikel Edukasi Terbaru**:
   - 3 artikel blog kesehatan ortopedi terbaru.
9. **Cabang & Peta Lokasi**:
   - Tab switcher lokasi klinik/kantor cabang dengan integrasi Google Maps.
10. **Footer**:
    - Logo, Alamat Pusat, No Telp, Email, Jam Kerja, Quick Links, Copyright.

---

### 3.3. Halaman E-Katalog Produk (`/products` & `/products/{slug}`)
- **Katalog Grid & Filter Sidebar**:
  - Filter Kategori Bagian Tubuh:
    - *Leher (Cervical)* (e.g. Foam Cervical Collar, Aspen CTO)
    - *Bahu (Shoulder)* (e.g. Shoulder Immobilizer)
    - *Punggung (Spinal)* (e.g. Lumbar Sacro Support)
    - *Panggul & Lutut (Hip and Knee)* (e.g. Knee Brace, ROM Walker)
    - *Kaki (Ankle & Foot)* (e.g. Ankle Support, Fracture Walker)
    - *Pergelangan & Tangan (Wrist & Hand)* (e.g. Wrist Splint)
  - Sorting: Berdasarkan Terbaru, Harga Terendah, Harga Tertinggi.
  - Search Input: Pencarian instan nama produk.
- **Halaman Detail Produk (`/products/{slug}`)**:
  - Image Gallery (Gambar utama + thumbnail interaktif via Alpine.js).
  - Badge Kategori Anatomi.
  - Harga Retail (IDR) & Status Ketersediaan (Ready Stock / Pre-Order).
  - Tab Konten: *Deskripsi Produk*, *Indikasi Medis*, *Spesifikasi Material*, *Panduan Ukuran (Size Chart)*.
  - **Tombol Aksi Utama**:
    - Tombol *"Order / Tanya Produk via WhatsApp"* (Auto-generate teks WA: `Halo Admin Ortotik, saya ingin memesan/tanya produk [Nama Produk] seharga [Harga] [Link URL]`).
  - Produk Terkait (Related Products Carousel/Grid).

---

### 3.4. Halaman Custom Made Products (`/custom-products`)
- Penjelasan alur pembuatan produk custom (Konsultasi -> Pengukuran/Casting 3D -> Fabrikasi -> Fitting & Adjustment).
- Showcase Kategori Custom: Kaki Palsu (Atas/Bawah Lutut), Tangan Palsu Bionik, Brace Skoliosis TLSO, Sepatu Diabetes/Ortopedi, Custom Insole.
- Tombol *"Konsultasikan Kasus Anda"* langsung terhubung ke spesialis via WhatsApp.

---

### 3.5. Halaman Services (`/services` & `/services/{slug}`)
- Overview 5 pilar layanan medis Ortotik.
- Detail per layanan lengkap dengan penjelasan indikasi, foto penanganan, dan FAQ layanan.

---

### 3.6. Halaman News & Artikel (`/news` & `/news/{slug}`)
- Grid artikel blog edukasi, filter kategori berita, dan pagination.
- Detail Artikel: Banner, penulis, tanggal rilis, isi artikel rich-text, tombol share medsos, artikel rekomendasi.

---

### 3.7. Halaman Kontak & Lokasi (`/contact`)
- Daftar cabang lengkap (Alamat fisik, Nomor Telp, WhatsApp, Jam operasional).
- Form pesan masuk publik (Nama, Email, No HP, Pesan) yang tersimpan ke database & terkirim ke email admin.
- Embed Google Maps interaktif.

---

## 4. Admin Dashboard UI (Custom Blade + Tailwind, NO FILAMENT)
- **Layout**:
  - Responsive Sidebar dengan navigasi modular.
  - Topbar dengan profile admin dropdown & badge notifikasi pesan masuk.
  - Dark/Light clean medical dashboard look.
- **Komponen Dashboard**:
  - **Stat Cards**: Total Produk, Total Layanan, Total Artikel, Total Pesan Masuk (Inquiries).
  - **Data Tables**: Search, Filter Kategori, Status toggle, Pagination, Action buttons (Create, Edit, Delete).
  - **Form Input**: Rich-text editor (Trix/Quill/Summernote), Single & Multiple image preview uploader, Currency input formatter (Rp).
  - **Modal Konfirmasi Hapus**: Alpine.js confirmation modal.
  - **Flash Toast Notification**: Notifikasi sukses/gagal di pojok kanan atas.

---

## 5. Non-Functional UI Requirements
- **SEO & Social Share**: Meta Title dinamis, OpenGraph image, Meta Description otomatis di setiap detail produk dan artikel.
- **Fast Loading**: Optimasi gambar format WebP, lazy loading `<img loading="lazy">`.
- **Floating WhatsApp Button**: Sticky di kanan bawah semua halaman dengan teks ajakan ramah.