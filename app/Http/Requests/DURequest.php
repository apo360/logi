<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\DU;

class DURequest extends FormRequest
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
            'tipo_depachoID' => 'required',
            'ProcessoID' => 'required',
            'NrOrdem' => ['nullable', 'max:12', function ($attribute, $value, $fail) {
                // Aplica a transformação usando o método setNrOrdemAttribute
                $du = new DU();
                $transformedValue = $du->setNrOrdemAttribute($value);
    
                // Verifica se o valor transformado é válido
                if ($transformedValue !== $value) {
                    $fail("O número de ordem não está no formato esperado.");
                }
            }],
            'NavioAviao' => 'required|max:100',
            'OrigemID' => 'nullable',
            'ProcDestino' => 'nullable|max:50',
            'CMarcaFiscal' => 'nullable|max:50',
            'BLCPorte' => 'nullable|max:50',
            'DataEntrada' => 'nullable|date',
        ];
    }
}
