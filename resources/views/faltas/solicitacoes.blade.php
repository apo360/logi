@extends('layouts.app') <!-- Se você tem um layout base, substitua por ele -->


    <h1>Visualização de Solicitações de Licenças</h1>
    <table>
        <tr>
            <th>Solicitação ID</th>
            <th>Nome do Funcionário</th>
            <th>Tipo de Licença</th>
            <th>Data de Início</th>
            <th>Data de Término</th>
            <th>Status</th>
        </tr>
        @foreach($solicitacoes as $solicitacao)
        <tr>
            <td>{{ $solicitacao->SolicitacaoID }}</td>
            <td>{{ $solicitacao->NomeDoFuncionario }}</td>
            <td>{{ $solicitacao->TipoDeLicenca }}</td>
            <td>{{ $solicitacao->DataDeInicio }}</td>
            <td>{{ $solicitacao->DataDeFim }}</td>
            <td>{{ $solicitacao->Status }}</td>
        </tr>
        @endforeach
    </table>

