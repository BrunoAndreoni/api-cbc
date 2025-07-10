<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ConsumoRecursosTest extends TestCase
{
    /**
     * Teste para o endpoint de consumir recurso com sucesso.
     */
    public function test_consumir_recurso_sucesso(){
        $response = $this->postJson('/api/consumir-recursos', [
            "clube_id"=>"1", 
            "recurso_id"=>"1", 
            "valor_consumo"=>"500,00" 
        ]);
        
        $this->logApi($response);
    
        $response->assertOk();
    }

    /**
     * Teste para o endpoint de consumir recurso com erros de validação.
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
}
