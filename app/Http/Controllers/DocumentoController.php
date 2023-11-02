<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\DocumentStatus;
use App\Models\Invoice;
use App\Models\Line;
use App\Models\Produto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DocumentoController extends Controller
{

    private function HashCode($hashIncrement = null) {
        
        $hashCode = '';

        return $hashCode;
    }

    public function index(){

        $clientes = Customer::all();

        $produtos = Produto::all();

        $tipoDocumentos = DB::table('InvoiceType')->get();

        return view('Documentos.create_documento', compact('clientes', 'tipoDocumentos', 'produtos'));
    }

    public function FacturasEmitir(Request $request)
    {
        // Tipos de Facturas a emitir (Factura: Normal, Proforma, )
        // Criar um novo registro na tabela "Invoice"
        $invoice = Invoice::create([
            'InvoiceNo' => $request->input('InvoiceNo'),
            'Hash' => $request->input('Hash'),
            'HashControl' => $request->input('HashControl'),
            'Period' => $request->input('Period'),
            'InvoiceDate' => $request->input('InvoiceDate'),
            'InvoiceType' => $request->input('InvoiceType'),
            'SourceID' => $request->input('SourceID'),
            'SystemEntryDate' => $request->input('SystemEntryDate'),
            'CustomerID' => $request->input('CustomerID'),
        ]);

        // Adicione o relacionamento com DocumentStatus e Line, se necessário

        $documentStatus = new DocumentStatus([
            'InvoiceNo' => $request->input('InvoiceNo'),
            // Outros campos de DocumentStatus
        ]);
        
        $invoice->documentStatus()->save($documentStatus);

        $linesData = $request->input('lines'); // Suponha que $linesData seja uma matriz de dados das linhas

        foreach ($linesData as $lineData) {
            $line = new Line([
                'InvoiceNo' => $request->input('InvoiceNo'),
                'LineNumber' => $lineData['LineNumber'],
                // Outros campos de Line
            ]);

            $invoice->lines()->save($line);
        }

        

        return response()->json(['message' => 'Invoice created successfully']);
    

    }
}
