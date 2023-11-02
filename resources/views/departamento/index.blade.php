<x-app-layout>
    <div class="container">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('departamentos.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-3">
                                <label for="">Codigo</label>
                                <x-input type="text" name="cod" id="cod"/>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <label for="">Departamento</label>
                                <x-input type="text" name="name" id="name"/>
                            </div>
                            <div class="col-md-3">
                                <label for="manager_id">Responsável</label>
                                <select name="manager_id" id="manager_id" class="form-control">
                                    <option value="">Selecionar</option>
                                    @foreach($managers as $manager)
                                        <option value="{{$manager->Id}}">{{$manager->Nome}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <br>
                        <x-button>Enviar</x-button>
                    </form>
                </div>
            </div>

            <div class="card">
                <div class="card-title"></div>
                <div class="card-body">
                    <table class="table table-sm">
                        <thead>
                            <th>Código</th>
                            <th>Departamento</th>
                            <th>Manager</th>
                            <th>Acções</th>
                        </thead>
                        <tbody>
                            @foreach($departamentos as $depart)
                                <tr>
                                    <td> {{$depart->cod}} </td>
                                    <td> {{$depart->name}} </td>
                                    <td> {{$depart->manager->Nome}} </td>
                                    <td>  
                                        <a href="{{ route('departamentos.edit', $depart->Id) }}">
                                            <i class="fa fa-edit" style="color: darkcyan;"></i> 
                                        </a>

                                        <a href="{{ route('departamentos.edit', $depart->Id) }}">
                                            <i class="fa fa-list" style="color: back;"></i> 
                                        </a>
                                        
                                        <i class="fa fa-info-circle" style="color: goldenrod;"></i>

                                        <a href="{{ route('departamentos.destroy', $depart->Id) }}">
                                            <i class="fa fa-trash" style="color: red;"></i> 
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>