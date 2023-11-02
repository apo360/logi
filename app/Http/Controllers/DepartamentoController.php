<?php

namespace App\Http\Controllers;

use App\Models\Departamento;
use App\Models\Funcionario;
use Illuminate\Http\Request;

class DepartamentoController extends Controller
{

    public function index(){

        $managers = Funcionario::all();
        $departamentos = Departamento::all();
        return view('departamento.index', compact('managers', 'departamentos'));
        
    }
    
    public function store(Request $request)
    {
        // Validação dos dados do formulário
        $request->validate([
            'cod' => 'required|string|max:5',
            'name' => 'required|string|max:200',
            'manager_id' => 'nullable|integer',
        ]);

        try {
            // Crie um novo departamento com os dados fornecidos
            Departamento::create([
                'cod' => $request->input('cod'),
                'name' => $request->input('name'),
                'manager_id' => $request->input('manager_id'),
            ]);

            return redirect()->back()->with('success', 'Departamento criado com sucesso.');
        } catch (\Throwable $th) {
            // Em caso de erro, trate o erro e redirecione de volta com uma mensagem de erro
            return redirect()->back()->with('error', 'Erro ao criar o departamento.');
        }
    }

    public function edit($departamentoID)
    {
        
        return view('departamento.edit');
    }

    public function show() {
        //
    }

    public function destroy(Departamento $departamento) {
        
    }
}
