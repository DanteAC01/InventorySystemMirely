<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;



Auth::routes();

Route::middleware(['auth'])->group(function () {
 Route::get('/', function () {return view('home');});
 Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


 Route::get('/areaList', [App\Http\Controllers\AreaController::class, 'index'])->name('areaList');
 Route::get('/areacreate', [App\Http\Controllers\AreaController::class, 'create'])->name('areacreate');
 Route::post('/areasave', [App\Http\Controllers\AreaController::class, 'store'])->name('areasave');
 
 Route::get('/materialeList', [App\Http\Controllers\MarterialeController::class, 'index'])->name('materialeList');
});