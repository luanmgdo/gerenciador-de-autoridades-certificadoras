@extends('layouts.dashboard')
@section('content')
<div class="card">
  <div class="card-body">
    <h3>{{ $ac->nome }}</h3>
    <p>CNPJ: {{ $ac->cnpj }}</p>
    <p>Tipo: {{ $ac->tipo }}</p>
    <p>Situação: {{ $ac->situacao }}</p>
    <p>Credenciamento: {{ $ac->credenciamento }}</p>
    <p>Telefone: {{ $ac->telefone }}</p>
    <hr>
    <h5>AC Nível 2</h5>
    <ul>
      @foreach($ac->acN2 as $n2)
        <li>
          <strong>{{ $n2->nome }}</strong>
          <ul>
            @foreach($n2->ars as $ar)
              <li>{{ $ar->nome }}</li>
            @endforeach
          </ul>
        </li>
      @endforeach
    </ul>
    <a href="{{ route('ac.index') }}" class="btn btn-secondary">Voltar</a>
  </div>
</div>
@endsection