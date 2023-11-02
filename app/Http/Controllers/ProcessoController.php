<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Mercadoria;
use App\Models\Processo;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use App\Helpers\DatabaseErrorHandler;
use App\Helpers\PdfHelper;
use App\Http\Requests\CobradoRequest;
use App\Http\Requests\DURequest;
use App\Http\Requests\LiquidacaoRequest;
use App\Models\DU;
use App\Models\DAR;
use App\Http\Requests\PortuariaRequest;
use App\Http\Requests\ProcessoRequest;
use App\Models\Cobrado;
use App\Models\Liquidacao;
use App\Models\Portuaria;

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
                $processo->Status,
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
        $qualificacao = DB::table('tipo_qualicacao')->get();
        $clientes = Customer::all(); // Busca os Clientes
        $NewProcesso = Processo::generateNewProcesso(); // Inicializar com novo código de processo

        // Retornar uma view com o formulário para criar um novo processo
        return view('processo.create_processo', compact('clientes', 'NewProcesso', 'qualificacao'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProcessoRequest $request)
    {
        // Valide os dados do processo
        $validatedData = $request->validated();

        // Gera o valor do ProcessoID automaticamente
        $validatedData['ProcessoID'] = Processo::auto_increment();
        try {
            // Inicia uma transação para garantir a integridade dos dados
            DB::beginTransaction();

            // Cria um novo registro de processo na tabela 'processos' com os dados fornecidos
            $processo = Processo::create($validatedData);

            // Obtém os dados das mercadorias do formulário
            $mercadoriasData = $request->input('dadosTabela');

            // Valide os dados das mercadorias, se necessário
            
            // Percorra os dados das mercadorias e crie as instâncias de mercadoria
            foreach ($mercadoriasData as $dados) {
                // Acesse os valores individuais de cada linha da tabela
                $marca = $dados->marcas;
                $numero = $dados->numero;
                $quantidade = $dados->quantidade;
                $qualificacaoID = $dados->qualificacaoID;
                $designacao = $dados->designacao;
                $peso = $dados->peso;

                // Chame o procedimento InserirMercadoria usando a função DB::statement
                DB::statement("CALL InserirMercadoria('$request->NrProcesso', '$marca', $numero, $quantidade, $qualificacaoID, '$designacao', $peso)");
            }

            // Confirma a transação, salvando as alterações no banco de dados
            DB::commit();
            
            // Redirecione para a página de listagem de processos com uma mensagem de sucesso
            return redirect()->route('processos.index', compact('processo'))->with('success', 'Processo inserido com sucesso!');
        } catch (QueryException $e) {

            DB::rollBack();

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
        $mercadorias = Mercadoria::where('ProcessoID', $processoID)->get();
        $du = DU::where('ProcessoID', $processoID)->first();
        $dar = DAR::where('ProcessoID', $processoID)->first();
        $liquidacao = Liquidacao::where('ProcessoID', $processoID)->first();
        $porto = Portuaria::where('ProcessoID', $processoID)->first();
        $cobrado = Cobrado::where('ProcessoID', $processoID)->first();
        $tipos = DB::table('tipo_despachante')->get();
        $qualificacao = DB::table('tipo_qualicacao')->get();
        $origens = DB::table('Paises')->get();
        return view('processo.edit_processo', compact('processo', 'mercadorias', 'tipos', 'origens', 'qualificacao', 'du', 'liquidacao', 'dar', 'porto', 'cobrado'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CobradoRequest $cobradoRequest, LiquidacaoRequest $liquidacaoRequest, 
                            PortuariaRequest $portuariaRequest, DURequest $dURequest,
                            $processoID)
    {
        
        // Valide os dados do processo, DU, DAR e Liquidacao, Portuaria
        $processo = Processo::findOrFail($processoID);

        try {

            // Inicia uma transação para garantir a integridade dos dados
            DB::beginTransaction();

            // Atualiza ou cria o registro de DU
            app(DuController::class)->storeOrUpdate($dURequest, $processo->du);

            // Atualiza ou cria o registro de Liquidacao
            app(LiquidacaoController::class)->storeOrUpdate($liquidacaoRequest, $processo->liquidacao);

            // Atualiza ou cria o registro de Portuaria
            app(PortuariaController::class)->storeOrUpdate($portuariaRequest, $processo->portuaria);

            // Chama os métodos storeOrUpdate() dos respectivos controllers para criar ou atualizar os registros
            app(CobradosController::class)->storeOrUpdate($cobradoRequest, $processo->cobrado);

            DB::commit();

            return redirect()->back()->with('success', 'Dados Inseridos');

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
        $processos = Processo::where('ProcessoID', $ProcessoId)->where('Status', $status)->get();
    
        // You can return the processes as a JSON response
        return response()->json([
            'processos' => $processos,
            'cliente' => $processos->first()->cliente, // Assuming all processes belong to the same customer
            'mercadorias' => $processos->flatMap->mercadorias,
            'cobranca' => $processos->first()->cobrado
        ]);
    }
    



}

