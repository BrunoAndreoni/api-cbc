<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Clube;
use App\Models\Recurso;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\TryCatch;

class ConsumoRecursosTest extends TestCase
{
     /**
    * Teste para o endpoint de consumir recurso com sucesso.
    */
    public function test_consumir_recurso_sucesso()
    {
        DB::beginTransaction();

        Try{
            
            $clube = Clube::create([
                'clube' => 'Clube Teste Sucesso',
                'saldo_disponivel' => '2000,00'
            ]);

            $recurso = Recurso::create([
                'recurso' => 'Teste Recurso Sucesso',
                'saldo_disponivel' => '10000,00'
            ]);

            $response = $this->postJson('/api/consumir-recursos', [
                "clube_id" => $clube->id, 
                "recurso_id" => $recurso->id, 
                "valor_consumo" => "500,00"
            ]);

            $response->assertOk();

        }finally{
            DB::rollBack();
        }
    }

    /**
    * Teste para o endpoint de consumir recurso com erros de validação vazias.
    */
    public function test_consumir_recurso_erro_validacao(){
        $response = $this->postJson('/api/consumir-recursos', []);
    
        $this->logApi($response);

        $response->assertStatus(422) ->assertStatus(422)
        ->assertJson([
            'success' => false,
            'message' => 'Dados inválidos'
        ])
        ->assertJsonValidationErrors(['clube_id', 'recurso_id', 'valor_consumo']);
    }

    public function test_consumir_recurso_erro_saldo_clube_insuficiente(){

        DB::beginTransaction();

        Try{
            
            $clube = Clube::create([
                'clube' => 'Clube Teste Insufficiente',
                'saldo_disponivel' => '200,00'
            ]);

            $response = $this->postJson('/api/consumir-recursos', [
                "clube_id" => $clube->id, 
                "recurso_id" => "1", 
                "valor_consumo" => "500,00"
            ]);

            $response->assertStatus(400)
            ->assertJson([
                'success' => false,
                'message' => 'O saldo disponível do clube é insuficiente.'
            ]);

        }finally{
            DB::rollBack();
        }
    }

    public function test_consumir_recurso_erro_recurso_saldo_recurso_insuficiente(){
         DB::beginTransaction();

        Try{
            
            $clube = Clube::create([
                'clube' => 'Clube Teste Insufficiente',
                'saldo_disponivel' => '200,00'
            ]);

            $recurso = Recurso::create([
                'recurso' => 'Teste Recurso Insufficiente',
                'saldo_disponivel' => '100,00'
            ]);

            $response = $this->postJson('/api/consumir-recursos', [
                "clube_id" => $clube->id, 
                "recurso_id" => $recurso->id, 
                "valor_consumo" => "200,00"
            ]);

            $response->assertStatus(400)
            ->assertJson([
                'success' => false,
                'message' => 'Saldo insuficiente no recurso'
            ]);

        }finally{
            DB::rollBack();
        }
    }
}
