<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Logigate</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        
        <style>
            body {
                font-family: 'Arial', sans-serif;
                margin: 0;
                padding: 0;
                box-sizing: border-box;
            }

            .container {
                width: 80%;
                margin: 0 auto;
            }

            .header {
                background-color: #333;
                color: white;
                padding: 10px 0;
            }

            .logo {
                font-size: 1.5rem;
                font-weight: bold;
            }

            nav .container {
                display: flex;
                align-items: center;
            }

            .menu {
                list-style-type: none;
                display: flex;
                margin: 0;
                padding: 0;
            }

            .menu li {
                margin-right: 20px;
            }

            .menu a {
                text-decoration: none;
                color: white;
                transition: color 0.3s ease;
            }

            .menu a:hover {
                color: #FFD700; /* Change to your preferred hover color */
            }

            .main-content {
                padding: 20px 0;
            }

        </style>
    </head>
    <body class="">

        <!-- Header Menu -->
        <div class="header">
            <div class="container">
                <div class="logo">Logotipo</div>
                <nav>
                    <ul class="menu">
                        <li class="menu_item"> <a href="#">Modulos</a> </li>
                        <li class="menu_item"> <a href="#">Preços</a> </li>
                        <li class="menu_item"> <a href="#">Funcionalidades</a> </li>
                        <li class="menu_item"> <a href="#">Suporte ao Cliente</a> </li>
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
            <div class="col-md-12 text-center section_main">
                <h1>Software de Processos e Facturação Online</h1>
                <p>O Logigate é um software online ...</p>
                <br>
                <a href="{{ route('register') }}">Experimente Grátis</a>
                <br>
                <span> 30 Dias Gratuitos Sem Compromisso</span>

            <div class="section_modulo">
                Processos
                Recursos Humanos
                Facturação
                ...
            </div>
            <div class="section_precos">
                Plano Basico
                Plano Mais Basico
                Plano Premiumn
                ...
            </div>
            <div class="section_funcionalidade">

            </div>
            <div class="section_suporte">
                <div>
                    <span>Icon</span>
                    <span>CallCenter</span>
                    <span>Atendimento das 09H às 15H</span>
                </div>
                <div>
                    <span>Icon</span>
                    <span>Whatsaap</span>
                    <span>Atendimento das 09H às 18H</span>
                </div>
                <div>
                    <span>Icon</span>
                    <span>Skype</span>
                    <span>Por Marcação</span>
                </div>
            </div>
        </div>

        <!-- Footer Rodapé -->
        
    </body>
</html>
