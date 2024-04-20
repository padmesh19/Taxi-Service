<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\RideRequestController;
use App\Http\Controllers\PaymentController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/mainpage', function () {
    return view('ui.mainpage');
})->name('mainpage');

Route::group(['prefix' => 'customer'], function () {
    Route::group(['middleware' => 'permission:customers.write'], function () {
        Route::get('/create', [CustomerController::class, 'create'])->name('customer.create');
        Route::get('/{user}/edit', [CustomerController::class, 'edit'])->name('customer.edit');
        Route::post('', [CustomerController::class, 'store'])->name('customer.store');
        Route::put('/{user}', [CustomerController::class, 'update'])->name('customer.update');
        Route::delete('/{user}', [CustomerController::class, 'destroy'])->name('customer.destroy');
    });
    Route::group(['middleware' => 'permission:customers.read'], function () {
        Route::get('', [CustomerController::class, 'index'])->name('customer.index');
        Route::get('/{user}', [CustomerController::class, 'show'])->name('customer.show');
    });
});

Route::group(['prefix' => 'driver'], function () {
    Route::group(['middleware' => 'permission:drivers.write'], function () {
        Route::get('/create', [DriverController::class, 'create'])->name('driver.create');
        Route::get('/{user}/edit', [DriverController::class, 'edit'])->name('driver.edit');
        Route::post('', [DriverController::class, 'store'])->name('driver.store');
        Route::put('/{user}', [DriverController::class, 'update'])->name('driver.update');
        Route::delete('/{user}', [DriverController::class, 'destroy'])->name('driver.destroy');
    });
    Route::group(['middleware' => 'permission:drivers.read|drivers.write'], function () {
        Route::get('', [DriverController::class, 'index'])->name('driver.index');
        Route::get('/{user}', [DriverController::class, 'show'])->name('driver.show');
    });
});

Route::group(['prefix' => 'driver'], function () {
    Route::group(['middleware' => 'permission:driverLocations.write'], function () {
        Route::get('/location/{user}', [DriverController::class, 'Location'])->name('driverLocation.show');
        Route::put('/location/{user}', [DriverController::class, 'updateLocation'])->name('driverLocation.update');
        Route::get('/location/{user}/edit', [DriverController::class, 'editLocation'])->name('driverLocation.edit');
    });
});

Route::group(['prefix' => 'ride'], function () {
    Route::group(['middleware' => 'permission:rides.write'], function () {
        Route::get('/create', [RideRequestController::class, 'create'])->name('ride.create');
        Route::get('/{rideRequest}/edit', [RideRequestController::class, 'edit'])->name('ride.edit');
        Route::post('', [RideRequestController::class, 'store'])->name('ride.store');
        Route::put('/{rideRequest}', [RideRequestController::class, 'update'])->name('ride.update');
        Route::delete('/{rideRequest}', [RideRequestController::class, 'destroy'])->name('ride.destroy');
    });
    Route::group(['middleware' => 'permission:rides.write'], function () {
        Route::get('', [RideRequestController::class, 'index'])->name('ride.index');
        Route::get('/{rideRequest}', [RideRequestController::class, 'show'])->name('ride.show');
        Route::get('/ride-history/{rideRequest}', [RideRequestController::class, 'rideHistory'])->name('ride.history');
    });

    Route::group(['middleware' => 'permission:rides.accept'], function () {
        Route::get('/accept/{rideRequest}', [RideRequestController::class, 'rideRequestAccept'])->name('ride.accept');
        Route::get('/reject/{rideRequest}', [RideRequestController::class, 'rideRequestReject'])->name('ride.reject');
        Route::get('/complete/{rideRequest}', [RideRequestController::class, 'rideCompleted'])->name('ride.complete');
    });
});



Route::group(['prefix' => 'payment'], function () {
    Route::group(['middleware' => 'permission:payments.write'], function () {
        Route::get('/create/{rideRequest}', [PaymentController::class, 'create'])->name('payment.create');
        Route::get('/{payment}/edit', [PaymentController::class, 'edit'])->name('payment.edit');
        Route::post('', [PaymentController::class, 'store'])->name('payment.store');
        Route::put('/{payment}', [PaymentController::class, 'update'])->name('payment.update');
        Route::delete('/{payment}', [PaymentController::class, 'destroy'])->name('payment.destroy');
    });
    Route::group(['middleware' => 'permission:payments.write'], function () {
        Route::get('', [PaymentController::class, 'index'])->name('payment.index');
        Route::get('/{payment}', [PaymentController::class, 'show'])->name('payment.show');
    });
});
