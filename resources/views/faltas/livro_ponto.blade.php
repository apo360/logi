<x-app-layout>
    <x-slot name="header">
        <x-breadcrumb title="Livro" breadcrumb="Livro de Ponto Eletrônico" />
        <div class="row">
            <div class="col-md-6">
                Data: {{ \Carbon\Carbon::now()->format('Y-m-d') }} <!-- Exibe a data atual -->
            </div>
            <div class="col-md-6">
                Hora: {{ \Carbon\Carbon::now()->format('H:i:s') }} <!-- Exibe a hora atual -->
            </div>
            <div class="col-md-6">
                Status:
                <!-- Determine o status com base no horário atual -->
                @php
                    $horaAtual = \Carbon\Carbon::now()->format('H:i');
                    $status = '';

                    if ($horaAtual >= '08:00' && $horaAtual <= '08:29') {
                        $status = 'Entrada';
                    } elseif ($horaAtual >= '08:30' && $horaAtual <= '09:00') {
                        $status = 'Atraso de Entrada';
                    } elseif ($horaAtual >= '09:01' && $horaAtual <= '10:00') {
                        $status = 'Falta Meio Dia';
                    } elseif ($horaAtual >= '10:01') {
                        $status = 'Falta Completa';
                    }
                @endphp

                <!-- Exiba o status com base na lógica acima -->
                @if($status == 'Entrada')
                    <span class="badge badge-success">Entrada</span>
                @elseif($status == 'Atraso de Entrada')
                    <span class="badge badge-warning">Atraso de Entrada</span>
                @elseif($status == 'Falta Meio Dia')
                    <span class="badge badge-danger">Falta Meio Dia</span>
                @elseif($status == 'Falta Completa')
                    <span class="badge badge-danger">Falta Completa</span>
                @endif
            </div>
        </div>
    </x-slot>

    <div class="container">
        <div class="col-md-12">
            <div class="row">
                <table class="table table-sm">
                    <thead>
                        <th>Funcionário</th>
                        <th>...</th>
                    </thead>
                    <tbody>
                        @foreach($funcionarios as $funcionario)
                            <tr>
                                <td>{{$funcionario->Nome}} {{$funcionario->apelido}}</td>
                                <td>
                                    <button class="btn btn-success" value="P">Presente</button>
                                    <button class="btn btn-danger" value="F">Falta</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
