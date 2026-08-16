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
        
        // Placeholder routes for subsequent tasks to prevent route error in sidebar
        Route::get('/leads', function () {
            return redirect()->route('admin.dashboard');
        })->name('leads.index');

        Route::get('/products', function () {
            return redirect()->route('admin.dashboard');
        })->name('products.index');

        Route::get('/services', function () {
            return redirect()->route('admin.dashboard');
        })->name('services.index');

        Route::get('/articles', function () {
            return redirect()->route('admin.dashboard');
        })->name('articles.index');

        Route::get('/branches', function () {
            return redirect()->route('admin.dashboard');
        })->name('branches.index');

        Route::get('/settings', function () {
            return redirect()->route('admin.dashboard');
        })->name('settings.index');
    });
});

