<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CustomerRequest extends FormRequest
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
        $id = $this->isMethod('PUT') ? $this->route('customer') : null;

        return [
            'CustomerID' => ['required', 'string', 'max:30', $id ? Rule::unique('Customer')->ignore($id) : ''],
            'CustomerTaxID' => ['nullable','required', 'string', 'min:6', 'max:14', Rule::unique('Customer')->ignore($id, 'CustomerID')], // NIF deve ter exatamente 14 dígitos
            'AccountID' => ['nullable', 'string', 'max:30'],
            'CompanyName' => ['required', 'string', 'max:100'],
            'Telephone' => ['required', 'string', 'max:20'], // Defina um tamanho máximo apropriado para o telefone
            'Email' => ['nullable', 'email', 'max:254'],
            'Website' => ['nullable', 'url', 'max:60'], // Verifica se é uma URL válida
            //'AddressLine1' =>'required_if:IsBusiness=true|string|max:
        ];
    }
}
