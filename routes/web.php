<?php

use App\Http\Controllers\ArquivoController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CsvController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DepartamentoController;
use App\Http\Controllers\DocumentoController;
use App\Http\Controllers\EmpresaController;
use App\Http\Controllers\FaltasController;
use App\Http\Controllers\FuncionarioController;
use App\Http\Controllers\MercadoriaController;
use App\Http\Controllers\ProcessoController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\UserController;
use App\Models\Funcionario;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/', function () { return view('welcome'); });

Route::get('/verifica_despachante', [AuthController::class, 'index'])->name('show.despachante');

Route::post('/confirmar', [AuthController::class, 'verificar'])->name('consultar.cedula');


//-------------------------------------------------------------------------------------------------------------//
//******************************************* Rotas Autenticadas ********************************************* */
//-------------------------------------------------------------------------------------------------------------//



Route::middleware([ 'auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {  

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('checkEmpresa');

    Route::resources(
        [ 
            'customers' => CustomerController::class, // Rotas dos Clientes 
            'funcionarios' => FuncionarioController::class, // Rotas de Funcionarios
            'processos' => ProcessoController::class, // Rotas dos Processos 
            'produtos' => ProdutoController::class, // Rotas dos Produtos/Serviços
            'mercadorias' => MercadoriaController::class, //  Rotas das Mercadorias
            'arquivos' => ArquivoController::class, // Rotas dos Ficheiros
            'departamentos' => DepartamentoController::class, // Rotas para Departamentos
            'usuarios' => UserController::class, //
            'empresa' => EmpresaController::class, //
        ]
    );

    // Rotas adicionais para empresa
    Route::get('/empresa/subscricao', [EmpresaController::class, 'SubscricaoModulo'])->name('empresas.subscricao')->middleware('checkEmpresa');
    Route::post('/empresa/processar-subscricao', [EmpresaController::class, 'processarSubscricao'])->name('processar-subscricao')->middleware('checkEmpresa');
    
    Route::post('/password/update', [UserController::class, 'updatePassword'])->name('password.update');

    
    // Rota para Inserir Grupo/Categoria de Produtos
    Route::post('/produto/grupo/insert', [ProdutoController::class, 'InsertGrupo'])->name('insert.grupo.produto');

    Route::get('LivroPonto', [FaltasController::class, 'LivroPontoOpen'])->name('ponto');

    Route::get('/MapaFerias&Licença', [FaltasController::class,'MapaFL'])->name('ferias.mapa');
    // Get Processo By CustomerID and Status

    /**Rotas de Configurações */

    Route::group(['prefix' => 'Configuracoes'], function() {
        Route::get('/RH', function() {
            return view('configuracoes.config_rh');
        });
    });

    Route::get('/funteste', function(){
        $fun = Funcionario::find(1);
        return $fun;
    });
    
    # Route for Print Customer
    Route::post('print-customer/{customer}', [CustomerController::class, 'print'])->name('customers.print');
    Route::get('/clientes/ultimo', [CustomerController::class, 'obterUltimoClienteAdicionado'])->name('clientes.obter_ultimo');

    # Route for Print Processos
    Route::get('print-processo/{processo}', [ProcessoController::class, 'print'])->name('processos.print');
    # Route for Print Processos
    Route::get('factura-processo/{processo}', [ProcessoController::class, 'print'])->name('processos.factura');

    // Grupo de Rotas de Documentos
    Route::get('documentos/criar-documento', [DocumentoController::class, 'index'])->name('create.documento');
    Route::post('documentos/inserir-documento', [DocumentoController::class, 'store'])->name('documentos.store');

    Route::get('/importar', [CsvController::class, 'import_view'])->name('edit.import');
    Route::get('/exportar', [CSVController::class, 'export_view'])->name('edit.export');
    Route::get('/export-csv', [CSVController::class, 'exportCSV'])->name('export-csv');
    Route::post('/import-csv', [CSVController::class, 'importCSV'])->name('import-csv');

});
