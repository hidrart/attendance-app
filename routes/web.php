<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RecordController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AttendanceController;

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

Auth::routes();

Route::redirect('/', '/presence');

Route::middleware(['auth'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/presence', [HomeController::class, 'presence'])->name('presence');
    Route::post('/checkin', [RecordController::class, 'checkin'])->name('checkin');
    Route::post('/checkout', [RecordController::class, 'checkout'])->name('checkout');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::resource('users', UserController::class)->except(['store', 'update', 'destroy']);
    Route::resource('attendances', AttendanceController::class);
    Route::resource('records', RecordController::class);
});
