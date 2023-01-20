<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\mainController;
use App\Http\Controllers\fileController;
use App\Http\Controllers\folderOrFileController;

Route::get('/login', [mainController::class, 'halamanLogin'] )->name('login');
Route::get('/profile', [mainController::class, 'profileIndex'] )->middleware('auth');
Route::post('/login', [mainController::class, 'prosesLogin'] );
Route::resource('/administrasi-guru', fileController::class )->middleware('auth');
Route::resource('/folderOrFile', folderOrFileController::class )->middleware('auth');
