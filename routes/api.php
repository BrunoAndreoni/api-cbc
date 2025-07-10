<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClubesController;
use App\Http\Controllers\ConsumirController;

// Listar todos os clubes 
Route::get('/listar-clubes', [ClubesController::class, 'listarClubes']);

// Cadastrar clubes;
Route::post('/cadastrar-clubes', [ClubesController::class, 'cadastrarClubes']);

// Consumir recursos; 
Route::post('/consumir-recursos', [ConsumirController::class, 'consumirRecursos']);