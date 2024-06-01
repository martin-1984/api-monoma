<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\LeadController;
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

Route::post('/auth', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {

    Route::post('/lead', [LeadController::class, 'create'])->middleware('manager');
    Route::get('/lead/{id}', [LeadController::class, 'show']);
    Route::get('/leads', [LeadController::class, 'all']);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
