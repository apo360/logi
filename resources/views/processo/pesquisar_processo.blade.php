<!-- resources/views/processos/index.blade.php -->

<x-app-layout>
    <x-slot name="header">
        <x-breadcrumb title="Lista de Processos" breadcrumb="Lista de Processos" />
    </x-slot>
    <br>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card card-default">
                    <div class="card-header">
                        <h3 class="card-title" > <i class="fas fa-search"></i> Pesquisar Processos</h3>
                        <div class="float-right">
                            <a href="{{ route('processos.create') }}" type="button" class="btn btn-dark" style="color: black;">
                                <i class="fas fa-user-plus" style="color: black;"></i> Novo Processo
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

    

