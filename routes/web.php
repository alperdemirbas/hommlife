<?php

use App\Http\Controllers\Admin\Products as AdminProductsController;
use App\Http\Controllers\Admin\ProfileController as AdminProfileController;
use App\Http\Controllers\User\Products;
use App\Http\Controllers\User\ProfileController as UserProfileController;

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('admin')->middleware('auth:admin')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware(['verified'])->name('admin.dashboard');

    Route::get('/profile', [AdminProfileController::class, 'edit'])->name('admin.profile.edit');
    Route::patch('/profile', [AdminProfileController::class, 'update'])->name('admin.profile.update');
    Route::delete('/profile', [AdminProfileController::class, 'destroy'])->name('admin.profile.destroy');

    # Ürünler
    Route::prefix('/products')->group(function () {
        Route::get('/', [AdminProductsController::class,'index'])->name('admin.products.index');
        Route::get('/create', [AdminProductsController::class,'create'])->name('admin.products.create');
        Route::post('/store', [AdminProductsController::class,'store'])->name('admin.products.store');
        Route::get('/edit', [AdminProductsController::class,'edit'])->name('admin.products.edit');
        Route::patch('/update', [AdminProductsController::class,'update'])->name('admin.products.update');
        Route::delete('/destroy/{id}', [AdminProductsController::class,'destroy'])->name('admin.products.destroy');
    });

});

Route::prefix('/')->group(function () {
    Route::middleware('auth')->group(function () {
        Route::get('/dashboard', function () {
            return view('dashboard');
        })->middleware(['verified'])->name('dashboard');

        Route::get('/profile', [UserProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [UserProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [UserProfileController::class, 'destroy'])->name('profile.destroy');
    });

    # Ürünler
    Route::group(['middleware' => ['web']], function () {
        Route::get('products', [Products::class, 'index'])->name('product.index');
        Route::get('products/{id}', [Products::class, 'get'])->name('product.get');
    });

});


require __DIR__.'/auth.php';
