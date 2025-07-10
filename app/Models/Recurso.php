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
     * Formata o valor para entrada (gravação no banco)
     */
    public function setSaldoDisponivelAttribute($valor):void
    {
        if (is_string($valor)) {
            $valor = str_replace(['.', ','], ['', '.'], $valor);
        }
        $this->attributes['saldo_disponivel'] = (float) $valor;
    }
    
    /**
     * Formata o valor para saída (leitura do banco)
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
        $valor = $this->formatatValorFloat($valor); // Converte valor de entrada se necessário
        
        if ($this->saldo_disponivel < $valor) {
            throw new Exception('Saldo insuficiente no recurso');
        }
    }

    public function calcularSaldoRecurso($saldoConsumo): float
    {
        $saldoConsumo = $this->formatatValorFloat($saldoConsumo); // Converte valor de entrada se necessário
        $novoSaldo = $this->formatatValorFloat($this->saldo_disponivel-$saldoConsumo);
        
        return $novoSaldo;
    }
    
    private function formatatValorFloat($valor): float
    {
       // Converte valor de entrada se necessário
        if (is_string($valor)) {
            $valor = str_replace(['.', ','], ['', '.'], $valor);
        }
        
        return $valor = (float) $valor;
    }

}