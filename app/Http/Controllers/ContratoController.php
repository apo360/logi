<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContratoRequest;
use App\Models\Contrato;
use App\Models\Funcionario;

class ContratoController extends Controller
{
    
    public function storeOrUpdate(ContratoRequest $request, Funcionario $funcionario) {

        if ($funcionario) {
            // Atualiza um registro existente na tabela 'contrato' com os dados fornecidos
            $du = Contrato::where('employee_id', $funcionario->Id)->update($request->validated());
        } else {
            // Cria um novo registro de contrato na tabela 'contrato' com os dados fornecidos
            Contrato::create($request->validated());
        }
        
    }
}
