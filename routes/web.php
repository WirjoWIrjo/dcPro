<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\FacilityController;
use App\Http\Controllers\MonitoringController;
use App\Http\Controllers\ProductPublicController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AboutController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

// Home
Route::get('/', [HomeController::class, 'index'])->name('home.index');
Route::get('/home', [HomeController::class, 'index']);
Route::get('/home/create', [HomeController::class, 'create'])->name('home.create');
Route::post('/home', [HomeController::class, 'store'])->name('home.store');
Route::get('/home/{id}', [HomeController::class, 'show'])->name('home.show');
Route::get('/home/{id}/edit', [HomeController::class, 'edit'])->name('home.edit');
Route::put('/home/{id}', [HomeController::class, 'update'])->name('home.update');
Route::delete('/home/{id}', [HomeController::class, 'destroy'])->name('home.destroy');

// Infrastructure
Route::get('/infrastructure', [FacilityController::class, 'index'])->name('facilities.index');
Route::get('/infrastructure/create', [FacilityController::class, 'create'])->name('facilities.create');
Route::post('/infrastructure', [FacilityController::class, 'store'])->name('facilities.store');
Route::get('/infrastructure/{id}', [FacilityController::class, 'show'])->name('facilities.show');
Route::get('/infrastructure/{id}/edit', [FacilityController::class, 'edit'])->name('facilities.edit');
Route::put('/infrastructure/{id}', [FacilityController::class, 'update'])->name('facilities.update');
Route::delete('/infrastructure/{id}', [FacilityController::class, 'destroy'])->name('facilities.destroy');

// Sustainability (Energy Metrics)
Route::get('/sustainability', [MonitoringController::class, 'index'])->name('monitoring.index');
Route::get('/sustainability/metric/create', [MonitoringController::class, 'createMetric'])->name('monitoring.createMetric');
Route::post('/sustainability/metric', [MonitoringController::class, 'storeMetric'])->name('monitoring.storeMetric');
Route::get('/sustainability/metric/{id}', [MonitoringController::class, 'showMetric'])->name('monitoring.showMetric');
Route::get('/sustainability/metric/{id}/edit', [MonitoringController::class, 'editMetric'])->name('monitoring.editMetric');
Route::put('/sustainability/metric/{id}', [MonitoringController::class, 'updateMetric'])->name('monitoring.updateMetric');
Route::delete('/sustainability/metric/{id}', [MonitoringController::class, 'destroyMetric'])->name('monitoring.destroyMetric');

// Articles (public)
Route::get('/articles', [MonitoringController::class, 'indexArtikel'])->name('monitoring.indexArtikel');
Route::get('/articles/create', [MonitoringController::class, 'createArticle'])->name('monitoring.createArticle');
Route::post('/articles', [MonitoringController::class, 'storeArticle'])->name('monitoring.storeArticle');
Route::get('/articles/{id}', [MonitoringController::class, 'showArticle'])->name('monitoring.showArticle');
Route::get('/articles/{id}/edit', [MonitoringController::class, 'editArticle'])->name('monitoring.editArticle');
Route::put('/articles/{id}', [MonitoringController::class, 'updateArticle'])->name('monitoring.updateArticle');
Route::delete('/articles/{id}', [MonitoringController::class, 'destroyArticle'])->name('monitoring.destroyArticle');

// Products (public)
Route::get('/products', [ProductPublicController::class, 'index'])->name('products.index');
Route::get('/products/{id}', [ProductPublicController::class, 'show'])->name('products.show');

// About
Route::get('/about', [AboutController::class, 'index'])->name('about.index');

// Contact
Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->name('admin.')->group(function () {

    // Guest routes (login page)
    Route::middleware(\App\Http\Middleware\GuestAdmin::class)->group(function () {
        Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
        Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    });

    // Protected admin routes
    Route::middleware(\App\Http\Middleware\AdminAuth::class)->group(function () {
        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

        // Dashboard
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

        // CRUD Resources
        Route::resource('articles', ArticleController::class);
        Route::resource('products', ProductController::class);
        Route::resource('galleries', GalleryController::class);

        // Company Profile
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');

        // Reports
        Route::get('/reports/articles-pdf', [ReportController::class, 'articlesPdf'])->name('reports.articles');
    });
});
