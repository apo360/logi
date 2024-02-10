
<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="...">
<!-- Bootstrap JavaScript (popper.js is required) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="..." crossorigin="anonymous"></script>


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

    @if(session('success'))
        <div>
            <div class="font-medium text-green-600">{{ __('Sucesso!') }}</div>

            <p class="mt-3 text-sm text-green-600">
                {{ session('success') }}
            </p>
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
                            <div class="float-right">
                                <div class="btn-group">
                                    <x-button class="btn btn-dark" type="submit">
                                         {{ __('Atualizar') }}
                                    </x-button>
                                    <div class="input-group-append">
                                        <a class="btn btn-dark" href="{{ route('arquivos.edit', $processo->ProcessoID) }}">
                                            {{ __('Upload') }}
                                        </a>
                                    </div>
                                    
                                    <a class="btn btn-dark" href="{{ route('processos.factura', $processo->ProcessoID) }}">
                                        {{ __('Factura') }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card card-dark">
                    <div class="card-header">
                        <div class="">
                            <div class="card-title flex items-center">
                                <strong>Nº Processo:</strong> <span>{{ $processo->NrProcesso }}</span>
                                <strong>Cliente : </strong> <span>{{ $processo->cliente->CompanyName }}</span>
                                <strong>Ref/Factura : </strong> <span>{{ $processo->RefCliente }}</span>
                                <input type="hidden" name="Fk_processo" id="Fk_processo" value="{{ $processo->ProcessoID }}">
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="card card-default">
                            <div class="card-header">
                                <div class="card-title">
                                    <span>Mercadorias</span>
                                </div>
                            </div>
                            <div class="card-body">
                                <table class="table table-sm" id="mercadorias-table">
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
                                        @if ($mercadorias)
                                            @foreach ($mercadorias as $mercadoria)
                                                <tr>
                                                    <td>{{ $mercadoria->NCM_HS }}</td>
                                                    <td>{{ $mercadoria->NCM_HS_Numero }}</td>
                                                    <td>{{ $mercadoria->Quantidade }}</td>
                                                    <td>{{ $mercadoria->Qualificacao }}</td>
                                                    <td>{{ $mercadoria->Descricao }}</td>
                                                    <td>{{ $mercadoria->Peso }}</td>
                                                    <!-- Exiba outros campos da mercadoria, se houver -->
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="3">Nenhuma mercadoria disponível</td>
                                            </tr>
                                        @endif
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <ul class="nav nav-tabs nav-dark" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">DAR</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">DU</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="messages-tab" data-bs-toggle="tab" data-bs-target="#messages" type="button" role="tab" aria-controls="messages" aria-selected="false">Taxas Portuárias</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="settings-tab" data-bs-toggle="tab" data-bs-target="#settings" type="button" role="tab" aria-controls="settings" aria-selected="false">Documentos</button>
                            </li>
                        </ul>

                        <div class="tab-content">
                            <div class="tab-pane active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                <div class="row">
                                    <div class="col-md-4 mt-4">
                                        <label for="N_Dar">Nº do DAR</label>
                                        <input type = "text" name = "N_Dar" class="form-control" value="{{ $processo->dar->N_Dar ?? '' }}" style="border: 0px; border-bottom: 1px solid black;">
                                    </div>

                                    <div class="col-md-4 mt-4">
                                        <label for="DataEntrada">Data de Entrada</label>
                                        <input type = "date" name = "DataEntrada" class="form-control" value="{{$processo->dar ? $processo->dar->DataEntrada : '' }}" style="border: 0px; border-bottom: 1px solid black;">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4 mt-4">
                                        <label for="direitos">Direitos</label>
                                        <input type = "decimal" name = "direitos" class="form-control subtotal-input" value="{{$processo->dar ? $processo->dar->direitos : '0.00'}}" style="border: 0px; border-bottom: 1px solid black;">
                                    </div>
                                    <div class="col-md-4 mt-4">
                                        <label for="emolumentos">Emolumentos</label>
                                        <input type = "decimal" name = "emolumentos" class="form-control subtotal-input" value="{{$processo->dar ? $processo->dar->emolumentos : '0.00'}}" style="border: 0px; border-bottom: 1px solid black;">
                                    </div>
                                    <div class="col-md-4 mt-4">
                                        <label for="iva_aduaneiro">IVA Aduaneiro</label>
                                        <input type = "decimal" name = "iva_aduaneiro" class="form-control subtotal-input" value="{{$processo->dar ? $processo->dar->iva_aduaneiro : '0.00'}}" style="border: 0px; border-bottom: 1px solid black;">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4 mt-4">
                                        <label for="iec">IEC</label>
                                        <input type = "decimal" name = "iec" class="form-control subtotal-input" value="{{$processo->dar ? $processo->dar->iec : '0.00'}}" style="border: 0px; border-bottom: 1px solid black;">
                                
                                    </div>
                                    <div class="col-md-4 mt-4">
                                        <label for="impostoEstatistico">Imposto Estatístico</label>
                                        <input type = "decimal" name = "impostoEstatistico" class="form-control subtotal-input" value="{{$processo->dar ? $processo->dar->impostoEstatistico : '0.00'}}" style="border: 0px; border-bottom: 1px solid black;">
                                
                                    </div>
                                    <div class="col-md-4 mt-4">
                                        <label for="juros_mora">Juros de Mora</label>
                                        <input type = "decimal" name = "juros_mora" class="form-control subtotal-input" value="{{$processo->dar ? $processo->dar->juros_mora : '0.00'}}" style="border: 0px; border-bottom: 1px solid black;">
                                
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4 mt-4">
                                        <label for="multas">Multas</label>
                                        <input type = "decimal" name = "multas" class="form-control subtotal-input" value="{{$processo->dar ? $processo->dar->multas : '0.00'}}" style="border: 0px; border-bottom: 1px solid black;">
                                
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4 mt-4">
                                        <label for="subtotal">Sub-Total</label>
                                        <input type = "decimal" name = "subtotal" class="form-control subtotal" class="subtotal-input" value="{{$processo->dar ? $processo->dar->subtotal : '0.00'}}" style="border: 0px; border-bottom: 1px solid black;">
                                    </div>
                                </div>
                                
                            </div>

                            <div class="tab-pane" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                <div class="row">
                                    <div class="col-md-4 mt-4">
                                        <label for="NrDU">Nº de Ordem DU</label>
                                        <input type="text" name="NrDU" class="form-control tarifa-du-input" value="{{ $processo->du ? $processo->du->NrDU : '' }}" style="border: 0px; border-bottom: 1px solid black;">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4 mt-4">
                                        <label for="lmc">LMC</label>
                                        <input type="decimal" name="lmc" class="form-control tarifa-du-input" value="{{ $processo->du ? $processo->du->lmc : '0.00' }}" style="border: 0px; border-bottom: 1px solid black;">
                                    </div>

                                    <div class="col-md-4 mt-4">
                                        <label for="navegacao">Navegação</label>
                                        <input type="decimal" name="navegacao" class="form-control tarifa-du-input" value="{{ $processo->du ? $processo->du->navegacao : '0.00' }}" style="border: 0px; border-bottom: 1px solid black;">
                                    </div>

                                    <div class="col-md-4 mt-4">
                                        <label for="viacao">Viação</label>
                                        <input type="decimal" name="viacao" class="form-control tarifa-du-input" value="{{ $processo->du ? $processo->du->viacao : '0.00' }}" style="border: 0px; border-bottom: 1px solid black;">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4 mt-4">
                                        <label for="taxa_aeroportuaria">Taxa Aeroportuária</label>
                                        <input type="decimal" name="taxa_aeroportuaria" class="form-control tarifa-du-input" value="{{ $processo->du ? $processo->du->taxa_aeroportuaria : '0.00' }}" style="border: 0px; border-bottom: 1px solid black;">
                                    </div>

                                    <div class="col-md-4 mt-4">
                                        <label for="caucao">Caução</label>
                                        <input type="decimal" name="caucao" class="form-control tarifa-du-input" value="{{ $processo->du ? $processo->du->caucao : '0.00' }}" style="border: 0px; border-bottom: 1px solid black;">
                                    </div>

                                    <div class="col-md-4 mt-4">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label for="honorario">Honorário</label>
                                                <input type="decimal" name="honorario" class="form-control tarifa-du-input" value="{{ $processo->du ? $processo->du->honorario : '0.00' }}" style="border: 0px; border-bottom: 1px solid black;">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="honorario_iva">Honorário IVA</label>
                                                <input type="decimal" name="honorario_iva" class="form-control tarifa-du-input" value="{{ $processo->du ? $processo->du->honorario_iva : '0.00' }}" style="border: 0px; border-bottom: 1px solid black;">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4 mt-4">
                                        <label for="frete">Frete</label>
                                        <input type="decimal" name="frete" class="form-control tarifa-du-input" value="{{ $processo->du ? $processo->du->frete : '0.00' }}" style="border: 0px; border-bottom: 1px solid black;">
                                    </div>

                                    <div class="col-md-4 mt-4">
                                        <label for="carga_descarga">Carga/Descarga</label>
                                        <input type="decimal" name="carga_descarga" class="form-control tarifa-du-input" value="{{ $processo->du ? $processo->du->carga_descarga : '0.00' }}" style="border: 0px; border-bottom: 1px solid black;">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4 mt-4">
                                        <label for="orgaos_oficiais">Órgãos Oficiais</label>
                                        <input type="decimal" name="orgaos_oficiais" class="form-control tarifa-du-input" value="{{ $processo->du ? $processo->du->orgaos_oficiais : '0.00' }}" style="border: 0px; border-bottom: 1px solid black;">
                                    </div>

                                    <div class="col-md-4 mt-4">
                                        <label for="deslocacao">Deslocação</label>
                                        <input type="decimal" name="deslocacao" class="form-control tarifa-du-input" value="{{ $processo->du ? $processo->du->deslocacao : '0.00' }}" style="border: 0px; border-bottom: 1px solid black;">
                                    </div>

                                    <div class="col-md-4 mt-4">
                                        <label for="guia_fiscal">Guia Fiscal</label>
                                        <input type="decimal" name="guia_fiscal" class="form-control tarifa-du-input" value="{{ $processo->du ? $processo->du->guia_fiscal : '0.00' }}" style="border: 0px; border-bottom: 1px solid black;">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4 mt-4">
                                        <label for="inerentes">Inerentes</label>
                                        <input type="decimal" name="inerentes" class="form-control tarifa-du-input" value="{{ $processo->du ? $processo->du->inerentes : '0.00' }}" style="border: 0px; border-bottom: 1px solid black;">
                                    </div>

                                    <div class="col-md-4 mt-4">
                                        <label for="despesas">Despesas</label>
                                        <input type="decimal" name="despesas" class="form-control tarifa-du-input" value="{{ $processo->du ? $processo->du->despesas : '0.00' }}" style="border: 0px; border-bottom: 1px solid black;">
                                    </div>

                                    <div class="col-md-4 mt-4">
                                        <label for="selos">Selos</label>
                                        <input type="decimal" name="selos" class="form-control tarifa-du-input" value="{{ $processo->du ? $processo->du->selos : '0.00' }}" style="border: 0px; border-bottom: 1px solid black;">
                                    </div>
                                </div>


                            </div>
                            
                            <div class="tab-pane" id="messages" role="tabpanel" aria-labelledby="messages-tab">
                                
                            <div class="form-group mt-4 col-md-4">
                                <label for="Situacao">Situação:</label>
                                <select name="Situacao" class="form-control" style="border: 0px; border-bottom: 1px solid black;">
                                    <option value="" selected>Selecionar</option>
                                    <option value="em processamento" {{ $processo->Situacao == 'em processamento' ? 'selected' : '' }}>Em Processamento</option>
                                    <option value="desembarcado" {{ $processo->Situacao == 'desembarcado' ? 'selected' : '' }}>Desembarcado</option>
                                    <option value="retido" {{ $processo->Situacao == 'retido' ? 'selected' : '' }}>Retido</option>
                                    <option value="concluido" {{ $processo->Situacao == 'concluido' ? 'selected' : '' }}>Concluído</option>
                                    <!-- Adicione outras opções conforme necessário -->
                                </select>
                                @error('Situacao')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>


                                <div class="row">
                                    <div class="col-md-4 mt-4">
                                        <label for="ep14">EP14</label>
                                        <input type="decimal" name="ep14" class="form-control" value="{{$processo->portuaria ? $processo->portuaria->ep14 : '0.00'}}" style="border: 0px; border-bottom: 1px solid black;">
                                    </div>
                                    <div class="col-md-4 mt-4">
                                        <label for="ep17">EP17</label>
                                        <input type="decimal" name="ep17" class="form-control" value="{{$processo->portuaria ? $processo->portuaria->ep17 : '0.00'}}" style="border: 0px; border-bottom: 1px solid black;">
                                    </div>
                                    <div class="col-md-4 mt-4">
                                        <label for="terminal">Terminal</label>
                                        <input type="decimal" name="terminal" class="form-control" value="{{$processo->portuaria ? $processo->portuaria->terminal : '0.00'}}" style="border: 0px; border-bottom: 1px solid black;">
                                    </div>
                                </div>
                            </div>
                            
                            <div class="tab-pane" id="settings" role="tabpanel" aria-labelledby="settings-tab">
                                <div class="col-md-12 mt-4">
                                    
                                    <div id="drop-area" style="width: 100%; height: 200px; border: 2px dashed #ccc; text-align: center; padding: 20px;">
                                        <h2>Arraste e solte documento aqui!</h2>
                                        <p>ou</p>
                                        <label for="file-input" style="cursor: pointer;" class="button-arquivo">Selecione um arquivo</label>
                                    </div>
                                    <input type="file" id="file-input" multiple style="display: none;">
                                    
                                    <div id="file-list" class="mt-4">
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
                            <x-input type="date" class="form-control" value="{{ isset($du) ? $du->DataEntrada : '' }}"/>
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
