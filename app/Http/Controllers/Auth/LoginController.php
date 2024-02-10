<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\AuthLog;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Laravel\Fortify\Fortify;

class LoginController extends Controller
{

    public function showChangePasswordForm()
    {
        return view('auth.change-password');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (auth()->attempt($credentials)) {
            $user = auth()->user();

            // Verifique se a senha está expirada ou se é o primeiro login
            if (!$user->password_change_required || $user->created_at == $user->updated_at || $user->password_expired <= now()) {
                // Redirecione para o processo de reset de senha do Jetstream
                return 'teste';
            }
        }

        throw ValidationException::withMessages([
            'email' => [trans('auth.failed')],
        ]);

        // Dentro do método de login
        AuthLog::create([
            'user_id' => $user->id,
            'action_type' => 'login',
            'ip_address' => request()->ip(),
        ]);
    }

    public function handleLogin($user)
    {
 
        // Outras lógicas de pós-login, se necessário...
    }
}
