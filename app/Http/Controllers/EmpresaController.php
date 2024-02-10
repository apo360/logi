<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use Illuminate\Http\Request;

class EmpresaController extends Controller
{
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
        return view('Empresa.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validar os dados recebidos do formulário
        $request->validate([
            //'nome' => 'required|string|max:255',
            'cod_factura' => 'nullable|string|max:20',
            'cod_processo' => 'nullable|string|max:20',
            'slogan' => 'nullable|string|max:100',
            'endereco_completo' => 'nullable|string|max:200',
            'provincia' => 'nullable|string|max:100',
            'cidade' => 'nullable|string|max:100',
            'dominio' => 'nullable|string|max:100',
            'email' => 'nullable|email|max:100',
            'fax' => 'nullable|string|max:100',
            'contacto_movel' => 'nullable|string|max:100',
            'contacto_fixo' => 'nullable|string|max:100',
            // Adicione mais validações conforme necessário
        ]);

        // Criar uma nova instância da empresa
        $empresa = new Empresa();
        
        // Preencher os campos com os dados do formulário
        $empresa->nome = $request->input('nome');
        $empresa->cod_factura = $request->input('cod_factura');
        $empresa->cod_processo = $request->input('cod_processo');
        $empresa->slogan = $request->input('slogan');
        $empresa->endereco_completo = $request->input('endereco_completo');
        $empresa->provincia = $request->input('provincia');
        $empresa->cidade = $request->input('cidade');
        $empresa->dominio = $request->input('dominio');
        $empresa->email = $request->input('email');
        $empresa->fax = $request->input('fax');
        $empresa->contacto_movel = $request->input('contacto_movel');
        $empresa->contacto_fixo = $request->input('contacto_fixo');
        // Preencha outros campos conforme necessário

        // Salvar a empresa no banco de dados
        $empresa->save();

        // Redirecionar para a página de exibição ou fazer algo mais, dependendo do seu fluxo de aplicativo
        return redirect()->route('empresa.index')->with('success', 'Empresa cadastrada com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
