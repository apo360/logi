<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Mercadoria;
use App\Models\Processo;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use App\Helpers\DatabaseErrorHandler;
use App\Helpers\PdfHelper;
use App\Http\Requests\DARRequest;
use App\Http\Requests\DocumentoAduRequest;
use App\Http\Requests\DURequest;
use App\Http\Requests\ImportacaoRequest;
use App\Http\Requests\LiquidacaoRequest;
use App\Models\DU;
use App\Models\DAR;
use App\Http\Requests\PortuariaRequest;
use App\Http\Requests\ProcessoRequest;
use App\Http\Requests\TarifaDURequest;
use App\Models\Exportacao;
use App\Models\Importacao;
use App\Models\Pais;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ProcessoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $processos = Processo::all();

        $tableData = [
            'headers' => ['Nº','Número do Processo', 'Cliente', 'Data de Abertura', 'Status', 'Ações'],
            'rows' => [],
        ];

        foreach ($processos as $key => $processo) {
            $tableData['rows'][] = [
                $key + 1,
                $processo->NrProcesso,
                $processo->cliente->CompanyName,
                $processo->DataAbertura,
                $processo->Situacao,
                '
                   <div class="inline-flex">
                    <a href="' . route('processos.show', $processo->ProcessoID) . '" class="dropdown-item" data-toggle="tooltip" title="Detalhe"> <i class="fas fa-user"></i> </a>
                    <a href="' . route('processos.edit', $processo->ProcessoID) . '" class="dropdown-item" data-toggle="tooltip" title="Editar"> <i class="fas fa-edit"></i> </a>
                    <a href="' .  route('processos.destroy', $processo->ProcessoID) . '" class="dropdown-item" style="color: red;" onclick="event.preventDefault(); 
                        if (confirm("Tem certeza de que deseja apagar?")) 
                        { 
                            document.getElementById("delete-form-'.$processo->ProcessoID.'").submit(); 
                        }" data-toggle="tooltip" title="Apagar">
                        <i class="fas fa-trash" style="color: red;"></i>
                    </a>

                    <form id="delete-form-{{ $customer->Id }}" action="' . route('processos.destroy', $processo->ProcessoID) . '" method="POST" style="display: none;">
                        @csrf
                        @method('.'DELETE'.')
                    </form>

                   </div>         
                ',
            ];
        }
        
        // Retornar uma view com os processos listados ou realizar outra ação necessária
        return view('processo.pesquisar_processo', compact('tableData'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $clientes = Customer::all(); // Busca os Clientes
        $paises = Pais::all();
        $NewProcesso = Processo::generateNewProcesso(); // Inicializar com novo código de processo
        // chamar a stored procedure
        $newCustomerCode = Customer::generateNewCode();

        // Retornar uma view com o formulário para criar um novo processo
        return view('processo.create_processo', compact('clientes', 'NewProcesso', 'paises', 'newCustomerCode'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        try {

            $validatedProcessoData =  $request->validate([
                'NrProcesso' => 'required|string|max:100',
                'ContaDespacho' => 'nullable|string|max:150',
                'CustomerID' => 'required|string|max:30',
                'RefCliente' => 'nullable|string|max:200',
                'Descricao' => 'nullable|string|max:200',
                'DataAbertura' => 'required|date',
                'TipoProcesso' => 'required|string|max:100',
                'Situacao' => 'required|string|in:em processamento,desembarcado,retido,concluido',
            ]);
            // Atribuir automaticamente o UserID
            $validatedProcessoData['UserID'] = Auth::id();

            // Cria o processo
            $processo = Processo::create($validatedProcessoData);

            // Verifique o tipo de processo
            $tipoProcesso = $validatedProcessoData['TipoProcesso'];
            
            if ($tipoProcesso == 'importacao') {
                // Valide os dados de importação
                $validatedImportacaoData = $request->validate([
                    // Regras de validação para dados de importação
                    
                ]);

                // Atribuir automaticamente o Fk_processo

                // Cria a importação
                $importacao = Importacao::create([
                    'Fk_processo' => $processo->getLastInsertedId(),
                    'Fk_pais' => $request->input('Fk_pais'),
                    'PortoOrigem' => $request->input('PortoOrigem'),
                    'TipoTransporte' => $request->input('TipoTransporte'),
                    'NomeTransporte' => $request->input('NomeTransporte'),
                    'DataChegada' => $request->input('DataChegada'),
                    'MarcaFiscal' => $request->input('MarcaFiscal'),
                    'BLC_Porte' => $request->input('BLC_Porte'),
                    'Moeda' => $request->input('Moeda'),
                    'Cambio' => $request->input('Cambio'),
                    'ValorAduaneiro' => $request->input('ValorAduaneiro'),
                    'ValorTotal' => $request->input('ValorTotal'),
                ]);

                // Decodifique os dados JSON recebidos
                $mercadoriasData = json_decode($request->input('mercadorias'), true);

                //dd($mercadoriasData);
                // Criar Mercadoria
                foreach ($mercadoriasData as $key => $mercadoriaData) {
                    Mercadoria::create([
                        'Fk_Importacao' => $importacao->getLastInsertedId(),
                        'Descricao' => $mercadoriaData['Descricao'],
                        'NCM_HS' => $mercadoriaData['NCM_HS'],
                        'NCM_HS_Numero' => $mercadoriaData['NCM_HS_Numero'],
                        'Quantidade' => $mercadoriaData['Quantidade'],
                        'Qualificacao' => $mercadoriaData['Qualificacao'],
                        'Unidade' => 'Kg',
                        'Peso' => $mercadoriaData['Peso'],
                    ]);
                }

            } elseif 
            ($tipoProcesso == 'exportacao') {

                // Atribuir automaticamente o Fk_processo
                $validatedExportacaoData['Fk_processo'] = $processo->ProcessoID;

                // Cria a exportação
                Exportacao::create($validatedExportacaoData);
            }
            
            // Redirecione para a página de listagem de processos com uma mensagem de sucesso
            return redirect()->route('processos.index', compact('processo'))->with('success', 'Processo inserido com sucesso!');
        
        } catch (QueryException $e) {

            return DatabaseErrorHandler::handle($e);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($processoID)
    {
        $processo = Processo::where('ProcessoID', $processoID)->first();
        $mercadorias = Mercadoria::where('ProcessoID', $processoID)->get();
        return view('processo.show_processo', compact('processo', 'mercadorias'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($processoID)
    {
        $processo = Processo::where('ProcessoID', $processoID)->first();
        $importacao = Importacao::where('Fk_processo',$processo->ProcessoID)->first(); // Obtenha a relação 'importacao'
        $mercadorias = Mercadoria::where('Fk_Importacao', $importacao->Id)->get(); // Obtenha a relação 'mercadoria'
        return view('processo.edit_processo', compact('processo', 'importacao', 'mercadorias'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $ProcessoRequest,  DARRequest $DARRequest, TarifaDURequest $DURequest, PortuariaRequest $Portuaria, $processoID)
    {
        
        try {

            // Inicia uma transação para garantir a integridade dos dados
            DB::beginTransaction();

            // Actualizar os campos de processos...

            Processo::where('ProcessoID', $processoID)->update([
                'Situacao' => $ProcessoRequest->input('Situacao'),
            ]); // Dados do Processo

            TarifaDARController::storeOrUpdate($DARRequest, $processoID); // Tarifas do DAR

            TarifaPortuariaController::storeOrUpdate($Portuaria, $processoID); // Tarifas Portuarias

            TarifaDUController::storeOrUpdate($DURequest, $processoID); // Tarifas do DU

            // Caso exista documento(File/Files) para inserir ou actualizar deve activar a função

            /*$importacao = Importacao::where('Fk_processo', $processoID)->first();

            if($importacao->documentosAduaneiros)
                DocumentoAduaneiroController::storeOrUpdate($DocumentoAdu, $importacao->Id);
            */
            DB::commit();

            return redirect()->back()->with('success', 'Dados Actualizados com sucesso');

        } catch (QueryException $e) {

            DB::rollBack();

            return DatabaseErrorHandler::handle($e);
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Processo $processo)
    {
        //
    }

    public function print($processoID)
    {
        $processo = Processo::where('ProcessoID', $processoID)->first();

        $header_footer = new PdfHelper();
        $header_footer::generatePrint($processo->cliente->Id);

        // Importante: Não é necessário retornar nada nesta rota
    }

    public function getProcessesByIdAndStatus($ProcessoId, $status)
    {
        // Find processes with the specified customer ID and status
        $processos = Processo::where('ProcessoID', $ProcessoId)->where('Situacao', $status)->get();
    
        // You can return the processes as a JSON response
        return response()->json([
            'processos' => $processos,
            'cliente' => $processos->first()->cliente, // Assuming all processes belong to the same customer
            'mercadorias' => $processos->flatMap->mercadorias,
            'cobranca' => $processos->first()->cobrado
        ]);
    }



}

