<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\HomeController;

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

Route::group(['prefix' => 'customer'], function () {
    Route::group(['middleware' => 'permission:customers.write'], function () {
        Route::get('/create', [CustomerController::class, 'create'])->name('customer.create');
        Route::get('/{customer}/edit', [CustomerController::class, 'edit'])->name('customer.edit');
        Route::post('', [CustomerController::class, 'store'])->name('customer.store');
        Route::put('/{customer}', [CustomerController::class, 'update'])->name('customer.update');
        Route::delete('/{customer}', [CustomerController::class, 'destroy'])->name('customer.destroy');
    });
    Route::group(['middleware' => 'permission:customers.read|customers.write'], function () {
        Route::get('', [CustomerController::class, 'index'])->name('customer.index');
        Route::get('/{customer}', [CustomerController::class, 'show'])->name('customer.show');
    });
});

Route::group(['prefix' => 'driver'], function () {
    Route::group(['middleware' => 'permission:drivers.write'], function () {
        Route::get('/create', [DriverController::class, 'create'])->name('driver.create');
        Route::get('/{driver}/edit', [DriverController::class, 'edit'])->name('driver.edit');
        Route::post('', [DriverController::class, 'store'])->name('driver.store');
        Route::put('/{driver}', [DriverController::class, 'update'])->name('driver.update');
        Route::delete('/{driver}', [DriverController::class, 'destroy'])->name('driver.destroy');
    });
    Route::group(['middleware' => 'permission:drivers.read|drivers.write'], function () {
        Route::get('', [DriverController::class, 'index'])->name('driver.index');
        Route::get('/{driver}', [DriverController::class, 'show'])->name('driver.show');
    });
});

Route::get('/deleteFile', [HomeController::class, 'deleteFolder']);