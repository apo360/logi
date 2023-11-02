<x-app-layout>
    <div class="py-12">
        <div class="max-w-8xl mx-auto sm:px-6 lg:px-8">
            <div class="card">
                <div class="card-header">
                    <div class="float-right flex items-center justify-end mt-4">
                        
                        <a href="{{ route('produtos.create') }}" type="button" class="btn btn-dark ml-4" style="color: black;">
                            <i class="fas fa-plus" style="color: black;">{{ __('Produto')}}</i> 
                        </a>
                        <select name="filter_name" id="filter_name" class="form-control ml-4">
                            <option value="">Exportar Produtos</option>
                            <option value="">Tabela de Preços</option>
                            <option value="">Upload Ficheiro CSV</option>
                            <option value="">Stock Upload Ficheiro CSV</option>
                        </select>
                    </div>
                </div>
            </div>

            <br>

            <div class="card">
                <div class="card-header">
                    
                </div>
                <div class="card-body"></div>
                <div class="card-footer"></div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="pesquisar">
            <div>
                <div class="row">
                    <div class="col-md-4">
                        <x-input type="text" name="search_nome" />
                    </div>
                    <div class="col-md-3">
                        <select name="" id="">
                            <option value="">Categorias</option>
                            <option value="">Produtos</option>
                            <option value="">Serviço</option>
                        </select>
                    </div>
                    <div class="col-md-3"></div>
                    <div class="col-md-3"></div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-3">
                        <label for="">PVP</label>
                    </div>
                    <div class="col-md-3">
                        <label for="">Preço Fornecedor</label>
                    </div>
                    <div class="col-md-3">
                        ...
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="checks_box">
                        <!-- //Checks Box -->
                        <x-input type="checkbox" name=""/>
                        <label for=""> Referência </label>

                        <x-input type="checkbox" name=""/>
                        <label for=""> Nome </label>

                        <x-input type="checkbox" name=""/>
                        <label for=""> Preço </label>

                        <x-input type="checkbox" name=""/>
                        <label for=""> Preço de Custo </label>

                        <x-input type="checkbox" name=""/>
                        <label for=""> Imposto </label>
                    </div>

                    <div class="button_search">
                        <x-button>
                            <a href="">Limpar</a>
                        </x-button>

                        <x-button>
                            <a href=""> 
                                <i class="fas fa-search"></i> 
                                Pesquisar
                            </a>
                        </x-button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <table>
            <thead>
                <th>Ref</th>
                <th>Nome</th>
                <th>Preço</th>
                <th>IVA</th>
                <th>...</th>
            </thead>
            <tbody>
                <!-- products -->
                @foreach($products as $product)
                <tr>
                    <td>{{ $product->ProductType }} | {{ $product->ProductCode }}</td>
                    <td>{{ $product->ProductDescription }}</td>
                    <td>{{ number_format(floatval($product->price), 2, ',','.') }} Kz</td>
                    <td>
                        
                    </td>

                    <td><form action="" method="POST" on> </form></td>
                    <td><form method='POST' action="{{ route('produtos.destroy', $product) }}">@csrf </form></td>
                    <td>
                        <a href="{{ route('produtos.edit', $product) }}" style='margin:5px;'class="btn btn-primary">
                                <i class="fa fa-pencil"></i>
                        </a>&nbsp;
                        <button onclick="deleteProduct({{ $product }})" type="submit" id="" data-toggle="modal" data-target="#exampleModalCentered" title="Delete Product" class="btn btn-danger">
                            Delete<span aria-hidden="true">&times;</span>
                        </button>
                        &nbsp;
                    </td>
                </tr>
                @endforeach
            </tbody>
            
        </table>
    </div>
</x-app-layout>