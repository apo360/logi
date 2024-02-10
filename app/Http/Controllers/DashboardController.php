<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index(){

        // Controlo de Login -- 
        $user = Auth::user();

        // Verifique se a senha está expirada ou se é o primeiro login
        if (!$user->password_change_required || $user->created_at == $user->updated_at || $user->password_expired <= now()) {
            // Redirecione para o processo de reset de senha do Jetstream
            return view('auth.change-password');
        }else{
            return view('dashboard');
        }
    }
}
