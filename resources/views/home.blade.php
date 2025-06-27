@extends('layouts.dashboard')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-body">
                    <h2 class="card-title text-center">Bem-vindo ao meu Desafio Técnico – Desenvolvedor PHP</h2>
                    <hr>

                    <h4>Sobre o Projeto</h4>
                    <p>Este sistema foi desenvolvido como um desafio técnico para a GestaOnline para a vaga de Desenvolvedor PHP</p>

                    <h4>Funcionalidades</h4>
                    <ul>
                        <li><strong>Cadastro e Login</strong>: Permite o cadastro e login de usuários com autenticador simples (email e senha)</li>
                        <li><strong>Cadastro e Edição de ACs:</strong> Permite o registro de novas ACs, bem como a atualização das informações das ACs existentes.</li>
                        <li><strong>Cadastro e Edição de AC N2:</strong> Administra as entidades de AC N2, vinculadas às ACs e com seus respectivos registros.</li>
                        <li><strong>Cadastro e Edição de AR:</strong> Gerencia as Autoridades de Registro, associando-as às AC N2s.</li>
                        <li><strong>Visualização:</strong> Exibe detalhes de cada entidade, incluindo as relações entre AC, AC N2 e AR.</li>
                        <li><strong>Excluir:</strong> Permite a exclusão de qualquer entidade, com confirmação via modal.</li>
                        <li><strong>Gerar QRCode:</strong>Cada entidade possui um botão para gerar link via QRCode.</li>
                        <li><strong>upload de arquivo JSON:</strong>O sistema permite a população do banco de dados através do upload de um arquivo JSON</li>
                    </ul>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection