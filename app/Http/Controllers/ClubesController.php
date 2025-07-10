<?php

namespace App\Http\Controllers;
use App\Http\Requests\ClubeRequest;

class ClubesController extends Controller
{
    public function listarClubes()
    {
        // ffazer consulta no banco de dados
        // Exemplo de retorno estático
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

    public function cadastrarClubes(ClubeRequest $request)
    {   
        $request->headers->set('Accept', 'application/json');
        
        // Salvar no banco
        // Exemplo de retorno estático
        return response()->json([
            "success" => true,
            'message' => 'Cadastro feito com sucesso',
        ],200);
    }
}
