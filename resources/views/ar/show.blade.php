@extends('layouts.dashboard')

@section('content')
<div class="card">
    <div class="card-body">
        <h3>{{ $ar->nome }}</h3>
        <p><strong>CNPJ:</strong> {{ $ar->cnpj }}</p>
        <p><strong>Tipo:</strong> {{ $ar->tipo }}</p>
        <p><strong>Situação:</strong> {{ $ar->situacao }}</p>
        <p><strong>Credenciamento:</strong> {{ $ar->credenciamento }}</p>
        <p><strong>Telefone:</strong> {{ $ar->telefone }}</p>

        <hr>

        <h5>AC Nível 2</h5>
        <p>{{ $ar->acN2->nome }}</p>

        <a href="{{ route('ar.index') }}" class="btn btn-secondary">Voltar</a>
    </div>
</div>
@endsection
