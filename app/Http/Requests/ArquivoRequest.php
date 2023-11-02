<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArquivoRequest extends FormRequest
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
            'ProcessoID' => 'required|exists:processos,ProcessoID',
            'Nome' => 'nullable|string|max:100',
            'tipofile' => 'required|in:bi,du,outro',
            'explica_outro' => 'nullable|required_if:tipofile,outro|string|max:255', 
            'arquivos.*' => 'required|file|mimes:pdf,doc,docx,xlsx,jpg, jpeg|max:2048', // Adicione as extensões de arquivo permitidas
            'data' => 'nullable', // Formato de data: yyyy-mm-dd
        ];
    }

    public function messages()
    {
        return [
            'tipofile.required' => 'O tipo de arquivo é obrigatório.',
            'tipofile.in' => 'O tipo de arquivo selecionado é inválido.',
            'explica_outro.required_if' => 'O campo de explicação para tipo "Outro" é obrigatório.',
            'explica_outro.max' => 'O campo de explicação não pode ter mais de :max caracteres.',
            'arquivos.*.required' => 'O arquivo é obrigatório.',
            'arquivos.*.mimes' => 'Tipos de arquivo permitidos: PDF, Word, Excel, JPG.',
            'arquivos.*.max' => 'O tamanho máximo do arquivo é de 2MB (2048 KB).',
        ];
    }
}
