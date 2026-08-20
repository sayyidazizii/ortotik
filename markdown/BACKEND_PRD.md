# Database Design & Schema Specification (MySQL)

## 1. Relational Overview (ERD)
- `product_categories` 1 : N `products`
- `products` 1 : N `product_images`
- `article_categories` 1 : N `articles`
- `users` 1 : N `articles` (Author)
- `inquiries` (Standalone inquiries / Pesan masuk)
- `branches` (Cabang klinik & kontak)
- `testimonials` (Ulasan & success stories)
- `site_settings` (Key-Value configuration)

---

## 2. Detailed Table Schemas

### 2.1. `users` (Admin Authentication)
| Column | Type | Attributes | Description |
| :--- | :--- | :--- | :--- |
| `id` | BIGINT UNSIGNED | PK, Auto Increment | ID User |
| `name` | VARCHAR(150) | NOT NULL | Nama Admin |
| `email` | VARCHAR(191) | UNIQUE, NOT NULL | Email Login |
| `password` | VARCHAR(255) | NOT NULL | Bcrypt Hashed Password |
| `role` | ENUM | 'superadmin', 'admin', 'editor' | Hak akses |
| `remember_token`| VARCHAR(100)| NULLABLE | Remember Me |
| `created_at` | TIMESTAMP | NULLABLE | |
| `updated_at` | TIMESTAMP | NULLABLE | |

---

### 2.2. `product_categories` (Kategori Anatomi Tubuh)
| Column | Type | Attributes | Description |
| :--- | :--- | :--- | :--- |
| `id` | BIGINT UNSIGNED | PK, Auto Increment | ID Kategori |
| `name` | VARCHAR(150) | NOT NULL | Misal: "Leher (Cervical)", "Kaki (Ankle & Foot)" |
| `slug` | VARCHAR(191) | UNIQUE, NOT NULL | Slug URL |
| `description` | TEXT | NULLABLE | Penjelasan kategori anatomi |
| `order_position`| INT | DEFAULT 0 | Urutan sortir menu |
| `created_at` | TIMESTAMP | NULLABLE | |
| `updated_at` | TIMESTAMP | NULLABLE | |

---

### 2.3. `products` (Katalog Produk Ready Stock / Jual)
| Column | Type | Attributes | Description |
| :--- | :--- | :--- | :--- |
| `id` | BIGINT UNSIGNED | PK, Auto Increment | ID Produk |
| `category_id` | BIGINT UNSIGNED | FK -> `product_categories.id` (CASCADE) | Kategori Anatomi |
| `name` | VARCHAR(255) | NOT NULL | Contoh: "ASPEN Vista Adjustable Collar" |
| `slug` | VARCHAR(255) | UNIQUE, NOT NULL | Slug URL SEO |
| `sku` | VARCHAR(100) | NULLABLE | Kode SKU Produk |
| `price` | DECIMAL(15,2) | DEFAULT 0.00 | Harga Jual (IDR) |
| `discount_price`| DECIMAL(15,2)| NULLABLE | Harga Diskon (Opsional) |
| `stock_status` | ENUM | 'in_stock', 'pre_order', 'out_of_stock' | Status Ketersediaan |
| `thumbnail` | VARCHAR(255) | NOT NULL | Foto Utama Produk |
| `excerpt` | TEXT | NULLABLE | Ringkasan singkat |
| `description` | LONGTEXT | NOT NULL | Deskripsi detail produk |
| `medical_indications`| TEXT | NULLABLE | Indikasi medis penggunaan alat |
| `specifications` | TEXT | NULLABLE | Bahan/material & fitur |
| `size_chart` | TEXT | NULLABLE | Panduan ukuran / tabel size |
| `is_featured` | BOOLEAN | DEFAULT FALSE | Tampil di beranda (True/False) |
| `meta_title` | VARCHAR(255) | NULLABLE | SEO Title |
| `meta_desc` | VARCHAR(255) | NULLABLE | SEO Description |
| `created_at` | TIMESTAMP | NULLABLE | |
| `updated_at` | TIMESTAMP | NULLABLE | |

---

### 2.4. `product_images` (Galeri Foto Produk)
| Column | Type | Attributes | Description |
| :--- | :--- | :--- | :--- |
| `id` | BIGINT UNSIGNED | PK, Auto Increment | ID Foto |
| `product_id` | BIGINT UNSIGNED | FK -> `products.id` (CASCADE) | Relasi Produk |
| `image_path` | VARCHAR(255) | NOT NULL | Lokasi file gambar di storage |
| `order_position`| INT | DEFAULT 0 | Urutan thumbnail |
| `created_at` | TIMESTAMP | NULLABLE | |
| `updated_at` | TIMESTAMP | NULLABLE | |

---

### 2.5. `custom_products` (Produk Custom Made P&O)
| Column | Type | Attributes | Description |
| :--- | :--- | :--- | :--- |
| `id` | BIGINT UNSIGNED | PK, Auto Increment | ID |
| `name` | VARCHAR(255) | NOT NULL | Contoh: "Kaki Palsu Bawah Lutut Custom" |
| `slug` | VARCHAR(255) | UNIQUE, NOT NULL | Slug URL |
| `category_type`| ENUM | 'prosthetic_leg', 'prosthetic_arm', 'scoliosis_brace', 'orthosis_foot', 'insole', 'orthopedic_shoes' |
| `thumbnail` | VARCHAR(255) | NOT NULL | Foto produk |
| `description` | LONGTEXT | NOT NULL | Penjelasan alat & spesifikasi |
| `workflow_steps`| TEXT | NULLABLE | Tahapan pembuatan custom |
| `is_active` | BOOLEAN | DEFAULT TRUE | Status tayang |
| `created_at` | TIMESTAMP | NULLABLE | |
| `updated_at` | TIMESTAMP | NULLABLE | |

---

### 2.6. `medical_services` (5 Layanan Utama Perusahaan)
| Column | Type | Attributes | Description |
| :--- | :--- | :--- | :--- |
| `id` | BIGINT UNSIGNED | PK, Auto Increment | ID Layanan |
| `title` | VARCHAR(200) | NOT NULL | Contoh: "Prosthetic", "Scoliosis Center" |
| `slug` | VARCHAR(220) | UNIQUE, NOT NULL | Slug URL |
| `short_description`| VARCHAR(500)| NOT NULL | Ringkasan untuk card |
| `full_content`| LONGTEXT | NOT NULL | Penjelasan lengkap layanan |
| `icon_name` | VARCHAR(100) | NULLABLE | Nama icon Lucide / SVG |
| `banner_image`| VARCHAR(255) | NULLABLE | Foto cover layanan |
| `order_position`| INT | DEFAULT 0 | Urutan menu |
| `created_at` | TIMESTAMP | NULLABLE | |
| `updated_at` | TIMESTAMP | NULLABLE | |

---

### 2.7. `article_categories` & `articles` (Blog & Edukasi Medis)
| Column | Type | Attributes | Description |
| :--- | :--- | :--- | :--- |
| `id` | BIGINT UNSIGNED | PK, Auto Increment | ID |
| `user_id` | BIGINT UNSIGNED | FK -> `users.id` (SET NULL) | Penulis artikel |
| `category_id` | BIGINT UNSIGNED | FK -> `article_categories.id` (SET NULL) | Kategori artikel |
| `title` | VARCHAR(255) | NOT NULL | Judul Artikel |
| `slug` | VARCHAR(255) | UNIQUE, NOT NULL | Slug URL |
| `thumbnail` | VARCHAR(255) | NOT NULL | Foto Cover Artikel |
| `body` | LONGTEXT | NOT NULL | Konten Artikel |
| `status` | ENUM | 'draft', 'published' | Status publikasi |
| `views_count` | BIGINT UNSIGNED | DEFAULT 0 | Counter views |
| `created_at` | TIMESTAMP | NULLABLE | |
| `updated_at` | TIMESTAMP | NULLABLE | |

---

### 2.8. `branches` (Cabang & Lokasi Klinik)
| Column | Type | Attributes | Description |
| :--- | :--- | :--- | :--- |
| `id` | BIGINT UNSIGNED | PK, Auto Increment | ID Cabang |
| `name` | VARCHAR(150) | NOT NULL | Contoh: "Kantor Pusat - Pantai Indah Kapuk" |
| `slug` | VARCHAR(180) | UNIQUE, NOT NULL | |
| `address` | TEXT | NOT NULL | Alamat fisik lengkap |
| `phone` | VARCHAR(50) | NOT NULL | Nomor telepon kantor |
| `whatsapp` | VARCHAR(50) | NOT NULL | Nomor WhatsApp cabang |
| `email` | VARCHAR(100) | NULLABLE | Email cabang |
| `open_hours` | VARCHAR(255) | NOT NULL | Contoh: "Senin - Jumat 09.00 - 17.00" |
| `maps_iframe` | TEXT | NULLABLE | Iframe URL Google Maps |
| `is_main_branch`| BOOLEAN | DEFAULT FALSE | Penanda kantor pusat |
| `created_at` | TIMESTAMP | NULLABLE | |
| `updated_at` | TIMESTAMP | NULLABLE | |

---

### 2.9. `inquiries` (Pesan Masuk Form Kontak / Tanya Produk)
| Column | Type | Attributes | Description |
| :--- | :--- | :--- | :--- |
| `id` | BIGINT UNSIGNED | PK, Auto Increment | ID Pesan |
| `name` | VARCHAR(150) | NOT NULL | Nama Pengirim |
| `email` | VARCHAR(150) | NOT NULL | Email Pengirim |
| `phone` | VARCHAR(50) | NOT NULL | No. Handphone / WhatsApp |
| `subject` | VARCHAR(200) | NULLABLE | Subjek Pesan / Nama Produk terkait |
| `message` | TEXT | NOT NULL | Isi pesan |
| `status` | ENUM | 'unread', 'read', 'followed_up' | Status penanganan |
| `created_at` | TIMESTAMP | NULLABLE | |
| `updated_at` | TIMESTAMP | NULLABLE | |

---

### 2.10. `testimonials` (Ulasan & Testimoni Pasien)
| Column | Type | Attributes | Description |
| :--- | :--- | :--- | :--- |
| `id` | BIGINT UNSIGNED | PK, Auto Increment | ID |
| `patient_name`| VARCHAR(150) | NOT NULL | Nama Pasien (e.g. "Syane - Jakarta") |
| `service_or_product`| VARCHAR(150)| NULLABLE | Contoh: "Fisioterapi Skoliosis" |
| `quote` | TEXT | NOT NULL | Isi testimoni pasien |
| `rating` | TINYINT | DEFAULT 5 | Bintang 1 - 5 |
| `photo` | VARCHAR(255) | NULLABLE | Foto pasien / alat |
| `is_active` | BOOLEAN | DEFAULT TRUE | Tampil di beranda |
| `created_at` | TIMESTAMP | NULLABLE | |
| `updated_at` | TIMESTAMP | NULLABLE | |

---

### 2.11. `site_settings` (Pengaturan Global Website)
| Column | Type | Attributes | Description |
| :--- | :--- | :--- | :--- |
| `id` | BIGINT UNSIGNED | PK, Auto Increment | ID |
| `key_name` | VARCHAR(100) | UNIQUE, NOT NULL | e.g. `main_whatsapp`, `site_email`, `hero_tagline` |
| `key_value` | LONGTEXT | NULLABLE | Nilai value setting |
| `created_at` | TIMESTAMP | NULLABLE | |
| `updated_at` | TIMESTAMP | NULLABLE | |