<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TagController\TagController;

// Corrected code
Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});


    // Route API cho các hành động của TagController
    Route::apiResource('tags', TagController::class);
    
