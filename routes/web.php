<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfessorController;
use App\Http\Controllers\SalaController;
use App\Http\Controllers\ReservaController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('professores', ProfessorController::class);
Route::resource('salas', SalaController::class);
Route::resource('reservas', ReservaController::class);
Route::get('/', [App\Http\Controllers\ReservaController::class, 'index'])->name('home');