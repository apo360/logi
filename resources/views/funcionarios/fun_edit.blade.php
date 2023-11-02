
<head>
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
</head>

<x-app-layout>
    <x-slot name="header">
        <x-breadcrumb title="Editar Funcionário" breadcrumb="Editar Funcionário" />
    </x-slot>
    <br>
    <div class="container">
        <div class="col-12">
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (Session::has('status'))
                <x-alert-message type="success" :message="Session::get('success')" />
                <x-alert-message type="error" :message="Session::get('error')" /> 
            @endif

            <form method="POST" action="{{ route('funcionarios.update', $funcionario->Id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <a type="button" href="{{ route('funcionarios.index') }}" class="btn btn-dark" style="color: black;">
                                <i class="fas fa-search" style="color: black;"></i> {{ __('Pesquisar Funcionarios') }}
                            </a>
                        </div>
                        <div class="float-right">
                            <div class="btn-group">
                                <x-button class="btn btn-default">
                                    <i class="fas fa-user-plus btn-icon" style="color: #0170cf;"></i> {{ __('Inserir Funcionario') }}
                                </x-button>
                                <a type="button" href="{{ route('edit.import') }}" class="btn btn-default" style="color: black;">
                                    <i class="fas fa-download" style="color: #0170cf;"></i> Upload CSV</a>
                                </a>
                                <a type="button" href="{{ route('edit.export') }}" class="btn btn-default" style="color: black;">
                                    <i class="fas fa-upload" style="color: #0170cf;"></i> Exportar</a>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header"></div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-8">
                                <label for="Nome">Nome:</label>
                                <x-input type="text" name="Nome" id="Nome" required value="{{ $funcionario->Nome }}"/>
                            </div>
                            <div class="col-md-4">
                                <label for="apelido">Sobrenome:</label>
                                <x-input type="text" name="apelido" id="apelido" value="{{ $funcionario->apelido }}"/>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-5">
                                <label for="Email">Email:</label>
                                <x-input type="email" name="Email" id="Email" value="{{ $funcionario->Email }}"/>
                            </div>
                            <div class="col-md-3">
                                <label for="Telefone">Telefone:</label>
                                <x-input type="text" name="Telefone" id="Telefone" value="{{ $funcionario->Telefone }}"/>
                            </div>
                            <div class="col-md-3">
                                <label for="data_nasc">Data de Nascimento:</label>
                                <x-input type="date" name="data_nasc" id="data_nasc" value="{{ $funcionario->data_nasc }}"/>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-8">
                                <label for="Endereco">Endereço:</label>
                                <x-input type="text" name="Endereco" id="Endereco" value="{{ $funcionario->Endereco }}"/>
                            </div>
                            <div class="col-md-4">
                                <label for="Genero">Gênero:</label>
                                <select class="form-control" name="Genero" id="Genero">
                                    <option value="Selecionar">Selecionar</option>
                                    <option value="M">Masculino</option>
                                    <option value="F">Feminino</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="col-md-12">
                            <ul class="nav nav-tabs">
                                <li class="nav-item">
                                    <a href="#contrato" class="nav-link active" roles="tab" data-toggle="tab">Contrato</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#attendance" class="nav-link" roles="tab" data-toggle="tab">Assuduidade</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#lutas" class="nav-link" roles="tab" data-toggle="tab">Certificações e Skills</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#lutas" class="nav-link" roles="tab" data-toggle="tab">Agregado Familiar</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#lutas" class="nav-link" roles="tab" data-toggle="tab">Extrato Salarial</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#lutas" class="nav-link" roles="tab" data-toggle="tab">Histórico</a>
                                </li>
                            </ul>

                            <div class="tab-content">
                                <br>
                                <hr>
                                <div role="tabpanel" class="tab-pane active" id="contrato">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label for="start_date">Ínicio de Contrato</label>
                                            <x-input type="date" name="start_date" id="start_date" value="{{ $contrato ? $contrato->start_date : '' }}" />
                                        </div>
                                        <div class="col-md-4">
                                            <label for="end_date">Fim de Contrato</label>
                                            <x-input type="date" name="end_date" id="end_date" value="{{ $contrato ? $contrato->end_date : '' }}" />
                                        </div>
                                        <div class="col-md-3">
                                            <label>Periodo de Contrato</label>
                                            <select id="periodo" class="form-control" >
                                                <option value="0">Selecionar</option>
                                                <option value="3">3 meses</option>
                                                <option value="6">6 meses</option>
                                                <option value="12">1 ano</option>
                                                <option value="24">2 anos</option>
                                                <option value="36">3 anos</option>
                                                <option value="60">5 anos</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label for="">Tipo de Contrato</label>
                                            <select name="contract_type" id="contract_type" class="form-control">
                                                <option value="prazo_indeterminado" @if ($contrato && $contrato->contract_type == "prazo_indeterminado") selected @endif>Contrato de Trabalho Indeterminado</option>
                                                <option value="prazo_determinado" @if ($contrato && $contrato->contract_type == "prazo_determinado") selected @endif>Contrato de Trabalho Determinado</option>
                                                <option value="temporario" @if ($contrato && $contrato->contract_type == "temporario") selected @endif>Contrato de Trabalho Temporário</option>
                                                <option value="estagio" @if ($contrato && $contrato->contract_type == "estagio") selected @endif>Contrato de Estágio</option>
                                                <option value="trabalho_parcial" @if ($contrato && $contrato->contract_type == "trabalho_parcial") selected @endif>Regime Parcial</option>
                                                <option value="trabalho_intermitente" @if ($contrato && $contrato->contract_type == "trabalho_intermitente") selected @endif>Contrato de Trabalho Intermitente</option>
                                                <option value="autonomo" @if ($contrato && $contrato->contract_type == "autonomo") selected @endif>Trabalho Autônomo</option>
                                                <option value="periodo_experimental" @if ($contrato && $contrato->contract_type == "periodo_experimental") selected @endif>Período Experimental</option>
                                                <option value="teletrabalho" @if ($contrato && $contrato->contract_type == "teletrabalho") selected @endif>Regime de Teletrabalho (Home Office)</option>
                                                <option value="obra_certa" @if ($contrato && $contrato->contract_type == "obra_certa") selected @endif>Obra Certa ou Serviço Específico</option>
                                            </select>

                                        </div>
                                        <div class="col-md-4">
                                            <label for="department_id">Departamento</label>
                                            <select name="department_id" id="department_id" class="form-control">
                                                <option value="">Selecionar</option>
                                                <option value="novo">+ Adicionar Novo</option>
                                                @foreach($departamentos as $departamento)
                                                    <option value="{{ $departamento->Id }}" @if ($departamento && $departamento->Id == $contrato->department_id) selected @endif>{{ $departamento->cod }} - {{ $departamento->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="manager_id">Responsável</label>
                                            <select name="manager_id" id="manager_id" class="form-control">
                                                <option value=""></option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label for="position">Função</label>
                                            <x-input type="text" name="position" id="position" placeholder="Função que exerce" value="{{ $contrato ? $contrato->position : '' }}"/>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="working_hours_per_week">Horas</label>
                                            <x-input type="number" name="working_hours_per_week" id="working_hours_per_week" placeholder="Horas de Trabalho por Semana" value="{{ $contrato ? $contrato->working_hours_per_week : '' }}"/>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="salary">Salário</label>
                                            <x-input type="text" name="salary" id="salary" value="{{ $contrato ? $contrato->salary : '' }}" placeholder="Remuneração Mensal" />
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <label for="probation_period">Período de Experiência:</label>
                                            <select name="probation_period" id="probation_period" class="form-control">
                                                <option value="0" @if ($contrato && $contrato->probation_period == "0") selected @endif>Nenhum</option>
                                                <option value="30" @if ($contrato && $contrato->probation_period == "30") selected @endif>30 dias</option>
                                                <option value="60" @if ($contrato && $contrato->probation_period == "60") selected @endif>60 dias</option>
                                                <option value="90" @if ($contrato && $contrato->probation_period == "90") selected @endif>90 dias</option>
                                                <option value="180" @if ($contrato && $contrato->probation_period == "180") selected @endif>180 dias</option>
                                            </select>
                                        </div>
                                    </div>
                                    

                                    <label for="">Modo de Pagamento</label>
                                    <select name="" id="">
                                        <option value="">Selecionar</option>
                                        <option value="">Conta Bancaria</option>
                                        <option value=""></option>
                                    </select>

                                    
                                </div>
                                <div role="tabpanel" class="tab-pane" id="attendance">

                                </div>
                                <br>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal para Listar os Produtos / Serviços -->
    <div class="modal-overlay" id="modal-overlay"></div>
    <aside class="modal-aside" id="modal-aside">
        <!-- Modal content here -->
        <div class="modal-content">
            <span class="close" id="closeModalBtn">&times;</span>
            <div class="card card-dark">
                <div class="card-header">
                    <div class="card-title"><span>Criar Novo Departamento</span></div>
                </div>

                <div class="card-body">
                    <form id="departmentForm" action="{{ route('departamentos.store')}}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <label for="cod">Código</label>
                                <x-input type="text" id="cod" name="cod" placeholder="Código do Departamento" required/>
                            </div>
                            <div class="col-md-12">
                                <label for="name">Departamento</label>
                                <x-input type="text" id="name" name="name" placeholder="Nome do Departamento" required/>
                            </div>
                            <div class="col-md-12">
                                <label for="name">Responsável</label>
                                <select name="" id="" class="form-control"></select>
                            </div>
                        </div>
                        
                        <x-button >Criar Departamento</x-button>
                    </form>
                </div>
            </div>
        </div>
    </aside>
    <!-- //Modal para Listar os Produtos / Serviços -->
</x-app-layout>

<script>
    // Obtém referências aos elementos do DOM
    const periodoSelect = document.getElementById('periodo');
    const startDateInput = document.getElementById('start_date');
    const endDateInput = document.getElementById('end_date');

    // Adiciona um ouvinte de eventos para o evento "change" no campo de seleção de período
    periodoSelect.addEventListener('change', () => {
        // Verifica se a data de início está preenchida
        if (startDateInput.value === '') {
            alert('Preencha a data de início antes de selecionar o período.');
            // Restaura o valor do campo de seleção de período para "Selecionar"
            periodoSelect.value = '0';
            return;
        }

        // Obtém o valor selecionado no campo de seleção de período
        const selectedValue = parseInt(periodoSelect.value);

        // Verifica se o valor selecionado é um número válido
        if (!isNaN(selectedValue)) {
            // Obtém a data de início do campo de data de início
            const startDate = new Date(startDateInput.value);

            // Verifica se a data de início é uma data válida
            if (!isNaN(startDate.getTime())) {
                // Calcula a data de término com base no período selecionado
                const endDate = new Date(startDate);
                endDate.setMonth(startDate.getMonth() + selectedValue);

                // Verifica se a data de término é um sábado ou domingo
                while (endDate.getDay() === 0 || endDate.getDay() === 6) {
                    endDate.setDate(endDate.getDate() + 1); // Adia a data de término em um dia
                }

                // Formata a data de término como "YYYY-MM-DD" para definir o valor do campo de data de término
                const formattedEndDate = endDate.toISOString().split('T')[0];
                endDateInput.value = formattedEndDate;
            }
        }
    });
</script>

<script>
    const departmentSelect = document.getElementById('department_id');
    const novoOption = document.querySelector('option[value="novo"]');
    var $modalOverlay = $('#modal-overlay');
    var $modalAside = $('#modal-aside');

    // Adicione um ouvinte de eventos para o campo de seleção
    departmentSelect.addEventListener('change', function () {
        if (departmentSelect.value === 'novo') {
            // A opção "Adicionar Novo" foi selecionada, então mostre o modal
            $modalOverlay.fadeIn();
            $modalAside.css('right', '0');
        } else {
            // Outra opção foi selecionada, então oculte o modal se estiver visível
            $modalOverlay.fadeOut();
            $modalAside.css('right', '-600px');
        }
    });

    $modalOverlay.click(function() {
        $modalOverlay.fadeOut();
        $modalAside.css('right', '-600px');
    });
</script>
