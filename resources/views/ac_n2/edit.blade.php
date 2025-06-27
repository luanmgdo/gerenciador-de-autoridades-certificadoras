@extends('layouts.dashboard')

@section('content')
<div class="form-container">
    <h2>Editar Autoridade Certificadora Nível 2 (AC N2)</h2>
    
    <form action="{{ route('ac_n2.update', $acN2) }}" method="POST">
        @csrf @method('PUT')
        <!-- Incluindo o formulário parcial com os dados da AC N2 para edição -->
        @include('ac_n2._form')
        
        <!-- Botão de Atualizar -->
        <button type="submit" class="btn btn-custom">Atualizar</button>
    </form>
</div>
@endsection
