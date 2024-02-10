<?php

namespace App\Helpers;

use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;

class DatabaseErrorHandler
{
    public static function handle(\Throwable $e)
    {
        if ($e instanceof QueryException) {
            // Log do erro de banco de dados
            Log::error('Erro de banco de dados: ' . $e->getMessage());

            // Exibir mensagem de erro para o usuário
            return redirect()->back()->with('error', 'Ocorreu um erro de banco de dados. Por favor, tente novamente mais tarde. ' . $e->getMessage());

            // OU

            // Redirecionar para uma página de erro personalizada
            //return redirect()->route('error.page');
        } else {
            // Log de outros erros
            Log::error('Erro não tratado: ' . $e->getMessage());

            // Exibir mensagem de erro para o usuário
            return redirect()->back()->with('error', 'Ocorreu um erro. Por favor, tente novamente mais tarde.');

            // OU

            // Redirecionar para uma página de erro personalizada
            //return redirect()->route('error.page');
        }
    }
}
