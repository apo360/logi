<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FuncionarioRequest extends FormRequest
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
            'Nome' => 'required|max:200',
            'apelido' => 'required|max:75',
            'Email' => 'nullable|required|max:200|email',
            'Telefone' => 'required|max:20',
            'Endereco' => 'required|max:230',
            'data_nasc' => 'required|date',
            'genero' => 'max:5',
        ];
    }
}
