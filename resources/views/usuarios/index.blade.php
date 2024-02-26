<x-app-layout>

    <x-slot name="header">
        <x-breadcrumb title="Pesquisar Usuários" breadcrumb="Pesquisar Usuários" />
    </x-slot>

    <div class="container">
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
                            <div class="input-group-append">
                                <a class="btn btn-dark" href="{{ route('usuarios.create') }}">
                                    {{ __('Add User') }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card card-dark">
            <div class="card-header">
                <div class="card-title">
                    <span>Lista de Usuários</span>
                </div>
            </div>
            <div class="card-body">
                @if (isset($tableDataUser['headers']) && isset($tableDataUser['rows']))
                    <x-table :tableData="$tableDataUser" />
                @endif
            </div>
            <div class="card-footer">

            </div>
        </div>
    </div>
</x-app-layout>