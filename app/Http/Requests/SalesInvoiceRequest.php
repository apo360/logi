<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SalesInvoiceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
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
            'invoice_no' => 'required|string|max:20',
            'hash' => 'required|string|max:172',
            'hash_control' => 'required|string|max:1',
            'period' => 'nullable|integer|min:1|max:12',
            'invoice_date' => 'required|date',
            'invoice_type_id' => 'required|exists:InvoiceType,Id',
            'self_billing_indicator' => 'nullable|boolean',
            'cash_vat_scheme_indicator' => 'nullable|boolean',
            'third_parties_billing_indicator' => 'nullable|boolean',
            'source_id' => 'required|exists:users,id',
            'system_entry_date' => 'nullable|datetime', // ou 'nullable|date_format:Y-m-d H:i:s',
            'transaction_id' => 'nullable|integer',
            'customer_id' => 'required|exists:Customers,id',
            'ship_to_id' => 'nullable|exists:ShipToAddress,Id',
            'from_to_id' => 'nullable|integer',
            'movement_end_time' => 'nullable|date', // ou 'nullable|date_format:Y-m-d H:i:s',
            'movement_start_time' => 'nullable|date', // ou 'nullable|date_format:Y-m-d H:i:s',
            'imposto_retido' => 'nullable|string|max:3',
            'motivo_retencao' => 'nullable|string|max:60',
            'montante_retencao' => 'nullable|numeric',
            // Adicione outras regras de validação conforme necessário
            //'sales_lines.*.product_code' => 'required|integer',
            //'sales_lines.*.quantity' => 'required|numeric',
            //'sales_lines.*.unit_price' => 'required|numeric',
            // Adicione outras regras de validação para os campos SalesLine conforme necessário
        
        ];
    }

    public function messages()
    {
        return [
            'customer_id.exists' => 'O ID do cliente fornecido é inválido.',
            
            'sales_lines.*.product_code.required' => 'O código do produto é obrigatório.',
            'sales_lines.*.product_code.integer' => 'O código do produto deve ser um número inteiro.',
            'sales_lines.*.quantity.required' => 'A quantidade do produto é obrigatória.',
            'sales_lines.*.quantity.numeric' => 'A quantidade do produto deve ser um número.',
            'sales_lines.*.unit_price.required' => 'O preço unitário do produto é obrigatório.',
            'sales_lines.*.unit_price.numeric' => 'O preço unitário do produto deve ser um número.',
            // ... outras mensagens ...
        ];
    }
}
