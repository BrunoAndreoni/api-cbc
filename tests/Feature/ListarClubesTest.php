<?php

namespace Tests\Feature;
use Tests\TestCase;

class ListarClubesTest extends TestCase
{
    /**
     * Teste para o endpoint de listar clubes com sucesso.
     */
    public function test_listar_clibes()
    {
        $response = $this->getJson('/api/listar-clubes');
        $this->logApi($response);
        $response->assertOk();
    }
}
