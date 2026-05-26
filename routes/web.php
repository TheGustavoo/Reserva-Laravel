<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfessorController;
use App\Http\Controllers\SalaController;
use App\Http\Controllers\ReservaController;
use App\Http\Controllers\EquipamentoController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('professores', ProfessorController::class);
Route::resource('salas', SalaController::class);
Route::resource('reservas', ReservaController::class);
Route::resource('equipamentos', EquipamentoController::class);
Route::get('/', [App\Http\Controllers\ReservaController::class, 'index'])->name('home');