<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\DB;
use Tests\TestCase;


class CadastroClubeTest extends TestCase
{
    /**
     * Teste para cadastrar um clube com sucesso.
     */
    public function test_cadastrar_clube_sucesso(){
        DB::beginTransaction();
        
        try {
           $response = $this->postJson('/api/cadastrar-clubes', [
                'clube' => 'Clube Exemplo',
                'saldo_disponivel' => '1000.00'
            ]);
        
            $this->logApi($response);
    
            $response->assertOk();
        } finally {
            DB::rollBack();
        }
        
    }

    /**
     * Teste para cadastrar um clube com erros de validação.
     */
    public function test_cadastrar_clube_erro_validacao(){
        $response = $this->postJson('/api/cadastrar-clubes', []);
        
        $this->logApi($response);
    
        $response->assertStatus(422) ->assertStatus(422)
        ->assertJson([
            'success' => false,
            'message' => 'Dados inválidos'
        ])
        ->assertJsonValidationErrors(['clube', 'saldo_disponivel']);
    }
}
