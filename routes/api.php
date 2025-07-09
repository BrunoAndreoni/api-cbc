<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClubesController;

// Listar todos os clubes 
Route::get('/listar-clubes', [ClubesController::class, 'listarClubes']);

// // Cadastrar clubes;
Route::post('/listar-clubes', [ClubesController::class, 'cadastrarClubes']);

// Consumir recursos; 
Route::post('/consumir-recursos', [ClubesController::class, 'consumirRecursos']);