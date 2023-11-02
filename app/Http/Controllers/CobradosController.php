<?php

namespace App\Http\Controllers;
use App\Http\Requests\CobradoRequest;
use App\Models\Cobrado;

use Illuminate\Http\Request;

class CobradosController extends Controller
{ 
    public function storeOrUpdate(CobradoRequest $request)
    {
        $data = $request->validated();
        
        $processoID = $data['ProcessoID'];

        // Use o método updateOrCreate para atualizar ou criar um registro
        $cobrado = Cobrado::updateOrCreate(['ProcessoID' => $processoID], $data);

        // Outras ações após a atualização ou criação do registro...
    }
}
