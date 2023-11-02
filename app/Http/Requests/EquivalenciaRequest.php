<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EquivalenciaRequest extends FormRequest
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
            'ProcessoID' => 'required|integer',
            'Moeda' => 'nullable|string|max:5',
            'ValorME' => 'nullable|numeric',
            'CambioKZ' => 'nullable|numeric',
            'ValorAduaneiro' => 'nullable|numeric',
        ];
    }
}
