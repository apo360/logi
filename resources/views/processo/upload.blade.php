<x-app-layout>
    <div class="container mt-5">
        <h2>Upload de Documentos</h2>

        <div>
            @if ($errors->any())
                <ul style='color:red'>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul><br />
            @endif
        </div>

        

        <form action="{{ route('arquivos.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <br>

            <div>
                @foreach($processos as $processo)
                    Cliente: {{ $processo->cliente->CompanyName }} <br>
                    Processo: {{ $processo->NrProcesso }} / Ref. Cliente: {{ $processo->RefCliente }}
                    <input type="hidden" name="ProcessoID" id="ProcessoID" value="{{ $processo->ProcessoID }}">
                @endforeach
            </div>
            <div class="row">
                <div class="col-md-4">
                    <x-label for="tipofile" value="{{__('Tipo de Ficheiro') }}"/>
                    <select name="tipofile" id="tipofile" class="form-control">
                        <option value="bi">BI</option>
                        <option value="du">DU</option>
                        <option value="outro">Outro</option>
                    </select>
                    <!-- Input deve ser preenchido caso o tipo de documento é do tipo 'outro' -->
                    <br>
                    <x-input type="text" name="explica_outro" id="explica_outro" class="" placeholder="Preenchido quando a seleção for Outro" style="display: none;" />
                    <br>
                </div>
                <div class="col-md-4">
                    <x-label for="arquivos" class="form-label" value="{{__('Selecione os Arquivos')}}"/>
                    <x-input type="file" class="form-control" id="arquivos" name="arquivos[]" multiple required />
                </div>
                <br>
            </div>
            <x-button type="submit" class="btn btn-primary">
                {{__('Enviar')}}
            </x-button>
        </form>
        
        <!-- Tabela para listar os arquivos selecionados -->
        <div class="table-responsive mt-5">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Nome do Arquivo</th>
                        <th>Tipo do Arquivo</th>
                        <th>Tamanho (KB)</th>
                    </tr>
                </thead>
                <tbody id="arquivosList"></tbody>
            </table>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Função para verificar se a opção "Outro" foi selecionada e mostrar/ocultar a caixa de texto explica_outro
            $('#tipofile').on('change', function() {
                var selectedOption = $(this).val();
                if (selectedOption === 'outro') {
                    $('#explica_outro').show();
                } else {
                    $('#explica_outro').hide();
                }
            });

            // Chamar a função na carga inicial da página para garantir que a caixa de texto esteja escondida ou mostrada corretamente
            $('#tipofile').trigger('change');

            // Função para exibir a lista de arquivos selecionados na tabela
            $('#arquivos').on('change', function() {
                var fileList = this.files;
                var tableBody = $('#arquivosList');
                tableBody.empty();

                for (var i = 0; i < fileList.length; i++) {
                    var fileSize = (fileList[i].size / 1024).toFixed(2);
                    var fileName = fileList[i].name;

                    var row = $('<tr></tr>');
                    row.append('<td>' + fileName + '</td>');
                    row.append('<td>' + $('#tipofile').val() + '</td>');
                    row.append('<td>' + fileSize + ' KB</td>');

                    tableBody.append(row);
                }
            });
        });
    </script>
</x-app-layout>
