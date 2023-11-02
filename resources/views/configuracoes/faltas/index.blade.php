<x-app-layout>
    <div class="container">
        config faltas

        <ul>
            @foreach($configuracoesFaltas as $falta)
                <li>{{$falta->descricao}}</li>
            @endforeach
        </ul>
    </div>
</x-app-layout>