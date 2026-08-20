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

// E-Katalog Produk Ready Stock
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{slug}', [ProductController::class, 'show'])->name('products.show');

// Custom Made Products (P&O Showcase)
Route::get('/custom-products', [CustomProductController::class, 'index'])->name('custom-products.index');
Route::get('/custom-products/{slug}', [CustomProductController::class, 'show'])->name('custom-products.show');

// Artikel Edukasi / Blog / News
Route::get('/articles', [ArticleController::class, 'index'])->name('articles.index');
Route::get('/articles/{slug}', [ArticleController::class, 'show'])->name('articles.show');
Route::get('/news', [ArticleController::class, 'index'])->name('news.index');
Route::get('/news/{slug}', [ArticleController::class, 'show'])->name('news.show');

// Formulir Konsultasi Pasien
Route::get('/consultation', [ConsultationController::class, 'create'])->name('consultation.create');
Route::post('/consultation', [ConsultationController::class, 'store'])->name('consultation.store');

// Kontak & Cabang Klinik
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::get('/about', function () {
    return view('pages.about');
})->name('about');
Route::get('/about-us', function () {
    return view('pages.about');
})->name('about-us');

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
        
        // CRM Leads Management
        Route::get('/leads', [\App\Http\Controllers\Admin\ConsultationLeadController::class, 'index'])->name('leads.index');
        Route::get('/leads/{id}', [\App\Http\Controllers\Admin\ConsultationLeadController::class, 'show'])->name('leads.show');
        Route::patch('/leads/{id}/status', [\App\Http\Controllers\Admin\ConsultationLeadController::class, 'updateStatus'])->name('leads.status');
        Route::delete('/leads/{id}', [\App\Http\Controllers\Admin\ConsultationLeadController::class, 'destroy'])->name('leads.destroy');

        // CMS Products (E-Katalog)
        Route::resource('products', \App\Http\Controllers\Admin\ProductController::class)->except(['show']);

        // CMS Services (Layanan Medis)
        Route::resource('services', \App\Http\Controllers\Admin\MedicalServiceController::class)->except(['show']);

        // CMS Articles (Edukasi & Blog)
        Route::resource('articles', \App\Http\Controllers\Admin\ArticleController::class)->except(['show']);

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
        });
    });
});

