-- ========================================================
-- Database Backup for: `railway`
-- Generated At: 2026-08-21 12:00:47
-- Application: PT Ortotik & Prostetik Indonesia (pediOcare)
-- Tables Dumped: 19
-- ========================================================

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- --------------------------------------------------------
-- Table structure and data for table `articles`
-- --------------------------------------------------------

DROP TABLE IF EXISTS `articles`;
CREATE TABLE `articles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned DEFAULT NULL,
  `category_id` bigint unsigned DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(270) COLLATE utf8mb4_unicode_ci NOT NULL,
  `summary` text COLLATE utf8mb4_unicode_ci,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `thumbnail` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `read_time` int NOT NULL DEFAULT '3',
  `views_count` bigint unsigned NOT NULL DEFAULT '0',
  `is_published` tinyint(1) NOT NULL DEFAULT '1',
  `published_at` timestamp NULL DEFAULT NULL,
  `meta_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `articles_slug_unique` (`slug`),
  KEY `articles_user_id_foreign` (`user_id`),
  KEY `articles_category_id_foreign` (`category_id`),
  KEY `articles_is_published_published_at_index` (`is_published`,`published_at`),
  CONSTRAINT `articles_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL,
  CONSTRAINT `articles_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*!40000 ALTER TABLE `articles` DISABLE KEYS */;
INSERT INTO `articles` (`id`, `user_id`, `category_id`, `title`, `slug`, `summary`, `content`, `thumbnail`, `read_time`, `views_count`, `is_published`, `published_at`, `meta_title`, `meta_description`, `created_at`, `updated_at`) VALUES
(1, 1, 11, 'Mengenal Ciri-Ciri Kaki O dan Kaki X pada Anak Sejak Dini', 'mengenal-ciri-kaki-o-dan-x-pada-anak', 'Panduan bagi orang tua untuk mendeteksi kelainan sudut lutut pada anak dan kapan waktu yang tepat untuk melakukan koreksi brace.', '<p>Kelainan sudut tungkai bawah seperti Genu Varum (Kaki O) dan Genu Valgum (Kaki X) seringkali dianggap normal pada fase awal balita. Namun, apabila jarak antar lutut melebihi 4-5 cm setelah usia 3 tahun, intervensi ortotik dengan brace korektif sangat dianjurkan untuk mencegah osteoartritis dini.</p>', '/images/articles/kaki-ox.jpg', 4, 125, 1, '2026-08-18 04:48:28', 'Ciri Kaki O dan X pada Anak - Klinik Ortotik', 'Deteksi dini kelainan lutut anak dan panduan penanganan koreksi brace ortopedi.', '2026-08-18 04:48:28', '2026-08-18 04:48:28'),
(2, 1, 12, 'Tips Merawat Kaki Palsu dan Stump agar Bebas Luka Lecet', 'tips-merawat-kaki-palsu-dan-stump', 'Langkah-langkah higienis membersihkan silicone liner medis dan menjaga elastisitas kulit tungkai sisa.', '<p>Kenyamanan menggunakan kaki palsu sangat bergantung pada kebersihan liner dan kesesuaian volume soket. Bersihkan liner setiap malam dengan sabun ber-pH netral dan periksakan ke klinik ortotis jika soket mulai terasa longgar.</p>', '/images/articles/perawatan-prostesis.jpg', 3, 98, 1, '2026-08-18 04:48:28', 'Panduan Perawatan Kaki Palsu - Klinik Ortotik', 'Tips merawat silicone liner dan soket kaki palsu agar bebas lecet dan awet.', '2026-08-18 04:48:28', '2026-08-18 04:48:28');
/*!40000 ALTER TABLE `articles` ENABLE KEYS */;


-- --------------------------------------------------------
-- Table structure and data for table `branches`
-- --------------------------------------------------------

DROP TABLE IF EXISTS `branches`;
CREATE TABLE `branches` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `whatsapp_number` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `google_maps_url` text COLLATE utf8mb4_unicode_ci,
  `google_maps_embed` text COLLATE utf8mb4_unicode_ci,
  `opening_hours` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Senin - Sabtu: 08:30 - 17:00 WIB',
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_main_branch` tinyint(1) NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `branches_is_active_index` (`is_active`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*!40000 ALTER TABLE `branches` DISABLE KEYS */;
INSERT INTO `branches` (`id`, `name`, `city`, `address`, `phone_number`, `whatsapp_number`, `email`, `google_maps_url`, `google_maps_embed`, `opening_hours`, `image`, `is_main_branch`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'pediOcare Clinic (Pusat)', 'Sleman, D.I. Yogyakarta', 'Jl. Puri Maguwo Indah No 9F, Maguwoharjo, Kabupaten Sleman, Daerah Istimewa Yogyakarta 55281', '0856 9792 2194', '+6285697922194', 'setiyawan245@gmail.com', 'https://maps.google.com/?q=pediOcare+Sleman', 'https://maps.app.goo.gl/mfuqB6DN4envfjZr6', 'Senin - Sabtu: 08.00 - 17.00 WIB', '/images/branches/sleman-yogyakarta.jpg', 1, 0, '2026-08-18 04:48:28', '2026-08-20 18:23:02');
/*!40000 ALTER TABLE `branches` ENABLE KEYS */;


-- --------------------------------------------------------
-- Table structure and data for table `cache`
-- --------------------------------------------------------

DROP TABLE IF EXISTS `cache`;
CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- --------------------------------------------------------
-- Table structure and data for table `cache_locks`
-- --------------------------------------------------------

DROP TABLE IF EXISTS `cache_locks`;
CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_locks_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- --------------------------------------------------------
-- Table structure and data for table `categories`
-- --------------------------------------------------------

DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` enum('service','product','article') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'product',
  `description` text COLLATE utf8mb4_unicode_ci,
  `order_position` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `categories_slug_unique` (`slug`),
  KEY `categories_type_slug_index` (`type`,`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` (`id`, `name`, `slug`, `type`, `description`, `order_position`, `created_at`, `updated_at`) VALUES
(1, 'Ortotik (Brace & Insole Medis)', 'ortotik', 'service', 'Layanan alat bantu penopang, penyangga, dan pengoreksi sistem muskuloskeletal tubuh.', 1, '2026-08-18 04:48:27', '2026-08-18 04:48:27'),
(2, 'Prostetik (Kaki & Tangan Palsu)', 'prostetik', 'service', 'Layanan penggantian anggota tubuh yang hilang dengan prostesis fungsional modern.', 2, '2026-08-18 04:48:27', '2026-08-18 04:48:27'),
(3, 'Scoliosis Care & Spine Correction', 'skoliosis-care', 'service', 'Pusat koreksi kelainan tulang belakang dan penanganan skoliosis terpadu.', 3, '2026-08-18 04:48:27', '2026-08-18 04:48:27'),
(4, 'Rehabilitasi & Fisioterapi', 'rehabilitasi', 'service', 'Pemulihan fungsi gerak, adaptasi alat bantu, dan terapi neuro robotik.', 4, '2026-08-18 04:48:27', '2026-08-18 04:48:27'),
(5, 'Leher (Cervical)', 'leher-cervical', 'product', 'Penyangga leher untuk pasca cedera servikal Ringan:\r\nTrauma servikal,dengan cedera jaringan lunak  Seperti\r\n-Kejang Otot Ringan\r\n-Nyeri Leher\r\n-Rheumatoid arthritis', 1, '2026-08-18 04:48:27', '2026-08-21 02:20:31'),
(6, 'Bahu & Lengan (Shoulder & Arm)', 'bahu-lengan', 'product', 'Alat imobilisasi bahu pasca dislokasi, fraktur humerus, dan cedera rotator cuff.', 2, '2026-08-18 04:48:27', '2026-08-18 04:48:27'),
(7, 'Punggung & Pinggang (Spine & Lumbar)', 'punggung-spine', 'product', 'Korset lumbar, TLSO, dan penyangga tulang belakang untuk HNP / saraf terjepit dan stabilitas postur.', 3, '2026-08-18 04:48:27', '2026-08-18 04:48:27'),
(8, 'Lutut & Panggul (Knee & Hip)', 'lutut-knee', 'product', 'Brace ligamen lutut (ACL/PCL/MCL), unloading brace untuk osteoarthritis, dan immobilizer sendi.', 4, '2026-08-18 04:48:27', '2026-08-18 04:48:27'),
(9, 'Kaki & Pergelangan (Ankle & Foot)', 'kaki-ankle-foot', 'product', 'Walker boot, AFO, insole medis ortopedi, dan ankle support untuk cedera pergelangan kaki.', 5, '2026-08-18 04:48:27', '2026-08-18 04:48:27'),
(10, 'Pergelangan Tangan & Jari (Wrist & Hand)', 'pergelangan-tangan', 'product', 'Splint carpal tunnel syndrome, finger splint, dan brace imobilisasi pergelangan tangan.', 6, '2026-08-18 04:48:27', '2026-08-18 04:48:27'),
(11, 'Edukasi Medis & Kesehatan', 'edukasi-medis', 'article', 'Informasi terpercaya seputar kesehatan tulang, sendi, dan ortotik prostetik.', 1, '2026-08-18 04:48:27', '2026-08-18 04:48:27'),
(12, 'Panduan Pasien & Pemulihan', 'panduan-pasien', 'article', 'Tips perawatan alat bantu gerak, latihan rehabilitasi di rumah, dan nutrisi pemulihan.', 2, '2026-08-18 04:48:27', '2026-08-18 04:48:27');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;


-- --------------------------------------------------------
-- Table structure and data for table `consultation_leads`
-- --------------------------------------------------------

DROP TABLE IF EXISTS `consultation_leads`;
CREATE TABLE `consultation_leads` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `branch_id` bigint unsigned DEFAULT NULL,
  `medical_service_id` bigint unsigned DEFAULT NULL,
  `full_name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `complaint_type` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `preferred_date` date DEFAULT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci,
  `attachment_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('new','contacted','scheduled','completed','cancelled') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'new',
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `consultation_leads_branch_id_foreign` (`branch_id`),
  KEY `consultation_leads_medical_service_id_foreign` (`medical_service_id`),
  KEY `consultation_leads_status_created_at_index` (`status`,`created_at`),
  CONSTRAINT `consultation_leads_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`) ON DELETE SET NULL,
  CONSTRAINT `consultation_leads_medical_service_id_foreign` FOREIGN KEY (`medical_service_id`) REFERENCES `medical_services` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*!40000 ALTER TABLE `consultation_leads` DISABLE KEYS */;
INSERT INTO `consultation_leads` (`id`, `branch_id`, `medical_service_id`, `full_name`, `phone_number`, `email`, `complaint_type`, `preferred_date`, `notes`, `attachment_path`, `status`, `ip_address`, `created_at`, `updated_at`) VALUES
(2, 1, NULL, 'Budi', '085602678871', 'budi@gmail.com', 'Prostetik', '2026-08-20', 'test', NULL, 'new', '152.233.15.120', '2026-08-19 11:38:31', '2026-08-19 11:38:31');
/*!40000 ALTER TABLE `consultation_leads` ENABLE KEYS */;


-- --------------------------------------------------------
-- Table structure and data for table `custom_products`
-- --------------------------------------------------------

DROP TABLE IF EXISTS `custom_products`;
CREATE TABLE `custom_products` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_type` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `thumbnail` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `summary` text COLLATE utf8mb4_unicode_ci,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `indications` json DEFAULT NULL,
  `features` json DEFAULT NULL,
  `workflow_steps` json DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `meta_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `custom_products_slug_unique` (`slug`),
  KEY `custom_products_category_type_is_active_index` (`category_type`,`is_active`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*!40000 ALTER TABLE `custom_products` DISABLE KEYS */;
INSERT INTO `custom_products` (`id`, `name`, `slug`, `category_type`, `thumbnail`, `summary`, `description`, `indications`, `features`, `workflow_steps`, `is_active`, `meta_title`, `meta_description`, `created_at`, `updated_at`) VALUES
(1, 'Kaki Palsu Bawah Lutut Carbon Fiber (Transtibial Custom Prosthesis)', 'kaki-palsu-bawah-lutut-carbon-custom', 'prosthetic_leg', '/images/custom/transtibial-carbon.jpg', 'Prostesis bawah lutut dengan soket cetak presisi 3D, silikon suspension lock, dan telapak kaki carbon dinamis.', '<p>Didesain khusus mengikuti anatomi tungkai sisa pasien dengan bobot super ringan namun mampu menahan beban aktifitas lari dan melompat.</p>', '[\"Amputasi bawah lutut\", \"Revisi soket kaki palsu lama\"]', '[\"Soket Carbon Fiber Ringan & Anti-Pecah\", \"Silicone Liner dengan Locking Pin System\", \"Dynamic Response Carbon Foot Blade\", \"Kosmetik Busa Waterproof Mirip Kulit Asli\"]', '[{\"desc\": \"Pemeriksaan kondisi stump dan pemindaian 3D non-invasif.\", \"step\": 1, \"title\": \"Konsultasi & 3D Scanning\"}, {\"desc\": \"Pencetakan soket carbon fiber berkualitas tinggi di workshop medik.\", \"step\": 2, \"title\": \"Fabrikasi Soket Presisi\"}, {\"desc\": \"Penyetelan sudut keseimbangan dan uji coba berjalan.\", \"step\": 3, \"title\": \"Pemasangan & Dynamic Alignment\"}, {\"desc\": \"Latihan pola jalan mandiri dan garansi penyesuaian fitting gratis.\", \"step\": 4, \"title\": \"Gait Training & Garansi\"}]', 1, NULL, NULL, '2026-08-18 04:48:27', '2026-08-18 04:48:27'),
(2, 'Korset Skoliosis 3D Cheneau Style TLSO', 'korset-skoliosis-3d-cheneau-tlso', 'scoliosis_brace', '/images/custom/scoliosis-cheneau-brace.jpg', 'Brace koreksi skoliosis 3 dimensi berbasis de-rotasi aktif tanpa menghambat fungsi pernapasan anak.', '<p>Metode terbaik koreksi skoliosis non-bedah dengan ruang ekspansi bernapas yang nyaman dipakai 18-20 jam sehari.</p>', '[\"Skoliosis idiopatik remaja\", \"Sudut Cobb 20-45 derajat\"]', '[\"Desain asimetris 3D aktif de-rotasi kurva\", \"Material Polypropylene Medis Ringan & Hipoalergenik\", \"Dilengkapi ventilasi sirkulasi udara\"]', '[{\"desc\": \"Perhitungan Cobb angle dan rotasi vertebra oleh klinisi.\", \"step\": 1, \"title\": \"Analisa X-Ray & Scanner 3D\"}, {\"desc\": \"Perancangan titik tekan (pressure pad) dan ruang ekspansi.\", \"step\": 2, \"title\": \"Pemodelan CAD Korektif\"}, {\"desc\": \"Pengecekan in-brace correction untuk memastikan reduksi sudut.\", \"step\": 3, \"title\": \"Fitting & Evaluasi Radiologi\"}]', 1, NULL, NULL, '2026-08-18 04:48:27', '2026-08-18 04:48:27');
/*!40000 ALTER TABLE `custom_products` ENABLE KEYS */;


-- --------------------------------------------------------
-- Table structure and data for table `failed_jobs`
-- --------------------------------------------------------

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- --------------------------------------------------------
-- Table structure and data for table `job_batches`
-- --------------------------------------------------------

DROP TABLE IF EXISTS `job_batches`;
CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- --------------------------------------------------------
-- Table structure and data for table `jobs`
-- --------------------------------------------------------

DROP TABLE IF EXISTS `jobs`;
CREATE TABLE `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- --------------------------------------------------------
-- Table structure and data for table `medical_services`
-- --------------------------------------------------------

DROP TABLE IF EXISTS `medical_services`;
CREATE TABLE `medical_services` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `category_id` bigint unsigned DEFAULT NULL,
  `title` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(220) COLLATE utf8mb4_unicode_ci NOT NULL,
  `summary` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `thumbnail` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `banner_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `icon_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `indications` json DEFAULT NULL,
  `meta_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order_position` int NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `medical_services_slug_unique` (`slug`),
  KEY `medical_services_category_id_foreign` (`category_id`),
  KEY `medical_services_is_active_order_position_index` (`is_active`,`order_position`),
  CONSTRAINT `medical_services_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*!40000 ALTER TABLE `medical_services` DISABLE KEYS */;
INSERT INTO `medical_services` (`id`, `category_id`, `title`, `slug`, `summary`, `content`, `thumbnail`, `banner_image`, `icon_name`, `indications`, `meta_title`, `meta_description`, `order_position`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 2, 'Prosthetics (Kaki & Tangan Palsu Berteknologi Tinggi)', 'prosthetics', 'Pembuatan kaki dan tangan palsu berstandar  dengan Socket Berbahan Plastik, Dan Resin Support dengan material Carbon yang ringan dan kuat', '<h3>Solusi Mobilitas Purna Mandiri Pasca Amputasi</h3><p>\r\n            </p><p>Klinik Ortotik &amp; Prostetik kami melayani pembuatan alat prostesis komprehensif mulai dari konsultasi awal, pencetakan soket, pemilihan komponen sendi hidrolik/pneumatik, hingga program gait training intensif.</p><p>\r\n            </p><h3>Keunggulan Layanan Prostetik Kami:</h3><ol><li data-list=\"ordered\"><span class=\"ql-ui\" contenteditable=\"false\"></span><strong>Garansi Seumur Hidup</strong></li><li data-list=\"ordered\"><span class=\"ql-ui\" contenteditable=\"false\"></span><strong>Terdaftar Dan Berizin Resmi</strong></li><li data-list=\"ordered\"><span class=\"ql-ui\" contenteditable=\"false\"></span><strong>Berpengalaman Lebih Dari 10 Tahun</strong></li></ol>', NULL, NULL, 'Activity', '[\"Pasca amputasi bawah lutut (Transtibial)\", \"Pasca amputasi atas lutut (Transfemoral)\", \"Disartikulasi panggul atau lutut\", \"Amputasi lengan bawah atau atas\", \"Penggantian prostesis lama yang longgar / sakit\"]', 'Layanan Kaki & Tangan Palsu Presisi Medis - Ortotik Prostetik', 'Pembuatan kaki palsu bawah lutut, atas lutut, dan tangan palsu bionik berkualitas internasional dengan garansi fitting.', 1, 1, '2026-08-18 04:48:27', '2026-08-21 08:51:25'),
(2, 1, 'Bracing & Orthopaedic Supports (Orthosis)', 'bracing-orthopaedic-supports-orthosis', 'Alat Bantu Kesehatan Yang berfungsi untuk Koreksi,fiksasi,Relief,Immobilisasi. Digunakan sesuai kebutuhan pasien', '<h2>Orthosis</h2><h3>Kami merancang dan memproduksi custom brace seperti KAFO (Knee Ankle Foot Orthosis), AFO (Ankle Foot Orthosis),WHO (Wrist Hand Orthosis),SO ( Scoliosis Brace) serta custom orthotic  untuk membantu anak-anak dengan kelainan tumbuh kembang maupun orang dewasa pasca stroke/trauma.</h3>', NULL, NULL, 'Shield', '[\"Koreksi Kaki O (Genu Varum) & Kaki X (Genu Valgum)\", \"Drop Foot akibat Stroke / Cedera Saraf Peroneal\", \"Osteoarthritis Lutut Derajat 1-4\", \"Cedera Ligamen Lutut (ACL, PCL, MCL, LCL)\", \"Flat Foot (Telapak Kaki Datar) & Nyeri Plantar Fasciitis\"]', 'Penyangga Medis & Brace Korektif Ortopedi - Ortotik Prostetik', 'Solusi brace ortopedi custom dan ready stock untuk koreksi kaki O, kaki X, drop foot, dan sendi lutut.', 2, 1, '2026-08-18 04:48:27', '2026-08-21 08:42:35'),
(3, 3, 'Scoliosis Center (Koreksi Skoliosis Medis)', 'scoliosis-center', 'Pusat penanganan skoliosis non-operatif terpadu menggunakan korset korektif 3D Cheneau Style TLSO dengan presisi pemindaian 3D scan.', '<h3>Koreksi Kurva Skoliosis Remaja & Dewasa Tanpa Operasi</h3>\n            <p>Melalui evaluasi biomekanik menyeluruh dan analisa rotasi tulang belakang berbasis radiologi, kami membuat brace skoliosis 3D custom yang aktif mendorong de-rotasi kurva saat anak bertumbuh.</p>', NULL, NULL, 'Layers', '[\"Skoliosis Idiopatik Remaja (AIS) Sudut Cobb 20° - 45°\", \"Ketidaksimetrisan bahu dan pinggul pada anak\", \"Nyeri punggung kronis akibat kelainan postur\", \"Pemantauan berkala sudut Cobb pra dan pasca bracing\"]', 'Pusat Penanganan & Korset Skoliosis 3D - Ortotik Prostetik', 'Korset skoliosis 3D Cheneau TLSO custom fit untuk meluruskan tulang belakang anak dan remaja tanpa operasi.', 3, 1, '2026-08-18 04:48:27', '2026-08-18 04:48:27'),
(4, 4, 'Physiotherapy & Gait Rehabilitation', 'physiotherapy', 'Layanan fisioterapi muskuloskeletal, latihan pola jalan fungsional (Gait Training), dan adaptasi penggunaan alat bantu ortosis/prostesis.', '<h3>Pemulihan Gerak & Pola Jalan Mandiri</h3>\n            <p>Fisioterapis klinis kami mendampingi pasien dalam latihan penguatan otot stump, keseimbangan tubuh, dan teknik melangkah alami saat menggunakan kaki palsu atau brace ortopedi.</p>', NULL, NULL, 'HeartPulse', '[\"Latihan adaptasi kaki palsu baru\", \"Rehabilitasi pasca cedera olahraga dan operasi sendi\", \"Pelemahan otot tungkai bawah\"]', 'Fisioterapi & Latihan Pola Jalan - Ortotik Prostetik', 'Layanan fisioterapi khusus adaptasi prostesis dan pemulihan gerak sendi.', 4, 1, '2026-08-18 04:48:27', '2026-08-18 04:48:27');
/*!40000 ALTER TABLE `medical_services` ENABLE KEYS */;


-- --------------------------------------------------------
-- Table structure and data for table `migrations`
-- --------------------------------------------------------

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_08_16_000001_create_categories_table', 1),
(5, '2026_08_16_000002_create_medical_services_table', 1),
(6, '2026_08_16_000003_create_products_table', 1),
(7, '2026_08_16_000004_create_product_images_table', 1),
(8, '2026_08_16_000005_create_custom_products_table', 1),
(9, '2026_08_16_000006_create_branches_table', 1),
(10, '2026_08_16_000007_create_articles_table', 1),
(11, '2026_08_16_000008_create_consultation_leads_table', 1),
(12, '2026_08_16_000009_create_testimonials_table', 1),
(13, '2026_08_16_000010_create_site_settings_table', 1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;


-- --------------------------------------------------------
-- Table structure and data for table `password_reset_tokens`
-- --------------------------------------------------------

DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- --------------------------------------------------------
-- Table structure and data for table `product_images`
-- --------------------------------------------------------

DROP TABLE IF EXISTS `product_images`;
CREATE TABLE `product_images` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `product_id` bigint unsigned NOT NULL,
  `image_path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alt_text` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order_position` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `product_images_product_id_order_position_index` (`product_id`,`order_position`),
  CONSTRAINT `product_images_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- --------------------------------------------------------
-- Table structure and data for table `products`
-- --------------------------------------------------------

DROP TABLE IF EXISTS `products`;
CREATE TABLE `products` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `medical_service_id` bigint unsigned DEFAULT NULL,
  `category_id` bigint unsigned DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sku` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` decimal(15,2) NOT NULL DEFAULT '0.00',
  `discount_price` decimal(15,2) DEFAULT NULL,
  `stock_status` enum('in_stock','pre_order','out_of_stock') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'in_stock',
  `thumbnail` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `excerpt` text COLLATE utf8mb4_unicode_ci,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `medical_indications` text COLLATE utf8mb4_unicode_ci,
  `specifications` json DEFAULT NULL,
  `size_chart` text COLLATE utf8mb4_unicode_ci,
  `images` json DEFAULT NULL,
  `is_featured` tinyint(1) NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `meta_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `products_slug_unique` (`slug`),
  KEY `products_medical_service_id_foreign` (`medical_service_id`),
  KEY `products_category_id_foreign` (`category_id`),
  KEY `products_is_active_is_featured_index` (`is_active`,`is_featured`),
  CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL,
  CONSTRAINT `products_medical_service_id_foreign` FOREIGN KEY (`medical_service_id`) REFERENCES `medical_services` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` (`id`, `medical_service_id`, `category_id`, `name`, `slug`, `sku`, `price`, `discount_price`, `stock_status`, `thumbnail`, `excerpt`, `description`, `medical_indications`, `specifications`, `size_chart`, `images`, `is_featured`, `is_active`, `meta_title`, `meta_description`, `created_at`, `updated_at`) VALUES
(1, 2, 5, 'Neck Collar', 'neck-collar', 'ORTHOSIS-NECK-01', '80000.00', '150000.00', 'in_stock', '/images/products/cervical-collar.jpg', 'Kolar leher  untuk imobilisasi servikal presisi.', '<p>Soft Collar dirancang untuk membatasi gerak leher pasca trauma  Servikal Ringan dengan Spoon Ati yang nyaman digunakan jangka panjang.</p><p>Cedera Dengan Kondisi Seperti:</p><ol><li data-list=\"ordered\"><span class=\"ql-ui\" contenteditable=\"false\"></span>Kejang Otot Ringan</li><li data-list=\"ordered\"><span class=\"ql-ui\" contenteditable=\"false\"></span>Nyeri Leher</li><li data-list=\"ordered\"><span class=\"ql-ui\" contenteditable=\"false\"></span>Rheumatoid arthritis</li></ol>', '<p>Trauma servikal,dengan cedera jaringan lunak  Seperti</p><ol><li data-list=\"ordered\"><span class=\"ql-ui\" contenteditable=\"false\"></span>Kejang Otot Ringan</li><li data-list=\"ordered\"><span class=\"ql-ui\" contenteditable=\"false\"></span>Nyeri Leher</li><li data-list=\"ordered\"><span class=\"ql-ui\" contenteditable=\"false\"></span>Rheumatoid arthritis</li></ol>', '{\"Bahan\": \"High-Density Polyethylene & Busa Antimikroba\", \"Fitur\": \"Dial penyesuaian 6 titik tinggi, bukaan trakeostomi besar\", \"Ukuran\": \"Universal (Tinggi & Lingkar Dapat Disesuaikan)\"}', NULL, NULL, 1, 1, NULL, NULL, '2026-08-18 04:48:27', '2026-08-21 02:25:36'),
(2, 2, 8, 'Knee Deker Jointed', 'knee-deker-jointed', 'ORTHOSIS-KNEE-DK', '130000.00', '200000.00', 'in_stock', '/images/products/knee-brace-armor.jpg', 'Brace pelindung ligamen lutut grade kompetisi untuk stabilitas maksimal pasca Osteo Arthritis.\r\nMembantau meredakan nyeri lutut agar bisa bebas bergerak lebih', '<p>Dengan Circum Presure deker ini mampu meredakan rasa nyeri di area lutut, Ditambah 1 pasang joint menambah kesetabilan sendi serta mempertahan deker agar tidak mudah lepas dari lutut</p>', '<p>Ketidakstabilan ACL, PCL, CI, pasca operasi ligamen lutut, proteksi olahraga ekstrem.</p>', '{\"Rangka\": \"Aircraft Aluminum 6061 T6\", \"Garansi\": \"Garansi Rangka 2 Tahun\", \"Sistem Engsel\": \"FourcePoint Technology 4-Points-of-Leverage\"}', NULL, NULL, 1, 1, NULL, NULL, '2026-08-18 04:48:27', '2026-08-21 02:36:07'),
(3, 2, 9, 'AirCast AirSelect Elite Fracture Walker Boot', 'aircast-airselect-elite-walker', 'AC-WALK-ELITE', '3200000.00', '2950000.00', 'in_stock', '/images/products/aircast-walker.jpg', 'Boot gips modern dengan pompa kompresi udara terintegrasi untuk pemulihan patah tulang dan sprain ankle berat.', '<p>Pengganti gips konvensional yang memungkinkan pasien berjalan lebih nyaman dengan sol rocker bottom penyerap benturan dan bantalan udara Duplex ganda untuk meredakan bengkak.</p>', 'Fraktur stabil pergelangan kaki / metatarsal, sprain ligamen ankle grade 3, pasca operasi tendon achilles.', '{\"Bahan\": \"Semi-rigid shell dengan bantalan udara bergradasi\", \"Fitur\": \"Selector dial pompa udara independen kiri-kanan\", \"Ukuran\": \"S, M, L, XL\"}', NULL, NULL, 1, 1, NULL, NULL, '2026-08-18 04:48:27', '2026-08-18 04:48:27'),
(4, 3, 7, 'KORSET TLSO', 'korset-tlso', 'ORTHOSIS-SO-TLSO', '225000.00', '350000.00', 'in_stock', '/images/products/tlso-brace.jpg', 'Penyangga tulang belakang Thoracal hingga lumbal  tulang belakang.\r\nDigunakan Pasca Operasi Tulang Belakang,Badan Bungkuk (Kifosis)', '<p>Memberikan stabilisasi  tulang thoracal  hingga lumbal bawah  dengan tarikan tali presisi yang mudah dikencangkan bahkan oleh pasien lanjut usia.</p><p>Cocok Digunakanan : Pasca Operasi, Postur Tubuh Bungkuk,</p>', '<p>HNP Lumbal (Saraf Terjepit), Spondylolisthesis, Fraktur Kompresi Osteoporosis, Postur Kifosis.</p>', '{\"Panel\": \"Ergonomic Anterior & Posterior Rigid Plates\", \"Mekanisme\": \"Patented Mechanical Pulley Compression System\"}', NULL, NULL, 0, 1, NULL, NULL, '2026-08-18 04:48:27', '2026-08-21 07:18:41'),
(5, 2, 9, 'Insole', 'insole', 'INS-3D-MED', '150000.00', '250000.00', 'in_stock', '/images/products/custom-insole.jpg', 'Insole Sepatu Universal, Yang digunakan Untuk Pederita Flaat Foot, Plantar fasitis,', '<p>Mengoreksi lengkungan arcus telapak kaki yang rata (Flatfoot), meredakan nyeri tumit berlebih, dan mendistribusikan tekanan beban tubuh secara seimbang pada saat berdiri dan melangkah.</p>', '<p>Flat Foot / Pes Planus, Plantar Fasciitis , Heel Spur, Diabetic Foot Pressure Relief.</p>', '{\"Bahan\": \"Multi-density EVA Medis & Poron XRD Shock Absorber\", \"Ketebalan\": \"3mm - 6mm (Sesuai tipe sepatu kerja / lari / kasual)\"}', NULL, NULL, 1, 1, NULL, NULL, '2026-08-18 04:48:27', '2026-08-21 07:51:27'),
(6, NULL, 7, 'KORSET LSO', 'korset-lso', 'ORTHOSIS-SO-LSO', '150000.00', '250000.00', 'in_stock', NULL, 'Korset Pinggang dengan 4 tulang dari alumunium yang ringan serta anti karat \r\nguna meredakan nyeri punggung seperti : Saraf terjepit,HNP,LBP, juga bisa digunakan setelah Pasca operasi\r\nNyaman juga digunakan untuk Duduk terlalu lama, Seperti Kerja Kantoran, Turing dll', '<p>Menggunakan Circum Presure yang telah diteliti bisa melancarkan peredaran darah dan meredakan nyeri,Kemudian didukung oleh 4 pilar alumunium agar tugang belakang tetap stabil di posisinya sehingga tidak bergerak yang membuat tidak mudah lelah, atau bergerak pasca operasi.</p>', '<p>Cedera Lumbal,HNP,LBP,Duduk Terlalu Lama,Touring</p>', NULL, NULL, NULL, 0, 1, NULL, NULL, '2026-08-21 07:35:33', '2026-08-21 07:35:33');
/*!40000 ALTER TABLE `products` ENABLE KEYS */;


-- --------------------------------------------------------
-- Table structure and data for table `sessions`
-- --------------------------------------------------------

DROP TABLE IF EXISTS `sessions`;
CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('7t7sdbvhPhgIiMj3tlCweGIJPjMAcPWQkz3bk7vQ', 1, '152.233.68.97', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiVnJTb0hsOHpRMm5wN3dvVEd5eThVT1FyQlI2S1BVMGJyRHFBZWg3aiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDE6Imh0dHBzOi8vb3J0b3Rpay1wcm9kdWN0aW9uLnVwLnJhaWx3YXkuYXBwIjtzOjU6InJvdXRlIjtzOjQ6ImhvbWUiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1787298653),
('EHV0z2wodZTVTnL11lYb59ocrXcbe2oXxwyemphr', 1, '152.233.15.123', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiM2FTcWd6eWZWUng3RTFocVQ3cW0yelZFSEZiRnhaVjJMUVphcTdPYiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDc6Imh0dHBzOi8vb3J0b3Rpay1wcm9kdWN0aW9uLnVwLnJhaWx3YXkuYXBwL2FkbWluIjtzOjU6InJvdXRlIjtzOjE1OiJhZG1pbi5kYXNoYm9hcmQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO30=', 1787302346),
('hNFyYQwoib3IgnwYLOVUuMqs5tIXbeESH7kXsscT', NULL, '152.233.15.123', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Mobile Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoidjJvdVYzS29wdTgyUmEzc3N2WlN6Tjh2RXhFOGRYcm9peWxxWVFkTSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDE6Imh0dHBzOi8vb3J0b3Rpay1wcm9kdWN0aW9uLnVwLnJhaWx3YXkuYXBwIjtzOjU6InJvdXRlIjtzOjQ6ImhvbWUiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1787291271),
('l6v7uvAy2GMQs74zyyK5x0DwVfAvenplBBunBIyu', 1, '152.233.15.123', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiVHlpT2VOREpyUzBrV2NWZXdGaXhEMUlaNnFZVUp0bUxZTzBjSWNOVSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NTQ6Imh0dHBzOi8vb3J0b3Rpay1wcm9kdWN0aW9uLnVwLnJhaWx3YXkuYXBwL2FkbWluL2JhY2t1cCI7czo1OiJyb3V0ZSI7czoxODoiYWRtaW4uYmFja3VwLmluZGV4Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTt9', 1787313627),
('lRzB9uMPrtNEvAd2bsmSnBlTV5pUzgHWPjuHfbDx', NULL, '152.233.15.120', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_6_2 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.6 Mobile/15E148 Safari/604.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoicklDbXNPU09mRWZWVHFUemYwV3VvM3B6N3Q2V0twV0kzTlR3eWh5QyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Njc6Imh0dHBzOi8vb3J0b3Rpay1wcm9kdWN0aW9uLnVwLnJhaWx3YXkuYXBwL2NvbnN1bHRhdGlvbj9zZXJ2aWNlX2lkPTQiO3M6NToicm91dGUiO3M6MTk6ImNvbnN1bHRhdGlvbi5jcmVhdGUiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1787298869),
('PkcHYrCmtT0Cc0Y9yFAQWFFhvbzKWmonaP9AEzh5', NULL, '152.233.15.121', 'Mozilla/5.0 (X11; Ubuntu; Linux i686; rv:24.0) Gecko/20100101 Firefox/24.0 Chrome/80.0.3987.132 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiRHh4WWYzbFlvRnRrcnRkbjRTU1k2Q0s5UVQxaDBRemZ0RERTc1FpZyI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czo0NzoiaHR0cHM6Ly9vcnRvdGlrLXByb2R1Y3Rpb24udXAucmFpbHdheS5hcHAvYWRtaW4iO31zOjk6Il9wcmV2aW91cyI7YToyOntzOjM6InVybCI7czo1MzoiaHR0cHM6Ly9vcnRvdGlrLXByb2R1Y3Rpb24udXAucmFpbHdheS5hcHAvYWRtaW4vbG9naW4iO3M6NToicm91dGUiO3M6MTE6ImFkbWluLmxvZ2luIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1787311862);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;


-- --------------------------------------------------------
-- Table structure and data for table `site_settings`
-- --------------------------------------------------------

DROP TABLE IF EXISTS `site_settings`;
CREATE TABLE `site_settings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` longtext COLLATE utf8mb4_unicode_ci,
  `group` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'general',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `site_settings_key_unique` (`key`),
  KEY `site_settings_group_index` (`group`)
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*!40000 ALTER TABLE `site_settings` DISABLE KEYS */;
INSERT INTO `site_settings` (`id`, `key`, `value`, `group`, `created_at`, `updated_at`) VALUES
(1, 'site_name', 'PT. Orthocare Indonesia', 'general', '2026-08-18 04:48:28', '2026-08-18 04:48:28'),
(2, 'site_tagline', 'High-Tech Orthopedic Care & Precision Prosthetics', 'general', '2026-08-18 04:48:28', '2026-08-18 04:48:28'),
(3, 'company_phone', '(0274) 889912', 'contact', '2026-08-18 04:48:28', '2026-08-18 04:48:28'),
(4, 'company_email', 'info@orthocare.co.id', 'contact', '2026-08-18 04:48:28', '2026-08-18 04:48:28'),
(5, 'whatsapp_global', '6281234567890', 'contact', '2026-08-18 04:48:28', '2026-08-18 04:48:28'),
(6, 'company_address', 'Jl. Kaliurang KM 8.5, Sinduharjo, Kec. Ngaglik, Kabupaten Sleman, Daerah Istimewa Yogyakarta 55581', 'contact', '2026-08-18 04:48:28', '2026-08-18 04:48:28'),
(7, 'working_hours', 'Senin - Sabtu: 08:30 - 17:00 WIB', 'general', '2026-08-18 04:48:28', '2026-08-18 04:48:28'),
(8, 'facebook_url', 'https://facebook.com/ortotikindonesia', 'social', '2026-08-18 04:48:28', '2026-08-18 04:48:28'),
(9, 'instagram_url', 'https://instagram.com/pediocareclinic', 'social', '2026-08-18 04:48:28', '2026-08-20 03:20:43'),
(10, 'youtube_url', 'https://youtube.com/@pediocareclinic', 'social', '2026-08-18 04:48:28', '2026-08-20 03:20:43'),
(11, 'hero_doctor_image', 'images/client_update/image5.png', 'hero', '2026-08-20 03:20:43', '2026-08-21 00:33:29'),
(12, 'hero_doctor_badge', 'PRESIDENT', 'hero', '2026-08-20 03:20:43', '2026-08-21 07:59:00'),
(13, 'hero_doctor_name', 'Sholeh Setyawan, S.Tr.Kes', 'hero', '2026-08-20 03:20:43', '2026-08-21 01:11:30'),
(14, 'hero_doctor_title', 'Owner & Founder Pediocare', 'hero', '2026-08-20 03:20:43', '2026-08-21 01:11:30'),
(15, 'hero_doctor_alt', 'Ortotis Prostetis', 'hero', '2026-08-20 03:20:43', '2026-08-20 03:20:43'),
(16, 'hero_badge_1_title', 'Ijin Dinkes Sleman', 'hero', '2026-08-20 03:20:43', '2026-08-20 03:20:43'),
(17, 'hero_badge_1_subtitle', '503/000007.58.22/OP/2022', 'hero', '2026-08-20 03:20:43', '2026-08-20 03:20:43'),
(18, 'hero_badge_2_title', 'Lifetime Guarantee', 'hero', '2026-08-20 03:20:43', '2026-08-20 03:20:43'),
(19, 'hero_badge_2_subtitle', 'fitting presisi', 'hero', '2026-08-20 03:20:43', '2026-08-20 03:20:43'),
(20, 'clinic_name', 'pediOcare Clinic', 'general', '2026-08-20 03:20:43', '2026-08-20 03:20:43'),
(21, 'clinic_tagline', 'Care your milestone', 'general', '2026-08-20 03:20:43', '2026-08-20 18:23:02'),
(22, 'hotline_whatsapp', '+6285697922194', 'contact', '2026-08-20 03:20:43', '2026-08-20 03:20:43'),
(23, 'contact_email', 'setiyawan245@gmail.com', 'contact', '2026-08-20 03:20:43', '2026-08-20 03:20:43'),
(24, 'footer_address', 'Jl. Puri Maguwo Indah No 9F, Maguwoharjo, Kabupaten Sleman, Daerah Istimewa Yogyakarta 55281', 'contact', '2026-08-20 03:20:43', '2026-08-20 03:20:43'),
(25, 'meta_description', 'Melayani pembuatan kaki palsu jogja, kaki palsu solo,  tangan palsu, korset skoliosis, sepatu,  AFO, KAFO, Korset nyeri pinggang, TLSO, Skoliosis Brace, pusat kaki palsu jogja terpercaya', 'seo', '2026-08-20 03:20:43', '2026-08-20 03:20:43'),
(26, 'hero_home_media', 'https://lh3.googleusercontent.com/aida/AP1WRLu-cYuotNRMpQoNz8xiNuno33F9xSgeFfAKDWqxDogo2VSMvAuCS4QUt2jbop_cQ4e18T36Uqa6an8ezvVtDtXtwih7tYUxTzRHyWrqiqVAcV-b3G6wS_YbGIeB9Bl7tYBFGY4K81YU6TE_o1OvhLPzQstL7r4XrQEGsJ3mWxHjfxXavdzURFHoctGm1HxnTSA9wW180ytfdljOX3A9UWVLpKx5mwhgV3xHx-gbLfAcVFwk-s2AOYLy', 'hero', '2026-08-20 18:23:02', '2026-08-20 18:23:02'),
(27, 'hero_home_media_type', 'image', 'hero', '2026-08-20 18:23:02', '2026-08-20 18:23:02'),
(28, 'hero_doctors', '[{\"name\":\"Sholeh Setyawan, S.Tr.Kes\",\"title\":\"Owner & Founder Pediocare\",\"badge\":\"PRESIDENT\",\"image\":\"images/client_update/image5.png\"},{\"name\":\"Muhammad Antas Salam., S.Tr.Kes\",\"title\":\"Ortotis Prostetis Mahir\",\"badge\":\"Tim Klinis Spesialis\",\"image\":\"storage/settings/doctor_EnijgNmyupn3olvJ.jpeg\"}]', 'hero', '2026-08-20 18:23:02', '2026-08-21 07:59:00'),
(29, 'current_tab', 'seo_meta', 'general', '2026-08-20 18:23:02', '2026-08-21 08:07:27'),
(30, 'hero_home_description', 'Sebaik-baik manusia adalah yang bermanfaat untuk orang lain. Kami memandang manusia sebagai makhluk ciptaan yang sempurna. Sudah lebih dari satu dekade pediOcare melayani, membantu dan memberi solusi bagi masyarakat yang membutuhkan layanan alat bantu Ortosis Prostesis. Suatu kebahagiaan bagi Kami ketika dapat melihat klien/pasien yang mengalami amputasi kaki namun dapat kembali berjalan penuhi harapan, anak lahir yang ditakdirkan memiliki keistimewaan dapat tumbuh dan berkembang sesuai capaian (milestone).', 'hero', '2026-08-20 18:23:02', '2026-08-20 18:23:02'),
(31, 'hero_about_badge', 'Profil & Integritas Medis', 'hero_pages', '2026-08-20 18:23:02', '2026-08-20 18:23:02'),
(32, 'hero_about_title', 'Tentang pediOcare', 'hero_pages', '2026-08-20 18:23:02', '2026-08-20 18:23:02'),
(33, 'hero_about_subtitle', 'Pusat pelayanan ortotik prostetik profesional dengan semangat bermanfaat untuk menunjang fungsi gerak dan kualitas hidup Anda.', 'hero_pages', '2026-08-20 18:23:02', '2026-08-20 18:23:02'),
(34, 'about_company_description', 'Pediocare Berdedikasi melakukan Pelayanan Ortotik Prostetik untuk membantu menunjang fungsi gerak, kenyamanan, serta kualitas hidup pengguna. Sejak 2012 Pediocare telah melayani dengan menghadirkan produk custom maupun readymade dengan mengutamakan kualitas bahan, kerapian pengerjaan, serta memperhatikan kebutuhan setiap pengguna. Dengan 14 tahun pengalaman di dunia alat bantu, Pediocare akan selalu berkomitmen memberi solusi yang terbaik dan dapat diandalkan.', 'general', '2026-08-20 18:23:02', '2026-08-20 18:23:02'),
(35, 'hero_services_badge', 'Pelayanan profesional dengan semangat bermanfaat', 'hero_pages', '2026-08-20 18:23:02', '2026-08-20 18:23:02'),
(36, 'hero_services_title', 'Layanan Orthosis Prosthesis & Alat Bantu Ortopedi', 'hero_pages', '2026-08-20 18:23:02', '2026-08-20 18:23:02'),
(37, 'hero_services_subtitle', 'Perawatan komprehensif dari evaluasi klinis, perancangan presisi, hingga rehabilitasi gait training berstandar medis.', 'hero_pages', '2026-08-20 18:23:02', '2026-08-20 18:23:02'),
(38, 'hero_contact_badge', 'Pelayanan & Lokasi Klinik', 'hero_pages', '2026-08-20 18:23:02', '2026-08-20 18:23:02'),
(39, 'hero_contact_title', 'Hubungi Kami', 'hero_pages', '2026-08-20 18:23:02', '2026-08-20 18:23:02'),
(40, 'hero_contact_subtitle', 'Kami siap melayani Anda dengan teknologi ortopedi mutakhir dan perawatan profesional yang mengutamakan kenyamanan pasien. Care your milestone.', 'hero_pages', '2026-08-20 18:23:02', '2026-08-20 18:23:02'),
(41, 'clinic_city', 'Sleman, D.I. Yogyakarta', 'contact', '2026-08-20 18:23:02', '2026-08-20 18:23:02'),
(42, 'opening_hours', 'Senin - Sabtu: 08.00 - 17.00 WIB', 'contact', '2026-08-20 18:23:02', '2026-08-20 18:23:02'),
(43, 'clinic_address', 'Jl. Puri Maguwo Indah No 9F, Maguwoharjo, Kabupaten Sleman, Daerah Istimewa Yogyakarta 55281', 'contact', '2026-08-20 18:23:02', '2026-08-20 18:23:02'),
(44, 'google_maps_embed', NULL, 'contact', '2026-08-20 18:23:02', '2026-08-20 18:23:02'),
(45, 'google_maps_url', 'https://maps.google.com/?q=pediOcare+Sleman', 'social', '2026-08-20 18:23:02', '2026-08-20 18:23:02'),
(46, 'phone_number', '0856 9792 2194', 'contact', '2026-08-20 18:23:02', '2026-08-20 18:23:02'),
(47, 'footer_description', 'Pusat pelayanan Ortotik Prostetik profesional dengan semangat bermanfaat untuk menunjang fungsi gerak dan kualitas hidup Anda.', 'footer', '2026-08-20 18:23:02', '2026-08-20 18:23:02'),
(48, 'tiktok_url', NULL, 'social', '2026-08-20 18:23:02', '2026-08-20 18:23:02'),
(49, 'meta_title', 'pediOcare - Care your milestone', 'seo', '2026-08-20 18:23:02', '2026-08-20 18:23:02'),
(50, 'meta_keywords', 'kaki palsu, tangan palsu, ortotik prostetik, AFO, korset skoliosis,kaki palsu jogja', 'seo', '2026-08-20 18:23:02', '2026-08-21 08:07:27'),
(51, 'hero_about_image', 'storage/banners/OVHM09BqdF6AHcX1rKQAoEpZAeJILhPfre4A0k0Q.png', 'hero_pages', '2026-08-21 07:54:28', '2026-08-21 08:05:38'),
(52, 'hero_contact_image', 'storage/banners/j5pNsapeWXo7WPLSliiuOfVEDaWqlca1pzbgbq4t.png', 'hero_pages', '2026-08-21 08:03:20', '2026-08-21 08:05:38'),
(53, 'hero_services_image', 'storage/banners/KIM4otUWXcNH9PD705vSCHWKFp1EESs0KDng5T5n.png', 'hero_pages', '2026-08-21 08:04:03', '2026-08-21 08:05:38');
/*!40000 ALTER TABLE `site_settings` ENABLE KEYS */;


-- --------------------------------------------------------
-- Table structure and data for table `testimonials`
-- --------------------------------------------------------

DROP TABLE IF EXISTS `testimonials`;
CREATE TABLE `testimonials` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `patient_name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `patient_info` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `service_used` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `testimony` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `before_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `after_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rating` tinyint unsigned NOT NULL DEFAULT '5',
  `is_featured` tinyint(1) NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `testimonials_is_active_index` (`is_active`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*!40000 ALTER TABLE `testimonials` DISABLE KEYS */;
INSERT INTO `testimonials` (`id`, `patient_name`, `patient_info`, `service_used`, `testimony`, `photo`, `before_image`, `after_image`, `rating`, `is_featured`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Bpk. Hendra Gunawan (45 th)', 'Jakarta • Pasien Kaki Palsu Bawah Lutut', 'Kaki Palsu Transtibial Carbon', 'Setelah amputasi akibat kecelakaan, saya sempat putus asa. Alhamdulillah di Klinik Ortotik saya dibuatkan kaki palsu yang pas sekali di stump, tidak ada lecet sama sekali, dan sekarang saya sudah bisa mengemudi dan jogging kembali.', '/images/testimonials/patient-1.jpg', NULL, NULL, 5, 1, 1, '2026-08-18 04:48:28', '2026-08-18 04:48:28'),
(2, 'Ibu Ratna (Ibunda dari Sarah, 14 th)', 'Surabaya • Pasien Koreksi Skoliosis', 'Korset Skoliosis 3D Cheneau', 'Putri saya terdiagnosa skoliosis 32 derajat. Setelah pemakaian rutin korset 3D dari klinik ini selama 9 bulan, hasil rontgen menunjukkan sudutnya berkurang drastis menjadi 14 derajat tanpa perlu tindakan operasi.', '/images/testimonials/patient-2.jpg', NULL, NULL, 5, 1, 1, '2026-08-18 04:48:28', '2026-08-18 04:48:28'),
(3, 'Bpk. Suryadi (52 th)', 'Tangerang • Pasien Nyeri Tumit & Flatfoot', 'Custom Medical Insole 3D', 'Nyeri tumit bertahun-tahun saat bangun tidur hilang dalam 2 minggu setelah menggunakan custom insole 3D dari Ortotik. Sangat direkomendasikan untuk siapa saja yang punya keluhan telapak kaki datar.', '/images/testimonials/patient-3.jpg', NULL, NULL, 5, 1, 1, '2026-08-18 04:48:28', '2026-08-18 04:48:28');
/*!40000 ALTER TABLE `testimonials` ENABLE KEYS */;


-- --------------------------------------------------------
-- Table structure and data for table `users`
-- --------------------------------------------------------

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('superadmin','admin','author') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'admin',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin Ortotik', 'admin@ortotik.co.id', NULL, '$2y$12$vLJ8B/ra6jEhCSs7N7YlTuNuphlvXYCCVKo9pEsGtzQgCMNl.VaTC', 'superadmin', 'sk0tV7FGMGWwHn8KSJHFnfdu4mv4Jr6RCQ0AhP4EgZkxjExjVJQmK8U6Tumk', '2026-08-18 04:48:27', '2026-08-18 04:48:27');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;


-- ========================================================
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
-- Dump completed on 2026-08-21 12:00:47
