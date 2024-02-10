
<x-app-layout>
    <x-slot name="header">
        <x-breadcrumb title="Novo Processo" breadcrumb="Novo Processo" />
    </x-slot>
    <br/>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <form method="POST" action="{{ route('processos.store') }}">
                    @csrf
                    <div class="card">
                        <div class="card-header">
                            <div class="float-left">
                                <a type="button" class="btn btn-dark" style="color: black;" href="{{ route('processos.index') }}">
                                    <i class="fas fa-search" style="color: black;"></i> {{ __('Pesquisar Processos') }}
                                </a>
                            </div>
                            <div class="float-right">
                                <div class="btn-group">
                                    <x-button class="btn btn-default" type="submit">
                                        <i class="fas fa-user-plus btn-icon" style="color: #0170cf;"></i> {{ __('Inserir Processo') }}
                                    </x-button>
                                    <div class="input-group-append">
                                        <a href="#" id="add-new-mercadoria" class="btn btn-dark" data-toggle="modal" data-target="#newMercadoriaModal" title="Adicionar Mercadoria na tabela">
                                            Adicionar Mercadoria
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <label for="NrProcesso">Processo: {{ $NewProcesso }}</label>
                            <input type="hidden" name="NrProcesso" value="{{ $NewProcesso }}"> <br>
                            <div class="row">
                                <div class="form-group mt-4 col-md-4">
                                    <label for="ContaDespacho">Conta Despacho:</label>
                                    <input type="text" name="ContaDespacho" value="{{ old('ContaDespacho') }}" class="form-control" style="border: 0px; border-bottom: 1px solid black;">
                                    @error('ContaDespacho')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group mt-4 col-md-4">
                                    <label for="CustomerID">Cliente</label>
                                    <div class="input-group">
                                        <input class="form-control border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" list="cliente_list" name="CustomerID" value="{{ old('CustomerID') }}">
                                        <div class="input-group-append">
                                            <a href="#" id="add-new-client-button" class="btn btn-dark" data-toggle="modal" data-target="#newClientModal">+ Cliente</a>
                                        </div>
                                    </div>
                                    <datalist id="cliente_list">
                                        @foreach ($clientes as $cliente)
                                            <option value="{{ $cliente->Id }}">{{ $cliente->CompanyName }} ({{ $cliente->CustomerID }})</option>
                                        @endforeach
                                    </datalist>
                                    @error('CustomerID')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group mt-4 col-md-4">
                                    <label for="RefCliente">Referência do Cliente:</label>
                                    <input type="text" name="RefCliente" value="{{ old('RefCliente') }}" class="form-control" style="border: 0px; border-bottom: 1px solid black;">
                                    @error('RefCliente')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group mt-4 col-md-4">
                                    <label for="DataAbertura">Data de Abertura:</label>
                                    <input type="date" name="DataAbertura" value="{{ old('DataAbertura') }}" class="form-control" style="border: 0px; border-bottom: 1px solid black;">
                                    @error('DataAbertura')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group mt-4 col-md-4">
                                    <label for="TipoProcesso">Tipo de Processo:</label>
                                    <select name="TipoProcesso" class="form-control" style="border: 0px; border-bottom: 1px solid black;">
                                        <option value="">Selecionar</option>
                                        <option value="importacao" {{ old('TipoProcesso') == 'importação' ? 'selected' : '' }}>Importação</option>
                                        <option value="exportação" {{ old('TipoProcesso') == 'exportação' ? 'selected' : '' }}>Exportação</option>
                                        <option value="petroleo" {{ old('TipoProcesso') == 'petróleo' ? 'selected' : '' }}>Petróleo</option>
                                        <!-- Adicione outras opções conforme necessário -->
                                    </select>
                                    @error('TipoProcesso')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group mt-4 col-md-4">
                                    <label for="Situacao">Situação:</label>
                                    <select name="Situacao" class="form-control" style="border: 0px; border-bottom: 1px solid black;">
                                        <option value="em processamento" {{ old('Situacao') == 'Em processamento' ? 'selected' : '' }}>Em Processamento</option>
                                        <option value="desembarcado" {{ old('Situacao') == 'desembaraçado' ? 'selected' : '' }}>Desembarcado</option>
                                        <option value="retido" {{ old('Situacao') == 'retido' ? 'selected' : '' }}>Retido</option>
                                        <option value="concluido" {{ old('Situacao') == 'concluido' ? 'selected' : '' }}>Concluido</option>
                                        <!-- Adicione outras opções conforme necessário -->
                                    </select>
                                    @error('Situacao')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="form-group mt-4 col-md-2">
                                    <label for="Fk_pais">País de Origem</label>
                                    <select name="Fk_pais" class="form-control" id="Fk_pais" style="border: 0px; border-bottom: 1px solid black;">
                                        @foreach($paises as $pais)
                                            <option value="{{$pais->id}}">{{$pais->pais}} ({{$pais->codigo}})</option>
                                        @endforeach
                                    </select>
                                    @error('Fk_pais')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group mt-4 col-md-2">
                                    <label for="TipoTransporte">Tipo de Transporte</label>
                                    <select name="TipoTransporte" class="form-control" id="TipoTransporte" style="border: 0px; border-bottom: 1px solid black;">
                                        <option value="">Selecionar</option>
                                        <option value="navio">Navio</option>
                                        <option value="navio">Avião</option>
                                        <option value="outro">Outro</option>
                                    </select>
                                </div>
                                
                                <div class="form-group mt-4 col-md-4">
                                    <label for="NomeTransporte">Nome do Transporte</label>
                                    <input type="text" name="NomeTransporte" class="form-control" style="border: 0px; border-bottom: 1px solid black;">
                                    @error('NomeTransporte')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group mt-4 col-md-3">
                                    <label for="PortoOrigem">Porto de Origem</label>
                                    <input type="text" name="PortoOrigem" class="form-control" style="border: 0px; border-bottom: 1px solid black;">
                                    @error('PortoOrigem')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group mt-4 col-md-4">
                                    <label for="DataChegada">Data de Chegada:</label>
                                    <input type="date" name="DataChegada" class="form-control" style="border: 0px; border-bottom: 1px solid black;">
                                </div>

                                <div class="form-group mt-4 col-md-4">
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label for="MarcaFiscal">Marca Fiscal:</label>
                                            <input type="text" name="MarcaFiscal" class="form-control" style="border: 0px; border-bottom: 1px solid black;">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="BLC_Porte">BLC Porte:</label>
                                            <input type="text" name="BLC_Porte" class="form-control" style="border: 0px; border-bottom: 1px solid black;">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group mt-4 col-md-4">
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label for="ValorAduaneiro">Valor Aduaneiro (USD)</label>
                                            <input type="text" name="ValorAduaneiro" class="form-control" value="0.0" style="border: 0px; border-bottom: 1px solid black;">
                                            @error('ValorAduaneiro')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="ValorTotal">Valor Total (AOA)</label>
                                            <input type="text" name="ValorTotal" class="form-control" value="0.0" style="border: 0px; border-bottom: 1px solid black;">
                                            @error('ValorTotal')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <input type="hidden" name="Moeda" class="form-control" value="USD">
                            <input type="hidden" name="Cambio" class="form-control" value="{{ number_format($Cambio['rates']['USD'] * $Cambio['rates']['AOA'], 3) }}">


                            <div class="form-group">
                                <label for="Descricao">Descrição:</label>
                                <input type="text" name="Descricao" value="{{ old('Descricao') }}" class="form-control" style="border: 0px; border-bottom: 1px solid black;">
                                @error('Descricao')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <hr>

                            <input type="hidden" name="mercadorias" id="mercadorias" value="">
                             
                            <table class="table table-sm table-dark table-hover caption-top" id="mercadorias-table">
                                <thead>
                                    <tr>
                                        <th>Marcas</th>
                                        <th col="2">Número</th>
                                        <th col="2">Quantidade</th>
                                        <th>Qualificação</th>
                                        <th>Designação</th>
                                        <th col="2">Peso (Kg)</th>
                                        <th>Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                </tbody>
                            </table>
                             <!-- Botão para criar campos -->
                            <br>
                            <div class="input-group-append">
                                <a href="#" id="add-new-mercadoria" class="btn btn-dark" data-toggle="modal" data-target="#newMercadoriaModal" title="Adicionar Mercadoria na tabela">
                                    Adicionar Mercadoria
                                </a>
                            </div>
                        </div>
                        

                        <!-- Os tabs aparecem depois de registar a informação acima. E o atributo action do form passa para processos.update em vez de permanecer em processos.store-->
                </form>
            </div>
        </div>
    </div>
    <!-- Modal para adicionar novo cliente -->
    <div class="modal fade" id="newClientModal" tabindex="-1" role="dialog" aria-labelledby="newClientModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-aside" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="newClientModalLabel">Novo Cliente</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                
                <form id="formNovoCliente">
                    <div class="modal-body">
                        
                        <input type="hidden" name="CustomerID" value="{{ $newCustomerCode }}" id="CustomerID">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mt-2">
                                    <x-label for="CustomerTaxID" value="{{ __('NIF') }}" />
                                    <x-input-button namebutton="Validar NIF" idButton="CustomerTaxID" type="text" name="CustomerTaxID" value="000000"/>
                                </div>
                            </div>
                            <br><hr style='border: 1px solid #ccc;'>
                            <div class="col-md-6">
                                <div class="mt-2">
                                    <x-label for="CompanyName" value="{{ __('Cliente') }}" />
                                    <x-input id="CompanyName" class="block mt-1 w-full" type="text" name="CompanyName" required autofocus autocomplete="CompanyName" />
                                </div>
                            </div>
                            <br><hr style='border: 1px solid #ccc;'>
                            <div class="col-md-6">
                                <div class="mt-2">
                                    <x-label for="Telephone" value="{{ __('Telefone') }}" />
                                    <x-input id="Telephone" class="block mt-1 w-full" type="text" name="Telephone" required autofocus autocomplete="Telephone" />
                                </div>
                            </div>
                            <br><hr style='border: 1px solid #ccc;'>
                        
                            <div class="col-md-6">
                                <div class="mt-4">
                                    <x-label for="Email" value="{{ __('Email') }}" />
                                    <x-input id="Email" class="block mt-1 w-full" type="email" name="Email" autocomplete="Email" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Salvar Cliente</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
    <!-- //Modal para adicionar novo cliente -->

    <!-- Modal para adicionar mercadoria na tabela  -->
    <div class="modal fade" id="newMercadoriaModal" tabindex="-1" role="dialog" aria-labelledby="newMercadoriaModalLabel" aria-hidden="true">
        <div class="modal-dialog  modal-lg modal-dialog-aside" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="newMercadoriaModalLabel"> Adicionar Mercadoria</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    
                    <!-- Adicione um botão para adicionar mais mercadorias -->
                    <button type="button" onclick="addMercadoria()">Adicionar Mercadoria</button>
                    <!-- Campos do formulário de mercadorias -->
                    <div id="mercadoriasForm">
                        <label for="mercadorias">Mercadorias:</label>
                        <!-- Adicione campos para cada atributo da mercadoria -->
                        <div class="mercadoria">
                            <input type="text" name="Descricao" id="Descricao" placeholder="Descrição">
                            <input type="text" name="NCM_HS" id="NCM_HS" placeholder="Marcas">
                            <input type="text" name="NCM_HS_Numero" id="NCM_HS_Numero" placeholder="Números">
                            <input type="number" name="Quantidade" id="Quantidade" placeholder="Quantidade">
                            <select name="Qualificacao" id="Qualificacao">
                                <option value="">Selecionar</option>
                                <option value="cont">Contentor</option>
                                <option value="auto">Automóvel</option>
                                <option value="outro">Outro</option>
                            </select>
                            <input type="decimal" name="Peso" id="Peso" placeholder="Peso">
                            <!-- Adicione outros campos conforme necessário -->
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    <button type="button" class="btn btn-primary" onclick="adicionarMercadoria()">Adicionar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Script para tratar de adição/editar/remover mercadorias a tabela -->
    <script>
        var mercadorias = [];

        function adicionarMercadoria() {
            var Descricao = $('#Descricao').val();
            var NCM_HS = $('#NCM_HS').val();
            var NCM_HS_Numero = $('#NCM_HS_Numero').val();
            var Quantidade = $('#Quantidade').val();
            var Qualificacao = $('#Qualificacao').val();
            var Peso = $('#Peso').val();

            // Adicione a mercadoria ao array
            mercadorias.push(
                { 
                    Descricao: Descricao, 
                    NCM_HS: NCM_HS,
                    NCM_HS_Numero: NCM_HS_Numero, 
                    Quantidade: Quantidade, 
                    Qualificacao: Qualificacao,
                    Peso: Peso 
                });

            // Atualize a tabela
            atualizarTabela();

            // Atualize o campo oculto mercadorias[]
            $('#mercadorias').val(JSON.stringify(mercadorias));

            // Limpe os campos do modal
            $('#descricao').val('');
            $('#ncm_hs').val('');
            // Limpe outros campos conforme necessário

            // Feche o modal
            $('#newMercadoriaModal').modal('hide');
        }

        function atualizarTabela() {
            var tabela = $('#mercadorias-table tbody');
            tabela.empty();

            // Adicione cada mercadoria à tabela
            for (var i = 0; i < mercadorias.length; i++) {
                tabela.append('<tr>' +
                    '<td>' + mercadorias[i].Descricao + '</td>' +
                    '<td>' + mercadorias[i].NCM_HS + '</td>' +
                    '<td>' + mercadorias[i].NCM_HS_Numero + '</td>' +
                    '<td>' + mercadorias[i].Quantidade + '</td>' +
                    '<td>' + mercadorias[i].Qualificacao + '</td>' +
                    '<td>' + mercadorias[i].Peso + '</td>' +
                    '<td><button type="button" onclick="editarMercadoria(' + i + ')">Editar</button>' +
                    ' <button type="button" onclick="excluirMercadoria(' + i + ')">Excluir</button></td>' +
                    '</tr>');
            }
        }

        function editarMercadoria(index) {
            // Obtenha os valores da mercadoria pelo índice
            var mercadoria = mercadorias[index];

            // Preencha os campos do modal com os valores da mercadoria
            $('#Descricao').val(mercadoria.Descricao);
            $('#NCM_HS').val(mercadoria.NCM_HS);
            $('#NCM_HS_Numero').val(mercadoria.NCM_HS_Numero);
            $('#Quantidade').val(mercadoria.Quantidade);
            $('#Qualificacao').val(mercadoria.Qualificacao);
            $('#Unidade').val(mercadoria.Unidade);
            $('#Peso').val(mercadoria.Peso);

            // Abra o modal de adição/editar
            $('#newMercadoriaModal').modal('show');

            // Remova a mercadoria da lista para evitar duplicatas após editar
            mercadorias.splice(index, 1);

            // Atualize a tabela
            atualizarTabela();
        }


        function excluirMercadoria(index) {
            mercadorias.splice(index, 1); // Remove a mercadoria do array
            atualizarTabela(); // Atualiza a tabela após excluir
        }
    </script>

<!--
    <script>
        // Quando o botão "+ Cliente" é clicado, mostra o modal
        $("#add-new-client-button").click(function() {
            $("#newClientModal").modal("show");
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#formNovoCliente').on('submit', function(e) {
                e.preventDefault(); // Impede o envio padrão do formulário

                // Coleta os dados do formulário
                var formData = $(this).serialize();

                // Faz a solicitação AJAX
                $.ajax({
                    type: 'POST',
                    url: '/clientes', // Certifique-se de ajustar o URL conforme necessário
                    data: formData,
                    success: function(response) {
                        // Sucesso - o cliente foi adicionado
                        alert('o cliente foi adicionado');
                        // Atualiza o campo ClienteID com o ID do cliente recém-adicionado
                        $('#ClienteID').val(response.cliente_id);

                        // Fecha o modal
                        $('#newClientModal').modal('hide');
                    },
                    error: function(error) {
                        // Erro - manipule conforme necessário
                        console.error("Erro ao adicionar cliente:", error);
                    }
                });
            });
        });
        function obterUltimoClienteAdicionado() {
            $.ajax({
                type: 'GET',
                url: '/clientes/ultimo',
                success: function (response) {
                    // Supondo que o endpoint retorne um JSON com a chave 'cliente_id'
                    var ultimoClienteID = response.cliente_id;
                    console.log("Último cliente adicionado:", ultimoClienteID);
                    return ultimoClienteID;
                },
                error: function (error) {console.error("Erro ao obter o último cliente adicionado:", error);}
            });
            // Este retorno aqui é apenas para fins ilustrativos, já que a chamada AJAX é assíncrona
            return null;
        }

        // Aguarde até que o documento esteja totalmente carregado
        document.addEventListener("DOMContentLoaded", function() {
            // Adicione um ouvinte de evento para quando o modal for exibido
            $('#newClientModal').on('shown.bs.modal', function () {
                // Limpe o valor do campo ao abrir o modal
                $('#ClienteID').val('');
            });

            // Adicione um ouvinte de evento para quando o modal for fechado
            $('#newClientModal').on('hidden.bs.modal', function () {
                // Obtenha o valor do campo do cliente recém-adicionado (isso depende da lógica específica do seu aplicativo)
                var novoClienteID = obterUltimoClienteAdicionado(); // Implemente esta função de acordo com sua lógica

                // Preencha automaticamente o campo no formulário principal
                $('#ClienteID').val(novoClienteID);
            });
        });
    </script>
    -->

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        $(document).ready(function () {
            // Função para calcular os valores com base na taxa de câmbio
            function calcularValores() {
                // Obter os valores dos campos
                var valorAduaneiroUSD = parseFloat($('[name="ValorAduaneiro"]').val()) || 0;
                var taxaCambio = parseFloat($('[name="Cambio"]').val()) || 1;

                // Calcular o Valor Total em AOA
                var valorTotalAOA = valorAduaneiroUSD * taxaCambio;

                // Atualizar os campos
                $('[name="ValorTotal"]').val(valorTotalAOA.toFixed(3));
            }

            // Adicionar um ouvinte de evento para o campo ValorAduaneiro
            $('[name="ValorAduaneiro"]').on('input', function () {
                calcularValores();
            });

            // Chame a função inicialmente para configurar os valores iniciais
            calcularValores();
        });
    </script>

</x-app-layout>