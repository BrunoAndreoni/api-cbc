<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Model;

class Recurso extends Model
{
    protected $table = 'recurso';
    protected $fillable = ['recurso', 'saldo_disponivel'];
    
    protected $casts = [
        'saldo_disponivel' => 'decimal:2'
    ];
    
    /**
     * Formata o valor para entrada para salvar no banco
     */
    public function setSaldoDisponivelAttribute($valor):void
    {
        if (is_string($valor)) {
            $valor = str_replace(['.', ','], ['', '.'], $valor);
        }
        $this->attributes['saldo_disponivel'] = (float) $valor;
    }
    
    /**
     * Formata o valor para saída para listagem
     */
    public function getSaldoFormatadoAttribute(): string
    {
        return number_format($this->saldo_disponivel, 2, ',', '.');
    }

    /**
     * Consome saldo com tratamento seguro de valores
     */
    public function VerifiConsumoSaldo($valor): void
    {
        $valor = $this->formatatValorFloat($valor);
        
        if ($this->saldo_disponivel < $valor) {
            throw new Exception('Saldo insuficiente no recurso');
        }
    }

    /**
     * Calcula o novo saldo do recurso após o consumo
     */
    public function calcularSaldoRecurso($saldoConsumo): float
    {
        $saldoConsumo = $this->formatatValorFloat($saldoConsumo);
        $novoSaldo = $this->formatatValorFloat($this->saldo_disponivel-$saldoConsumo);
        
        return $novoSaldo;
    }
    
    /**
     * Formata o valor para float, garantindo que seja um número válido
     */
    private function formatatValorFloat($valor): float
    {
        if (is_string($valor)) {
            $valor = str_replace(['.', ','], ['', '.'], $valor);
        }
        
        return $valor = (float) $valor;
    }

}