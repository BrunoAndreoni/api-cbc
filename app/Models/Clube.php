<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Clube extends Model
{
    protected $table = 'clube';
    protected $fillable = ['clube','saldo_disponivel',];
    protected $casts = ['clube' => 'string','saldo_disponivel' => 'float'];

    /**
     * Pega o saldo disponível formatado com duas casas decimais e vírgula como separador decimal.
     *
     * @param  mixed  $value
     * @return string
     */
    public function getSaldoDisponivelAttribute($value)
    {
        return number_format((float) $value, 2, ',', '');
    }
}   
