<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return response()->json([
        'message' => 'There is nothing here.',
        'status' => 'API Active',
        'documentation' => 'http://api.laravel.local:8000/api/docs'
    ]);
});