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
