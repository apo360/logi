<!-- resources/views/csv/import.blade.php -->
<x-app-layout>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Importar Dados do CSV</div>

                    <div class="panel-body">
                        @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        @if(session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('import-csv') }}" enctype="multipart/form-data">
                            {{ csrf_field() }}

                            <div class="form-group">
                                <label for="csv_file">Selecione o arquivo CSV:</label>
                                <input type="file" name="csv_file" id="csv_file" class="form-control">
                            </div>

                            <button type="submit" class="btn btn-primary">Importar Dados</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
