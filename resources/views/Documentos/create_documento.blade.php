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
    <div class="col-md-12">
        <div class="row hfluid">
            <!-- Documentos -->
            <div class="col-md-8">
                <!--  -->
                <div class="col-md-12">
                    <div class="card card-dark">
                        <div class="card-header">
                            <div class="card-title inline-flex gap-6">
                                <div id="doc-header-type" class="" data-href="#/office/change/">
                                    <div class="doc-type-circle doc-type inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150">FT</div> 
                                    <input type="hidden" name="document_type" id="document_type" value="FT">
                                </div>
                                <div class="doc-header-text">
                                    <div id="doc-type-title" class="title bold">Factura</div>
                                    <div class="doc-date-info">
                                        Data de Emissão: <span>Hoje</span>
                                    </div>
                                </div>
                                
                                <div class="doc-header-right right-0"> 
                                    <a href="#" id="office-change-doctype" class="event button">
                                        <span class="icon-edit icon"></span>Alterar
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!--  Lista de Tipos de Documentos-->
                        <div id="list-types" class="hfluid">
                            <div class="">
                                <div class="doc-header list-header">
                                    @foreach($tipoDocumentos->pluck('Grupo')->unique() as $key => $tipoGrupo)
                                        <div class="doc-header-group-item">{{$tipoGrupo}}</div>
                                        <ul class="list list-unstyled doc-header-list">
                                            @foreach($tipoDocumentos->where('Grupo', $tipoGrupo) as $index => $item)
                                                <li class="line pointer doc-type-list border-left border-left-FT">
                                                    <input type="radio" id="type_{{$item->Code}}" name="register" value="{{$item->Code}}" {{$key === 0 && $index === 0 ? 'checked' : ''}}>
                                                    <label for="type_{{$item->Code}}">{{$item->Descriptions}}</label>
                                                </li>
                                            @endforeach
                                        </ul>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <!-- //Lista de Tipos de Documentos -->

                        <div class="card-body">
                            <label for="cliente_choose">Selecione o Cliente</label>
                            <input type="text" name="cliente_choose" id="cliente_choose" list="cliente_list" class="form-control" placeholder="Consumidor Final">
                            <datalist id="cliente_list" class="form-datalist">
                                @foreach($clientes as $cliente)
                                    <option value="{{$cliente->Id}}"> {{$cliente->CompanyName}} </option>
                                @endforeach
                            </datalist>

                            <div id="processos-list" class="processos-list"></div>
                        </div>

                    </div>
                </div>

                <!-- Card Itens -->
                <div class="col-md-12">
                    <div class="card card-dark">
                        <div class="card-header justify-between h-16">
                            <div class="card-title flex"> <span>Itens</span> <span>Processos / Serviços</span> </div>
                            <div class="flex"> 
                                <a href="#" id="office-add-services" class="event button">
                                    <span class="icon-edit icon"></span>Serviços
                                </a>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="content no-padding pb-5">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div id="has-no-products" class="text-center"> 
                                            <span class="icon-bullet_list icon-4x"></span> 
                                            <br> Não existem itens associados ao documento. <br> 
                                            <a href="#" id="btn-office-add-product" class="btn event">
                                                <span class="icon-plus"></span> Adicionar Novo Item
                                            </a>
                                        </div>
                                        <table class="table table-sm table-flex table-flex--autocomplete" id="document-products">
                                            <thead>
                                                <tr class="no-border">
                                                    <th width="40"></th>
                                                    <th width="40"></th>
                                                    <th class="text-left" width="30%">Serviço</th>
                                                    <th class="text-left" width="20%">Descrição</th>
                                                    <th class="text-right" width="10%">Desc.</th>
                                                    <th class="text-right" width="10%">IVA</th>
                                                    <th class="text-right" width="10%">P.Unit.</th>
                                                    <th class="text-right" width="8%">Qtd.</th>
                                                    <th class="text-right" width="15%">Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                            </tbody>
                                            <tfoot>
                                                <tr class="document-desconto">
                                                    <td colspan="3">Desconto (% e valor)</td>
                                                    <td class="text-right" id="desconto-porcentagem">0%</td>
                                                    <td class="text-right" id="desconto-valor">0.00 Kz</td>
                                                </tr>
                                                <tr id="document-total-pay">
                                                    <th colspan="3">Total </th>
                                                    <th> </th>
                                                    <th class="text-right total">0.00 Kz</th>
                                                </tr>
                                                <!-- Linha de desconto -->
                                                
                                            </tfoot>
                                        </table>
                                        <input type="hidden" name="valorgeralservico" id="valorgeralservico" value="">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 col-md-offset-6 text-right"> 
                                        <span id="document-taxes-link" class="see-more" data-target="doc-taxes-table"> Ver Impostos  <i class="fa fa-angle-down"></i> </span>
                                        <div id="doc-taxes-table" class="hide">
                                            <table id="document-taxas" class="table table-sm table-flex no-margin mt-3">
                                                <thead>
                                                    <tr>
                                                        <td class="text-left">Taxa</td>
                                                        <td class="text-right">Base</td>
                                                        <td class="text-right">IVA</td>
                                                        <td class="text-right">Total</td>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>

                </div>
                <!-- //Card Itens -->

                <!-- Observações Itens -->
                <div class="col-md-12">
                    <div class="card card-dark">
                        <div class="card-header">
                            <div class="card-title"> 
                                <span>Observações</span> <br> 
                                <span>Processos / Serviços</span> 
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-10">
                                    <div class="form-group">
                                        <label for="observacoes">Observações</label>
                                        <textarea name="observacoes" id="observacoes" cols="30" rows="10" class="form-control"></textarea>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Referência Externa</label>
                                        <input type="text" class="form-control">
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                        
                    </div>

                </div>
                <!-- //Observações Itens -->
            </div>
            <!-- //Documentos -->

            <!-- Definições do Documento -->
            <div class="col-md-4">
                <div class="col-md-12">
                    <div class="card card-dark">
                        <div class="card-header">
                            <div class="card-title"> 
                                <span>Definições do Documento</span>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">Data de Emissão</label>
                                        <input type="date" class="form-control">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">Vencimento</label>
                                        <input type="date" class="form-control">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">Data de Disponibilização</label>
                                        <input type="date" class="form-control">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">Pagamentos</label>
                                        <input type="text" class="form-control">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">Descontos</label>
                                        <input type="text" name="desconto_percetagem" class="form-control" placeholder="%">
                                        <input type="text" name="desconto_numerario" class="form-control" placeholder="0.00" value="0">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-footer">
                            <button>Criar Factura</button>
                        </div>
                        
                    </div>

                </div>
            </div>
            <!-- //Definições do Documento -->
        </div>
    </div>

    <!-- Modal para Listar os Produtos / Serviços -->
    <div class="modal-overlay" id="modal-overlay"></div>
    <aside class="modal-aside" id="modal-aside">
        <!-- Modal content here -->
        <div class="header-service">
            <div class="row">
                <div class="col-md-6">
                    <input type="search" name="" id="" class="form-control">
                </div>
                <div class="col-md-6">
                    <x-button>
                        <a href="">Categorias</a>
                    </x-button>
                    <x-button>
                        <a href="">Produtos</a>
                    </x-button>
                </div>
            </div>
        </div>
        <div class="body-service">
            <span>Serviços e Produtos</span>
            <ul>
                @foreach($produtos as $produto)
                    <li class="item side-product-item stock-"> 
                        <a href="#" class="event" data-product="" data-id="147801086" data-title="{{$produto->ProductDescription}}"> 
                            <span class="title"> {{$produto->ProductDescription}} </span> 
                            <span class="slogan">{{$produto->ProductCode}}</span> 
                            <span class="right">0,00 Kz <br> </span> 
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
        
    </aside>
    <!-- //Modal para Listar os Produtos / Serviços -->

</x-app-layout>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        var $listTypes = $('#list-types');

        // Handle the change event on input:radio elements
        $('input[name="register"]').change(function(e) {
            // Get the selected code and description
            var code = $(this).val();
            var description = $(this).next('label').text();

            // Update the modal content
            $('#doc-type-title').text(description);
            $('.doc-type-circle').text(code);
            $('#document_type').val(code);

            // Stop the event from propagating to the parent elements
            e.stopPropagation();

            // Remove the 'active' class from the modal
            $listTypes.removeClass('active');

            // Add the 'fa-check' class to the selected radio button's label
            setTimeout(() => {
                $('#' + $(this).attr('id') + ' + label > i').addClass('fa-check');
            }, 150);
        })
        .focusout(function(event) {
            // Check if the radio button is not checked on focus out
            if (!$('#' + event.target.id).is(':checked')) {
                $($('.doc-type-circle')[2]).addClass('selected');
            } else {
                $($('.doc-type-circle')[2]).removeClass('selected');
            }
        });

        // Handle the click event on the 'Alterar' link
        $('#office-change-doctype').click(function(e) {
            e.preventDefault();
            var cardTitleHeight = $('.card-title').outerHeight();
            $listTypes.css('top', cardTitleHeight);
            $listTypes.toggleClass('active');
        });
    });

</script>

<script>
    $(document).ready(function() {
        var $modalOverlay = $('#modal-overlay');
        var $modalAside = $('#modal-aside');

        $('#office-add-services').click(function(e) {
            e.preventDefault();
            $modalOverlay.fadeIn();
            $modalAside.css('right', '0');
        });

        $modalOverlay.click(function() {
            $modalOverlay.fadeOut();
            $modalAside.css('right', '-600px');
        });
    });
</script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


<script>

    function formatarNumero(numero) {
        // Converte o número para uma string formatada
        return numero.toLocaleString('pt-AO', { style: 'currency', currency: 'AOA' });
    }

    function atualizarTaxas(taxa, vartotal) {
        // Limpar a tabela de taxas antes de preenchê-la novamente
        $('#document-taxas tbody').empty();

        // Variáveis para armazenar os totais
        let totalBase = 0;
        let totalIVA = 0;
        let totalGeral = 0;

        // Objeto para armazenar as taxas e seus totais
        const taxas = {};

        // Percorrer as linhas da tabela document-products
        $('#document-products tbody tr').each(function() {

            const total = vartotal;
            const iva = vartotal * (taxa / 100);
            const base = vartotal - iva;

            totalBase += base;
            totalIVA += iva;
            totalGeral += total;

            // Adicionar a linha de taxa correspondente à tabela document-taxas
            const taxaRow = `
                <tr>
                    <td class="text-left">${taxa}%</td>
                    <td class="text-right">${formatarNumero(base)}</td>
                    <td class="text-right">${formatarNumero(iva)}</td>
                    <td class="text-right">${formatarNumero(total)}</td>
                </tr>
            `;

            $('#document-taxas tbody').append(taxaRow);
        });

        // Adicionar a linha com o total geral no rodapé da tabela
        const totalGeralRow = `
            <tr>
                <td class="text-left">Total Geral</td>
                <td class="text-right">${formatarNumero(totalBase)}</td>
                <td class="text-right">${formatarNumero(totalIVA)}</td>
                <td class="text-right">${formatarNumero(totalGeral)}</td>
            </tr>
        `;

        $('#document-taxas tbody').append(totalGeralRow);
    }

    function atualizarDescontos() {
        // Obter os valores dos descontos
        const descontoPorcentagem = parseFloat($('input[name="desconto_percetagem"]').val());
        const descontoNumerario = parseFloat($('input[name="desconto_numerario"]').val());

        // Obter o valor total geral da tabela document-products no rodapé
        var totalGeral = parseFloat($('#valorgeralservico').val());

        // Obtem o calculo de todos os descontos
        const descontoTotal = ((descontoPorcentagem / 100) * totalGeral) + descontoNumerario;

        // Novo Total Geral
        var NewTotal = totalGeral - descontoTotal;

        // Atualizar os valores dos descontos
        $('#document-total-pay .total').text(formatarNumero(NewTotal));

        // Atualizar a linha de desconto no rodapé da tabela document-products
        $('#document-products .document-desconto #desconto-porcentagem').text(descontoPorcentagem + '%');
        $('#document-products .document-desconto #desconto-valor').text(formatarNumero(descontoTotal));
        
    }
    
    $(document).ready(function() {
        // Handle the input event on #cliente_choose
        $('#cliente_choose').on('input', function() {
            var selectedCliente = $(this).val();

            // Clear previous processos list
            $('#processos-list').empty();

            // Send AJAX GET request to retrieve processos data
            $.get('/api/customers/'+selectedCliente+'/Pendente', function(response) {
                var processos = response.processo;

                // Check if processos data is available
                if (processos && processos.length > 0) {
                    // Iterate over each processo and generate HTML
                    processos.forEach(function(processo) {
                        var radioId = 'radio_' + processo.ProcessoID;
                        var corpHtml = '<div class="line pointer doc-type-list border-left border-left-FT">' +
                            '<input type="radio" id="type_' + radioId + '" name="processos" value="' + processo.ProcessoID + '">' +
                            '<label for="type_' + radioId + '">' + processo.RefCliente + '</label>' +
                            '<span for="type_' + radioId + '">' + processo.Status + '</span>' +
                            '</div>';

                        // Append the generated HTML to #processos-list
                        $('#processos-list').append(corpHtml);
                    });
                } else {
                    $('#processos-list').text('Nenhum processo encontrado.');
                }
            }, 'json');
        });

        $(document).on('change', 'input[name="processos"]', function() {
            // Get the value of the selected input:radio
            var selectedProcesso = $(this).val();

            // Get the value of the Label selected
            $.get('/api/processos/'+selectedProcesso+'/Pendente', function(response) {
                const data = response;

                // Limpar o corpo da tabela antes de preenchê-la com novos dados
                $('#document-products tbody').empty();

                // Iterar pelos processos
                data.processos.forEach(function(processo) {
                    const mercadoriasHTML = processo.mercadorias.map(function(mercadoria) {
                        return `Importação - <span>${mercadoria.marcas}</span><br>${mercadoria.designacao}<br><br>`;
                    }).join('');

                    $('#valorgeralservico').val(processo.cobrado.TOTALGERAL);
                    const valor = parseFloat(processo.cobrado.TOTALGERAL);

                    const totalGeral = formatarNumero(valor);
                    const row = `
                        <tr>
                            <td></td>
                            <td></td>
                            <td class="text-left">Despacho Aduaneiro</td>
                            <td class="text-left">${mercadoriasHTML}</td>
                            <td class="text-right">0</td>
                            <td class="text-right">14%</td>
                            <td class="text-right">${totalGeral}</td>
                            <td class="text-right">1</td>
                            <td class="text-right geraltotal">${totalGeral}</td>
                        </tr>
                    `;

                    $('#document-products tbody').append(row);
                });

                // Calcular e preencher o total geral no rodapé
                const totalGeralRodape = data.processos.reduce(function(sum, processo) {
                    return sum + parseFloat(processo.cobrado.TOTALGERAL);
                }, 0);

                $('#document-total-pay .total').text(parseFloat(totalGeralRodape).toFixed(2) + ' Kz');

                atualizarTaxas(14,totalGeralRodape);
            }, 'json');
        });

        $('#document-products, input[name="desconto_percetagem"], input[name="desconto_numerario"]').on('change', function() {
            
            atualizarDescontos();
        });
    });
</script>


