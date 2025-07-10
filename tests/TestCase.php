<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\Log;

abstract class TestCase extends BaseTestCase
{
    /**
     * Metodo para salvar os logs das requisições feitas para a API.
     */
    protected function logApi($response){
        Log::debug('Resposta da API:', [
            'Http_Status' => $response->status(),
            'Conteudo' => $response->getContent()
        ]);
    }
}
