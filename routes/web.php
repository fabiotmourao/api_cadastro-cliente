<?php

use Illuminate\Support\Facades\Route;

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


// route::prefix('clientes')->group(function() {
//     route::get('/',[ClienteController::class, 'index']);
//     route::post('/create', [ClienteController::class, 'store']);
// });
