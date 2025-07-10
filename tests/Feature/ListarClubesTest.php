<?php

namespace Tests\Feature;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Clube;

class ListarClubesTest extends TestCase
{    
    /**
     * Teste para o endpoint para listar os clubes cadastrados.
     */
    public function test_listar_clubes()
    {
        $response = $this->getJson('/api/listar-clubes');
        $this->logApi($response);
        $response->assertOk();
    }
}
