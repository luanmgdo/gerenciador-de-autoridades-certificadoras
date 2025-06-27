<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        // Validação
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        try {
            // Tentar autenticar o usuário
            if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                // Redirecionar com sucesso
                return redirect()->intended('/dashboard')->with('success', 'Login realizado com sucesso!');
            } else {
                // Caso falhe a autenticação
                return back()->with('error', 'Credenciais inválidas!');
            }
        } catch (\Exception $e) {
            // Log do erro
            Log::error('Erro ao realizar login: ' . $e->getMessage());
            return back()->with('error', 'Ocorreu um erro ao tentar realizar o login. Tente novamente.');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/')->with('success', 'Você foi deslogado com sucesso!');
    }
}
