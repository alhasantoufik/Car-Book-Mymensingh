<?php

use App\Http\Controllers\Admin\BookingController as AdminBookingController;
use App\Http\Controllers\Admin\CarBrandController;
use App\Http\Controllers\Admin\CarCategoryController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {

    Route::get('/car-brands', [CarBrandController::class, 'index'])->name('car-brands.index');
    Route::post('/car-brands', [CarBrandController::class, 'store'])->name('car-brands.store');

    Route::get('/car-categories', [CarCategoryController::class, 'index'])->name('car-categories.index');
    Route::post('/car-categories', [CarCategoryController::class, 'store'])->name('car-categories.store');

});

Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')
    ->group(function () {

        Route::get('/bookings', [AdminBookingController::class, 'index'])->name('bookings.index');
        
    });
