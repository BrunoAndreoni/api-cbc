<?php

namespace App\Http\Controllers;
use App\Http\Requests\ClubeRequest;
use App\Models\Clube;

class ClubesController extends Controller
{
    /**
     * Funcao para listar clubes
     * @return \Illuminate\Http\JsonResponse
     */
    public function listarClubes()
    {
        // fazer consulta no banco de dados
        $clubes = Clube::all(['id', 'clube', 'saldo_disponivel']);
       
        // Retornar a lista de clubes
        return response()->json([
            "success" => true,
            'clubes' => $clubes,
        ], 200);
    }

    /**
     * Funcao para cadastrar clubes
     * @param ClubeRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function cadastrarClubes(ClubeRequest $request)
    {   
        $clube = Clube::create([
            'clube' => $request->clube,
            'saldo_disponivel' => $request->saldo_disponivel
        ]);
        
        return response()->json([
            "success" => true,
            'message' => 'Cadastro feito com sucesso'
        ], 200);
    }
}
