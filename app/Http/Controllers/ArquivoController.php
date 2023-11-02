<?php

// app/Http/Controllers/ArquivoController.php

namespace App\Http\Controllers;

use App\Models\Arquivo;
use Illuminate\Http\Request;
use App\Http\Requests\ArquivoRequest;
use Illuminate\Support\Facades\Storage;
use App\Helpers\FileHelper;
use App\Models\Processo;

class ArquivoController extends Controller
{

    // ...
    public function edit($processo){

        $processos = Processo::where('ProcessoID',$processo)->get();

        return view('processo.upload', compact('processos'));
    } 

    /**
     * Store a newly created resource in storage.
     */
    public function store(ArquivoRequest $request)
    {
        // Obtém os arquivos enviados pelo usuário
        $arquivos = $request->file('arquivos');

        // Percorre os arquivos e salva-os no servidor
        foreach ($arquivos as $arquivo) {
            // Salva o arquivo e obtém o caminho completo no armazenamento seguro
            $caminhoArquivo = FileHelper::saveFile($arquivo, $request->clienteID, $request->ProcessoID);

            // Salva os detalhes do arquivo no banco de dados
            Arquivo::create([
                'ProcessoID' => $request->ProcessoID,
                'Nome' => $arquivo->getClientOriginalName(),
                'Tipo' => $request->tipofile,
                'Caminho' => $caminhoArquivo,
                'data' => now(),
            ]);
        }

        return redirect()->back()->with('success', 'Arquivos enviados com sucesso!');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ArquivoRequest $request, Arquivo $arquivo)
    {
        $validatedData = $request->validated();

        // Verifica se um novo arquivo foi enviado para atualização
        if ($request->hasFile('arquivo')) {
            // Faz o upload do novo arquivo para o sistema de armazenamento (por exemplo, disco público)
            $path = $request->file('arquivo')->store('public');

            // Deleta o arquivo antigo do sistema de armazenamento
            Storage::delete($arquivo->Caminho);

            // Atualiza o registro do arquivo no banco de dados com as novas informações
            $arquivo->update([
                'ProcessoID' => $validatedData['ProcessoID'],
                'Nome' => $validatedData['Nome'],
                'Tipo' => $validatedData['Tipo'],
                'Caminho' => $path,
                'data' => $validatedData['data'],
            ]);
        } else {
            // Se não houver um novo arquivo enviado, apenas atualiza as outras informações no banco de dados
            $arquivo->update([
                'ProcessoID' => $validatedData['ProcessoID'],
                'Nome' => $validatedData['Nome'],
                'Tipo' => $validatedData['Tipo'],
                'data' => $validatedData['data'],
            ]);
        }

        return redirect()->back()->with('success', 'Arquivo atualizado com sucesso.');
    }

    // ...
}

