<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class RecursoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'clube_id'=>'required|numeric',
            'recurso_id'=>'required|numeric',
            'valor_consumo'=>'required|string|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            'clube_id.required' => 'O campo clube_id é obrigatório.',
            'clube_id.numeric' => 'O campo clube_id deve ser um número.',
            'recurso_id.required' => 'O campo recurso_id é obrigatório.',
            'recurso_id.numeric' => 'O campo recurso_id deve ser um número.',
            'valor_consumo.required' => 'O campo valor_consumo de consumo é obrigatório.',
            'valor_consumo.string' => 'O campo valor_consumo de consumo deve ser uma string.',
            'valor_consumo.max' => 'O campo valor_consumo de consumo não pode ter mais de 255 caracteres.',
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
