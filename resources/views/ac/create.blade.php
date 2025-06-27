@extends('layouts.dashboard')

@section('content')
<div class="form-container">
    <h2>Nova Autoridade Certificadora (AC)</h2>
    
    <form action="{{ route('ac.store') }}" method="POST">
        @csrf
        <!-- Formulário de Cadastro de AC -->
        @include('ac._form')
        
        <!-- Botão de Salvar -->
        <button type="submit" class="btn btn-custom">Salvar</button>
    </form>
</div>
@endsection
