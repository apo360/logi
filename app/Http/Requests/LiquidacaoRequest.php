<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LiquidacaoRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules()
    {
        return [
            'ProcessoID' => 'required|integer',
            'Direitos' => 'nullable|numeric|regex:/^\d+(\.\d{1,2})?$/',
            'MultasDiversas' => 'nullable|numeric|regex:/^\d+(\.\d{1,2})?$/',
            'Iva' => 'nullable|numeric|regex:/^\d+(\.\d{1,2})?$/',
            'Iec' => 'nullable|numeric|regex:/^\d+(\.\d{1,2})?$/',
            'EmolumentosPessoais' => 'nullable|numeric|regex:/^\d+(\.\d{1,2})?$/',
            'ImpostoEstatistico' => 'nullable|numeric|regex:/^\d+(\.\d{1,2})?$/',
            'Armazem' => 'nullable|numeric|regex:/^\d+(\.\d{1,2})?$/',
            'ReceitasDAR' => 'nullable|numeric|regex:/^\d+(\.\d{1,2})?$/',
            'SUBTOTAL' => 'nullable|numeric|regex:/^\d+(\.\d{1,2})?$/',
        ];
    }
}
