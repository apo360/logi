
<style>
        .body-doc {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .upload-container {
            text-align: center;
            background-color: #ffffff;
            border: 2px dashed #ccc;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }

        .progress-bar {
            width: 0;
            height: 10px;
            background-color: #3498db;
            border-radius: 5px;
            transition: width 0.3s ease-in-out;
        }

        #drop-area.active {
            background-color: #e0e0e0;
        }

        #file-list ul {
            list-style: none;
            padding: 0;
        }

        #file-list ul li {
            margin: 5px 0;
            padding: 5px;
            background-color: #f5f5f5;
            border: 1px solid #ddd;
            border-radius: 5px;
            cursor: move;
        }

        .button-arquivo {
            background-color: #3498db;
            color: #fff;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }

        input[type="file"] {
            display: none;
        }
    </style>

<x-app-layout>
    <x-slot name="header">
        <x-breadcrumb title="Editar Processo" breadcrumb="Editar Processo" />
    </x-slot>
    <br>
    <x-validation-errors class="mb-4" />

    @if (session('status'))
        <div class="mb-4 font-medium text-sm text-green-600">
            {{ session('status') }}
        </div>
    @endif

    @if (Session::has('error'))
        <div class="alert alert-success">
            {{ Session::get('error') }}
        </div>
    @endif

    <form action="{{ route('processos.update', $processo->ProcessoID) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <div class="flex items-center justify-between">
                            <div class="items-center">
                                <x-button>
                                    <a class="button" href="{{ route('processos.index') }}">
                                        {{ __('Pesquisar') }}
                                    </a>
                                </x-button>
                            </div>

                            <div class="items-center">
                                <div class="btn-group">
                                    <x-button type="submit" class="button">{{ __('Atualizar') }}</x-button>
                                    <x-button>
                                        <a class="button " href="{{ route('arquivos.edit', $processo->ProcessoID) }}">
                                            {{ __('Upload') }}
                                        </a>
                                    </x-button>
                                    <x-button>
                                        <a class="button" href="{{ route('processos.factura', $processo->ProcessoID) }}">
                                            {{ __('Factura') }}
                                        </a>
                                    </x-button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card card-navy">
                    <div class="card-header">
                        <div class="">
                            <div class="card-title flex items-center">
                                <strong>Nº Processo:</strong> <span>{{ $processo->NrProcesso }}</span>
                                <strong>Cliente : </strong> <span>{{ $processo->cliente->CompanyName }}</span>
                                <strong>Ref/Factura : </strong> <span>{{ $processo->RefCliente }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <!-- input's hidden's -->
                        <x-input type="text" name="NrProcesso" id="NrProcesso"  class="hidden" value="{{ $processo->NrProcesso }}" />
                        <x-input type="text" name="ClienteID" id="ClienteID" class="hidden" value="{{ $processo->cliente->Id }}" />
                        <x-input type="text" name="RefCliente" id="RefCliente"  class="hidden" value="{{ $processo->RefCliente }}" />

                        <div class="row">
                            <table class="table" id="mercadorias-table">
                                <thead>
                                    <tr>
                                        <th>Marcas</th>
                                        <th>Número</th>
                                        <th>Quantidade</th>
                                        <th>Qualificação</th>
                                        <th>Designação</th>
                                        <th>Peso (Kg)</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($mercadorias as $mercadoria)
                                        <tr>
                                            <td>{{ $mercadoria->marcas }}</td>
                                            <td>{{ $mercadoria->numero }}</td>
                                            <td>{{ $mercadoria->quantidade }}</td>
                                            <td>{{ $mercadoria->qualificacaoID }}</td>
                                            <td>{{ $mercadoria->designacao }}</td>
                                            <td>{{ $mercadoria->peso }}</td>
                                            <!-- Exiba outros campos da mercadoria, se houver -->
                                        </tr>
                                    @endforeach
                                    
                                </tbody>
                            </table>
                        </div>

                        <div class="container-tabs">
                            <!-- # Create tabs for DAR, DU, -->
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link " id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">DU</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link " id="dar-tab" data-bs-toggle="tab" data-bs-target="#dar" type="button" role="tab" aria-controls="dar" aria-selected="false">DAR</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="cobrado-tab" data-bs-toggle="tab" data-bs-target="#cobrado" type="button" role="tab" aria-controls="cobrado" aria-selected="false">Cobranças</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link " id="ficheiro-tab" data-bs-toggle="tab" data-bs-target="#ficheiro" type="button" role="tab" aria-controls="ficheiro" aria-selected="false">Ficheiros</button>
                                </li>
                            </ul>
                            <!-- Tab panes -->
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show " id="home" role="tabpanel" aria-labelledby="home-tab">
                                    <input type="hidden" name="ProcessoID" value="{{ $processo->ProcessoID }}">
                                    
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="tipo_depachoID">Tipo de Despacho ID:</label>
                                                <select name="tipo_depachoID" id="tipo_depachoID" class="form-control">
                                                    <option value="">Selecionar</option>    
                                                    @foreach($tipos as $tipo)
                                                        <option value="{{$tipo->id}}" @if ($du && $du->tipo_depachoID == $tipo->id) selected @endif >{{$tipo->tipo}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="NrOrdem">Número de Ordem:</label>
                                                <x-input type="text" name="NrOrdem" id="NrOrdem" class="form-control"  required value="{{ isset($du) ? $du->setNrOrdemAttribute($du->NrOrdem) : '' }}"/>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="NavioAviaoType">Navio/Avião</label>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <select name="NavioAviaoType" id="" class="form-control">
                                                            <option value="navio">Navio</option>
                                                            <option value="aviao">Avião</option>
                                                        </select>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <x-input type="text" name="NavioAviao" id="NavioAviao" class="form-control" required value="{{ isset($du) ? $du->NavioAviao : '' }}"/>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.row -->

                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="OrigemID">Origem</label>
                                                <select name="OrigemID" id="OrigemID" class="form-control">
                                                    <option value="">Selecionar</option>
                                                    @foreach($origens as $origem)
                                                        <option value="{{ $origem->id }}" @if ($du && $du->OrigemID == $origem->id) selected @endif>{{ $origem->pais }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="ProcDestino">Processo de Destino:</label>
                                                <x-input type="text" name="ProcDestino" id="ProcDestino" class="form-control" required value="{{ isset($du) ? $du->ProcDestino : '' }}"/>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="CMarcaFiscal">CMarca Fiscal:</label>
                                                <x-input type="text" name="CMarcaFiscal" id="CMarcaFiscal" class="form-control" required value="{{ isset($du) ? $du->CMarcaFiscal : '' }}"/>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="BLCPorte">BLC/Porte:</label>
                                                <x-input type="text" name="BLCPorte" id="BLCPorte" class="form-control" required value="{{ isset($du) ? $du->BLCPorte : '' }}"/>
                                            </div>
                                        </div>
                                    </div> 
                                </div>

                                <div class="tab-pane fade show " id="dar" role="tabpanel" aria-labelledby="dar-tab">
                                    <br>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <x-label for="NrReceita" value="{{__('Nº')}}" />
                                            <x-input type="text" name="NrReceita" id="NrReceita" value="{{ isset($dar) ? $dar->NrReceita : '' }}" />
                                            <x-input-error for="NrReceita" class="mt-2" />
                                        </div>
                                        <div class="col-md-4">
                                            <x-label for="DataDar" value="{{__('Data')}}" />
                                            <x-input type="date" name="DataDar" id="DataDar" value="{{ isset($dar) ? $dar->DataDar : '' }}" />
                                            <x-input-error for="DataDar" class="mt-2" />
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <x-label for="Direitos" value="{{__('Direitos')}}" />
                                            <x-input type="text" name="Direitos" value="{{ old('Direitos', isset($liquidacao) ? $liquidacao->Direitos : '0.00') }}" class="subtotal-input"/>
                                        </div>
                                        <div class="col-md-4">
                                            <x-label for="EmolumentosAduaneiros" value="{{__('Emolumentos Aduaneiros')}}" />
                                            <x-input type="text" name="EmolumentosAduaneiros" value="{{ old('EmolumentosAduaneiros', isset($liquidacao) ? $liquidacao->EmolumentosAduaneiros : '0.00') }}" class="subtotal-input"/>
                                        </div>
                                        <div class="col-md-4">
                                            <x-label for="IvaAduaneiro" value="{{__('Iva Aduaneiro')}}" />
                                            <x-input type="text" name="IvaAduaneiro" value="{{ old('IvaAduaneiro', isset($liquidacao) ? $liquidacao->IvaAduaneiro : '0.00') }}" class="subtotal-input"/>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <x-label for="Iec" value="{{__('IEC')}}" />
                                            <x-input type="text" name="Iec" value="{{ old('Iec', isset($liquidacao) ? $liquidacao->Iec : '0.00') }}" class="subtotal-input"/>
                                        </div>
                                        <div class="col-md-4">
                                            <x-label for="ImpostoEstatistico" value="{{__('Imposto Estatístico')}}" />
                                            <x-input type="text" name="ImpostoEstatistico" value="{{ old('ImpostoEstatistico', isset($liquidacao) ? $liquidacao->ImpostoEstatistico : '0.00') }}" class="subtotal-input"/>
                                        </div>
                                        <div class="col-md-4">
                                            <x-label for="JurosMora" value="{{__('Juros de Mora')}}" />
                                            <x-input type="text" name="JurosMora" value="{{ old('JurosMora', isset($liquidacao) ? $liquidacao->JurosMora : '0.00') }}" class="subtotal-input"/>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <x-label for="Multas" value="{{__('Multas')}}" />
                                            <x-input type="text" name="Multas" value="{{ old('Multas', isset($liquidacao) ? $liquidacao->Multas : '0.00') }}" class="subtotal-input"/>
                                        </div>
                                        <div class="col-md-6">
                                            <x-label for="SUBTOTAL" value="{{__('SUBTOTAL')}}" />
                                            <x-input type="text" name="SUBTOTAL" value="{{ old('SUBTOTAL', isset($liquidacao) ? $liquidacao->SUBTOTAL : '0.00') }}" readonly id="subtotal"/>
                                        </div>
                                    </div>
                                    
                                    <br> <hr style="border-color:black;">
                                    <span>Dados Portuários</span>
                                    <br> <hr style="border-color:black;">

                                    <div class="row">
                                        <div class="col-md-4">
                                            <x-label for="EP14" value="{{__('EP14')}}" />
                                            <x-input type="text" name="EP14" value="{{ old('EP14', isset($liquidacao) ? $liquidacao->EP14 : '0.00') }}" class="subtotal-input"/>
                                        </div>
                                        <div class="col-md-4">
                                            <x-label for="EP17" value="{{__('EP17')}}" />
                                            <x-input type="text" name="EP17" value="{{ old('EP17', isset($liquidacao) ? $liquidacao->EP17 : '0.00') }}" class="subtotal-input"/>
                                        </div>
                                        <div class="col-md-4">
                                            <x-label for="Terminal" value="{{__('Terminal')}}" />
                                            <x-input type="text" name="Terminal" value="{{ old('Terminal', isset($liquidacao) ? $liquidacao->Terminal : '0.00') }}" class="subtotal-input"/>
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane fade show " id="cobrado" role="tabpanel" aria-labelledby="cobrado-tab">
                                    <br>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <x-label for="licenca_ministerio" value="{{__('Licença Ministério')}}" />
                                            <x-input type="text" name="licenca_ministerio" id="licenca_ministerio" value="{{ old('licenca_ministerio', isset($cobrado) ? $cobrado->licenca_ministerio : '0.00') }} " class="total-input"/> 
                                        </div>
                                        <div class="col-md-4">
                                            <x-label for="CompanhiaNavegacao" value="{{__('Companhia Navegação')}}" />
                                            <x-input type="text" name="CompanhiaNavegacao" id="CompanhiaNavegacao" value="{{ old('CompanhiaNavegacao', isset($cobrado) ? $cobrado->CompanhiaNavegacao : '0.00') }}" class="total-input"/>
                                        </div>
                                        <div class="col-md-4">
                                            <x-label for="ServicosViacao" value="{{__('Serviços Viação')}}" />
                                            <x-input type="text" name="ServicosViacao" id="ServicosViacao" value="{{ old('ServicosViacao', isset($cobrado) ? $cobrado->ServicosViacao : '0.00') }}" class="total-input"/>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <x-label for="NrReceita" value="{{__('Taxa Aeroportuária')}}" />
                                            <x-input type="text" name="TaxaAeroportuaria" id="TaxaAeroportuaria" value="{{ old('TaxaAeroportuaria', isset($cobrado) ? $cobrado->TaxaAeroportuaria : '0.00') }}" class="total-input"/>
                                        </div>
                                        <div class="col-md-4">
                                            <x-label for="NrReceita" value="{{__('Caução')}}" />
                                            <x-input type="text" name="PreenchimentoDocEstatistico" id="PreenchimentoDocEstatistico" value="{{ old('PreenchimentoDocEstatistico', isset($cobrado) ? $cobrado->PreenchimentoDocEstatistico : '0.00') }}" class="total-input"/>
                                        </div>
                                        <div class="col-md-4">
                                            <x-label for="PortoBl" value="{{__('Legalização do Porto BL')}}" />
                                            <x-input type="text" name="PortoBl" id="PortoBl" value="{{ old('PortoBl', isset($cobrado) ? $cobrado->PortoBl : '0.00') }}" class="total-input"/>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <x-label for="Frete" value="{{__('Frete')}}" />
                                            <x-input type="text" name="Frete" id="Frete" value="{{ old('Frete', isset($cobrado) ? $cobrado->Frete : '0.00') }}" class="total-input"/>
                                        </div>
                                        <div class="col-md-4">
                                            <x-label for="AssistenciaCargaDescarga" value="{{__('Assistência a Carga e Descarga')}}" />
                                            <x-input type="text" name="AssistenciaCargaDescarga" id="AssistenciaCargaDescarga" value="{{ old('AssistenciaCargaDescarga', isset($cobrado) ? $cobrado->AssistenciaCargaDescarga : '0.00') }}" class="total-input"/>
                                        </div>
                                        <div class="col-md-4">
                                            <x-label for="ServicosOrgaosOficiais" value="{{__('Serviços Órgãos Oficiais')}}" />
                                            <x-input type="text" name="ServicosOrgaosOficiais" id="ServicosOrgaosOficiais" value="{{ old('ServicosOrgaosOficiais', isset($cobrado) ? $cobrado->ServicosOrgaosOficiais : '0.00') }}" class="total-input"/>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <x-label for="Deslocações" value="{{__('Deslocações')}}" />
                                            <x-input type="text" name="Deslocacoes" id="Deslocacoes" value="{{ old('Deslocacoes', isset($cobrado) ? $cobrado->Deslocacoes : '0.00') }}" class="total-input"/>
                                        </div>
                                        
                                        <div class="col-md-4">
                                            <x-label for="GuiaAcompanhamentofiscal" value="{{__('Guia Acompanhamento Fiscal')}}" />
                                            <x-input type="text" name="GuiaAcompanhamentofiscal" id="GuiaAcompanhamentofiscal" value="{{ old('GuiaAcompanhamentofiscal', isset($cobrado) ? $cobrado->GuiaAcompanhamentofiscal : '0.00') }}" class="total-input"/>
                                        </div>
                                        <div class="col-md-4">
                                            <x-label for="Inerentes" value="{{__('Inerentes')}}" />
                                            <x-input type="text" name="Inerentes" id="Inerentes" value="{{ old('Inerentes', isset($cobrado) ? $cobrado->Inerentes : '0.00') }}" class="total-input"/>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <x-label for="DespesaCarregamento" value="{{__('Despesas de Carregamento')}}" /> 
                                                <x-input type="text" name="DespesaCarregamento" id="DespesaCarregamento" value="{{ old('DespesaCarregamento', isset($cobrado) ? $cobrado->DespesaCarregamento : '0.00') }}" class="total-input"/>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <x-label for="SelosImpressosDespacho" value="{{__('Sêlos e Impressos de Despacho')}}" /> 
                                                <x-input type="text" name="SelosImpressosDespacho" id="SelosImpressosDespacho" value="{{ old('SelosImpressosDespacho', isset($cobrado) ? $cobrado->SelosImpressosDespacho : '0.00') }}" class="total-input"/>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <x-label for="Honorarios" value="{{__('Honorários')}}" /> 
                                                <x-input type="text" name="Honorarios" id="Honorarios" value="{{ old('Honorarios', isset($cobrado) ? $cobrado->Honorarios : '0.00') }}" class="total-input"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane fade show active" id="ficheiro" role="tabpanel" aria-labelledby="ficheiro-tab">
                                    <br>
                                    <div class="col-md-12">
                                        
                                        <div id="drop-area" style="width: 100%; height: 200px; border: 2px dashed #ccc; text-align: center; padding: 20px;">
                                            <h2>Arraste e solte documento aqui!</h2>
                                            <p>ou</p>
                                            <label for="file-input" style="cursor: pointer;" class="button-arquivo">Selecione um arquivo</label>
                                        </div>
                                        <input type="file" id="file-input" multiple style="display: none;">
                                        
                                        <div id="file-list">
                                            <p>Arquivos selecionados:</p>
                                            <ul></ul>
                                        </div>
                                        <br>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card card-navy">
                    <div class="card-header">
                        <div class="card-title">Configurações do Processo</div>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="DataEntrada">Moeda</label>
                            <select name="moeda" id="moeda" class="form-control">
                                <option value="">Selecionar</option>
                                <option value="euro">EUR</option>
                                <option value="dolar">USD</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="DataEntrada">Data de Entrada:</label>
                            <x-input type="date" name="DataEntrada" id="DataEntrada" class="form-control" required value="{{ isset($du) ? $du->DataEntrada : '' }}"/>
                        </div>

                        <ul>
                            <li>
                                <strong>IVA Serviço(14%)</strong> <x-input type="text" name="LicencasAvulsasMapas" id="LicencasAvulsasMapas" value="{{ old('LicencasAvulsasMapas', isset($cobrado) ? $cobrado->LicencasAvulsasMapas : '0.00') }}" class="total-input"/>
                            </li>
                            <li>
                                <strong>Descontos:</strong> <x-input type="text" name="desconto" value="" class=""/>
                            </li>
                            <li>
                                <strong>Total Geral:</strong> <x-input type="text" name="TOTALGERAL" id="TOTALGERAL" value="{{ old('TOTALGERAL', isset($cobrado) ? $cobrado->TOTALGERAL : '0.00') }}" readonly class="total"/>
                            </li>

                            <li>
                                <strong>Extenso:</strong> <x-input type="text" name="Extenso" id="Extenso" value="{{ old('Extenso', isset($cobrado) ? $cobrado->Extenso : '') }}"/>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <script>
        // Adicionar nova linha de mercadoria
        $(document).on('click', '.add-row', function (e) {
            e.preventDefault();
            var newRow = `
                <tr>
                    <td><input type="text" name="mercadorias[marcas][]" class="form-control"></td>
                    <td><input type="text" name="mercadorias[numero][]" class="form-control"></td>
                    <td><input type="text" name="mercadorias[quantidade][]" class="form-control"></td>
                    <td><input type="text" name="mercadorias[qualificacaoID][]" class="form-control"></td>
                    <td><input type="text" name="mercadorias[designacao][]" class="form-control"></td>
                    <td><input type="text" name="mercadorias[peso][]" class="form-control"></td>
                    <!-- Outros campos das mercadorias -->
                    <td>
                        <a href="#" class="btn btn-danger remove-row" data-toggle="tooltip" data-placement="top" title="Remover Mercadoria">
                            <i class="fas fa-trash"></i>
                        </a>
                    </td>
                </tr>
            `;
            $('#mercadorias-table tbody').append(newRow);
        });

        // Remover linha de mercadoria
        $(document).on('click', '.remove-row', function (e) {
            e.preventDefault();
            $(this).closest('tr').remove();
        });
    </script>

    <script>
        function adicionarMercadoria() {
            // Função para adicionar uma nova linha na tabela de mercadorias

            var tableBody = document.getElementById('mercadorias-table').getElementsByTagName('tbody')[0];

            var row = document.createElement('tr');

            var createTableCell = function(content) {
            var cell = document.createElement('td');
            cell.innerHTML = content;
            return cell;
            };

            var createTextInput = function(name, required = true) {
            return '<x-input type="text" class="form-control" name="' + name + '" ' + (required ? 'required' : '') + ' class = "form-control" />';
            };

            var createNumberInput = function(name, required = true) {
            return '<x-input type="number" class="form-control" name="' + name + '" ' + (required ? 'required' : '') + ' />';
            };

            var createSelectInput = function(name, options, required = true) {
            var select = '<select name="' + name + '" ' + (required ? 'required' : '') + ' class = "form-control">';
            options.forEach(function(option) {
                select += '<option value="' + option.value + '">' + option.label + '</option>';
            });
            select += '</select>';
            return select;
            };

            var marcasCell = createTableCell(createTextInput('mercadorias[marcas][]'));
            var numeroCell = createTableCell(createNumberInput('mercadorias[numero][]'));
            var quantidadeCell = createTableCell(createNumberInput('mercadorias[quantidade][]'));

            // Exemplo de opções para o campo 'qualificação'
            var qualificacaoOptions = 
            [
                { value: '', label: 'Selecionar' },
                @foreach($qualificacao as $qualifi)
                { 
                    value: '{{$qualifi->Id}}', label: '{{$qualifi->Cod}}' 
                },
                @endforeach
            ];
            var qualidadeCell = createTableCell(createSelectInput('mercadorias[qualificaçãoID][]', qualificacaoOptions));

            var designacaoCell = createTableCell(createTextInput('mercadorias[designacao][]'));
            var pesoCell = createTableCell(createNumberInput('mercadorias[peso][]'));

            var trash = `<a href="#" class="btn btn-danger remove-row" data-toggle="tooltip" data-placement="top" title="Remover Mercadoria">
                            <i class="fas fa-trash"></i>
                        </a>`;

            // Adicione outros campos necessários

            row.appendChild(marcasCell);
            row.appendChild(numeroCell);
            row.appendChild(quantidadeCell);
            row.appendChild(qualidadeCell);
            row.appendChild(designacaoCell);
            row.appendChild(pesoCell);
            row.appendChild(trash);

            tableBody.appendChild(row);

        }
    </script>

<script>
    // Função para atualizar o subtotal
    function updateSubtotal() {
        var subtotal = 0;
        var inputs = document.getElementsByClassName('subtotal-input');
        
        // Somar os valores dos inputs
        for (var i = 0; i < inputs.length; i++) {
            var value = parseFloat(inputs[i].value.replace(',', '.')) || 0;
            subtotal += value;
        }
        
        // Atualizar o valor do campo SUBTOTAL
        document.getElementById('subtotal').value = subtotal.toFixed(2).replace('.', ',');
    }

    function updateTotal() {
        var total = 0;
        var inputsL = document.getElementsByClassName('total-input');

        // Somar os valores dos inputsL
        total += parseFloat(document.getElementById('subtotal').value.replace(',', '.'));

        for (var i = 0; i < inputsL.length; i++) {
            var value = parseFloat(inputsL[i].value.replace(',', '.')) || 0;
            total += value;
        }

        // Atualizar o valor do campo TOTALGERAL
        document.getElementById('TOTALGERAL').value = total.toFixed(2).replace('.', ',');
    }
    
    // Chamar a função ao carregar a página e sempre que houver alteração nos inputs
    window.addEventListener('load', function() {
        updateSubtotal();
        updateTotal();
    });

    Array.from(document.getElementsByClassName('subtotal-input')).forEach(function(input) {
        input.addEventListener('input', updateSubtotal);
    });

    Array.from(document.getElementsByClassName('total-input')).forEach(function(input) {
        input.addEventListener('input', updateTotal);
    });
</script>

<script>
    const dropArea = document.getElementById('drop-area');
    const fileList = document.querySelector('#file-list ul');

    // Prevenir comportamento padrão de arrastar e soltar
    dropArea.addEventListener('dragenter', (e) => {
        e.preventDefault();
        dropArea.style.border = '2px dashed #aaa';
    });

    dropArea.addEventListener('dragover', (e) => {
        e.preventDefault();
    });

    dropArea.addEventListener('dragleave', () => {
        dropArea.style.border = '2px dashed #ccc';
    });

    dropArea.addEventListener('drop', (e) => {
        e.preventDefault();
        dropArea.style.border = '2px dashed #ccc';

        const files = e.dataTransfer.files;
        updateFileList(files);
    });

    // Validar o tipo de arquivo
    function validateFileType(file) {
        const allowedTypes = ['image/jpeg', 'image/png', 'application/pdf'];
        return allowedTypes.includes(file.type);
    }

    // Atualizar a lista de arquivos selecionados
    function updateFileList(files) {
        fileList.innerHTML = '';
        for (const file of files) {
            if (validateFileType(file) && validateFileSize(file)) {
                const li = createFileListItem(file);
                fileList.appendChild(li);
            }
        }
    }

    // Validar o tamanho do arquivo
    function validateFileSize(file) {
        const maxSizeMB = 5;
        const maxSizeBytes = maxSizeMB * 1024 * 1024;
        if (file.size <= maxSizeBytes) {
            return true;
        } else {
            alert('Tamanho do arquivo excede o limite de ' + maxSizeMB + 'MB.');
            return false;
        }
    }

    // Criar item da lista de arquivos
    function createFileListItem(file) {
        const li = document.createElement('li');
        li.textContent = file.name;

        const removeButton = document.createElement('button');
        removeButton.textContent = 'Remover';
        removeButton.addEventListener('click', () => {
            li.remove();
        });

        li.appendChild(removeButton);

        return li;
    }

    // Lidar com o evento de arrastar sobre a área de soltar
    dropArea.addEventListener('dragover', (e) => {
        e.preventDefault();
        dropArea.classList.add('active');
    });

    // Lidar com o evento de sair da área de soltar
    dropArea.addEventListener('dragleave', () => {
        dropArea.classList.remove('active');
    });

    // Lidar com o evento de soltar na área de soltar
    dropArea.addEventListener('drop', (e) => {
        e.preventDefault();
        dropArea.classList.remove('active');

        const files = e.dataTransfer.files;
        updateFileList(files);
    });


    // Lidar com a seleção de arquivo usando o input de arquivo
    const fileInput = document.getElementById('file-input');
    fileInput.addEventListener('change', (e) => {
        const files = e.target.files;
        updateFileList(files);
    });

    // Permitir reordenar arquivos usando arrastar e soltar
    new Sortable(fileList, {
        animation: 150,
        ghostClass: 'sortable-ghost'
    });
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.14.0/Sortable.min.js"></script>

</x-app-layout>
