<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return response()->json([
        'message' => 'There is nothing here.',
        'status' => true,
        'name' => env('APP_NAME'),
        'url' => env('APP_URL'),
        'rate_limit' => (int) env('API_RATE_LIMIT'),
    ]);
});