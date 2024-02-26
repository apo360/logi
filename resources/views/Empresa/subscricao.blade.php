<x-config-layout>
    <div class="container">
        <x-slot name="header">
            <x-breadcrumb title="Subscrições" breadcrumb="Subscrições" />
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

        <h1>Escolha os Módulos e Submódulos</h1>

        <form action="{{ route('processar') }}" method="post">
            @csrf

            @foreach($modules as $module)
                <div>
                    <label>
                        <input type="checkbox" name="modules[]" value="{{ $module->id }}"> {{ $module->module_name }}
                    </label>

                    @if($module->submodules->count() > 0)
                        <ul>
                            @foreach($module->submodules as $submodule)
                                <li>
                                    <label>
                                        <input type="checkbox" name="submodules[]" value="{{ $submodule->id }}"> {{ $submodule->module_name }}
                                    </label>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            @endforeach

            <button type="submit">Processar Subscrição</button>
        </form>

    </div>
    <x-config-layout>