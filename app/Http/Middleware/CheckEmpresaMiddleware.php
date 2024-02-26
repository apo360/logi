<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CheckEmpresaMiddleware
{
    protected $user;

    public function __construct()
    {
        $this->user = Auth::user();
    }

    public function handle($request, Closure $next)
    {
        if ($this->user && $this->user->isAdmin()) {
            if ($this->user->empresa && $this->user->empresa->dadosPreenchidos()) {
                return $next($request);
            } else {
                return redirect()->route('empresa.create');
            }
        }elseif ($this->user && $this->user->isNormal()) {
            if($this->user->status == 'Activo'){
                return $next($request);
            }else{
                // Retorna a pagina de Erro que o usuario não está autorizado.
            }
            
        }

        abort(403, 'Unauthorized');
    }

}
