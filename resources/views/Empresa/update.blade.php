<x-config-layout>
    <div class="container">
        <x-slot name="header">
            <x-breadcrumb title="Editar Empresa" breadcrumb="Editar Empresa" />
        </x-slot>
        <br>

        <x-validation-errors class="mb-4" />

        @if(session('success'))
            <div>
                <p class="mt-3 text-smfont-medium  text-green-600">
                    {{ session('success') }}
                </p>
            </div>
        @endif
        
        <form action="{{ route('empresa.update', $empresa->NIF) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <div class="flex items-center justify-between">
                                <div class="float-right">
                                    <div class="btn-group">
                                        <x-button class="btn btn-dark" type="submit">
                                            {{ __('Atualizar') }}
                                        </x-button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card card-dark">
                        <div class="card-header">
                            <div class="">
                                <div class="card-title flex items-center">
                                    <strong>Empresa:</strong> <span>{{ $empresa->Empresa }}</span>
                                    <input type="hidden" name="EmpresaNIF" id="EmpresaNIF" value="{{ $empresa->NIF }}">
                                </div>
                            </div>
                        </div>
                        <div class="card-body">

                            <ul class="nav nav-tabs nav-dark" id="myTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="info-tab" data-bs-toggle="tab" data-bs-target="#info" type="button" role="tab" aria-controls="info" aria-selected="true"> <i class="fas fa-info-circle"></i> Info</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="aduaneiro-tab" data-bs-toggle="tab" data-bs-target="#aduaneiro" type="button" role="tab" aria-controls="aduaneiro" aria-selected="true">Proc. Aduaneiro</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="facturacao-tab" data-bs-toggle="tab" data-bs-target="#facturacao" type="button" role="tab" aria-controls="facturacao" aria-selected="false">Facturação</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="contabilidade-tab" data-bs-toggle="tab" data-bs-target="#contabilidade" type="button" role="tab" aria-controls="contabilidade" aria-selected="false">Contabilidade</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="banco-tab" data-bs-toggle="tab" data-bs-target="#banco" type="button" role="tab" aria-controls="banco" aria-selected="false">Contas Bancarias</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="settings-tab" data-bs-toggle="tab" data-bs-target="#settings" type="button" role="tab" aria-controls="settings" aria-selected="false">Impressão</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="settings-tab" data-bs-toggle="tab" data-bs-target="#settings" type="button" role="tab" aria-controls="settings" aria-selected="false">Impressão</button>
                                </li>
                            </ul>

                            <div class="tab-content">
                                <div class="tab-pane active" id="info" role="tabpanel" aria-labelledby="info-tab">
                                    <div class="form-group mt-2">
                                        <label for="logotipo">Logotipo da Empresa</label>
                                        <input type="file" class="form-control" id="logotipo" name="logotipo">
                                        
                                    </div>

                                    <!-- Campo Slogan -->
                                    <div class="form-group">
                                        <label for="slogan">Slogan</label>
                                        <input type="text" class="form-control" id="slogan" name="slogan" value="{{$empresa->Slogan}}">
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <!-- Campo Endereco_completo -->
                                            <div class="form-group">
                                                <label for="endereco_completo">Endereço Completo</label>
                                                <input type="text" class="form-control" id="endereco_completo" name="endereco_completo" value="{{$empresa->Endereco_completo}}">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <!-- Campo Provincia -->
                                            <div class="form-group">
                                                <label for="provincia">Província</label>
                                                <select id="provincia" name="provincia" class="form-control">
                                                    @foreach($provincias as $provincia)
                                                        <option value="{{ $provincia->ID }}" {{ $empresa->Provincia == $provincia->ID ? 'selected' : '' }}>{{ $provincia->Nome}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <!-- Campo Cidade -->
                                            <div class="form-group">
                                                <label for="cidade">Cidade</label>
                                                <input type="text" class="form-control" id="cidade" name="cidade" value="{{$empresa->Cidade}}">
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- Campo Dominio -->
                                    <div class="form-group">
                                        <label for="dominio">Website Corporativo</label>
                                        <input type="text" class="form-control" id="dominio" name="dominio" value="{{$empresa->Dominio}}">
                                    </div>

                                    <!-- Campo Email -->
                                    <div class="form-group">
                                        <label for="email">Email Corporativo</label>
                                        <input type="email" class="form-control" id="email" name="email" value="{{$empresa->Email}}">
                                    </div>

                                    <!-- Campo Fax -->
                                    <div class="form-group">
                                        <label for="fax">Fax</label>
                                        <input type="text" class="form-control" id="fax" name="fax" value="{{$empresa->Fax}}">
                                    </div>

                                    <!-- Campo Contacto_movel -->
                                    <div class="form-group">
                                        <label for="contacto_movel">Contacto Móvel</label>
                                        <input type="tel" class="form-control" id="contacto_movel" name="contacto_movel" value="{{$empresa->Contacto_movel}}">
                                    </div>

                                    <!-- Campo Contacto_fixo -->
                                    <div class="form-group">
                                        <label for="contacto_fixo">Contacto Fixo</label>
                                        <input type="tel" class="form-control" id="contacto_fixo" name="contacto_fixo" value="{{$empresa->Contacto_fixo}}">
                                    </div>

                                </div>

                                <!-- Esta div aparece caso o cliente tenha a o Modulo de Processos Aduaneiros Activado -->
                                <div class="tab-pane" id="aduaneiro" role="tabpanel" aria-labelledby="aduaneiro-tab">
                                    <!-- Este campo Aparece caso a Empresa Tenha o modulo Processos Aduaneiros Activado -->
                                    <div class="form-group">
                                        <label for="cod_processo">Código do Processo</label>
                                        <input type="text" class="form-control" id="cod_processo" name="cod_processo">
                                    </div>
                                </div>

                                <!-- Esta div aparece caso o cliente tenha a o Modulo de Facturação Activado -->
                                <div class="tab-pane" id="facturacao" role="tabpanel" aria-labelledby="facturacao-tab">
                                    <!-- Campo CodFactura -->
                                    <div class="form-group">
                                        <label for="cod_factura">Código da Fatura </label>
                                        <span>Informação fornecidad pela AGT</span>
                                        <input type="text" class="form-control" id="cod_factura" name="cod_factura">
                                    </div>

                                    <input type="checkbox" name="" id=""> Pretende usar o endereço definido como endereço de facturamento

                                    <div class="form-group">
                                        <label for="">Tipos de Documentos</label>
                                        checkboxs
                                    </div>

                                    <div class="form-group">
                                        <label for="">Formas de Pagamentos</label>
                                        checkboxs
                                    </div>
                                </div>

                                <!-- Esta div aparece caso o cliente tenha a o Modulo de Contabilidade Activado -->
                                <div class="tab-pane" id="contabilidade" role="tabpanel" aria-labelledby="contabilidade-tab"></div>

                                <div class="tab-pane" id="banco" role="tabpanel" aria-labelledby="banco-tab">
                                    <div class="form-group">
                                        <label for="banco">Banco</label>
                                        <input type="text" class="form-control" id="banco" name="banco">
                                    </div>

                                    <div class="form-group">
                                        <label for="conta_bancaria">Número de Conta Bancária</label>
                                        <input type="text" class="form-control" id="conta_bancaria" name="conta_bancaria">
                                    </div>

                                    <div class="form-group">
                                        <label for="iban">IBAN</label>
                                        <input type="text" class="form-control" id="iban" name="iban">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer"></div>
                        <!-- /.card-footer -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col-md -->
            </div>
        </form>
    </div>

    <!-- Bootstrap JavaScript (popper.js is required) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="..." crossorigin="anonymous"></script>
</x-config-layout>