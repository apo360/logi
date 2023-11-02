<x-app-layout>
    <x-slot name="header">
        <x-breadcrumb title="Pesquisar Clientes" breadcrumb="Pesquisar Clientes" />
    </x-slot>
    <br>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title" > <i class="fas fa-search"></i> Pesquisar Clientes</h3>
                        <div class="float-right">
                            <a href="{{ route('customers.create') }}" type="button" class="btn btn-dark" style="color: black;">
                                <i class="fas fa-user-plus" style="color: black;"></i> Novo Cliente
                            </a>
                            <a type="button" href="{{ route('customers.create') }}" class="btn btn-default" style="color: black;">
                                <i class="fas fa-download" style="color: #0170cf;"></i> Upload Clientes CSV</a>
                            </a>
                            <a type="button" href="{{ route('customers.create') }}" class="btn btn-default" data-toggle="modal" data-target="#modal-lg" style="color: black;">
                                <i class="fas fa-upload" style="color: #0170cf;"></i> Exportar Clientes</a>
                            </a>
                        </div>
                    </div>
        
                    <div class="card-body">
                        @if (isset($tableData['headers']) && isset($tableData['rows']))
                            <x-table :tableData="$tableData" />
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>