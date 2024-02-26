<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use App\Models\Modulo;
use App\Models\Provincia;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmpresaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, $subdomain)
    {
        // Verifique se a empresa (subdomínio) existe no banco de dados
        $empresa = Empresa::where('subdominio', $subdomain)->first();

        if ($empresa) {
            // A empresa existe, faça o que for necessário
            return view('empresa.index', compact('empresa'));
        } else {
            // A empresa não existe, redirecione ou exiba uma mensagem de erro
            abort(404);
        }
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
        $request->validate([
            'nif' => 'nullable|required|unique:Empresa,NIF|string|max:50',
            'Empresa' => 'required',
            'atividade_comercial' => 'required|array',
            'contacto_movel' => 'nullable|string|max:100',
            'nome' => 'required|string',
        ]);
        
        // Criar ou atualizar a empresa
        $empresaData = [
            'NIF' => $request['nif'],
            'Empresa' => $request['Empresa'],
            'ActividadeComercial' => implode(', ', $request['atividade_comercial']),
            'Contacto_movel' => $request['contacto_movel'],
        ];
        
        $empresa = Empresa::updateOrInsert(
            ['NIF' => $request['nif']],
            $empresaData
        );
        
        // Atualizar o nome do usuário
        User::where('id', Auth::user()->id)->update(['name' => $request['nome'], 'Fk_Empresa' => $empresa->Id]);
        
        // Redirecionar ou executar outras ações com base no seu fluxo de aplicativo
        return redirect()->route('empresa.edit', ['id' => $empresa->Id])->with('success', 'Empresa cadastrada/atualizada com sucesso!');
        
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
        $empresa = Empresa::where('Id', $id)->first();
        $provincias = Provincia::all();
        return view('Empresa.update', compact('empresa', 'provincias'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $request->validate([
            'cod_factura' => 'nullable|string|max:20',
            'cod_processo' => 'nullable|string|max:20',
            'slogan' => 'nullable|string|max:100',
            'endereco_completo' => 'nullable|string|max:200',
            'provincia' => 'nullable|string|max:100',
            'cidade' => 'nullable|string|unique:Empresa,Dominio|max:100',
            'dominio' => 'nullable|string|max:100',
            'email' => 'nullable|email|max:100',
            'fax' => 'nullable|string|max:100',
            'contacto_movel' => 'nullable|string|max:100',
            'contacto_fixo' => 'nullable|string|max:100',
            // Adicione mais validações conforme necessário
        ]);

        $empresa = Empresa::where('NIF', $id)->first();

        if (!$empresa) {
            return redirect()->back()->with('error', 'Empresa não encontrada.');
        }

        $empresa->update([
            'CodFactura' => $request->input('cod_factura'),
            'CodProcesso' => $request->input('cod_processo'),
            'Slogan' => $request->input('slogan'),
            'Endereco_completo' => $request->input('endereco_completo'),
            'Provincia' => $request->input('provincia'),
            'Cidade' => $request->input('cidade'),
            'Dominio' => $request->input('dominio'),
            'Email' => $request->input('email'),
            'Fax' => $request->input('fax'),
            'Contacto_movel' => $request->input('contacto_movel'),
            'Contacto_fixo' => $request->input('contacto_fixo'),
        ]);

        return redirect()->route('empresa.edit', $empresa->Id)->with('success', 'Empresa atualizada com sucesso.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function SubscricaoModulo(){
        $modulos = Modulo::whereNull('parent_id')->with('submodules')->get();
        return view('Empresa.subscricao', compact('modulos'));
    }

    public function processarSubscricao(Request $request)
    {
        // Lógica para processar a subscrição baseada nos módulos e submódulos selecionados

        return redirect()->route('Empresa.subscricao')->with('success', 'Subscrição processada com sucesso.');
    }
}
