<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;



Auth::routes();

Route::middleware(['auth'])->group(function () {
  Route::get('/', function () {return view('home');});
  Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

  Route::get('/classroomList', [App\Http\Controllers\AreaController::class, 'index'])->name('classroomList');
  Route::get('/classroomCreate', [App\Http\Controllers\AreaController::class, 'create'])->name('classroomCreate');
  Route::post('/classroomSave', [App\Http\Controllers\AreaController::class, 'store'])->name('classroomSave');
  Route::get('/classroomEdit/{id}', [App\Http\Controllers\AreaController::class, 'edit'])->name('classroomEdit');
  Route::put('/classroomUpdate/{id}', [App\Http\Controllers\AreaController::class, 'update'])->name('classroomUpdate');
  Route::delete('/classroomDestroy/{id}', [App\Http\Controllers\AreaController::class, 'destroy'])->name('classroomDestroy');
 
  Route::get('/materialList', [App\Http\Controllers\MarterialeController::class, 'index'])->name('materialList');
  Route::get('/materialCreate', [App\Http\Controllers\MarterialeController::class, 'create'])->name('materialCreate');
  Route::post('/materialSave', [App\Http\Controllers\MarterialeController::class, 'store'])->name('materialSave');
  Route::get('/materialShow{id}', [App\Http\Controllers\MarterialeController::class, 'show'])->name('materialShow');
  Route::get('/materialEdit/{id}', [App\Http\Controllers\MarterialeController::class, 'edit'])->name('materialEdit');
  Route::put('/materialUpdate/{id}', [App\Http\Controllers\MarterialeController::class, 'update'])->name('materialUpdate');
  Route::delete('/materialDestroy/{id}', [App\Http\Controllers\MarterialeController::class, 'destroy'])->name('materialDestroy');

  Route::get('/loanList', [App\Http\Controllers\PrestamoController::class, 'index'])->name('loanList');
  Route::get('/loanCreate', [App\Http\Controllers\PrestamoController::class, 'create'])->name('loanCreate');
  Route::get('/materialsByClassroom/{sector}', [App\Http\Controllers\PrestamoController::class, 'materialsByClassroom']);
  Route::post('/loanSave', [App\Http\Controllers\PrestamoController::class, 'store'])->name('loanSave');
  Route::get('/loanEdit/{id}', [App\Http\Controllers\PrestamoController::class, 'edit'])->name('loanEdit');
  Route::put('/loanUpdate/{id}', [App\Http\Controllers\PrestamoController::class, 'update'])->name('loanUpdate');
  Route::delete('/loanDestroy/{id}', [App\Http\Controllers\PrestamoController::class, 'destroy'])->name('loanDestroy');
});