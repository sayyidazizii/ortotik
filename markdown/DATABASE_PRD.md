<?php

$aiHeader = <<<'RAW'
# AI DEVELOPMENT RULES

## Development Rules
* Selalu inspect project sebelum coding.
* Ikuti struktur dan arsitektur existing.
* Gunakan **Laravel 12 + MySQL**.
* Gunakan **Repository Pattern + Service Layer**.
* Flow backend: **Request → Controller → Service → Repository → Model → Database**.
* Controller harus tipis.
* Business logic hanya di Service.
* Database access melalui Repository.
* Gunakan Dependency Injection dan Interface/Contract.
* Gunakan Form Request untuk validation.
* Gunakan Policy/Middleware untuk authorization.
* Gunakan Eloquent Relationship dan hindari N+1 query.
* Gunakan migration untuk perubahan database.
* Gunakan index, pagination, transaction, cache, dan queue sesuai kebutuhan.
* Jangan hardcode secret/configuration.
* Jangan commit `.env` atau credential.
* Prioritaskan security, scalability, performance, dan maintainability.
* Hindari duplicate code dan overengineering.
* Gunakan reusable component pada frontend.
* Backend tetap menjadi sumber kebenaran.
* Jangan melakukan breaking change tanpa alasan.
* Jangan menghapus existing feature tanpa memastikan impact.
* Setiap fitur penting wajib memiliki test.
* Setelah coding wajib melakukan test dan pengecekan error.
* Jangan meninggalkan debugging code.
* Jangan mengubah file yang tidak berhubungan dengan task.
* JANGAN GUNAKAN FILAMENT. Buat Custom Tailwind Blade Admin Dashboard.

---

# AI SKILLS
AI Agent harus memiliki kemampuan:
* Software Architecture
* Laravel 12 Development
* PHP Development
* MySQL Database Design
* Repository Pattern
* Service Layer Architecture
* REST API Development
* Frontend Development
* Eloquent ORM
* Database Optimization
* Query Optimization
* Authentication & Authorization
* Application Security
* Testing & Debugging
* Git & Version Control
* Performance Optimization
* Scalable System Design
* Clean Code & SOLID
* Refactoring
* Code Review
* Error Analysis & Root Cause Debugging
* Deployment & Production Readiness

---

# AI WORKFLOW
**Analyze → Plan → Implement → Test → Review → Optimize**
Jangan langsung coding sebelum memahami project dan dependency yang terdampak.
Selalu prioritaskan: **Security → Correctness → Maintainability → Scalability → Performance**

---
RAW;

// ==========================================
// 1. ISI LENGKAP DATABASE_PRD.md
// ==========================================
$databaseContent = $aiHeader . <<<'RAW'

# DATABASE SPECIFICATION & ARCHITECTURE (DATABASE_PRD.md)
**Project:** Website Klinik Ortotik & Prostetik Indonesia (Ref: orthocareindonesia.co.id)

## 1. STRUKTUR LENGKAP MIGRATIONS (LARAVEL 12)

Buat seluruh file migrasi ini pada `database/migrations/`:

### 1.1 `create_users_table.php`
```php
Schema::create('users', function (Blueprint $table) {
    $table->id();
    $table->string('name', 100);
    $table->string('email', 150)->unique();
    $table->timestamp('email_verified_at')->nullable();
    $table->string('password');
    $table->enum('role', ['superadmin', 'admin', 'author'])->default('admin');
    $table->rememberToken();
    $table->timestamps();
});

1.2 create_categories_table.php
code
PHP
Schema::create('categories', function (Blueprint $table) {
    $table->id();
    $table->string('name', 100);
    $table->string('slug', 120)->unique();
    $table->enum('type', ['service', 'product', 'article']);
    $table->text('description')->nullable();
    $table->timestamps();

    $table->index(['type', 'slug']);
});
1.3 create_medical_services_table.php
code
PHP
Schema::create('medical_services', function (Blueprint $table) {
    $table->id();
    $table->foreignId('category_id')->nullable()->constrained('categories')->nullOnDelete();
    $table->string('title', 200);
    $table->string('slug', 220)->unique();
    $table->string('summary', 300);
    $table->longText('content');
    $table->string('thumbnail')->nullable();
    $table->string('banner_image')->nullable();
    $table->json('indications')->nullable(); // List indikasi: Kaki O, Kaki X, Skoliosis, Flatfoot
    $table->string('meta_title')->nullable();
    $table->string('meta_description', 255)->nullable();
    $table->integer('order_position')->default(0);
    $table->boolean('is_active')->default(true);
    $table->timestamps();

    $table->index(['is_active', 'order_position']);
});
1.4 create_products_table.php
code
PHP
Schema::create('products', function (Blueprint $table) {
    $table->id();
    $table->foreignId('medical_service_id')->nullable()->constrained('medical_services')->nullOnDelete();
    $table->foreignId('category_id')->nullable()->constrained('categories')->nullOnDelete();
    $table->string('name', 200);
    $table->string('slug', 220)->unique();
    $table->text('description');
    $table->json('specifications')->nullable();
    $table->json('images')->nullable();
    $table->string('thumbnail')->nullable();
    $table->boolean('is_featured')->default(false);
    $table->boolean('is_active')->default(true);
    $table->string('meta_title')->nullable();
    $table->string('meta_description', 255)->nullable();
    $table->timestamps();

    $table->index(['is_active', 'is_featured']);
});
1.5 create_branches_table.php
code
PHP
Schema::create('branches', function (Blueprint $table) {
    $table->id();
    $table->string('name', 150);
    $table->string('city', 100);
    $table->text('address');
    $table->string('phone_number', 30);
    $table->string('whatsapp_number', 30);
    $table->text('google_maps_url')->nullable();
    $table->text('google_maps_embed')->nullable();
    $table->string('opening_hours', 150)->default('Senin - Sabtu: 08:30 - 17:00 WIB');
    $table->string('image')->nullable();
    $table->boolean('is_active')->default(true);
    $table->timestamps();

    $table->index('is_active');
});
1.6 create_articles_table.php
code
PHP
Schema::create('articles', function (Blueprint $table) {
    $table->id();
    $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
    $table->foreignId('category_id')->nullable()->constrained('categories')->nullOnDelete();
    $table->string('title', 255);
    $table->string('slug', 270)->unique();
    $table->longText('content');
    $table->string('thumbnail')->nullable();
    $table->integer('read_time')->default(3);
    $table->unsignedBigInteger('views_count')->default(0);
    $table->boolean('is_published')->default(true);
    $table->timestamp('published_at')->nullable();
    $table->string('meta_title')->nullable();
    $table->string('meta_description', 255)->nullable();
    $table->timestamps();

    $table->index(['is_published', 'published_at']);
});
1.7 create_consultation_leads_table.php
code
PHP
Schema::create('consultation_leads', function (Blueprint $table) {
    $table->id();
    $table->foreignId('branch_id')->nullable()->constrained('branches')->nullOnDelete();
    $table->foreignId('medical_service_id')->nullable()->constrained('medical_services')->nullOnDelete();
    $table->string('full_name', 150);
    $table->string('phone_number', 30);
    $table->string('email', 150)->nullable();
    $table->string('complaint_type', 150);
    $table->date('preferred_date')->nullable();
    $table->text('notes')->nullable();
    $table->string('attachment_path')->nullable();
    $table->enum('status', ['new', 'contacted', 'scheduled', 'completed', 'cancelled'])->default('new');
    $table->string('ip_address', 45)->nullable();
    $table->timestamps();

    $table->index(['status', 'created_at']);
});
1.8 create_testimonials_and_settings_tables.php
code
PHP
Schema::create('testimonials', function (Blueprint $table) {
    $table->id();
    $table->string('patient_name', 150);
    $table->string('service_used', 150);
    $table->text('testimony');
    $table->string('photo')->nullable();
    $table->string('before_image')->nullable();
    $table->string('after_image')->nullable();
    $table->unsignedTinyInteger('rating')->default(5);
    $table->boolean('is_active')->default(true);
    $table->timestamps();
});

Schema::create('site_settings', function (Blueprint $table) {
    $table->id();
    $table->string('key', 100)->unique();
    $table->longText('value')->nullable();
    $table->string('group', 50)->default('general');
    $table->timestamps();
});

2. ELOQUENT MODELS LENGKAP
Buat file model di app/Models/:
code
PHP
// app/Models/MedicalService.php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MedicalService extends Model
{
    protected $fillable = ['category_id', 'title', 'slug', 'summary', 'content', 'thumbnail', 'banner_image', 'indications', 'meta_title', 'meta_description', 'order_position', 'is_active'];
    protected $casts = ['indications' => 'array', 'is_active' => 'boolean', 'order_position' => 'integer'];

    public function category(): BelongsTo { return $this->belongsTo(Category::class); }
    public function products(): HasMany { return $this->hasMany(Product::class); }
    public function leads(): HasMany { return $this->hasMany(ConsultationLead::class); }
}
code
PHP
// app/Models/ConsultationLead.php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ConsultationLead extends Model
{
    protected $fillable = ['branch_id', 'medical_service_id', 'full_name', 'phone_number', 'email', 'complaint_type', 'preferred_date', 'notes', 'attachment_path', 'status', 'ip_address'];
    protected $casts = ['preferred_date' => 'date'];

    public function branch(): BelongsTo { return $this->belongsTo(Branch::class); }
    public function medicalService(): BelongsTo { return $this->belongsTo(MedicalService::class); }
}
code
PHP
// app/Models/Branch.php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Branch extends Model
{
    protected $fillable = ['name', 'city', 'address', 'phone_number', 'whatsapp_number', 'google_maps_url', 'google_maps_embed', 'opening_hours', 'image', 'is_active'];
    protected $casts = ['is_active' => 'boolean'];
    public function leads(): HasMany { return $this->hasMany(ConsultationLead::class); }
}
3. SEEDER REALISTIS (database/seeders/DatabaseSeeder.php)
code
PHP
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Category;
use App\Models\MedicalService;
use App\Models\Branch;
use App\Models\SiteSetting;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Super Admin Ortotik',
            'email' => 'admin@ortotik.co.id',
            'password' => Hash::make('PasswordOrtotik2026!'),
            'role' => 'superadmin',
        ]);

        $catOrt = Category::create(['name' => 'Ortotik (Brace & Insole)', 'slug' => 'ortotik', 'type' => 'service']);
        $catPros = Category::create(['name' => 'Prostetik (Kaki/Tangan Palsu)', 'slug' => 'prostetik', 'type' => 'service']);

        MedicalService::create([
            'category_id' => $catOrt->id,
            'title' => 'Koreksi Kaki O & Kaki X (Genu Varum & Valgum)',
            'slug' => 'koreksi-kaki-o-dan-x',
            'summary' => 'Penanganan sudut kelainan lutut anak dan dewasa dengan brace ortopedi custom.',
            'content' => '<p>Evaluasi menyeluruh biomekanik dan pembuatan KAFO / Knee Brace khusus untuk meluruskan poros tungkai.</p>',
            'indications' => ['Lutut menempel saat jalan', 'Jarak antar lutut renggang > 4cm', 'Cepat lelah saat berjalan'],
            'order_position' => 1,
            'is_active' => true,
        ]);

        MedicalService::create([
            'category_id' => $catOrt->id,
            'title' => 'Custom Insole Medis (Flat Foot & Plantar Fasciitis)',
            'slug' => 'custom-insole-medis',
            'summary' => 'Insole cetak 3D untuk telapak kaki rata dan meredakan nyeri tumit berlebih.',
            'content' => '<p>Solusi orthotic insole dengan foot scan berteknologi tinggi untuk mengoreksi distribusi tekanan kaki.</p>',
            'indications' => ['Telapak kaki datar tanpa lengkungan', 'Nyeri tumit saat bangun tidur', 'Keseleo berulang'],
            'order_position' => 2,
            'is_active' => true,
        ]);

        MedicalService::create([
            'category_id' => $catPros->id,
            'title' => 'Kaki Palsu Bawah Lutut (Transtibial Prosthesis)',
            'slug' => 'kaki-palsu-bawah-lutut',
            'summary' => 'Prostesis bawah lutut ringan dengan soket carbon fiber berkualitas internasional.',
            'content' => '<p>Didesain presisi untuk mobilitas aktif pasca amputasi bawah lutut dengan bantalan silikon medis anti lecet.</p>',
            'indications' => ['Pasca amputasi bawah lutut', 'Penggantian kaki palsu lama'],
            'order_position' => 3,
            'is_active' => true,
        ]);

        Branch::create([
            'name' => 'Klinik Cabang Jakarta',
            'city' => 'Jakarta Pusat',
            'address' => 'Jl. Salemba Raya No. 45, Jakarta Pusat',
            'phone_number' => '021-3901234',
            'whatsapp_number' => '6281234567890',
            'is_active' => true,
        ]);

        Branch::create([
            'name' => 'Klinik Cabang Surabaya',
            'city' => 'Surabaya',
            'address' => 'Jl. Dharmahusada No. 88, Gubeng, Surabaya',
            'phone_number' => '031-5901234',
            'whatsapp_number' => '6281234567891',
            'is_active' => true,
        ]);

        SiteSetting::create(['key' => 'site_name', 'value' => 'Ortocare Indonesia Clinic', 'group' => 'general']);
        SiteSetting::create(['key' => 'whatsapp_global', 'value' => '6281234567890', 'group' => 'contact']);
    }
}