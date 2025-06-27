@extends('layouts.dashboard')

@section('content')
<div class="form-container">
    <h2>Nova Autoridade Certificadora Nível 2 (AC N2)</h2>
    
    <form action="{{ route('ac_n2.store') }}" method="POST">
        @csrf
        <!-- Formulário de Cadastro -->
        @include('ac_n2._form')
        
        <!-- Botão de Salvar -->
        <button type="submit" class="btn btn-custom">Salvar</button>
    </form>
</div>
@endsection