<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\MedicalServiceController;
use App\Http\Controllers\CustomProductController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\ConsultationController;
use App\Http\Controllers\ContactController;

/*
|--------------------------------------------------------------------------
| Web Routes - Public
|--------------------------------------------------------------------------
*/

// Beranda (10 Sections)
Route::get('/', [HomeController::class, 'index'])->name('home');

// Layanan Medis (5 Pillars)
Route::get('/services', [MedicalServiceController::class, 'index'])->name('services.index');
Route::get('/services/{slug}', [MedicalServiceController::class, 'show'])->name('services.show');
Route::get('/layanan-medis', [MedicalServiceController::class, 'index']);
Route::get('/layanan-medis/{slug}', [MedicalServiceController::class, 'show']);

// E-Katalog Produk Ready Stock
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{slug}', [ProductController::class, 'show'])->name('products.show');
Route::get('/produk', [ProductController::class, 'index']);
Route::get('/produk/{slug}', [ProductController::class, 'show']);

// Custom Made Products (P&O Showcase)
Route::get('/custom-products', [CustomProductController::class, 'index'])->name('custom-products.index');
Route::get('/custom-products/{slug}', [CustomProductController::class, 'show'])->name('custom-products.show');
Route::get('/alur-pasien', [CustomProductController::class, 'index']);
Route::get('/alur-pasien/{slug}', [CustomProductController::class, 'show']);

// Artikel Edukasi / Blog / News
Route::get('/articles', [ArticleController::class, 'index'])->name('articles.index');
Route::get('/articles/{slug}', [ArticleController::class, 'show'])->name('articles.show');
Route::get('/artikel', [ArticleController::class, 'index']);
Route::get('/artikel/{slug}', [ArticleController::class, 'show']);
Route::get('/news', [ArticleController::class, 'index'])->name('news.index');
Route::get('/news/{slug}', [ArticleController::class, 'show'])->name('news.show');

// Formulir Konsultasi Pasien
Route::get('/consultation', [ConsultationController::class, 'create'])->name('consultation.create');
Route::post('/consultation', [ConsultationController::class, 'store'])->name('consultation.store');
Route::get('/konsultasi', [ConsultationController::class, 'create']);
Route::post('/konsultasi', [ConsultationController::class, 'store']);

// Kontak & Cabang Klinik
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::get('/kontak', [ContactController::class, 'index']);
Route::get('/about', function () {
    return view('pages.about');
})->name('about');
Route::get('/about-us', function () {
    return view('pages.about');
})->name('about-us');
Route::get('/tentang-kami', function () {
    return view('pages.about');
});

/*
|--------------------------------------------------------------------------
| Admin Authentication Routes
|--------------------------------------------------------------------------
*/
Route::get('/login', [\App\Http\Controllers\Admin\AuthController::class, 'showLoginForm'])->name('login');
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [\App\Http\Controllers\Admin\AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [\App\Http\Controllers\Admin\AuthController::class, 'login'])->name('login.submit');
    Route::post('/logout', [\App\Http\Controllers\Admin\AuthController::class, 'logout'])->name('logout');

    /*
    |--------------------------------------------------------------------------
    | Protected Admin Routes (Requires auth and admin role)
    |--------------------------------------------------------------------------
    */
    Route::middleware(['auth', 'admin'])->group(function () {
        Route::get('/', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
        Route::get('/dashboard', [\App\Http\Controllers\Admin\DashboardController::class, 'index']);
        
        // CRM Leads Management
        Route::get('/leads', [\App\Http\Controllers\Admin\ConsultationLeadController::class, 'index'])->name('leads.index');
        Route::get('/leads/{id}', [\App\Http\Controllers\Admin\ConsultationLeadController::class, 'show'])->name('leads.show');
        Route::patch('/leads/{id}/status', [\App\Http\Controllers\Admin\ConsultationLeadController::class, 'updateStatus'])->name('leads.status');
        Route::delete('/leads/{id}', [\App\Http\Controllers\Admin\ConsultationLeadController::class, 'destroy'])->name('leads.destroy');

        // CMS Products (E-Katalog) & Kategori Produk
        Route::resource('products', \App\Http\Controllers\Admin\ProductController::class)->except(['show']);
        Route::resource('product-categories', \App\Http\Controllers\Admin\ProductCategoryController::class)->except(['show']);

        // CMS Services (Layanan Medis)
        Route::resource('services', \App\Http\Controllers\Admin\MedicalServiceController::class)->except(['show']);

        // CMS Articles (Edukasi & Blog)
        Route::resource('articles', \App\Http\Controllers\Admin\ArticleController::class)->except(['show']);

        // CMS Testimonials (Ulasan Pasien Beranda)
        Route::resource('testimonials', \App\Http\Controllers\Admin\TestimonialController::class)->except(['show']);
        Route::patch('/testimonials/{id}/toggle-active', [\App\Http\Controllers\Admin\TestimonialController::class, 'toggleActive'])->name('testimonials.toggle-active');
        Route::patch('/testimonials/{id}/toggle-featured', [\App\Http\Controllers\Admin\TestimonialController::class, 'toggleFeatured'])->name('testimonials.toggle-featured');

        // CMS Branches (Cabang Klinik)
        Route::resource('branches', \App\Http\Controllers\Admin\BranchController::class)->except(['show']);

        // CMS Settings (Pengaturan Klinik)
        Route::get('/settings', [\App\Http\Controllers\Admin\SiteSettingController::class, 'index'])->name('settings.index');
        Route::put('/settings', [\App\Http\Controllers\Admin\SiteSettingController::class, 'update'])->name('settings.update');

        // Database & Excel Backup & Restore Management
        Route::prefix('backup')->name('backup.')->group(function () {
            Route::get('/', [\App\Http\Controllers\Admin\BackupController::class, 'index'])->name('index');
            Route::post('/export-sql', [\App\Http\Controllers\Admin\BackupController::class, 'exportSql'])->name('export-sql');
            Route::post('/export-excel', [\App\Http\Controllers\Admin\BackupController::class, 'exportExcel'])->name('export-excel');
            Route::post('/import-sql', [\App\Http\Controllers\Admin\BackupController::class, 'importSql'])->name('import-sql');
            Route::post('/import-excel', [\App\Http\Controllers\Admin\BackupController::class, 'importExcel'])->name('import-excel');
            Route::post('/create', [\App\Http\Controllers\Admin\BackupController::class, 'createStored'])->name('create');
            Route::get('/download/{filename}', [\App\Http\Controllers\Admin\BackupController::class, 'download'])->name('download');
            Route::post('/restore/{filename}', [\App\Http\Controllers\Admin\BackupController::class, 'restore'])->name('restore');
            Route::delete('/destroy/{filename}', [\App\Http\Controllers\Admin\BackupController::class, 'destroy'])->name('destroy');
            Route::delete('/clean-all', [\App\Http\Controllers\Admin\BackupController::class, 'cleanAll'])->name('clean-all');
            Route::post('/sync-pull', [\App\Http\Controllers\Admin\BackupController::class, 'pullSync'])->name('sync-pull');
            Route::post('/sync-test', [\App\Http\Controllers\Admin\BackupController::class, 'testSyncConnection'])->name('sync-test');
        });
    });
});
