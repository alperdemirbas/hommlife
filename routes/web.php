<?php

use App\Http\Controllers\Admin\Campaign as CampaignController;
use App\Http\Controllers\Admin\CampaignPeriod;
use App\Http\Controllers\Admin\CampaignPeriodProduct;
use App\Http\Controllers\Admin\Products as AdminProductsController;
use App\Http\Controllers\Admin\ProfileController as AdminProfileController;
use App\Http\Controllers\User\Cart;
use App\Http\Controllers\User\Order;
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
        Route::get('/edit/{id}', [AdminProductsController::class,'edit'])->name('admin.products.edit');
        Route::patch('/update/{id}', [AdminProductsController::class,'update'])->name('admin.product.update');
        Route::delete('/destroy/{id}', [AdminProductsController::class,'destroy'])->name('admin.products.destroy');
    });


    # Kampanyalar
    Route::prefix('/campaigns')->group(function () {
        Route::get('/',[CampaignController::class,'index'])->name('admin.campaigns.index');
        Route::get('/create',[CampaignController::class,'create'])->name('admin.campaign.create');
        Route::post('/store',[CampaignController::class,'store'])->name('admin.campaign.store');
        Route::get('/edit/{id}',[CampaignController::class,'edit'])->name('admin.campaign.edit');
        Route::patch('/update/{id}',[CampaignController::class,'update'])->name('admin.campaign.update');
        Route::delete('/destroy/{id}',[CampaignController::class,'destroy'])->name('admin.campaign.destroy');

        #Kampanya Periodları
        Route::prefix('/periods')->group(function () {
            Route::get('/',[CampaignPeriod::class,'index'])->name('admin.campaigns.periods.index');
            Route::get('/create',[CampaignPeriod::class,'create'])->name('admin.campaigns.periods.create');
            Route::post('/store',[CampaignPeriod::class,'store'])->name('admin.campaigns.periods.store');
            Route::get('/edit/{id}',[CampaignPeriod::class,'edit'])->name('admin.campaigns.periods.edit');
            Route::patch('/update/{id}',[CampaignPeriod::class,'update'])->name('admin.campaigns.periods.update');
            Route::delete('/destroy/{id}',[CampaignPeriod::class,'destroy'])->name('admin.campaigns.periods.destroy');

            # Periolara bağlı ürünler
            Route::prefix('/products')->group(function () {
                Route::get('/',[CampaignPeriodProduct::class,'index'])->name('admin.campaigns.periods.products.index');
                Route::get('/create',[CampaignPeriodProduct::class,'create'])->name('admin.campaigns.periods.products.create');
                Route::post('/store',[CampaignPeriodProduct::class,'store'])->name('admin.campaigns.periods.products.store');
                Route::get('/edit/{id}',[CampaignPeriodProduct::class,'edit'])->name('admin.campaigns.periods.products.edit');
                Route::patch('/update/{id}',[CampaignPeriodProduct::class,'update'])->name('admin.campaigns.periods.products.update');
                Route::delete('/destroy/{id}',[CampaignPeriodProduct::class,'destroy'])->name('admin.campaigns.periods.products.destroy');
            });
        });
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

    Route::resource('carts', Cart::class)->middleware(['web']);
    Route::resource('orders', Order::class)->middleware(['web']);
});


require __DIR__.'/auth.php';
