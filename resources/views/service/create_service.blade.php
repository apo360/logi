<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Novo Serviço/Produto') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <x-validation-errors class="mb-4" />
                <form method="POST" action="{{ route('produtos.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="container">
                        <div class="flex items-center justify-end mt-4">
                            <x-button class="ml-4">
                                {{ __('Novo') }}
                            </x-button>

                            <x-button type="submit" class="button ml-4">
                                {{ __('Inserir') }}
                            </x-button>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="mt-2">
                                <x-label for="ProductCode" value="{{ __('Código') }}" />
                                <x-input id="ProductCode" class="block mt-1 w-full" type="text" name="ProductCode" placeholder="Código do Produto" />
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="mt-2">
                                <x-label for="ProductNumberCode" value="{{ __('Código de Barras') }}" />
                                <x-input id="ProductNumberCode" class="block mt-1 w-full" type="text" name="ProductNumberCode" placeholder="Código de Barras" />
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-8">
                            <div class="mt-2">
                                <x-label for="ProductDescription" value="{{ __('Nome do Serviço / Produto') }}" />
                                <x-input id="ProductDescription" class="block mt-1 w-full" type="text" name="ProductDescription" placeholder="Nome do Produto/Serviço" required />
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="mt-2">
                                <x-label for="ProductType" value="{{ __('Tipo') }}" />
                                <select name="ProductType" id="ProductType" class="form-control">
                                    @foreach($productTypes as $type)
                                        <option value="{{ $type->code }}">{{ $type->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="mt-2">
                                <x-label for="ProductGroup" value="{{ __('Categoria') }}" />
                                <select name="ProductGroup" id="ProductGroup" class="form-control">
                                    <option value="null">Sem Categoria</option>
                                    <option value="add">+ Categoria</option>
                                    <!-- Foreach -->
                                    <!-- /.Foreach -->
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="mt-2">
                                <x-label for="imagem" value="{{ __('Imagem') }}" />
                                <x-input id="imagem" class="block mt-1 w-full" type="file" name="imagem" />
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="mt-2">
                                <x-label for="factura" value="{{ __('Incluir na Fatura') }}" />
                                <select name="factura" id="factura">
                                    <option value="nao">Não</option>
                                    <option value="sim">Sim</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="mt-2">
                                <x-label for="unidade" value="{{ __('Unidade') }}" />
                                <select name="unidade" id="unidade">
                                    <option value="uni">Unidade</option>
                                    <option value="kg">Kilograma (Kg)</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="mt-2">
                                <x-label for="taxa_iva" value="{{ __('Imposto') }}" />
                                <div class="input-group input-group-sm">
                                    <x-input type="text" id="taxa_iva" name="taxa_iva" placeholder="Taxa de Imposto" />
                                    <span class="input-group-append">
                                        <button type="button" class="btn btn-info btn-flat" id="btt_categoria" data-toggle="modal" data-target="#modal-primary"> 
                                            <i class="fa fa-search-plus"></i>
                                        </button>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="mt-2">
                                <x-label for="motivo_isencao" value="{{ __('Motivo de Isenção') }}" />
                                <select name="motivo_isencao" id="motivo_isencao">
                                    @foreach($productExemptionReasons as $reason)
                                        <option value="{{ $reason->code }}">{{ $reason->name }}</option>
                                    @endforeach
                                </select>
                                <x-input type="text" name="dedutivel_iva" id="dedutivel_iva" value="100%" />
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <div class="mt-2">
                                <x-label for="preco_custo" value="{{ __('Preço de Custo') }}" />
                                <x-input type="text" name="preco_custo" id="preco_custo" placeholder="Preço de Custo" />
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="mt-2">
                                <x-label for="preco_venda" value="{{ __('Preço de Venda') }}" />
                                <x-input type="text" name="preco_venda" id="preco_venda" placeholder="Preço de Venda" />
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="mt-2">
                                <x-label for="margem_lucro" value="{{ __('Margem de Lucro') }}" />
                                <x-input type="text" name="margem_lucro" id="margem_lucro" placeholder="Margem de Lucro" />
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="mt-2">
                                <x-label for="preco_sem_iva" value="{{ __('Preço sem IVA') }}" />
                                <x-input type="text" name="preco_sem_iva" id="preco_sem_iva" placeholder="Preço sem IVA" />
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
