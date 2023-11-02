
<x-app-layout>
    <div class="py-12">
        <div class="container">
            <div class="bg-white overflow-hidden">
                <div>
                    Dados do Cliente
                </div>
                <hr>
                <hr>
                <hr>
                <div class="row">
                    <div class="col-md-6">
                        <span>Nome</span>
                        <hr>
                        <b>{{ $customer->CompanyName}}</b>
                        <br><br>
                        <span>Gestor de Conta</span>
                        <hr>
                        <b>{{ auth()->user()->name }}</b>
                        <br><br>
                        <span>Referência Externa</span>
                        <hr>
                        <b>---</b>
                    </div>

                    <div class="col-md-6">
                        <span>NIF:</span>
                        <hr>
                        <b>{{ $customer->CustomerTaxID }}</b>
                        <br><br>
                        <span>País</span>
                        <hr>
                        <b>Angola [AO]</b>
                        <br><br>
                        <span>Modo Pagamento</span>
                        <hr>---
                    </div>
                </div>
                <span>Morada Completa</span>
                ---
                <hr><hr>
                <div class="row">
                    <div class="col-md-6">
                        
                    </div>

                    <div class="col-md-6">
                        
                    </div>
                </div>
                
                <span>Contactos</span>
                <hr><hr>
                
            </div>
        </div>

        <div class="container">
            <div class="bg-white overflow-hidden">
                <div><h3><b>Processos</b></h3></div>
                <hr><hr>
                <br>
                <x-button>Fechar Processos</x-button>
                <x-button>Uploads</x-button>
                <br>
                Nº de Processos : {{$Countprocessos}}
            </div>
        </div>

        <div class="container">
            <div class="bg-white overflow-hidden">
                <div><h3><b>Conta</b></h3></div>
                <hr><hr>
                <br>
                <x-button>Movimentos Conta Corrente</x-button>
                <x-button>Liquidar Facturas</x-button>
                <x-button>Regularizar</x-button>
                <br>
                Conta Corrente,
                Saldo Total,
                Dívida Corrente, 
                Dívida Vencida
            </div>
        </div>
    </div>
</x-app-layout>