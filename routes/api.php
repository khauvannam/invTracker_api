<?php

use App\Http\Controllers\Auth\UserController;
use App\Http\Controllers\Folder\FolderController;
use App\Http\Controllers\Histories\UserHistoryController;
use App\Http\Controllers\TagController\TagController;
use App\Http\Controllers\Item\ItemController;
use App\Http\Controllers\Field\CustomFieldController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});
Route::get("history", [UserHistoryController::class, "show"]);

Route::apiResource('tags', TagController::class);

Route::apiResource('user', UserController::class);

Route::apiResource('folders', FolderController::class);

Route::apiResource('items', ItemController::class);
Route::prefix('items/{itemId}')->group(function () {
    Route::post('relationships', [ItemController::class, 'addRelationship']);
    
    Route::get('relationships', [ItemController::class, 'getRelationships']);
    
    Route::delete('relationships/{relationshipId}', [ItemController::class, 'removeRelationship']);
});
Route::prefix('fields')->group(function () {
    Route::apiResource('custom-fields', CustomFieldController::class);

    Route::prefix('custom-fields/{customFieldId}/relationships')->group(function () {
        Route::post('/', [CustomFieldController::class, 'addRelationship']);  
        Route::get('/', [CustomFieldController::class, 'getRelationships']);   
        Route::delete('{relationshipId}', [CustomFieldController::class, 'removeRelationship']); 
    });
});