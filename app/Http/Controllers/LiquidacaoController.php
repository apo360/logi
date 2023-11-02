<?php

namespace App\Http\Controllers;

use App\Http\Requests\LiquidacaoRequest;
use App\Models\Liquidacao;
use Illuminate\Http\Request;

class LiquidacaoController extends Controller
{
    public function storeOrUpdate(LiquidacaoRequest $request)
    {
        $data = $request->validated();
        
        $processoID = $data['ProcessoID'];

        // Use o método updateOrCreate para atualizar ou criar um registro
        $cobrado = Liquidacao::updateOrCreate(['ProcessoID' => $processoID], $data);

        // Outras ações após a atualização ou criação do registro...
    }
}
