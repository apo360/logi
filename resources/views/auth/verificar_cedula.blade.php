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
        <form method="POST" action="{{ route('consultar.cedula') }}">
            @csrf
            <label for="cedula">Pesquisar por Cedula ou NIF</label>
            <input type="text" name="cedula" id="cedula">
            <button type="submit">Consultar Cédula</button>
        </form>
    </body>
<html>
