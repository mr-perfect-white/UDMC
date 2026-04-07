<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\RegisterController;
use App\Http\Controllers\Frontend\VehicleRegisterController;
use  App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\Master\PlantController;
use App\Http\Controllers\Admin\Master\VehicleController;
use App\Http\Controllers\Auth\VehicleAuthController;
use APP\Http\Middleware\VehicleAuthMiddleware;




Route::get('/', function () {
    return view('welcome');
});

Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::get('/vehicleform', [VehicleRegisterController::class, 'index'])->name('vehicleform');

Route::post('/vehicle/store', [VehicleRegisterController::class, 'store'])->name('vehicle.store');
Route::get('/vehicle/view/{id}', [VehicleController::class, 'show'])->name('vehicle.view');

Route::get('/status', [RegisterController::class, 'status'])->name('status');

 Route::post('/register/store',[RegisterController::class,'store'])->name('register.store');



Route::middleware(['auth'])->group(function () {

    Route::get('/admin/plant', [PlantController::class, 'index'])->name('plant');
    Route::get('/admin/vehicle', [VehicleController::class, 'index'])->name('vehicle');

    Route::get('/admin/plantcreate', [PlantController::class, 'create'])->name('plant.create');

    Route::post('/admin/plant/store', [PlantController::class, 'store'])
        ->name('admin.plant.store');
    Route::post('/plant/{id}/toggle', [PlantController::class, 'toggle'])->name('plants.toggle');

});


Route::get('/login', function () {
    return redirect()->route('admin.login');
})->name('login');

// Login
Route::get('/admin/login', [LoginController::class, 'index'])->name('admin.login');
Route::post('/admin/login', [LoginController::class, 'login'])->name('admin.login.submit');

// Dashboard
Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
})->name('admin.dashboard');





use App\Http\Controllers\Admin\Register\FormRegisterController;

Route::prefix('admin')->middleware('auth')->group(function () {

    Route::resource('register', FormRegisterController::class);

});

Route::post('/register/{id}/approve', [FormRegisterController::class, 'approve'])
    ->name('admin.register.approve');
    Route::get('/admin/dashboard', [FormRegisterController::class, 'dashboardcount'])
    ->name('admin.dashboard');
// Logout
Route::get('/admin/logout', [LoginController::class, 'logout'])->name('admin.logout');



// Vehicle Routes
Route::prefix('vehicle')->name('vehicle.')->group(function () {

 
    Route::get('/login', [VehicleAuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [VehicleAuthController::class, 'login'])->name('login.post');

    
    
    Route::post('/logout', [VehicleAuthController::class, 'logout'])->name('logout');

    
    Route::middleware(['vehicle.auth'])->group(function () {

        Route::get('/dashboard', function () {
            return view('vehiclepwa.dashboard');
        })->name('dashboard');

    });

});


use App\Http\Controllers\PaymentController;

Route::get('/payment', [PaymentController::class, 'createOrder']);
Route::post('/payment-success', [PaymentController::class, 'paymentSuccess'])->name('payment.success');