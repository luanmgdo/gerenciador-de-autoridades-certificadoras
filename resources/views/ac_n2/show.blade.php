@extends('layouts.dashboard')

@section('content')
<div class="card">
    <div class="card-body">
        <h3>{{ $acN2->nome }}</h3>
        <p><strong>CNPJ:</strong> {{ $acN2->cnpj }}</p>
        <p><strong>Tipo:</strong> {{ $acN2->tipo }}</p>
        <p><strong>Situação:</strong> {{ $acN2->situacao }}</p>
        <p><strong>Credenciamento:</strong> {{ $acN2->credenciamento }}</p>
        <p><strong>Telefone:</strong> {{ $acN2->telefone }}</p>

        <hr>

        <h5>Autoridades de Registro (AR)</h5>
        <ul>
            @foreach($acN2->ars as $ar)
                <li><strong>{{ $ar->nome }}</strong></li>
            @endforeach
        </ul>

        <a href="{{ route('ac_n2.index') }}" class="btn btn-secondary">Voltar</a>
    </div>
</div>
@endsection