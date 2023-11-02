<?php

namespace App\Http\Controllers;

use App\Http\Requests\PortuariaRequest;
use App\Models\Portuaria;
use Illuminate\Http\Request;

class PortuariaController extends Controller
{
    public function storeOrUpdate(PortuariaRequest $request)
    {
        $data = $request->validated();
        
        $processoID = $data['ProcessoID'];

        // Use o método updateOrCreate para atualizar ou criar um registro
        $cobrado = Portuaria::updateOrCreate(['ProcessoID' => $processoID], $data);

        // Outras ações após a atualização ou criação do registro...
    }
}
