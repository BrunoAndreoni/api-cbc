<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class ClubeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules()
    {
        return [
            'clube' => 'required|string|max:255',
            'saldo_disponivel' => 'required|numeric|min:0',
        ];
    }

    public function messages()
    {
        return [
            'clube.required' => 'O campo clube é obrigatório.',
            'clube.string' => 'O campo clube deve ser uma string.',
            'clube.max' => 'O campo clube não pode ter mais de 255 caracteres.',
            'saldo_disponivel.required' => 'O campo saldo_disponivel disponível é obrigatório.',
            'saldo_disponivel.numeric' => 'O campo saldo_disponivel disponível deve ser um número.',
            'saldo_disponivel.min' => 'O campo saldo_disponivel disponível deve ser maior ou igual a zero.',
        ];
    }

    function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success' => false,
            'errors' => $validator->errors(),
            'message' => 'Dados inválidos'
        ], 422));
    }
}