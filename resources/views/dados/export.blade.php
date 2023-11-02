<!-- resources/views/csv/export.blade.php -->
<x-app-layout>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Exportar Dados para CSV</div>

                    <div class="panel-body">
                        <form method="POST" action="{{ route('export-csv') }}">
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-primary">Exportar Dados</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
