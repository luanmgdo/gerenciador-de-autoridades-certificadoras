<?php
namespace App\Http\Controllers;

use App\Models\Ac;
use App\Models\AcN2;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\QueryException;
use chillerlan\QRCode\QRCode;
use chillerlan\QRCode\QROptions; 

class AcN2Controller extends Controller
{
    public function index()
    {
        try {
            $acN2s = AcN2::all();
            return view('ac_n2.index', compact('acN2s'));
        } catch (\Exception $e) {
            // Log do erro
            Log::error('Erro ao buscar AC N2s: ' . $e->getMessage());
            return back()->with('error', 'Ocorreu um erro ao buscar as ACs Nível 2.');
        }
    }

    public function create()
    {
        try {
            $acs = Ac::all();
            return view('ac_n2.create', compact('acs'));
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
            'ac_id' => 'required|exists:ac,id',
        ]);

        try {
            // Criar AC Nível 2
            AcN2::create($request->all());
            return redirect()->route('ac_n2.index')->with('success', 'AC Nível 2 criada com sucesso!');
        } catch (QueryException $e) {
            // Log de erro para falha no banco
            Log::error('Erro ao criar AC Nível 2: ' . $e->getMessage());
            return back()->with('error', 'Ocorreu um erro ao tentar criar a AC Nível 2.');
        } catch (\Exception $e) {
            // Log de erro para outros erros inesperados
            Log::error('Erro inesperado ao criar AC Nível 2: ' . $e->getMessage());
            return back()->with('error', 'Ocorreu um erro inesperado. Tente novamente.');
        }
    }

    public function show($id)
    {
        try {
            // Buscar a AC N2 com as ARs associadas
            $acN2 = AcN2::with('ars')->findOrFail($id);
            return view('ac_n2.show', compact('acN2'));
        } catch (\Exception $e) {
            // Log de erro
            Log::error('Erro ao buscar AC N2: ' . $e->getMessage());
            return back()->with('error', 'AC Nível 2 não encontrada.');
        }
    }

    public function edit(AcN2 $acN2)
    {
        try {
            $acs = Ac::all();
            return view('ac_n2.edit', compact('acN2', 'acs'));
        } catch (\Exception $e) {
            // Log de erro
            Log::error('Erro ao carregar o formulário de edição: ' . $e->getMessage());
            return back()->with('error', 'Ocorreu um erro ao carregar o formulário de edição.');
        }
    }

    public function update(Request $request, AcN2 $acN2)
    {
        // Validação
        $validated = $request->validate([
            'nome' => 'required',
            'cnpj' => 'required',
            'tipo' => 'required',
            'situacao' => 'required',
            'credenciamento' => 'required',
            'telefone' => 'required',
            'ac_id' => 'required|exists:ac,id',
        ]);

        try {
            // Atualizar AC Nível 2
            $acN2->update($request->all());
            return redirect()->route('ac_n2.index')->with('success', 'AC Nível 2 atualizada com sucesso!');
        } catch (QueryException $e) {
            // Log de erro para falha no banco
            Log::error('Erro ao atualizar AC Nível 2: ' . $e->getMessage());
            return back()->with('error', 'Ocorreu um erro ao tentar atualizar a AC Nível 2.');
        } catch (\Exception $e) {
            // Log de erro para outros erros inesperados
            Log::error('Erro inesperado ao atualizar AC Nível 2: ' . $e->getMessage());
            return back()->with('error', 'Ocorreu um erro inesperado. Tente novamente.');
        }
    }

    public function destroy(AcN2 $acN2)
    {
        try {
            // Excluir AC Nível 2
            $acN2->delete();
            return redirect()->route('ac_n2.index')->with('success', 'AC Nível 2 excluída com sucesso!');
        } catch (QueryException $e) {
            // Log de erro para falha no banco
            Log::error('Erro ao excluir AC Nível 2: ' . $e->getMessage());
            return back()->with('error', 'Ocorreu um erro ao tentar excluir a AC Nível 2.');
        } catch (\Exception $e) {
            // Log de erro para outros erros inesperados
            Log::error('Erro inesperado ao excluir AC Nível 2: ' . $e->getMessage());
            return back()->with('error', 'Ocorreu um erro inesperado. Tente novamente.');
        }
    }
    public function generateQRCode($id)
    {
        try {
            $acN2 = AcN2::findOrFail($id);
            
            // Configurar as opções do QR Code
            $options = new QROptions([
                'version' => 5, // Tamanho do QR Code
                'eccLevel' => QRCode::ECC_L, // Nível de correção de erro
                'moduleValues' => [10], // Tamanho dos módulos
                'imageBase64' => false, // Se o QR Code será base64 ou não
            ]);

            // Gerar o QR Code com a URL da AC (ou qualquer outra informação desejada)
            $url = route('ac_n2.show', ['ac_n2' => $acN2->id]);

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
