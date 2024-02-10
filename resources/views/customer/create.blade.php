<x-app-layout>
    <x-slot name="header">
        <x-breadcrumb title="Cadastro de Cliente" breadcrumb="Cadastro de Cliente" />
    </x-slot>
    <br>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <form method="POST" action="{{ route('customers.store') }}">
                    @csrf
                    <div class="card">
                        <div class="card-header">
                            <div class="float-left">
                                <a type="button" href="{{ route('customers.index') }}" class="btn btn-dark" style="color: black;">
                                    <i class="fas fa-search" style="color: black;"></i> {{ __('Pesquisar Cliente') }}
                                </a>
                            </div>
                            <div class="float-right">
                                <div class="btn-group">
                                    <x-button class="btn btn-default ">
                                        <i class="fas fa-user-plus btn-icon" style="color: #0170cf;"></i> {{ __('Inserir Cliente') }}
                                    </x-button>
                                    <a type="button" href="{{ route('customers.create') }}" class="btn btn-default" style="color: black;">
                                        <i class="fas fa-download" style="color: #0170cf;"></i> Upload Clientes CSV</a>
                                    </a>
                                    <a type="button" href="{{ route('customers.create') }}" class="btn btn-default" style="color: black;">
                                        <i class="fas fa-upload" style="color: #0170cf;"></i> Exportar Clientes</a>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="mt-2">
                                        <x-label for="name" value="{{ __('Cliente ID') }}" />
                                        <x-input id="name" class="block mt-1 w-full" type="text" name="CustomerID" value="{{ $newCustomerCode }}" readonly />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mt-2">
                                            <x-label for="CustomerTaxID" value="{{ __('NIF') }}" />
                                            <x-input-button namebutton="Validar NIF" idButton="CustomerTaxID" type="text" name="CustomerTaxID" value="000000"/>
                                        </div>
                                    </div>
                                    <br><hr style='border: 1px solid #ccc;'>
                                    <div class="col-md-6">
                                        <div class="mt-2">
                                            <x-label for="CompanyName" value="{{ __('Empresa') }}" />
                                            <x-input id="CompanyName" class="block mt-1 w-full" type="text" name="CompanyName" required autofocus autocomplete="CompanyName" />
                                        </div>
                                    </div>
                                    <br><hr style='border: 1px solid #ccc;'>
                                    <div class="col-md-6">
                                        <div class="mt-2">
                                            <x-label for="Telephone" value="{{ __('Telefone') }}" />
                                            <x-input id="Telephone" class="block mt-1 w-full" type="text" name="Telephone" required autofocus autocomplete="Telephone" />
                                        </div>
                                    </div>
                                    <br><hr style='border: 1px solid #ccc;'>
                                
                                    <div class="col-md-6">
                                        <div class="mt-4">
                                            <x-label for="Email" value="{{ __('Email') }}" />
                                            <x-input id="Email" class="block mt-1 w-full" type="email" name="Email" autocomplete="Email" />
                                        </div>
                                    </div>
                                    <br><hr style='border: 1px solid #ccc;'>
                                    <div class="col-md-6">
                                        <div class="mt-4">
                                            <x-label for="Website" value="{{ __('Site') }}" />
                                            <x-input id="Website" class="block mt-1 w-full" type="text" name="Website" autocomplete="Website" />
                                        </div>
                                    </div>
                                    <br><hr style='border: 1px solid #ccc;'>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>