<?php

namespace App\Http\Controllers;

use App\Models\DU;
use App\Models\Mercadoria;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class MercadoriaController extends Controller
{
    
    /**
     * Tratamento dos erros que podem ocorrer dentro do código
     */
    private function handleDatabaseErrors(\Throwable $e)
    {
        if ($e instanceof QueryException) {
            // Log do erro de banco de dados
            Log::error('Erro de banco de dados: ' . $e->getMessage());

            // Exibir mensagem de erro para o usuário
            return redirect()->back()->with('error', 'Ocorreu um erro de banco de dados. Por favor, tente novamente mais tarde.');

            // OU

            // Redirecionar para uma página de erro personalizada
            return redirect()->route('error.page');
        } else {
            // Log de outros erros
            Log::error('Erro não tratado: ' . $e->getMessage());

            // Exibir mensagem de erro para o usuário
            return redirect()->back()->with('error', 'Ocorreu um erro. Por favor, tente novamente mais tarde.');

            // OU

            // Redirecionar para uma página de erro personalizada
            return redirect()->route('error.page');
        }
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Valide os dados das mercadorias

        // Inicia uma transação para garantir a integridade dos dados
        DB::beginTransaction();

        $mercadoriasData = $request->input('mercadorias');

        // Obtém os dados das mercadorias do formulário
        $mercadoriasData = $request->input('mercadorias');

        // Valide os dados das mercadorias, se necessário
        
        // Percorra os dados das mercadorias e crie as instâncias de mercadoria
        foreach ($mercadoriasData['marcas'] as $index => $marcas) {
            $marca = $mercadoriasData['marcas'][$index];
            $numero = $mercadoriasData['numero'][$index];
            $quantidade = $mercadoriasData['quantidade'][$index];
            $qualificacaoID = $mercadoriasData['qualificaçãoID'][$index];
            $designacao = $mercadoriasData['designacao'][$index];
            $peso = $mercadoriasData['peso'][$index];

            // Chame o procedimento InserirMercadoria usando a função DB::statement
            DB::statement("CALL InserirMercadoria('$request->NrProcesso', '$marca', $numero, $quantidade, $qualificacaoID, '$designacao', $peso)");
        }

    }

    /**
     * Display the specified resource.
     */

     public function show($processoId)
{
    // Get Datas Mercadorias
    $mercadorias = Mercadoria::where('ProcessoID', $processoId)->get();
    $DU = DU::where('ProcessoID', $processoId)->first();
    if ($mercadorias->isEmpty()) {
        return response()->json([
            "error" => "Nenhuma mercadoria encontrada para o ProcessoID fornecido.",
        ], 404);
    }

    $result = [];
    foreach ($mercadorias as $mercadoria) {
        // Verificar se a relação 'qualificacao' está carregada
        $result[] = [
            "marcas" => $mercadoria->marcas,
            "numeros" => $mercadoria->numero,
            "quantidades" => $mercadoria->quantidade,
            "designacao" => $mercadoria->designacao,
            "qualificacao" => ($mercadoria->qualificacao)? [
                "cod" => $mercadoria->qualificacao->Cod,
                "descricao" => $mercadoria->qualificacao->descricao,
            ] : null,

            "DU" => ($DU)? ["tipo" => $DU->getTipoDespacho($DU->tipo_depachoID), "transporte" => $DU->NavioAviao] : null,
        ];
    }

    return response()->json([
        "mercadorias" => $result,
    ]);
}

    


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Mercadoria $mercadoria)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Mercadoria $mercadoria)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Mercadoria $mercadoria)
    {
        //
    }
}
