<?php

namespace App\Http\Controllers;

use App\Models\Funcionario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FaltasController extends Controller
{
    public function index() {
        
        
    }
    
    public function LivroPontoOpen() {
        
        $funcionarios = Funcionario::all();
        return view('faltas.livro_ponto', compact('funcionarios'));
    }

    public function InserirFaltas() {
        
        
    }

    public function JustificarFaltas() {
        
        
    }

    public function ConfigFaltas() {
        
        
    }

    public function MapaFL() {
        
        $solicitacoes = DB::table('SolicitacoesDeLicenca')
        ->select('ID as id', 'TipoDeLicenca as title', 'DataDeInicio as start', 'DataDeFim as end')
        ->get();

        $solicitacoes = json_encode($solicitacoes);

        return view('faltas.mapa', compact('solicitacoes'));
    }
}
