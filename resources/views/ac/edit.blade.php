@extends('layouts.dashboard')

@section('content')
<div class="form-container">
    <h2>Editar Autoridade Certificadora (AC)</h2>
    
    <form action="{{ route('ac.update', $ac) }}" method="POST">
        @csrf @method('PUT')
        <!-- Formulário de Edição de AC -->
        @include('ac._form')
        
        <!-- Botão de Atualizar -->
        <button type="submit" class="btn btn-custom">Atualizar</button>
    </form>
</div>
@endsection
