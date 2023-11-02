<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Logigate</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        
    </head>
    <body class="">

        <!-- Header Menu -->
        <div class="header_fix">
            <div class="container">

                <div class="logotipo">
                    <a href="">Logotipo</a>
                </div>

                <nav>
                    <ul class="menu">
                        <li class="menu_item"> <a href="">Modulos</a> </li>
                        <li class="menu_item"> <a href="">Preços</a> </li>
                        <li class="menu_item"> <a href="">Funcionalidades</a> </li>
                        <li class="menu_item"> <a href="">Suporte ao Cliente</a> </li>
                        @if (Route::has('login'))
                            @auth
                                <li class="menu_item item_dashboard">
                                    <a href="{{ url('/dashboard') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Pagina Inicial</a>
                                </li>
                            @else
                                <li class="menu_item item_login">
                                    <a href="{{ route('login') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Acesso</a>
                                </li>
                                @if (Route::has('register'))
                                    <li class="menu_item item_register">
                                        <a href="{{ route('register') }}" class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Experimente Grátis</a>
                                    </li>
                                @endif
                            @endauth
                        @endif
                    </ul>
                </nav>
            </div>
        </div>

        <!-- Main -->
        <div class="container">
            <div class="col-md-12 text-center">
                <h1>Software de Processos e Facturação Online</h1>
                <p>O Logigate é um software online ...</p>
                <br>
                <a href="">Experimente Grátis</a>
                <br>
                <span> 30 Dias Gratuitos Sem Compromisso</span>
            </div>
        </div>

        <!-- Footer Rodapé -->
        
        
    </body>
</html>
