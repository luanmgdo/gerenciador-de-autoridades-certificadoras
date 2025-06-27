<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ac;
use App\Models\AcN2;
use App\Models\Ar;
use Illuminate\Support\Facades\Storage;

class JsonImportController extends Controller
{
    public function index()
    {
        return view('upload_file.import');
    }

    public function store(Request $request)
    {
        // Validar o arquivo JSON
        $validated = $request->validate([
            'json_file' => 'required|file|mimes:json|max:10240',
        ]);

        // Armazenar o arquivo JSON
        $path = $request->file('json_file')->storeAs('uploads', 'data.json');

        // Ler o conteúdo do arquivo JSON
        $jsonContent = Storage::get($path);
        $data = json_decode($jsonContent, true);

        // Verificar se o JSON foi processado corretamente
        if (!$data) {
            return back()->withErrors(['json_file' => 'O arquivo JSON não pôde ser processado.']);
        }

        // Processar e armazenar os dados no banco
        $this->importData($data);

        // Redirecionar com sucesso
        return back()->with('success', 'Arquivo JSON importado com sucesso!');
    }

   private function importData(array $data)
    {
        // Criar a AC raiz
        $acRoot = Ac::create([
            'tipo' => $data['tipo'],
            'telefone' => $data['telefone'],
            'situacao' => $data['situacao'],
            'nome' => $data['nome'],
            // 'id' => $data['id'],       
        ]);

        // Processar as entidades vinculadas à AC raiz (AC 1º Nível, AC 2º Nível e ARs)
        if (isset($data['entidades_vinculadas'])) {
            foreach ($data['entidades_vinculadas'] as $acData) {
                // Criar AC Nível 1 ou Nível 2
                $acN2 = AcN2::create([
                    'tipo' => $acData['tipo'],
                    'situacao' => $acData['situacao'],
                    'nome' => $acData['nome'],
                    // 'id' => $acData['id'],
                    'ac_id' => $acRoot->id, // Relacionar com AC raiz
                ]);

                // Verificar se existem entidades vinculadas (AC N2 ou ARs)
                if (isset($acData['entidades_vinculadas'])) {
                    foreach ($acData['entidades_vinculadas'] as $arData) {
                        // Criar AR
                        Ar::create([
                            'tipo' => $arData['tipo'],
                            'situacao' => $arData['situacao'],
                            'nome' => $arData['nome'],
                            // 'id' => $arData['id'],
                            'ac_n2_id' => $acN2->id, // Relacionar com AC N2
                        ]);
                    }
                }
            }
        }
        
    }

}
