<?php

namespace App\Http\Controllers;

use App\Helpers\DatabaseErrorHandler;
use App\Models\Customer;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\CustomerRequest;
use App\Models\Processo;

class CustomerController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customers = Customer::all();

        $tableData = [
            'headers' => ['Nº', 'Cod Cliente', 'Conta', 'Empresa / Nome', 'Telefone', 'Ações'],
            'rows' => [],
        ];
    
        foreach ($customers as $key => $customer) {
            $tableData['rows'][] = [
                $key + 1,
                $customer->CustomerID,
                $customer->AccountID,
                $customer->CompanyName,
                $customer->Telephone,
                '
                   <div class="inline-flex">
                    <a href="' . route('customers.show', ['customer' => $customer->Id]) . '" class="dropdown-item" data-toggle="tooltip" title="Detalhe"> <i class="fas fa-user"></i> </a>
                    <a href="' . route('customers.print', $customer->Id) . '" class="dropdown-item" data-toggle="tooltip" title="Imprimir pdf"> <i class="fas fa-upload"></i> </a>
                    <a href="' . route('customers.edit', $customer->Id) . '" class="dropdown-item" data-toggle="tooltip" title="Editar"> <i class="fas fa-edit"></i> </a>
                    <a href="' .  route('customers.destroy', $customer->Id) . '" class="dropdown-item" style="color: red;" onclick="event.preventDefault(); 
                        if (confirm("Tem certeza de que deseja apagar?")) 
                        { 
                            document.getElementById("delete-form-'.$customer->Id.'").submit(); 
                        }" data-toggle="tooltip" title="Apagar">
                        <i class="fas fa-trash" style="color: red;"></i>
                    </a>

                    <form id="delete-form-{{ $customer->Id }}" action="' . route('customers.destroy', $customer->Id) . '" method="POST" style="display: none;">
                        @csrf
                        @method('.'DELETE'.')
                    </form>

                   </div>         
                ',
            ];
        }
        return view('customer.customer_pesquisar', compact('tableData'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // chamar a stored procedure
        $newCustomerCode = Customer::generateNewCode();
        return view('customer.create', compact('newCustomerCode'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CustomerRequest $request)
    {

        try {
            // Inicia uma transação para garantir a integridade dos dados
            DB::beginTransaction();

            // Cria um novo registro de cliente na tabela 'customers' com os dados fornecidos
            $newCustomer = Customer::create($request->validated());

            // Confirma a transação, salvando as alterações no banco de dados
            DB::commit();

            // Define a mensagem de sucesso e redireciona para a página de edição do cliente
            return redirect()->route('customers.edit', ['customer' => $newCustomer->id])->with('success', 'Cliente criado com sucesso!');

        } catch (QueryException $e) { 
            DB::rollBack();

            return DatabaseErrorHandler::handle($e);
        } 

    }

    /**
     * Show the specified resource in storage
     */
    public function show(Customer $customer) {
        //Finf Customer with specified ID
        $processo = Processo::where('ClienteID', $customer->Id)->where('Status', 'Aberto')->get();
        $Countprocessos= count($processo);

        return view('customer.customer_show', compact('customer', 'processo', 'Countprocessos'));
        // $documentos =DocumentoController::getDocumentsByCustomerId($ClienteID)->paginate(15);
        // $factura_mes = DocumentoController::getTotalFacturaMesActual($ClienteID,$ano);
        // $total_facturas=$documentos->whereIn('TipoDoc',['FT','FR','NC','FG','ND'])->get();
        // foreach ($total_facturas as &$value){
        //     array_push($arrayTotalFacturas,floatval((string)$value));
        // };
        // dd($arrayTotalFacturas[2]->format('%d/%m'));
        // $total_facturas=(int)(str_replace(",",".",$total_facturas));
        // if(!empty($factura_mes)){
        //     $valor_medio_mensalidade =(float)((number_format(($total_facturas/$factura_mes), 2)));
        // }else{
        //     $valor_medio_mensalidade="0";
        // }
        // $data['clientes'] = $cliente;
        // $data['documentos']= $documentos;
        // $data['valor_medio_mensalidade'] =$valor_medio_mensalidade;
        /*return view("customer.show",compact(["cliente","documentos","valor_medio_mensalidade"]));*/
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit($customer)
    {

        $costumers = Customer::where('Id',$customer)->first();
        $paises = DB::table('Paises')->get();

        $countries = [];
        foreach ($paises as $pais_) {
            $countries[$pais_->codigo] = $pais_->pais.'['.$pais_->codigo.']';
        }
        $selectedCountry = 'AO';

        $provincias = DB::table('Provincias')->get();
        $provinces = [];
        foreach ($provincias as $prov) {
            $provinces[$prov->ID] = $prov->Nome;
        }
        $selectedProvinces = '11';

        $paymentModes = [
            'Cash' => 'Cash',
            'Credit Card' => 'Credit Card',
            'Bank Transfer' => 'Bank Transfer',
            // Add more options as needed
        ];
        
        $ivaExercises = [
            'Normal' => 'Normal',
            'Especial(taxa)' => 'Especial(taxa)',
            'Isento' => 'Isento',
        ];

        $typeContacts = [];
        return view('customer.customer_edit', compact('costumers', 'countries', 'selectedCountry','provinces', 'selectedProvinces', 'paymentModes', 'ivaExercises', 'typeContacts'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CustomerRequest $request, Customer $customer)
    {
        
        try {
            DB::beginTransaction();
            
            // Atualize os atributos do cliente com base nos dados recebidos no $request
            Customer::where('CustomerID',$customer->CustomerID)->update($request->validated());

            DB::commit();

            // Redirecione para a página de listagem de clientes
            return redirect()->route('customers.index')->with('success', 'Cliente atualizado com sucesso!');;
        } catch (QueryException $e) {
            DB::rollBack();

            return $this->handleDatabaseErrors($e);
        } 

    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        try {
            DB::beginTransaction();

            // Check if the customer has any related invoices or processes
            if ($customer->invoices()->exists() || $customer->processes()->exists()) {
                // If the customer has related invoices or processes, don't delete and alert the administrator.
                return redirect()->route('customers.index')->with('error', 'O cliente possui faturas ou processos relacionados e não pode ser removido!');
            }

            // If the customer does not have any related invoices or processes, proceed with deletion
            $customer->delete();

            DB::commit();

            // Redirect to the customer listing page
            return redirect()->route('customers.index')->with('success', 'Cliente removido com sucesso!');

        } catch (QueryException $e) {
            DB::rollBack();

            return $this->handleDatabaseErrors($e);
        }
    }


    public function print(Customer $customer){
        if(!$customer ||!$customer instanceof Customer ){
            abort(403, "Não autorizado!");
        }
        else{
            return view("print", compact(['customer']));
        }
        
    }

    // Pegar processos por cliente.
    public function getProcessoByCustomer($CustomerId, $status){
        $processo = Processo::where('ClienteID', $CustomerId)->where('Status', $status)->get();
        
        return response()->json(['processo' => $processo]); 
    }


    public function obterUltimoClienteAdicionado()
    {
        // Lógica para obter o ID do último cliente adicionado
        $ultimoCliente = Customer::latest()->first();
        
        return response()->json(['cliente_id' => $ultimoCliente->id]);
    }
}
