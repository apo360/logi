<?php

namespace App\Http\Controllers;

use App\Helpers\DatabaseErrorHandler;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use App\Models\DU;

class DuController extends Controller
{

    /**
     * Store a newly created resource in storage for DU.
     */
    public function storeOrUpdate(Request $request, $id = null)
    {
        // Valide os dados do formulário
        $validatedData = $request->validate([
            'tipo_depachoID' => 'required',
            'ProcessoID' => 'required',
            'NrOrdem' => 'required|max:12',
            'NavioAviao' => 'required|max:100',
            'OrigemID' => 'nullable',
            'ProcDestino' => 'nullable|max:50',
            'CMarcaFiscal' => 'nullable|max:50',
            'BLCPorte' => 'nullable|max:50',
            'DataEntrada' => 'nullable|date',
        ]);

        try {
            // Inicia uma transação para garantir a integridade dos dados
            DB::beginTransaction();

            if ($id) {
                // Atualiza um registro existente na tabela 'tb_du' com os dados fornecidos
                $du = DU::findOrFail($id);
                $du->update($validatedData);
            } else {
                // Cria um novo registro de DU na tabela 'tb_du' com os dados fornecidos
                DU::create($validatedData);
            }

            // Confirma a transação, salvando as alterações no banco de dados
            DB::commit();
        } catch (QueryException $e) {
            DB::rollBack();

            // Manipule os erros do banco de dados, se necessário
            return DatabaseErrorHandler::handle($e);
        }
    }


}
