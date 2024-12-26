<?php

use App\Http\Controllers\Auth\UserController;
use App\Http\Controllers\Folder\FolderController;
use App\Http\Controllers\History\UserHistoryController;
use App\Http\Controllers\Tag\TagController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource("userHistory", UserHistoryController::class);

Route::apiResource('tags', TagController::class);

Route::apiResource('user', UserController::class);

Route::get('folders', [FolderController::class, 'index']); // Lấy danh sách
Route::get('folders/{id}', [FolderController::class, 'show']); // Lấy chi tiết
Route::post('folders', [FolderController::class, 'store']); // Tạo mới
Route::put('folders/{id}', [FolderController::class, 'update']); // Cập nhật
Route::delete('folders/{id}', [FolderController::class, 'destroy']); // Xóa