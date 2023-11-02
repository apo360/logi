<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CobradoRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'ProcessoID' => 'required|integer',
            'licenca_ministerio' => 'numeric|min:0',
            'pre_embraque' => 'numeric|min:0',
            'CompanhiaNavegacao' => 'numeric|min:0',
            'ServicosViacao' => 'numeric|min:0',
            'TaxaAeroportuaria' => 'numeric|min:0',
            'AverbamentoeEndossos' => 'numeric|min:0',
            'ChequeVisado' => 'numeric|min:0',
            'RequerimentosVolantes' => 'numeric|min:0',
            'PreenchimentoDocEmbarque' => 'numeric|min:0',
            'PreenchimentoDocEstatistico' => 'numeric|min:0',
            'LicencasAvulsasMapas' => 'numeric|min:0',
            'SelagemDocumentos' => 'numeric|min:0',
            'ExamesPreviosComerciais' => 'numeric|min:0',
            'PesagensVistoriasSeguros' => 'numeric|min:0',
            'AssistenciaCargaDescarga' => 'numeric|min:0',
            'ServicosOrgaosOficiais' => 'numeric|min:0',
            'Deslocacoes' => 'numeric|min:0',
            'GuiaAcompanhamentofiscal' => 'numeric|min:0',
            'Verificacao' => 'numeric|min:0',
            'Fotocopias' => 'numeric|min:0',
            'ReqAutorizacaoCarregamento' => 'numeric|min:0',
            'ModelosREMRSM' => 'numeric|min:0',
            'DivExtra' => 'numeric|min:0',
            'Diversos1' => 'numeric|min:0',
            'SelosImpressosDespacho' => 'numeric|min:0',
            'Honorarios' => 'numeric|min:0',
            'TOTALGERAL' => 'string|min:0',
            'Extenso' => ['nullable', 'string', 'max:255'],
        ];
    }
}
