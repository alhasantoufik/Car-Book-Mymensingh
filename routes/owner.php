<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Owner\CarController;
use App\Http\Controllers\Owner\BookingController as OwnerBookingController;

Route::middleware(['auth', 'role:owner'])->prefix('owner')->name('owner.')->group(function () {

    Route::get('/cars', [CarController::class, 'index'])->name('cars.index');
    Route::get('/cars/create', [CarController::class, 'create'])->name('cars.create');
    Route::post('/cars', [CarController::class, 'store'])->name('cars.store');

});



Route::middleware(['auth', 'role:owner'])
    ->prefix('owner')
    ->name('owner.')
    ->group(function () {

        Route::get('/bookings', [OwnerBookingController::class, 'index'])
            ->name('bookings.index');

        Route::post('/bookings/{id}/approve', [OwnerBookingController::class, 'approve'])
            ->name('bookings.approve');

        Route::post('/bookings/{id}/cancel', [OwnerBookingController::class, 'cancel'])
            ->name('bookings.cancel');
});
