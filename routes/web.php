<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WorkController;
use App\Http\Controllers\RecordController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\ActionPlanController;

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
    // home
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/presence', [HomeController::class, 'presence'])->name('presence');

    // record
    Route::post('/checkin', [RecordController::class, 'checkin'])->name('checkin');
    Route::post('/checkout', [RecordController::class, 'checkout'])->name('checkout');

    // works
    Route::resource('works', WorkController::class)->only(['index'])->only(['index']);

    // action plan
    Route::get('/actions', [ActionPlanController::class, 'userAction'])->name('actions.index');
    Route::post('/actions/change', [ActionPlanController::class, 'change'])->name('actions.change');
    Route::resource('works.actions', ActionPlanController::class)->shallow()->only([
        'index', 'store', 'destroy'
    ]);
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/logsheet', [HomeController::class, 'logsheet'])->name('logsheet');
    Route::resource('users', UserController::class)->only(['index']);
    Route::resource('attendances', AttendanceController::class)->only(['index']);

    Route::post('/works/change', [WorkController::class, 'change'])->name('works.change');
    Route::resource('works', WorkController::class)->only(['store', 'destroy']);
});
