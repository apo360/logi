<!DOCTYPE html>
<html lang="pt-PT">
<head>

    <style>

        *{
            font-size: 13px;
        }


        td {
            border-top: 1px solid #ddd;
            margin: 10px;
            font-size: 13px;
            padding: 5px;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        th {
            text-align: left;
            padding: 5px;
        }


    </style>

</head>
<body>

<?php
    $despachante = $factura->despachente();
    $user  = $despachante->user();
    $meses = $factura->mesesPagos()->get();
    $servico = $factura->getServico();
?>


<div>
    <div style="float:right;">
        <div style="margin-top: 150px">
        Exmo Senhor(a)<br>
        <strong>{{$user->name}}</strong><br>
        {{$despachante->endereco}}
        </div>
    </div>

    <div>
            <img src="{{asset("imagens/padrao.png")}}" style="width:100px; height:100px" /><br>
            <strong>HongaYetu Prestação de Serviços</strong><br>
            NIF: 0000000<br>
            Rua amilcar cabral, nº 66, 1ª Dto<br>
            Tel: +244 923 000 000<br>
            Email: geral@hongayetu.com<br>
            Web: www.hongayetu.com
    </div>

</div>
<br><br>



    <div style="float: right;">
        Original
    </div>
    <div>
        Factura HY{{date("Y")}}/1
    </div>
    <hr>
    <table>
        <thead>
        <tr>
            <th>V/Contribuente</th>
            <th>Data</th>
            <th>Data de vencimento</th>
            <th>Condições de pagamentos</th>
        </tr>
        </thead>
        <tbody>
                <tr>
                    <td>{{$despachante->cedula}}</td>
                    <td>{{$factura->created_at->translatedFormat("d/m/Y")}}</td>
                    <td>{{$factura->data_vencimento->translatedFormat("d/m/Y")}}</td>
                    <td>Factura 30 dias</td>
                </tr>
        </tbody>
    </table>
    <table>
        <thead>
        <tr>
            <th>V/Referência</th>
            <th>Desconto cliente</th>
            <th>Desconto financeiro</th>
            <th>Moeda</th>
            <th>Cambio</th>
        </tr>
        </thead>
        <tbody>
            <tr>
                <td>000000</td>
                <td>0.00</td>
                <td>0.00</td>
                <td>USD</td>
                <td>0.00</td>
            </tr>
        </tbody>
    </table>
    <br>

    <hr>

        <table>
            <thead>
            <tr>
                <th>Artigo/Serviço</th>
                <th>Descrinção</th>
                <th>Quantidade</th>
                <th>Pr. Unitário</th>
                <th>Desconto</th>
                <th>IVA</th>
                <th>Valor</th>
            </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{$servico["nome"]}}</td>
                    <td>

                        @if($factura->tipo_factura == \App\Models\Facturas::TIPO_QUOTA)
                            @foreach ($meses as $m)
                                {{\App\Helpers\Utils::returnMeses($m->mes)}}<br>
                            @endforeach
                        @else
                        ...
                        @endif

                    </td>
                    <td>{{$factura->quantidade}}</td>
                    <td>{{\App\Helpers\Utils::formataDinheiro($factura->quota)}}</td>
                    <td>{{\App\Helpers\Utils::formataDinheiro(0)}}</td>
                    <td>{{\App\Helpers\Utils::formataDinheiro($factura->getQuota("simples"))}}</td>
                    <td>{{\App\Helpers\Utils::formataDinheiro($factura->getQuota("simples"))}}</td>
                </tr>
            </tbody>
        </table>

    <br><br><br><br><br><br><br><br><br><br><br>


    <hr>

<div>
    <div style="width:470px; float:left;">
        <div style="border-bottom: dotted 1px #000">
            <strong>Quadro resumo de imposto</strong>
        </div>
        <table>
            <thead>
            <tr>
                <th>Taxa/Valor</th>
                <th>Incidência/Quantidade</th>
                <th>Motivo da insenção</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>IVA (0.00)</td>
                <td>= Valor total</td>
                <td>= Regime supensivo</td>
            </tr>
            </tbody>
        </table>
        <br>
        <hr>
        <div style="border-bottom: dotted 1px #000">
            <strong>Quadro retenção da fonte</strong>
        </div>
        <table>
            <thead>
            <tr>
                <th>Taxa/Valor</th>
                <th>Incidência/Quantidade</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>RFII (0.00)</td>
                <td>= Valor total</td>
            </tr>
            </tbody>
        </table>

        <br>
    </div>

    <div style="width:200px; $from == 'im' ? 'margin-right: -200px; float: left;':'margin-right: -250px; float: right;'">
        <div style="border-bottom: dotted 1px #000;">
            Mercadoria/Serviço: <span style="float:right">{{\App\Helpers\Utils::formataDinheiro($factura->getQuota("simples"))}}</span>
        </div>
        <div style="border-bottom: dotted 1px #000;">
            Descontos comercias: <span style="float:right">{{\App\Helpers\Utils::formataDinheiro(0)}}</span>
        </div>
        <div style="border-bottom: dotted 1px #000;">
            Desconto financeiro: <span style="float:right">{{\App\Helpers\Utils::formataDinheiro(0)}}</span>
        </div>
        <div style="border-bottom: dotted 1px #000;">
            Portes: <span style="float:right">{{\App\Helpers\Utils::formataDinheiro(0)}}</span>
        </div>
        <div style="border-bottom: dotted 1px #000;">
            Outros serviços: <span style="float:right">{{\App\Helpers\Utils::formataDinheiro(0)}}</span>
        </div>
        <div style="border-bottom: dotted 1px #000;">
            Adiantamentos: <span style="float:right">{{\App\Helpers\Utils::formataDinheiro(0)}}</span>
        </div>
        <div style="border-bottom: dotted 1px #000;">
            IEC: <span style="float:right">{{\App\Helpers\Utils::formataDinheiro(0)}}</span>
        </div>
        <div style="border-bottom: dotted 1px #000;">
            IVA: <span style="float:right">{{ $factura->tipo_factura ==  \App\Models\Facturas::TIPO_QUOTA ? \App\Helpers\Utils::formataDinheiro(0):\App\Helpers\Utils::formataDinheiro($factura->getQuota("simples"))}}</span>
        </div>
        <div style="border-bottom: dotted 1px #000;">
            Acerto: <span style="float:right">{{\App\Helpers\Utils::formataDinheiro(0)}}</span>
        </div>
        <br>
        <hr>
        <div style="font-size: 20px;">
                Total

            <span style="float:right; font-size: 20px;">{{\App\Helpers\Utils::formataDinheiro($factura->getQuota("simples"))}}</span>
        </div>
    </div>

</div>

    <br>


<div style="clear: both;"></div>

    <div>
        <h3>Coordenadas bancárias:</h3>
        <div style="clear: both"></div>

        <div style="float: left; width:240px; margin-right: 10px;">
            <strong>BAI</strong>: AO0600400000-85943672-10185
        </div>

        <div style="float: right; width: 240px;">
            <strong>BCI</strong>: AO06000500000-1034021-10294
        </div>

        <div style="float: right; width: 240px;">
            <strong>BIC</strong>: AO0600510000-16648463-10137
        </div>
    </div>

    <div style="clear: both;"></div>

</body>
