<div class="container">
    <div class="header">
        <!-- Adicione o conteúdo desejado para o cabeçalho -->
        <div class="logotipo">

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

    <div class="body">
        Data de Emissão: Data: {{ date('d-m-Y') }}
        <table>
            <thead>
                <tr>
                    <th>Código do produto</th> 
                    <th>Descrição</th>
                    <th>P/Unitário</th>
                    <th>Quantidade</th>
                    <th>Desconto</th>
                    <th>Taxa%</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
    </div>

    <div class="footer">
        <p>Serviços afaldengarios colocado à disposição do adquirente na Data do Documento</p>
        <div class="">
            ZlkW-Processado por programa validado Nº {{ $header->SoftwareValidationNumber }} / {{ $header->ProductID }} 
        </div>
    </div>
</div>