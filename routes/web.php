<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\ProductCategoryController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('language/{locale}', function ($locale) {
    app()->setLocale($locale);
    session()->put('locale', $locale);
    return redirect()->back();
})->name('language.switch');

Route::get('/', [DashboardController::class, 'index'])->middleware(['auth', 'verified']);

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // Profile Routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Product Category Routes
    Route::get('/product-category', [ProductCategoryController::class, 'show'])->name('product_category.show');
    Route::get('/product-category/create', [ProductCategoryController::class, 'create'])->name('product_category.create');
    Route::get('/product-category/edit/{id}', [ProductCategoryController::class, 'edit'])->name('product_category.edit');
    Route::post('/product-category/store', [ProductCategoryController::class, 'store'])->name('product_category.store');
    Route::post('/product-category/update', [ProductCategoryController::class, 'update'])->name('product_category.update');
    Route::post('/product-category/delete', [ProductCategoryController::class, 'delete'])->name('product_category.delete');

    // Shop Routes
    Route::get('/shop', [ShopController::class, 'show'])->name('shop.show');
    Route::get('/shop/detail/{id}', [ShopController::class, 'detail'])->name('shop.detail');
    Route::get('/shop/create', [ShopController::class, 'create'])->name('shop.create');
    Route::get('/shop/edit/{id}', [ShopController::class, 'edit'])->name('shop.edit');
    Route::post('/shop/store', [ShopController::class, 'store'])->name('shop.store');
    Route::post('/shop/update', [ShopController::class, 'update'])->name('shop.update');
    Route::post('/shop/delete', [ShopController::class, 'delete'])->name('shop.delete');
});

require __DIR__.'/auth.php';
