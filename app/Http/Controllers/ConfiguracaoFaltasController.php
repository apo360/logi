<?php

namespace App\Http\Controllers;

use App\Models\ConfiguracaoFalta;
use Illuminate\Http\Request;

class ConfiguracaoFaltasController extends Controller
{
    
    public function index()
    {
        $configuracoesFaltas = ConfiguracaoFalta::all(); // Recupere todas as configurações de falta do banco de dados
        return view('configuracoes.faltas.index', compact('configuracoesFaltas'));
    }

}
