<?php
namespace App\Http\Controllers;

use App\Models\Ac;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\QueryException;
use chillerlan\QRCode\QRCode;
use chillerlan\QRCode\QROptions; 


class AcController extends Controller
{
    public function index()
    {
        try {
            $acs = Ac::all();
            return view('ac.index', compact('acs'));
        } catch (\Exception $e) {
            // Log do erro
            Log::error('Erro ao buscar ACs: ' . $e->getMessage());
            return back()->with('error', 'Ocorreu um erro ao buscar as ACs.');
        }
    }

    public function create()
    {
        try {
            return view('ac.create');
        } catch (\Exception $e) {
            // Log do erro
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
        ]);

        try {
            // Criar a AC
            Ac::create($request->all());
            return redirect()->route('ac.index')->with('success', 'AC criada com sucesso!');
        } catch (QueryException $e) {
            // Log de erro para falha no banco de dados
            Log::error('Erro ao criar AC: ' . $e->getMessage());
            return back()->with('error', 'Ocorreu um erro ao tentar criar a AC.');
        } catch (\Exception $e) {
            // Log de erro para outros erros inesperados
            Log::error('Erro inesperado ao criar AC: ' . $e->getMessage());
            return back()->with('error', 'Ocorreu um erro inesperado. Tente novamente.');
        }
    }

    public function show($id)
    {
        try {
            // Buscar a AC com as AC N2 e ARs associadas
            $ac = Ac::with('acN2.ars')->findOrFail($id);
            return view('ac.show', compact('ac'));
        } catch (\Exception $e) {
            // Log do erro
            Log::error('Erro ao buscar AC: ' . $e->getMessage());
            return back()->with('error', 'AC não encontrada.');
        }
    }

    public function edit(Ac $ac)
    {
        try {
            return view('ac.edit', compact('ac'));
        } catch (\Exception $e) {
            // Log do erro
            Log::error('Erro ao carregar o formulário de edição: ' . $e->getMessage());
            return back()->with('error', 'Ocorreu um erro ao carregar o formulário de edição.');
        }
    }

    public function update(Request $request, Ac $ac)
    {
        // Validação
        $validated = $request->validate([
            'nome' => 'required',
            'cnpj' => 'required',
            'tipo' => 'required',
            'situacao' => 'required',
            'credenciamento' => 'required',
            'telefone' => 'required',
        ]);

        try {
            // Atualizar a AC
            $ac->update($request->all());
            return redirect()->route('ac.index')->with('success', 'AC atualizada com sucesso!');
        } catch (QueryException $e) {
            // Log de erro para falha no banco de dados
            Log::error('Erro ao atualizar AC: ' . $e->getMessage());
            return back()->with('error', 'Ocorreu um erro ao tentar atualizar a AC.');
        } catch (\Exception $e) {
            // Log de erro para outros erros inesperados
            Log::error('Erro inesperado ao atualizar AC: ' . $e->getMessage());
            return back()->with('error', 'Ocorreu um erro inesperado. Tente novamente.');
        }
    }

    public function destroy(Ac $ac)
    {
        try {
            // Excluir a AC
            $ac->delete();
            return redirect()->route('ac.index')->with('success', 'AC excluída com sucesso!');
        } catch (QueryException $e) {
            // Log de erro para falha no banco de dados
            Log::error('Erro ao excluir AC: ' . $e->getMessage());
            return back()->with('error', 'Ocorreu um erro ao tentar excluir a AC.');
        } catch (\Exception $e) {
            // Log de erro para outros erros inesperados
            Log::error('Erro inesperado ao excluir AC: ' . $e->getMessage());
            return back()->with('error', 'Ocorreu um erro inesperado. Tente novamente.');
        }
    }

     public function generateQRCode($id)
    {
        try {
            $ac = Ac::findOrFail($id);
            
            // Configurar as opções do QR Code
            $options = new QROptions([
                'version' => 5, // Tamanho do QR Code
                'eccLevel' => QRCode::ECC_L, // Nível de correção de erro
                'moduleValues' => [10], // Tamanho dos módulos
                'imageBase64' => false, // Se o QR Code será base64 ou não
            ]);

            // Gerar o QR Code com a URL da AC (ou qualquer outra informação desejada)
            $url = route('ac.show', ['ac' => $ac->id]);

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
