<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\mainController;
use App\Http\Controllers\fileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\folderOrFileController;

Route::resource('/account/user',UserController::class );
Route::get('/logout', [mainController::class, 'logout'] )->name('logout')->middleware('auth');;
Route::get('/file/download/{path}/{name}', [folderOrFileController::class, 'download'] )->name('download')->middleware('auth');;
Route::get('/file/view/{path}/{name}', [folderOrFileController::class, 'view'] )->name('view')->middleware('auth');;
Route::get('/file/delete/{id}', [folderOrFileController::class, 'deleteFile'] )->name('view')->middleware('auth');;
Route::get('/login', [mainController::class, 'halamanLogin'] )->name('login')->middleware('guest');;
Route::post('/upload-file', [folderOrFileController::class, 'uploadFile'])->middleware('auth');;
Route::get('/profile', [mainController::class, 'profileIndex'])->middleware('auth');;
Route::post('/login', [mainController::class, 'prosesLogin'])->middleware('guest');;
Route::resource('/administrasi-guru', fileController::class)->middleware('auth');
Route::resource('/folderOrFile', folderOrFileController::class)->middleware('auth');
Route::get('/{hakakses}/{folder}/akses', [folderOrFileController::class, 'folder'])->middleware('auth');
Route::get('/search/{str}', [folderOrFileController::class, 'search'])->middleware('auth');
