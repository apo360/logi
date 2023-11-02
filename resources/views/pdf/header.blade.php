
<style>
    /* Estilos CSS para o cabeçalho */
    .header {
        text-align: left;
        background-color: #f2f2f2;
    }
</style>

<div class="header">
    <!-- Adicione o conteúdo desejado para o cabeçalho -->
    <div class="logotipo">
        teste
    </div>
    <div class="">
        @foreach ($headers as $header)
            <div class="">
                <span>Endereço: Kassequel do Lourenço</span><br>
                <span>Contactos: {{ $header->Telephone }} / {{ $header->Telephone }}</span><br>
                <span>Email: {{ $header->Email }}</span><br>
                <span>Nif: {{ $header->TaxRegistrationNumber }}</span><br>
            </div>
        @endforeach
    </div>
</div>
