<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BillingAddressRequest extends FormRequest
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
        $rules = [
            'BuildingNumber' => 'nullable|string|max:15',
            'StreetName' => 'nullable|string|max:200',
            'AddressDetail' => 'nullable|string|max:250',
            'City' => 'nullable|string|max:50',
            'PostalCode' => 'nullable|string|max:10',
            'Country' => 'nullable|string|max:12',
        ];

        if ($this->is('customers*')) {
            // Regras de validação específicas para o controlador Customer
            $rules['CustomerID'] = 'required|integer';
        } elseif ($this->is('suppliers*')) {
            // Regras de validação específicas para o controlador Supplier
            $rules['SupplierID'] = 'required|integer';
        }

        return $rules;
    }
}
