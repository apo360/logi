<?php

use App\Http\Controllers\ArquivoController;
use App\Http\Controllers\CsvController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DepartamentoController;
use App\Http\Controllers\DocumentoController;
use App\Http\Controllers\FaltasController;
use App\Http\Controllers\FuncionarioController;
use App\Http\Controllers\MercadoriaController;
use App\Http\Controllers\ProcessoController;
use App\Http\Controllers\ProdutoController;
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

Route::middleware([ 'auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {

    Route::get('/dashboard', function () {return view('dashboard');})->name('dashboard');

    Route::resources(
        [ 
            'customers' => CustomerController::class, // Rotas dos Clientes 
            'funcionarios' => FuncionarioController::class, // Rotas de Funcionarios
            'processos' => ProcessoController::class, // Rotas dos Processos 
            'produtos' => ProdutoController::class, // Rotas dos Produtos/Serviços
            'mercadorias' => MercadoriaController::class, //  Rotas das Mercadorias
            'arquivos' => ArquivoController::class, // Rotas dos Ficheiros
            'departamentos' => DepartamentoController::class // Rotas para Departamentos
        ]
    );

    Route::get('LivroPonto', [FaltasController::class, 'LivroPontoOpen'])->name('ponto');
    Route::get('/MapaFerias&Licença', [FaltasController::class,'MapaFL'])->name('ferias.mapa');
    // Get Processo By CustomerID and Status

    /**Rotas de Configurações */

    Route::get('/configuracoes/faltas', [ConfiguracaoFaltasController::class,'index'])->name('configuracoes.faltas');

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

    # Route for Print Processos
    Route::get('print-processo/{processo}', [ProcessoController::class, 'print'])->name('processos.print');

    # Route for Print Processos
    Route::get('factura-processo/{processo}', [ProcessoController::class, 'print'])->name('processos.factura');

    // Grupo de Rotas de Documentos
    Route::get('documentos/criar-documento', [DocumentoController::class, 'index'])->name('create.documento');

    Route::get('/importar', [CsvController::class, 'import_view'])->name('edit.import');
    Route::get('/exportar', [CSVController::class, 'export_view'])->name('edit.export');
    Route::get('/export-csv', [CSVController::class, 'exportCSV'])->name('export-csv');
    Route::post('/import-csv', [CSVController::class, 'importCSV'])->name('import-csv');

});
