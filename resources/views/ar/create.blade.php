@extends('layouts.dashboard')

@section('content')
<div class="form-container">
    <h2>Nova Autoridade de Registro (AR)</h2>
    <form action="{{ route('ar.store') }}" method="POST">
        @csrf
        <!-- Incluindo o formulário parcial -->
        @include('ar._form')
        
        <!-- Botão de Salvar -->
        <button type="submit" class="btn btn-custom">Salvar</button>
    </form>
</div>
@endsection
