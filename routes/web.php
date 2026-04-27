<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PayuController;

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
Route::get('/payment', [PaymentController::class, 'index']);
Route::post('/payment/verify', [PaymentController::class, 'verify']);

// PayU Routes
Route::get('/payu', [PayuController::class, 'index']);
Route::post('/payu/success', [PayuController::class, 'success'])->name('payu.success');
Route::post('/payu/failure', [PayuController::class, 'failure'])->name('payu.failure');