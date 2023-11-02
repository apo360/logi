<?php

namespace App\Http\Controllers;

use App\Utilities\DatabaseUtility;
use Illuminate\Http\Request;
use Illuminate\Http\Response as HttpResponse;

class CsvController extends Controller
{
    
    public function export_view(){

        return view('dados.export');
    }

    public function import_view(Request $request){

        return view('dados.import');
    }

    /**
     * $headers = ['Coluna1', 'Coluna2', 'Coluna3']; // Substitua pelos nomes das colunas
     */
    public function exportCSV($tableName, $filename, $headers)
    {
        $data = DatabaseUtility::exportData($tableName);
        
        // Abra um arquivo temporário para escrever
        $file = fopen('php://temp', 'w');

        // Escreva os cabeçalhos das colunas (se aplicável)
        fputcsv($file, $headers);

        // Escreva os dados no arquivo CSV
        foreach ($data as $row) {
            fputcsv($file, (array)$row);
        }

        // Retorne o arquivo CSV como uma resposta HTTP
        rewind($file);
        $csv = stream_get_contents($file);
        fclose($file);

        return response($csv, HttpResponse::HTTP_OK)->header('Content-Type', 'text/csv')
            ->header('Content-Disposition', 'attachment; filename="' . $filename . '"');
    }

    public function importCSV(Request $request, $tableName)
    {

        if ($request->hasFile('csv_file')) {
            $file = $request->file('csv_file');

            // Verifique se o arquivo é válido (por exemplo, tamanho, formato)
            if ($file->isValid() && $file->getClientOriginalExtension() === 'csv') {
                $data = [];

                // Abra o arquivo CSV para leitura
                $handle = fopen($file->getRealPath(), 'r');

                // Pule o cabeçalho (se aplicável)
                fgetcsv($handle);

                // Leia os dados do arquivo CSV
                while (($row = fgetcsv($handle)) !== false) {
                    $data[] = $row;
                }

                fclose($handle);

                // Importe os dados para a tabela
                $result = DatabaseUtility::importData($tableName, $data);

                if ($result) {
                    // Importação bem-sucedida
                    return redirect()->route('sua_rota')->with('success', 'Dados importados com sucesso.');
                } else {
                    // Algo deu errado durante a importação
                    return redirect()->back()->with('error', 'Erro durante a importação de dados.');
                }
            } else {
                // Arquivo inválido
                return redirect()->back()->with('error', 'Formato de arquivo inválido.');
            }
        } else {
            // Nenhum arquivo enviado
            return redirect()->back()->with('error', 'Nenhum arquivo enviado.');
        }
    }

}
