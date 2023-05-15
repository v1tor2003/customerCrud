<?php

use App\Http\Controllers\CustomerController;
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
    return "test";
});

Route::controller(CustomerController::class)->group(function(){
    Route::get('/customers', 'index');
    Route::get('/customers/create', 'create');
    Route::post('/customers', 'store');
    Route::get('/customers/{customer}/edit', 'edit');
    Route::put('/customer/{customer}', 'update');
    Route::delete('/customers/{customer}', 'destroy');
});