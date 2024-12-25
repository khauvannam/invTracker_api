<?php

use App\Http\Controllers\Auth\UserController;
use App\Http\Controllers\Histories\UserHistoryController;
use App\Http\Controllers\TagController\TagController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});
<<<<<<< HEAD
Route::get("history",[UserHistoryController::class,"index"]);
=======
Route::get("history", [UserHistoryController::class, "show"]);

Route::apiResource('tags', TagController::class);

Route::apiResource('user', UserController::class);
>>>>>>> origin/namdeptrai
