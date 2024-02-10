<style>
    /* Adicione essas regras ao seu arquivo de estilo ou no cabeçalho do HTML */
.pesquisar {
    padding: 15px;
}

.font-weight-bold {
    font-weight: bold;
}

/* Estilizando os checkboxes */
.checks_box input[type="checkbox"] {
    margin-right: 5px;
}

/* Estilizando os botões de ação */
.button_search x-button {
    display: inline-block;
}

</style>

<x-app-layout>
    <div class="py-12">
        <div class="max-w-8xl mx-auto sm:px-6 lg:px-8">

            <div class="card">

                <div class="card-header">
                    <div class="float-right flex items-center justify-end mt-4">
                        <button type="button" class="btn btn-navy ml-4" data-toggle="modal" data-target="#largeModal" style="color: black;">
                            <i class="fas fa-plus" style="color: black;">{{ __('Produto')}}</i> 
                        </button>
                        
                        <select name="filter_name" id="filter_name" class="form-control ml-4">
                            <option value="">Exportar Produtos</option>
                            <option value="">Tabela de Preços</option>
                            <option value="">Upload Ficheiro CSV</option>
                            <option value="">Stock Upload Ficheiro CSV</option>
                        </select>
                        <x-input type="text" name="search_nome" placeholder="Pesquisar Produto"/>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row">

                    <div class="col-md-3 card" style="background-color: beige;">
    <div class="pesquisar">
        <span class="font-weight-bold">Filtro de Pesquisa</span>
        <div class="mt-3">
            <!-- Opções de Filtro -->
            <div class="row mb-2">
                <div class="col-md-4">
                    <label for="filterPVP">PVP</label>
                </div>
                <div class="col-md-4">
                    <label for="filterPrecoFornecedor">Preço Fornecedor</label>
                </div>
                <!-- Adicione mais opções de filtro conforme necessário -->
            </div>
            <hr>

            <!-- Opções de Seleção -->
            <div class="row mb-2">
                <div class="col-md-6 checks_box">
                    <x-input type="checkbox" name="filterReferencia" id="filterReferencia"/>
                    <label for="filterReferencia">Referência</label>

                    <x-input type="checkbox" name="filterNome" id="filterNome"/>
                    <label for="filterNome">Nome</label>

                    <x-input type="checkbox" name="filterPreco" id="filterPreco"/>
                    <label for="filterPreco">Preço</label>

                    <x-input type="checkbox" name="filterPrecoCusto" id="filterPrecoCusto"/>
                    <label for="filterPrecoCusto">Preço de Custo</label>

                    <x-input type="checkbox" name="filterImposto" id="filterImposto"/>
                    <label for="filterImposto">Imposto</label>
                </div>
            </div>
        </div>
    </div>
</div>


                        <div class="col-md-9">
                        <table class="table table-sm table-stripped">
                            <thead>
                                <th></th>
                                <th>Tipo|Ref</th>
                                <th>Descrição</th>
                                <th>Preço S/Taxa</th>
                                <th>Taxa</th>
                                <th>Preço Venda</th>
                                <th>...</th>
                            </thead>
                            <tbody>
                                <!-- products -->
                                @foreach($products as $product)
                                <tr id="productRow_{{ $product->Id }}" >
                                    <td>
                                        <a href="{{ route('produtos.edit', $product->Id) }}" style='margin:5px;' title="Editar Produto">
                                                <i class="fas fa-edit"></i>
                                        </a>
                                        <a onclick="deleteProduct({{ $product->Id }})" data-id="{{ $product->Id }}" type="button" data-toggle="modal" data-target="#exampleModalCentered" title="Excluir Produto">
                                            <i class="fas fa-trash" style="color: salmon;"></i>
                                        </a>
                                        <a href="">
                                            <i class="fas fa-eye" style="color: lightseagreen;"></i>
                                        </a>
                                    </td>
                                    <td>{{ $product->ProductType }} | {{ $product->ProductCode }}</td>
                                    <td>{{ $product->ProductDescription }}</td>
                                    <td>{{ number_format(floatval($product->venda_sem_iva), 2, ',','.') }} Kz</td>
                                    <td>{{ number_format(floatval($product->imposto), 2, ',','.') }} %</td>
                                    <td>{{ number_format(floatval($product->venda), 2, ',','.') }} Kz</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        </div>
                    </div>
                </div>

                <div class="card-footer">
                    
                </div>

            </div>
        </div>
    </div>

<!-- O Modal -->
<div class="modal fade" id="largeModal" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="largeModalLabel">Título do Modal Grande</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <form method="POST" action="{{ route('produtos.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="mt-2">
                            <x-label for="ProductCode" value="{{ __('Código') }}" />
                            <x-input id="ProductCode" class="block mt-1 w-full" type="text" name="ProductCode" placeholder="Código do Produto" />
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mt-2">
                            <x-label for="ProductNumberCode" value="{{ __('Código de Barras') }}" />
                            <x-input id="ProductNumberCode" class="block mt-1 w-full" type="text" name="ProductNumberCode" placeholder="Código de Barras" />
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="mt-2">
                            <x-label for="ProductDescription" value="{{ __('Nome do Serviço / Produto') }}" />
                            <x-input id="ProductDescription" class="block mt-1 w-full" type="text" name="ProductDescription" placeholder="Nome do Produto/Serviço" required />
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mt-2">
                            <x-label for="ProductType" value="{{ __('Tipo') }}" />
                            <select name="ProductType" id="ProductType" class="form-control">
                                <option value="">Selecionar</option>    
                                @foreach($productTypes as $type)
                                    <option value="{{ $type->code }}">{{ $type->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mt-2">
                        <x-label for="ProductGroup" value="{{ __('Categoria') }}" />
                        <select name="ProductGroup" id="ProductGroup" class="form-control">
                            <option value="0">Sem Categoria</option>
                            <option value="add">+ Categoria</option>
                            @foreach($grupoProduto as $grupos)
                                <option value="{{$grupos->id}}"> {{$grupos->descricao}}</option>
                            @endforeach
                        </select>
                        </div>
                    </div>
                </div>
                <div>
                    <x-button type="submit" class="button ml-4">
                        {{ __('Inserir') }}
                    </x-button>
                </div>
                
            </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        <button type="button" class="btn btn-primary">Salvar mudanças</button>
      </div>
    </div>
  </div>
</div>

<!-- Segundo Modal para Nova Categoria -->
<div class="modal fade" id="addCategoryModal" tabindex="-1" role="dialog" aria-labelledby="addCategoryModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addCategoryModalLabel">Adicionar Nova Categoria</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- Formulário para adicionar nova categoria -->
        <form method="POST" class="" action="{{ route('insert.grupo.produto')}}">
            @csrf
          <!-- Campos do formulário -->
          <div class="row">
            <div class="col-md-12">
                <x-input id="descricao" name="descricao" class="block mt-1 w-full" type="text" placeholder="Nova Categoria" />
            </div>
          </div>
          <!-- Botão para salvar e fechar o segundo modal -->
            <x-button type="submit" class="button ml-4">
                {{ __('Salvar e Fechar') }}
            </x-button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Script JavaScript para manipular a lógica do modal -->
<script>
  $(document).ready(function() {
    // Flag para evitar recursão infinita
    var isAddingCategory = false;

    // Evento ao alterar o valor do seletor ProductGroup
    // Delegação de evento para o seletor ProductGroup
    $('body').on('change', '#ProductGroup', function() {
        if ($(this).val() === 'add' && !isAddingCategory) {
            // Definir a flag para true
            isAddingCategory = true;
            
            // Fechar o primeiro modal
            //$('#largeModal').modal('hide');
            // Abrir o segundo modal para adicionar nova categoria
            $('#addCategoryModal').modal('show');
        }
    });

    // Evento ao fechar o segundo modal
    $('#addCategoryModal').on('hidden.bs.modal', function () {
        // Limpar o valor do input de nova categoria
        $('#newCategory').val('');
        // Reabrir o primeiro modal
        $('#largeModal').modal('show');

        // Resetar a flag para false
        isAddingCategory = false;
    });
  });

  // Função para salvar e fechar o segundo modal
  function saveAndCloseAddCategoryModal() {
    // Simulação: obtendo o valor da nova categoria do input
    var newCategoryValue = $('#newCategory').val();

    // Lógica para salvar a nova categoria (usando Ajax, por exemplo)
    // Aqui você deve implementar a lógica real para salvar a nova categoria

    // Atualizar o seletor ProductGroup no primeiro modal com a nova categoria (simulação)
    $('#ProductGroup').append('<option value="' + newCategoryValue + '">' + newCategoryValue + '</option>');

    // Fechar o segundo modal
    $('#addCategoryModal').modal('hide');
  }
</script>

<script>
    function deleteProduct(productId) {
        // Exibir um modal de confirmação, se desejar
        if (confirm("Tem certeza de que deseja excluir este produto?")) {
            // Enviar uma solicitação Ajax para excluir o produto
            $.ajax({
                url: route('produtos.destroy', productId), // Substitua pelo seu URL de rota de exclusão
                type: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}',
                },
                success: function (response) {
                    // Remover a linha da tabela após a exclusão bem-sucedida
                    $('#productRow_' + productId).remove();
                },
                error: function (error) {
                    console.error('Erro ao excluir o produto:', error);
                }
            });
        }
    }
</script>

</x-app-layout>