<?php
namespace App\Http\Controllers;

use App\Models\AcN2;
use App\Models\Ar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\QueryException;
use chillerlan\QRCode\QRCode;
use chillerlan\QRCode\QROptions; 

class ArController extends Controller
{
    public function index()
    {
        try {
            $ars = Ar::all();
            return view('ar.index', compact('ars'));
        } catch (\Exception $e) {
            // Log de erro
            Log::error('Erro ao buscar ARs: ' . $e->getMessage());
            return back()->with('error', 'Ocorreu um erro ao buscar os ARs.');
        }
    }

    public function create()
    {
        try {
            $acN2s = AcN2::all();
            return view('ar.create', compact('acN2s'));
        } catch (\Exception $e) {
            Log::error('Erro ao carregar o formulário de criação: ' . $e->getMessage());
            return back()->with('error', 'Ocorreu um erro ao carregar o formulário de criação.');
        }
    }

    public function store(Request $request)
    {
        // Validação
        $validated = $request->validate([
            'nome' => 'required',
            'cnpj' => 'required',
            'tipo' => 'required',
            'situacao' => 'required',
            'credenciamento' => 'required',
            'telefone' => 'required',
            'ac_n2_id' => 'required|exists:ac_n2,id',
        ]);

        try {
            // Criar AR
            Ar::create($request->all());
            return redirect()->route('ar.index')->with('success', 'Autoridade de Registro criada com sucesso!');
        } catch (QueryException $e) {
            // Log de erro para erros no banco
            Log::error('Erro ao criar AR: ' . $e->getMessage());
            return back()->with('error', 'Ocorreu um erro ao tentar criar a Autoridade de Registro.');
        } catch (\Exception $e) {
            // Log de erro para outros tipos de exceções
            Log::error('Erro inesperado ao criar AR: ' . $e->getMessage());
            return back()->with('error', 'Ocorreu um erro inesperado. Tente novamente.');
        }
    }

    public function show($id)
    {
        try {
            // Buscar a AR associada
            $ar = Ar::findOrFail($id);
            return view('ar.show', compact('ar'));
        } catch (\Exception $e) {
            Log::error('Erro ao buscar AR: ' . $e->getMessage());
            return back()->with('error', 'Autoridade de Registro não encontrada.');
        }
    }

    public function edit(Ar $ar)
    {
        try {
            $acN2s = AcN2::all();
            return view('ar.edit', compact('ar', 'acN2s'));
        } catch (\Exception $e) {
            Log::error('Erro ao carregar o formulário de edição: ' . $e->getMessage());
            return back()->with('error', 'Ocorreu um erro ao carregar o formulário de edição.');
        }
    }

    public function update(Request $request, Ar $ar)
    {
        // Validação
        $validated = $request->validate([
            'nome' => 'required',
            'cnpj' => 'required',
            'tipo' => 'required',
            'situacao' => 'required',
            'credenciamento' => 'required',
            'telefone' => 'required',
            'ac_n2_id' => 'required|exists:ac_n2,id',
        ]);

        try {
            // Atualizar AR
            $ar->update($request->all());
            return redirect()->route('ar.index')->with('success', 'Autoridade de Registro atualizada com sucesso!');
        } catch (QueryException $e) {
            // Log de erro para falhas no banco de dados
            Log::error('Erro ao atualizar AR: ' . $e->getMessage());
            return back()->with('error', 'Ocorreu um erro ao tentar atualizar a Autoridade de Registro.');
        } catch (\Exception $e) {
            // Log de erro para outros tipos de falhas
            Log::error('Erro inesperado ao atualizar AR: ' . $e->getMessage());
            return back()->with('error', 'Ocorreu um erro inesperado. Tente novamente.');
        }
    }

    public function destroy(Ar $ar)
    {
        try {
            // Excluir AR
            $ar->delete();
            return redirect()->route('ar.index')->with('success', 'Autoridade de Registro excluída com sucesso!');
        } catch (QueryException $e) {
            Log::error('Erro ao excluir AR: ' . $e->getMessage());
            return back()->with('error', 'Ocorreu um erro ao tentar excluir a Autoridade de Registro.');
        } catch (\Exception $e) {
            Log::error('Erro inesperado ao excluir AR: ' . $e->getMessage());
            return back()->with('error', 'Ocorreu um erro inesperado. Tente novamente.');
        }
    }

    public function generateQRCode($id)
    {
        try {
            $ar = Ar::findOrFail($id);
            
            // Configurar as opções do QR Code
            $options = new QROptions([
                'version' => 5, // Tamanho do QR Code
                'eccLevel' => QRCode::ECC_L, // Nível de correção de erro
                'moduleValues' => [10], // Tamanho dos módulos
                'imageBase64' => false, // Se o QR Code será base64 ou não
            ]);

            // Gerar o QR Code com a URL da AC (ou qualquer outra informação desejada)
             $url = route('ar.show', ['ar' => $ar->id]);

            // Gerar o QR Code com a URL da AC
            $qrCode = (new QRCode($options))->render($url);

            // Retornar o QR Code corretamente dentro de um JSON
            return response()->json(['qrcode' => $qrCode]);

        } catch (\Exception $e) {
            // Log do erro
            \Log::error('Erro ao gerar o QR Code: ' . $e->getMessage());
            return response()->json(['error' => 'Falha ao gerar QR Code'], 500);
        }
    }
}
