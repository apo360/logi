<?php

namespace App\Http\Controllers;

use App\Services\CedulaService;
use Illuminate\Http\Request;
use GuzzleHttp\Client;

class AuthController
{
    function index(){

        return view('auth.verificar_cedula');
    }

    function verificar(Request $request){

        $client = new Client();

        $parametro = $request['cedula'];
        $chave = "345672010";


        $response = $client->request('GET', 'https://cdoangola.co.ao/api/despachante/'. urlencode($parametro), [
            'query' => ['chave' => $chave],
        ]);

        $body = $response->getBody();
        $data = json_decode($body, true);

        return view ('auth.confirm_cedula', ['dados' => $data]);

        /*$parametro = $request['cedula']; // Substitua pelo valor desejado

        $cedulaService = new CedulaService($parametro);

        try {
            $dados = $cedulaService->consultarCedula();
            // Faça algo com os dados obtidos, por exemplo, passar para a view
            return $dados;
            //return view ('auth.register', compact($dados));
        } catch (\Exception $e) {
            // Tratar exceções, por exemplo, redirecionar com mensagem de erro
            return redirect()->back()->with('error', 'Erro ao consultar cédula.');
        }*/

        
    }
}