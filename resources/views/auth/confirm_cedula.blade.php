<!DOCTYPE html>
<html>
<head>
    <title>Sua View</title>
</head>
<body>

    @if(isset($dados))
        <form>
            <label for="cedula">Cedula:</label>
            <input type="text" id="cedula" name="cedula" value="{{ $dados['cedula'] }}" readonly>

            <label for="nif">NIF:</label>
            <input type="text" id="nif" name="nif" value="{{ $dados['nif'] }}" readonly>

            <label for="endereco">Endereço:</label>
            <input type="text" id="endereco" name="endereco" value="{{ $dados['endereco'] }}" readonly>

            <!-- Adicione outros campos conforme necessário -->

            <label for="nome_usuario">Nome do Usuário:</label>
            <input type="text" id="nome_usuario" name="nome_usuario" value="{{ $dados['user']['name'] }}" readonly>

            <label for="email_usuario">E-mail do Usuário:</label>
            <input type="text" id="email_usuario" name="email_usuario" value="{{ $dados['user']['email'] }}" readonly>

            <!-- Adicione outros campos do usuário conforme necessário -->
            
            <label for="nome_instancia">Nome da Instância:</label>
            <input type="text" id="nome_instancia" name="nome_instancia" value="{{ $dados['instancia']['nome_provincia'] }}" readonly>

            <!-- Adicione outros campos da instância conforme necessário -->

            <!-- Adicione o botão de envio ou qualquer outra coisa que você desejar -->

        </form>
    @else
        <p>Dados não disponíveis.</p>
    @endif

</body>
</html>

