<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContratoRequest extends FormRequest
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
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'position' => 'required|string|max:255',
            'salary' => 'required|numeric',
            'working_hours_per_week' => 'nullable|integer',
            'probation_period' => 'nullable|integer',
            'contract_type' => 'required|string|max:255',
            'department_id' => 'required|integer',
            'manager_id' => 'nullable|integer',
            'probation_period' => 'nullable|integer',
        ];
    }
}
