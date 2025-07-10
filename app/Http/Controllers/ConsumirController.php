<?php

namespace App\Http\Controllers;

use App\Http\Requests\RecursoRequest;
use App\Models\Recurso;
use App\Models\Clube;

class ConsumirController extends Controller
{
    public function consumirRecursos(RecursoRequest $request)
    {
        try {
             // buscar o saldo do clube 
            $clube = $this->buscarSaldoClube($request->clube_id);
            if (!$clube) {
                throw new \Exception('Clube não encontrado');
            }

             // buscar o saldo do recurso
            $recurso = $this->buscarSaldoRecurso($request->recurso_id);
            if (!$recurso) {
                throw new \Exception('Recurso não encontrado');
            }
            // Verifica se o valor do consumo é válido
            $clube->verificaSaldoDisponivel($request->valor_consumo);
            $recurso->VerifiConsumoSaldo($request->valor_consumo);
            

            // calcula o novo saldo do clube e do recurso
            $novoSaldoClube = $clube->calcularSaldoClube($request->valor_consumo);
            $novoSaldoDisponivel = $recurso->calcularSaldoRecurso($request->valor_consumo);
            
            // atualiza os saldos no banco de dados
            $this->updateSaldoClube($clube->id, $novoSaldoClube);
            $this->updateSaldoRecurso($recurso->id, $novoSaldoDisponivel );

            return response()->json([
                "success" => true,
                'message' => 'Recursos consumidos com sucesso '.  $novoSaldoClube
            ], 200);

        } catch (\Exception $e) {
            
            return response()->json([
                "success" => false,
                'message' => $e->getMessage()
            ], 400);
        }
       
    }

    /**
     * Método para buscar o saldo do recurso e do clube.
     *
     * @param int $id
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    private function buscarSaldoRecurso($id)
    {
        return Recurso::where('id', $id)->first();
    }

    /**
     * Método para buscar o saldo do clube.
     *
     * @param int $id
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    private function buscarSaldoClube($id)
    {
        return Clube::where('id', (int)$id)->first();
    }

    /**
     * Atualiza o saldo do recurso no banco de dados.
     *
     * @param int $id
     * @param float $novoSaldo
     * @return void
     */
    private function updateSaldoRecurso($id, $novoSaldo)
    {
      Recurso::where('id', $id)->update(['saldo_disponivel' => $novoSaldo]);
    }

    /**
     * Atualiza o saldo do clube no banco de dados.
     *
     * @param int $id
     * @param float $novoSaldo
     * @return void
     */
    private function updateSaldoClube($id, $novoSaldo)
    {
        Clube::where('id', $id)->update(['saldo_disponivel' => $novoSaldo]);
    }
}
