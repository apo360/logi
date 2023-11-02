<!DOCTYPE html>
<style>
    .modal-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        z-index: 9999;
        display: none;
    }

    .modal-aside {
        position: fixed;
        top: 0;
        right: -600px; /* Adjust as needed based on the desired width of the modal */
        width: 600px; /* Adjust as needed based on the desired width of the modal */
        height: 100%;
        background-color: #fff;
        transition: right 0.3s ease-out;
        z-index: 10000;
    }

    #list-types {
        position: absolute;
        top: 100%;
        left: 0;
        width: 100%;
        max-height: 30vh; /* Adjust as needed */
        overflow-y: auto;
        background-color: #fff;
        transition: right 0.3s ease-out;
        display: none;
        z-index: 9999;
        /* Add additional styling for the modal */
    }

    #list-types.active {
        display: block;
    }

</style>
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
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group mt-4">
                                        <label for="NrProcesso">Nº do Processo:</label>
                                        <x-input type="text" name="NrProcesso" id="NrProcesso"  readonly value="{{ $NewProcesso }}" />
                                        <x-input-error for="NrProcesso" class="mt-2" />
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group mt-4">
                                        <label for="DataAbertura">Data de Abertura:</label>
                                        <x-input type="date" name="DataAbertura" id="DataAbertura" required />
                                        <x-input-error for="DataAbertura" class="mt-2" />
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-5">
                                    <div class="form-group mt-4">
                                        <label for="ClienteID">Cliente</label>
                                        <div class="input-group">
                                            <input class = 'form-control border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm' list="cliente_list">
                                            <div class="input-group-append">
                                                <a href="#" id="add-new-client-button" class="btn btn-dark" data-toggle="modal" data-target="#newClientModal">+ Cliente</a>
                                            </div>
                                        </div>
                                        <datalist id="cliente_list">
                                            @foreach ($clientes as $cliente)
                                                <option value="{{ $cliente->Id }}">{{ $cliente->CompanyName }} {{ $cliente->Id }}</option>
                                            @endforeach
                                        </datalist>
                                        <x-input-error for="ClienteID" class="mt-2" />
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group mt-4">
                                        <label for="RefCliente">Ref.ª do Cliente(Factura)</label>
                                        <x-input type="text" name="RefCliente" id="RefCliente" required />
                                        <x-input-error for="RefCliente" class="mt-2" />
                                    </div>
                                </div>
                            </div>
                            <hr>
                            
                            <table class="table table-sm" id="mercadorias-table">
                                <thead class="table-dark">
                                    <tr>
                                        <th>Marcas</th>
                                        <th col="2">Número</th>
                                        <th col="2">Quantidade</th>
                                        <th>Qualificação</th>
                                        <th>Designação</th>
                                        <th>Peso (Kg)</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                </tbody>
                            </table>
                             <!-- Botão para criar campos -->
                             <br>
                             <a href="#" class="add-row" data-toggle="tooltip" data-placement="top" onclick="adicionarMercadoria()" title="Adicionar Mercadoria na tabela">
                                Adicionar Mercadoria
                            </a>
                        </div>
                        

                        <!-- Os tabs aparecem depois de registar a informação acima. E o atributo action do form passa para processos.update em vez de permanecer em processos.store-->
                </form>
            </div>
        </div>
    </div>

    <!-- Modal para Listar os Produtos / Serviços -->
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
                <div class="modal-body">
                    <!-- Formulário para adicionar novo cliente -->
                    <!-- Campos do formulário aqui -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary">Salvar Cliente</button>
                </div>
            </div>
        </div>
    </div>
    <!-- //Modal para Listar os Produtos / Serviços -->

    <script>
        // Função para adicionar mercadoria à tabela
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
            return '<input type="text" class="form-control">';
                    };

            var createNumberInput = function(name, required = true) {
            return '<input type="number" class="form-control" name="' + name + '"' + (required ? 'required' : '')+'>';
                    };

            var createSelectInput = function(name, options, required = true) {
            var select = '<select name="' + name + '"' + (required ? 'required' : '') + 'class="form-control">';
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
                    { value: '{{$qualifi->Id}}', label: '{{$qualifi->Cod}}' },
                @endforeach
            ];
            var qualidadeCell = createTableCell(createSelectInput('mercadorias[qualificaçãoID][]', qualificacaoOptions));
            var designacaoCell = createTableCell(createTextInput('mercadorias[designacao][]'));
            var pesoCell = createTableCell(createNumberInput('mercadorias[peso][]'));
            var buttonRemove = createTableCell('<a class="btn btn-sm remove-row" onclick="removerLinha()"><i class="fas fa-trash" style="color: red;"></></a>');

            

            // Adicione outros campos necessários

            row.appendChild(marcasCell);
            row.appendChild(numeroCell);
            row.appendChild(quantidadeCell);
            row.appendChild(qualidadeCell);
            row.appendChild(designacaoCell);
            row.appendChild(pesoCell);
            row.appendChild(buttonRemove);

            tableBody.appendChild(row);

        }

        function removerLinha() {
            // Encontra o elemento <tr> pai da linha do botão clicado e remove
            $(event.target).closest("tr").remove();
        }

    </script>

    <script>
        // Quando o botão "+ Cliente" é clicado, mostra o modal
    $("#add-new-client-button").click(function() {
        $("#newClientModal").modal("show");
    });
    </script>

</x-app-layout>