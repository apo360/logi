<x-app-layout>
    <br>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left col-md-6">
                            <x-input type="search" name="" id="" placeholder="Pesquisar Clientes"/>
                        </div>

                        <div class="float-right">

                            <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                                <a href="{{ route('funcionarios.create') }}" type="button" class="btn btn-primary" style="color: black;">
                                    <i class="fas fa-user-plus" style="color: black;"></i> Novo Cliente
                                </a>

                                <a href="#" type="button" class="btn btn-primary" style="color: black;">2</a>
                                
                                <div class="btn-group" role="group">
                                    <button id="btnGroupDrop1" type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="true" style="color: black;">
                                        Filtros
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                        <li><a class="dropdown-item" href="#">Dropdown link</a></li>
                                        <li><a class="dropdown-item" href="#">Dropdown link</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
        
                    <div class="card-body">
                        <table class="table table-sm">
                            <thead>
                                <th>...</th>
                                <th>Código</th>
                                <th>Funcionarios</th>
                                <th>Departamento</th>
                                <th>Função</th>
                                <th>Telefone</th>
                                <th>Idade</th>
                                <th>Gênero</th>
                            </thead>
                            <tbody>
                                @foreach($funcionarios as $funcionario)
                                    <tr>
                                        <td>
                                            <a href="{{ route('funcionarios.edit',$funcionario->Id) }}">
                                                Foto
                                            </a>
                                        </td>
                                        <td>
                                            <a href="{{ route('funcionarios.edit',$funcionario->Id) }}">
                                                {{ $funcionario->FuncionarioID }}
                                            </a>
                                        </td>
                                        <td>
                                            <a href="{{ route('funcionarios.edit',$funcionario->Id) }}">
                                                {{ $funcionario->Nome }} {{ $funcionario->apelido }}
                                            </a>
                                        </td>
                                        <td>{{ $funcionario->contrato ? $funcionario->contrato->departamento->name : '' }}</td>
                                        <td>{{ $funcionario->contrato ? $funcionario->contrato->position : '' }}</td>
                                        <td>{{ $funcionario->Telefone }}</td>
                                        <td>{{ $funcionario->idade() }}</td>
                                        <td>{{ $funcionario->genero }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>