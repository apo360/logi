<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class ProcessoRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'NrProcesso' => 'required|string|max:100',
            'ContaDespacho' => 'nullable|string|max:150',
            'CustomerID' => 'required|string|max:30',
            'RefCliente' => 'nullable|string|max:200',
            'Descricao' => 'nullable|string|max:200',
            'DataAbertura' => 'required|date',
            'TipoProcesso' => 'required|string|max:100',
            'Situacao' => 'required|string|in:em processamento,desembarcado,retido,concluido',
            'UserID' => ['required', 'string', 'max:255', Rule::in([Auth::id()])],
        ];
    }

    public function messages()
    {
        return [
            'required' => 'O campo :attribute é obrigatório.',
            'max' => 'O campo :attribute não pode ter mais de :max caracteres.',
            'string' => 'O campo :attribute deve ser uma string.',
            'date' => 'O campo :attribute deve ser uma data válida.',
            'integer' => 'O campo :attribute deve ser um número inteiro.',
        ];
    }
}
