<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


use App\Http\Controllers\api\v2\TransactionController;

Route::prefix('v2/transactions')->group(function () {

    // List all transactions
    Route::get('/', [TransactionController::class, 'index']);

    // Store a new transaction
    Route::post('/', [TransactionController::class, 'store']);
    
    // Get a single transaction by ID
    Route::get('/{id}', [TransactionController::class, 'show']);

    // Update an existing transaction
    Route::put('/{id}', [TransactionController::class, 'update']);    
});
