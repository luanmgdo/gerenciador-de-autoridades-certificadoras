<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    // Exibe o formulário de registro
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    // Processa o cadastro de usuário
    public function register(Request $request)
{
    // Validação
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|confirmed|min:8',
    ]);

    try {
        // Criar o usuário
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Autenticar o usuário após o registro
        auth()->login($user);

        // Redirecionar com sucesso
        return redirect()->route('home')->with('success', 'Registro realizado com sucesso!');
    } catch (\Exception $e) {
        // Log do erro
        Log::error('Erro ao registrar usuário: ' . $e->getMessage());
        return back()->with('error', 'Ocorreu um erro ao tentar registrar. Tente novamente.')->withInput();
    }
}
}
