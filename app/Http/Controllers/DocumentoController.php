<?php

namespace App\Http\Controllers;

use App\Helpers\DatabaseErrorHandler;
use App\Http\Requests\SalesInvoiceRequest;
use App\Models\Customer;
use App\Models\InvoiceType;
use App\Models\Produto;
use App\Models\SalesDocTotal;
use App\Models\SalesInvoice;
use App\Models\SalesLine;
use App\Models\SalesStatus;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DocumentoController extends Controller
{

    private function signAndSaveHash($invoiceId)
    {
        // Obtenha o modelo SalesInvoice
        $invoice = SalesInvoice::find($invoiceId);
        $DocTotal = SalesDocTotal::where('documentoID',$invoiceId)->first;

        // Campos a serem assinados
        $fieldsToSign = [$invoice->invoice_date, $invoice->getSystemEntryDate, $invoice->invoice_no, $DocTotal->gross_total,];

        // Crie a mensagem a ser assinada
        $messageToSign = implode(';', $fieldsToSign);

        // Salve a mensagem em um arquivo temporário
        $filePath = storage_path('app/temp_message.txt');
        file_put_contents($filePath, $messageToSign);

        // Caminho da chave privada
        $privateKeyPath = 'ocean_system/sea/weave/fechadura_rest.pem';

        // Assine a mensagem
        openssl_sign($messageToSign, $signature, file_get_contents($privateKeyPath), OPENSSL_ALGO_SHA1);

        // Codifique para base64
        $base64Signature = base64_encode($signature);

        // Atualize o modelo SalesInvoice com o hash assinado
        $invoice->hash = $base64Signature;

        $invoice->save();
    }
    /**
     * Display a listing of the resource.
     */
    public function index(){

        $clientes = Customer::all();

        $produtos = DB::table('Listar_Produtos')->get();

        $tipoDocumentos = DB::table('InvoiceType')->get();

        return view('Documentos.create_documento', compact('clientes', 'tipoDocumentos', 'produtos'));
    }

     /**
     * Show the form for creating a new resource.
     */
    public function store(Request $request)
    {
        // Inicializar as variaveis
        $SumTax = $SumNetTotal = $SumGrossTotal = 0;

        DB::beginTransaction();

        $invoiceTypeID = (new InvoiceType())->getID($request->input('document_type'));

        try {
            
            // Validação e criação da fatura de venda
            //$salesInvoiceData = $request->validated();

            // Executar o procedimento armazenado para obter o próximo número de fatura
            $result = DB::select("CALL GenerateInvoiceNo(?)", [$invoiceTypeID]);

            $salesInvoice = SalesInvoice::create([
                'invoice_no' => $result[0]->InvoiceNo,
                'hash' => '0',
                'hash_control' => '0',
                'period' => 1,
                'invoice_date' => $request->input('invoice_date'),
                'self_billing_indicator' => 0,
                'cash_vat_scheme_indicator' => 0,
                'third_parties_billing_indicator' => 0,
                'invoice_type_id' => $invoiceTypeID,
                'source_id' => Auth::user()->id,
                'system_entry_date' => Carbon::now()->toDateTimeString(), // ou 'nullable|date_format:Y-m-d H:i:s',
                'customer_id' => $request->input('customer_id'), 
            ]);

            SalesStatus::create([
                'invoice_status' => 'N',
                'invoice_status_date' => $request->input('invoice_date'),
                'source_id' => Auth::user()->id,
                'source_billing' => 'P',
            ]);

            // Obter dados da tabela
            $dadosDaTabela = $request->input('dadostabela');

            // Certificar-se de que $dadosDaTabela é uma string antes de tentar decodificar
            if (is_string($dadosDaTabela)) {
                // Remover aspas duplas ao redor da string JSON
                $dadosDaTabela = trim($dadosDaTabela, '"');

                // Decodificar a string JSON para obter um array associativo
                $dadosDecodificados = json_decode($dadosDaTabela, true);

                // Certificar-se de que $dadosDecodificados é um array
                if (is_array($dadosDecodificados)) {
                    // Usar $dadosDecodificados para a lógica de inserção no banco de dados
                    foreach ($dadosDecodificados as $key => $dadosDaLinha) {
                        // Lógica para inserir no banco de dados

                        $produto = Produto::findOrFail($dadosDaLinha['productId']);
                        SalesLine::create([
                            'line_number' => $key + 1,
                            'documentoID' => $salesInvoice->id,
                            'productID' => $dadosDaLinha['productId'],
                            'quantity' => $dadosDaLinha['quantidade'],
                            'unit_of_measure' => $produto->unidade,
                            'unit_price' => $dadosDaLinha['preco'],
                            'tax_point_date' => Carbon::now()->toDateTimeString(),
                            'credit_amount' => $dadosDaLinha['total'],
                        ]);

                        $SumTax += $produto->taxAmount;
                        $SumNetTotal += $produto->venda_sem_iva*$dadosDaLinha['quantidade'];
                        $SumGrossTotal += $dadosDaLinha['total'];
                    }
                } else {
                    // Tratar caso em que $dadosDecodificados não é um array
                    // ...
                }
            }

            SalesDocTotal::create([
                'tax_payable' => $SumTax, // total das taxas somatório das taxas dos produtos
                'net_total' => $SumNetTotal, // total de preços sem taxa
                'gross_total' => $SumGrossTotal, // total de preços com taxa
                'documentoID' => $salesInvoice->id,
            ]);


            // Assinar o campo Hash
            $this->signAndSaveHash($salesInvoice->id);

            DB::commit();

            return response()->json(['message' => 'Fatura de venda criada com sucesso'], 201);

        } catch (QueryException $e) { 
            DB::rollBack();

            return DatabaseErrorHandler::handle($e);
        } 
        
    }
}
