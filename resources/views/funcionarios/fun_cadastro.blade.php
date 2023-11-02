<x-app-layout>
    <x-slot name="header">
        <x-breadcrumb title="Cadastro de Funcionário" breadcrumb="Cadastro de Funcionário" />
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

            <form method="POST" action="{{ route('funcionarios.store') }}">
                @csrf
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
                                <x-input type="text" name="Nome" id="Nome" required placeholder="Nome Próprio do Funcionário"/>
                            </div>
                            <div class="col-md-4">
                                <label for="Apelido">Sobrenome:</label>
                                <x-input type="text" name="Apelido" id="Apelido" placeholder="Sobrenome do Funcionário"/>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-5">
                                <label for="Email">Email:</label>
                                <x-input type="email" name="Email" id="Email"/>
                            </div>
                            <div class="col-md-3">
                                <label for="Telefone">Telefone:</label>
                                <x-input type="text" name="Telefone" id="Telefone"/>
                            </div>
                            <div class="col-md-3">
                                <label for="data_nasc">Data de Nascimento:</label>
                                <x-input type="date" name="data_nasc" id="data_nasc"/>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-8">
                                <label for="Endereco">Endereço:</label>
                                <x-input type="text" name="Endereco" id="Endereco"/> 929504745
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
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
