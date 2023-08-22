<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\ClienteController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::prefix('clientes')->group(function() {
    Route::get('/', [ClienteController::class, 'index']);
    Route::post('create', [ClienteController::class, 'store']);
    Route::put('update/{id}', [ClienteController::class, 'update']);
    Route::get('filtrar', [ClienteController::class, 'filtrar']);
    Route::delete('delete/{id}', [ClienteController::class, 'destroy']);
});
