<?php

use App\Models\Work;
use App\Models\ActionPlan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sactum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
});

Route::get('/works/{id}', function (string $id) {
    return response()->json(Work::find($id));
});

Route::get('/actions/{id}', function (string $id) {
    return response()->json(ActionPlan::find($id));
});
