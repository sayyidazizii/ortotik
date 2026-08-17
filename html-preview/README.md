# 🏥 PT. Orthocare Indonesia - Frontend Prototype (Static HTML)

Folder ini berisi seluruh halaman prototipe statis (**HTML, CSS Tailwind CDN, & JS**) yang siap ditunjukkan kepada client atau di-deploy ke **GitHub Pages** secara langsung tanpa membutuhkan server backend (PHP/Laravel/MySQL).

---

## 📂 Struktur File Halaman

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
| 13 | `assets/js/main.js` | Script interaktivitas (Drawer menu mobile, circular slider, filter kategori, FAQ & modal simulasi) |

---

## 🚀 Cara Menjalankan Secara Lokal (Offline)

Cukup **klik dua kali (double click) file `index.html`** pada file explorer Anda. Halaman akan langsung terbuka di browser (Chrome / Edge / Firefox / Safari) tanpa perlu install apa pun.

---

## 🌐 Cara Deploy ke GitHub Pages (Gratis)

### Metode 1: GitHub Actions (Otomatis dari Repo Ini)
Workflow GitHub Action telah disiapkan di `.github/workflows/deploy-preview.yml`.
1. Push project ini ke repository GitHub Anda:
   ```bash
   git add .
   git commit -m "Add html-preview for client testing"
   git push origin main
   ```
2. Buka repository Anda di GitHub browser: **Settings** > **Pages**.
3. Pada bagian **Build and deployment > Source**, pilih **GitHub Actions**.
4. GitHub akan otomatis melakukan build dan memberikan link live, misalnya:
   `https://<username>.github.io/<repo-name>/`

---

### Metode 2: Branch `gh-pages` (Alternatif Manual yang Sangat Mudah)
Jika ingin mendeploy khusus folder `html-preview` saja ke branch `gh-pages`:
```bash
git subtree push --prefix html-preview origin gh-pages
```
Lalu di **Settings > Pages**, pilih branch `gh-pages` (root) dan klik **Save**.
