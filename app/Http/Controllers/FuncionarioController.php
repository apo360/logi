<?php

namespace App\Http\Controllers;

use App\Helpers\DatabaseErrorHandler;
use App\Http\Requests\ContratoRequest;
use App\Models\Funcionario;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\FuncionarioRequest;
use App\Models\Contrato;
use App\Models\Departamento;
use Illuminate\Database\QueryException;

class FuncionarioController extends Controller
{
    public function index()
    {
        $funcionarios = Funcionario::all();
        $contratos = $funcionarios->contrato();
        return view('funcionarios.fun_index', compact('funcionarios', 'contratos'));
    }

    public function create()
    {
        return view('funcionarios.fun_cadastro');
    }

    public function store(FuncionarioRequest $request)
    {
        $data = $request->validated();
        
        // Extract the relevant data from the request
        $nome = $data['Nome']; $apelido = $data['Apelido'];
        $nascimento = $data['data_nasc']; $genero = $data['Genero'];
        $email = $data['Email']; $telefone = $data['Telefone'];
        $endereco = $data['Endereco'];
        
        // Get the authenticated user's ID
        $user = auth()->user()->id;

        // Execute the stored procedure
        $results = DB::select("CALL insert_employee(?, ?, ?, ?, ?, ?, ?, ?)", [$nome, $apelido, $nascimento, $genero, $email, $telefone, $endereco, $user]);
        
        // Verifica se o resultado tem mensagem de sucesso ou de erro
        $message = $results[0]->resultado;

        if (strpos($message, 'sucesso') !== false) {
            // Success message
            return redirect()->route('funcionarios.index')->with('success', $message);
        } else {
            // Error message
            return redirect()->back()->with('error', $message);
        }
    }


    public function show(Funcionario $funcionario)
    {
        return view('funcionarios.fun_show', compact('funcionario'));
    }

    public function edit(Funcionario $funcionario)
    {
        $departamentos = Departamento::all();
        // Verifique se já existe um contrato para o funcionário
        $contrato = Contrato::where('employee_id', $funcionario->Id)->first();

        return view('funcionarios.fun_edit', compact('funcionario', 'departamentos', 'contrato'));
    }

    public function update(FuncionarioRequest $funcionarioRequest, ContratoRequest $contratoRequest, Funcionario $funcionario, Contrato $contrato)
    {
        try {
            DB::beginTransaction();

            // Atualize os dados do funcionário
            $dadosValidados = $funcionarioRequest->validated();

            // Verifique se o email foi alterado
            if ($funcionario->Email === $dadosValidados['Email']) {
                // O email não foi alterado, remova-o dos dados validados
                unset($dadosValidados['Email']);
            } else {
                // O email foi alterado, verifique se o novo email já existe na base de dados
                $emailExistente = Funcionario::where('Email', $dadosValidados['Email'])->exists();

                if ($emailExistente) {
                    // O novo email já existe na base de dados, faça o rollback e retorne um erro
                    DB::rollBack();
                    return redirect()->back()->with('error', 'O email fornecido já está em uso.');
                }
            }

            // Atualiza os dados do funcionário
            $funcionario->update($dadosValidados);

            // Extrair os dados validados do objeto ContratoRequest
            $dadosContrato = $contratoRequest->validated();

            // Cria ou atualiza o contrato do funcionário
            $contrato->CreateOrUpdate($dadosContrato, $funcionario);

            DB::commit();

            return redirect()->route('funcionarios.index')->with('success', 'Funcionário atualizado com sucesso.');
        } catch (QueryException $e) {

            // Faça rollback da transação em caso de exceção
            DB::rollBack();

            // Trate a exceção de acordo com suas regras de negócios
            return $this->handleDatabaseErrors($e);
        }
    }



    public function destroy(Funcionario $funcionario)
    {
        $funcionario->delete();

        return redirect()->route('funcionarios.index')
            ->with('success', 'Funcionário excluído com sucesso.');
    }
}
