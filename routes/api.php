<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});
Route::get("history",[UserHistoryController::class,"show"]);


    // Route API cho các hành động của TagController
    Route::apiResource('tags', TagController::class);


Route::apiResource('user', UserController::class);
