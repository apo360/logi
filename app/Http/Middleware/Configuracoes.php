<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Services\ExchangeRateService;

class Configuracoes
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $cambioAtual = new ExchangeRateService();

        // Compartilhe a configuração com todas as views
        view()->share('Cambio', $cambioAtual->getExchangeRates());

        return $next($request);
    }

}
