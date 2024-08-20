<?php

use App\Http\Controllers\DataKualitasAirController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('kualitas_air', [DataKualitasAirController::class, 'index']);
Route::get('/kualitas_air/{id}', [DataKualitasAirController::class, 'view']);
Route::post('kualitas_air', [DataKualitasAirController::class, 'store']);
Route::put('/kualitas_air/{id}', [DataKualitasAirController::class, 'update']);
Route::delete('/kualitas_air/{id}', [DataKualitasAirController::class, 'delete']);