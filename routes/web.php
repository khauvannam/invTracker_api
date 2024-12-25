<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controllers\TagController\TagController;

Route::get('/', function () {
    return ['Laravel' => app()->version()];
});


require __DIR__.'/auth.php';
