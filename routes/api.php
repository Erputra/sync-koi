<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TransferDataController;

Route::middleware('auth:sanctum')->group(function () {
    Route::post('uploadsalesdata', [TransferDataController::class, 'receive_sales_data']);
    Route::post('uploadaccountingdata', [TransferDataController::class, 'receive_accounting_data']);
    Route::post('uploadaccumulatedtransactionsdata', [TransferDataController::class, 'receive_accumulated_transactions_data']);
});

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login'])->name('login');
