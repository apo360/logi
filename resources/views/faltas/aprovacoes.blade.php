@extends('layouts.app') <!-- Se você tem um layout base, substitua por ele -->

    <h1>Visualização de Aprovação de Licenças</h1>
    <table>
        <tr>
            <th>Solicitação ID</th>
            <th>Nome do Funcionário</th>
            <th>Tipo de Licença</th>
            <th>Data de Aprovação</th>
        </tr>
        @foreach($aprovacoes as $aprovacao)
        <tr>
            <td>{{ $aprovacao->SolicitacaoID }}</td>
            <td>{{ $aprovacao->NomeDoFuncionario }}</td>
            <td>{{ $aprovacao->TipoDeLicenca }}</td>
            <td>{{ $aprovacao->DataDeAprovacao }}</td>
        </tr>
        @endforeach
    </table>
