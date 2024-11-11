<?php

use App\Http\Controllers\Api\TransactionController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::prefix('transactions')->group(function () {
    Route::post('/', [TransactionController::class, 'store']);
    Route::get('/', [TransactionController::class, 'index']);
});

Route::prefix('users')->group(function () {
    Route::get('{user}/transactions', [TransactionController::class, 'userTransactions']);
    Route::get('{user}/balance', [TransactionController::class, 'balance']);
});
