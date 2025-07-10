<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Exceptions\SaldoInsuficienteException;
use Exception;
use Illuminate\Support\Facades\Log;

class Clube extends Model
{
    protected $table = 'clube';
    protected $fillable = ['clube', 'saldo_disponivel'];
    
    protected $casts = [
        'saldo_disponivel' => 'decimal:2'
    ];

    /**
     * Formata o valor para listagem
     */
    public function getSaldoFormatadoAttribute(): string
    {
        return number_format($this->saldo_disponivel, 2, ',', '.');
    }

    /**
     * Formata o valor para entrada (gravação no banco)
     */
    public function setSaldoDisponivelAttribute($valor): void
    {
        $this->attributes['saldo_disponivel'] = $this->formatatValorFloat($valor);
    }
  
    /**
     * Verifica se o saldo disponível é suficiente para o consumo
     */
    public function verificaSaldoDisponivel($valor): void
    {
        $valor = $this->formatatValorFloat($valor); 
        
        if ($this->saldo_disponivel < $valor) {
            throw new Exception('O saldo disponível do clube é insuficiente. ');
        }
    }

    /**
     * Calcula o novo saldo do clube após o consumo
     */
    public function calcularSaldoClube($valor): float
    {
        $valorConsumido = $this->formatatValorFloat($valor); 
        $novoSaldo = $this->formatatValorFloat($this->saldo_disponivel - $valorConsumido);
        Log::info('Calculo'. $this->saldo_disponivel . ' - '.$valorConsumido.' = '.$novoSaldo);
        return $novoSaldo;   
    }

    /**
     * Formata o valor para float, garantindo que seja um número válido
     */
    private function formatatValorFloat($valor): float
    {
       // Converte valor de entrada se necessário
        if (is_string($valor)) {
            $valor = str_replace(['.', ','], ['', '.'], $valor);
        }
        
        return $valor = (float) $valor;
    }
}