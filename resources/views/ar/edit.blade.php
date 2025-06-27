@extends('layouts.dashboard')

@section('content')
<div class="form-container">
    <h2>Editar Autoridade de Registro (AR)</h2>
    <form action="{{ route('ar.update', $ar) }}" method="POST">
        @csrf @method('PUT')
        <!-- Incluindo o formulário parcial -->
        @include('ar._form')
        
        <!-- Botão de Atualizar -->
        <button type="submit" class="btn btn-custom">Atualizar</button>
    </form>
</div>
@endsection
