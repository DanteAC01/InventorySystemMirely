<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;



Auth::routes();

Route::middleware(['auth'])->group(function () {
 Route::get('/', function () {return view('home');});
 Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


 Route::get('/areaList', [App\Http\Controllers\AreaController::class, 'index'])->name('areaList');
 Route::get('/areaCreate', [App\Http\Controllers\AreaController::class, 'create'])->name('areaCreate');
 Route::post('/areaSave', [App\Http\Controllers\AreaController::class, 'store'])->name('areaSave');
 
 Route::get('/materialeList', [App\Http\Controllers\MarterialeController::class, 'index'])->name('materialeList');
 Route::get('/materialeCreate', [App\Http\Controllers\MarterialeController::class, 'create'])->name('
 ');
 Route::post('/materialeSave', [App\Http\Controllers\MarterialeController::class, 'store'])->name('materialeSave');
 Route::get('/materialeShow{id}', [App\Http\Controllers\MarterialeController::class, 'show'])->name('materialeShow');
});