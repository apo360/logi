<!DOCTYPE html>
<html>
<head>
    <title>Detalhes do Funcionário</title>
</head>
<body>
    <h1>Detalhes do Funcionário</h1>

    <table>
        <tr>
            <th>ID</th>
            <td>{{ $funcionario->id }}</td>
        </tr>
        <tr>
            <th>Funcionario ID</th>
            <td>{{ $funcionario->FuncionarioID }}</td>
        </tr>
        <tr>
            <th>Nome</th>
            <td>{{ $funcionario->Nome }}</td>
        </tr>
        <!-- Add other table rows for the remaining columns -->

    </table>

    <a href="{{ route('funcionarios.edit', $funcionario->id) }}">Editar</a>
</body>
</html>
