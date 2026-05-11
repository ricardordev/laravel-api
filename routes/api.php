<?php
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;

// token generator
Route::post('/auth', [AuthController::class, 'login']);

// protected routes
Route::middleware('auth:sanctum')->group(function () {
    // Resource Controller para /api/transactions
    // GET    /transactions          -> index
    // POST   /transactions          -> store
    // PUT    /transactions/{hash}   -> update
    // DELETE /transactions/{hash}   -> destroy
    Route::apiResource('transactions', TransactionController::class)
         ->parameters(['transactions' => 'transaction:hash']);
});