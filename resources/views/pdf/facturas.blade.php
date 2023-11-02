<!DOCTYPE html>
<head>
    <title>Factura</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        
    <style>
        
        /* Estilos CSS para o cabeçalho */

    </style>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div style="float:right;">
                    <div style="margin-top: 150px">
                    Exmo Senhor(a)<br>
                    <strong>{{$cliente->CompanyName}}</strong><br>
                    {{$cliente->CustomerTaxID}}
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <strong>HongaYe Prestação de Serviços</strong><br>
                NIF: 0000000<br>
                Rua amilcar cabral, nº 66, 1ª Dto<br>
                Tel: +244 923 000 000<br>
                Email: geral@hongayetu.com<br>
                Web: www.hongayetu.com
            </div>
        </div>
    </div>


    <div class="container">
        
        <div class="row">
            <div style="float: left;">
                Exmo.(s) Sr(s) <br>
                {{$cliente->CompanyName}} <!-- Nome/empresa --> <br>
                {{$cliente->CustomerTaxID}} <!-- NIF: --> <br>
                Endereço: 
            </div>

            <!-- Adicione o conteúdo desejado para o cabeçalho -->
            <div class="rigth">
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
            
        </div>

        <div class="body">
            <label for="">Factura</label>
            Data de Emissão: {{ date('d-m-Y') }}
            Original
            <hr>

            <table class="table table-sm">
                <thead>
                    <tr>
                        <th>Cod. Produto</th>
                        <th>Descrição</th>
                        <th>P/Unitário</th>
                        <th>Qtd</th>
                        <th>Dsconto</th>
                        <th>Taxa %</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>54515155</td>
                        <td>PO 66618915615</td>
                        <td>AOA</td>
                        <td>499</td>
                        <td>499</td>
                        <td>499</td>
                        <td>{{ date('d-m-Y') }}</td>
                    </tr>
                    <tr>
                        <th>Desc. Cli.</th>
                        <th>Desc. Fin.</th>
                        <th>Vencimento</th>
                        <th>Condição Pagamento</th>
                    </tr>
                    <tr>
                        <td>0.00</td>
                        <td>0.00</td>
                        <td>...</td>
                        <td>30 dias</td>
                    </tr>
                </tbody>
            </table>

            <br/>
            <hr/>
            <table class="table">
                <thead>
                    <tr>
                        <th>Serviço</th>
                        <th>Descrição</th>
                    </tr>
                </thead>
                <tbody>
                    <td>...</td>
                    <td>...</td>
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
</body>


