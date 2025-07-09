<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ClubesController extends Controller
{
    public function listarClubes()
    {
        return response()->json([
           [ 
                [ 
                    "id"=>"1", 
                    "clube"=>"Clube A", 
                    "saldo_disponivel"=>"2000,00"
                ], 
                [ 
                    "id"=>"2", 
                    "clube"=>"Clube B", 
                    "saldo_disponivel"=>"3000,00" 
                ] 
            ],
        ]);
    }

    public function cadastrarClubes()
    {
        return response()->json([
            'message' => 'ok',
        ]);
    }

    public function consumirRecursos()
    {
        return response()->json([
            'message' => 'ok',
        ]);
    }
}
