<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProcessoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules()
    {
        return [
            'NrProcesso' => ['required', 'string', 'max:30'],
            'ClienteID' => ['required', 'string', 'max:10'],
            'RefCliente' => ['nullable', 'string', 'max:20'],
            'Descricao' => ['nullable', 'string', 'max:254'],
            'DataAbertura' => ['nullable', 'date'], // Use 'date' em vez de 'string'
            'Status' => 'Aberto',
        ];
    }
}
