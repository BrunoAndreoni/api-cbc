<?php

namespace App\Http\Controllers;

use App\Http\Requests\RecursoRequest;

class ConsumirController extends Controller
{
    public function consumirRecursos(RecursoRequest $request)
    {
        $request->headers->set('Accept', 'application/json');
        // Fazer a logica de consumo de recursos aqui
        // Exemplo de retorno estático
        return response()->json([
            'message' => 'Recurso consumido com sucesso',
        ]);
    }

}
