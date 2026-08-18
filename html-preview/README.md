# 🏥 PT. Orthocare Indonesia - Frontend Prototype (Static HTML)

Folder ini berisi seluruh halaman prototipe statis (**HTML, CSS Tailwind CDN, Lucide Icons, & JS**) yang siap ditunjukkan kepada client atau di-deploy ke **GitHub Pages** secara langsung tanpa membutuhkan server backend (PHP/Laravel/MySQL).

---

## 📂 Struktur File Halaman Prototype

### 🌐 1. Halaman Publik (12 Halaman)
| No | File | Deskripsi Halaman |
| :--- | :--- | :--- |
| 1 | `index.html` | **Beranda Utama** (10 Section Lengkap: Hero, Profil, Slider Layanan, E-Katalog, Testimoni, Peta & Form Janji Temu) |
| 2 | `services.html` | **Katalog Layanan Medis** (5 Pilar: Prostetik, Ortotik, Skoliosis, Fisioterapi, Neuro Robotik) |
| 3 | `service-detail.html` | **Detail Prosedur Layanan** (Tahapan Pembuatan Kaki Palsu & Spesifikasi) |
| 4 | `products.html` | **E-Katalog Ready Stock** (Filter Kategori Interaktif: Lutut, Leher, Ankle, Tulang Belakang) |
| 5 | `product-detail.html` | **Detail Produk** (DonJoy Armor Knee Brace with FourcePoint & Pesan WhatsApp) |
| 6 | `custom-products.html` | **Showcase Alur Pasien Custom** (4 Langkah Prosedur Pasien & Portofolio Fabrikasi) |
| 7 | `custom-product-detail.html` | **Detail Studi Kasus Custom** (Kaki Palsu Bawah Lutut Transtibial Carbon Fiber) |
| 8 | `articles.html` | **Pusat Edukasi & Blog** (Grid Artikel Kesehatan & Pediatrik) |
| 9 | `article-detail.html` | **Detail Baca Artikel** (Ciri-Ciri Kaki O dan Kaki X pada Anak) |
| 10 | `consultation.html` | **Formulir Janji Temu Pasien** (Simulasi Form Booking dengan Konfirmasi Popup Modal) |
| 11 | `contact.html` | **Kontak & Cabang Klinik** (Alamat Sleman Yogyakarta, Jam Buka, Peta & Pesan Cepat) |
| 12 | `about.html` | **Tentang Kami** (Visi, Misi, Tim Dokter Spesialis & Standar Kemenkes RI) |

---

### 🔐 2. Halaman Administrator Panel (`admin/` - 17 Halaman)
| No | File | Deskripsi Halaman |
| :--- | :--- | :--- |
| 1 | `admin/login.html` | **Login Administrator** (Kredensial staf medis & form autentikasi) |
| 2 | `admin/dashboard.html` / `admin/index.html` | **Dashboard Overview** (4 KPI Statistik, Pesan Pasien Baru, Status Follow-Up) |
| 3 | `admin/leads.html` | **Manajemen Leads CRM** (Filter status tab, respon WA otomatis, status selector) |
| 4 | `admin/lead-detail.html` | **Detail Profil Pasien** (Catatan klinis, riwayat keluhan, template WA generator) |
| 5 | `admin/products.html` | **Manajemen E-Katalog Produk** (Daftar produk, SKU, harga, status stok) |
| 6 | `admin/product-create.html` | **Tambah Produk Medis** (Form input spesifikasi anatomi, indikasi medis, garansi) |
| 7 | `admin/product-edit.html` | **Edit Produk Medis** (Form perbarui data & foto produk) |
| 8 | `admin/services.html` | **Manajemen 5 Pilar Layanan** (Kartu layanan, urutan tampil, status aktif) |
| 9 | `admin/service-create.html` | **Tambah Layanan Medis** (Form input tahapan konsultasi & deskripsi) |
| 10 | `admin/service-edit.html` | **Edit Layanan Medis** (Form perbarui pilar layanan) |
| 11 | `admin/articles.html` | **Manajemen Artikel Edukasi** (Tabel artikel, kategori, pembaca & status published) |
| 12 | `admin/article-create.html` | **Tulis Artikel Baru** (Form editor artikel, ringkasan meta, estimasi baca) |
| 13 | `admin/article-edit.html` | **Edit Artikel Edukasi** (Form update konten & banner) |
| 14 | `admin/branches.html` | **Manajemen Cabang Klinik** (Kartu fasilitas Sleman Yogyakarta & hotline) |
| 15 | `admin/branch-create.html` | **Tambah Cabang Baru** (Form input cabang, nomor WA, jam buka & maps) |
| 16 | `admin/branch-edit.html` | **Edit Cabang Klinik** (Form update informasi kantor cabang) |
| 17 | `admin/settings.html` | **Pengaturan Situs & SEO** (Profil klinik, nomor WA global, alamat & media sosial) |

---

## 🚀 Cara Menjalankan Secara Lokal (Offline)

Cukup **klik dua kali (double click) file `index.html`** pada file explorer Anda untuk website publik, atau **`admin/login.html`** untuk melihat panel administrator. Halaman akan langsung terbuka di browser (Chrome / Edge / Firefox / Safari) tanpa perlu install apa pun.

---

## 🌐 Cara Deploy ke GitHub Pages (Gratis)

### Metode 1: GitHub Actions (Otomatis dari Repo Ini)
Workflow GitHub Action telah disiapkan di `.github/workflows/deploy-preview.yml`.
1. Push project ini ke repository GitHub Anda:
   ```bash
   git add .
   git commit -m "Add full blade-identical static html previews"
   git push origin main
   ```
2. Buka repository Anda di GitHub browser: **Settings** > **Pages**.
3. Pada bagian **Build and deployment > Source**, pilih **GitHub Actions**.
4. GitHub akan otomatis melakukan build dan memberikan link live, misalnya:
   `https://<username>.github.io/<repo-name>/`

---

### Metode 2: Branch `gh-pages` (Alternatif Manual)
Jika ingin mendeploy khusus folder `html-preview` saja ke branch `gh-pages`:
```bash
git subtree push --prefix html-preview origin gh-pages
```
Lalu di **Settings > Pages**, pilih branch `gh-pages` (root) dan klik **Save**.
