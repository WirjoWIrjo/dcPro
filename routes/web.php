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
use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/
Route::get('/', [HomeController::class, 'index']);
Route::get('/home', [HomeController::class, 'index']);
Route::get('/infrastructure', [FacilityController::class, 'index']);
Route::get('/sustainability', [MonitoringController::class, 'index']);
Route::get('/about', function () { return view('pages.about'); });
Route::get('/contact', [ContactController::class, 'index']);
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

// Articles
Route::get('/articles', [MonitoringController::class, 'indexArtikel'])->name('articles.index');
Route::get('/articles/{id}', [MonitoringController::class, 'showArticle'])->name('articles.show');

// Products
Route::get('/products', [\App\Http\Controllers\ProductPublicController::class, 'index'])->name('products.index');
Route::get('/products/{id}', [\App\Http\Controllers\ProductPublicController::class, 'show'])->name('products.show');

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
