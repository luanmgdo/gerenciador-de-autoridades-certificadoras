<div class="mb-3">
    <label for="nome" class="form-label">Nome</label>
    <input type="text" class="form-control" id="nome" name="nome" value="{{ old('nome', $acN2->nome ?? '') }}" required>
</div>

<div class="mb-3">
    <label for="cnpj" class="form-label">CNPJ</label>
    <input type="text" class="form-control" id="cnpj" name="cnpj" value="{{ old('cnpj', $acN2->cnpj ?? '') }}" required>
</div>

<div class="mb-3">
    <label for="tipo" class="form-label">Tipo</label>
    <input type="text" class="form-control" id="tipo" name="tipo" value="{{ old('tipo', $acN2->tipo ?? '') }}" required>
</div>

<div class="mb-3">
    <label for="situacao" class="form-label">Situação</label>
    <input type="text" class="form-control" id="situacao" name="situacao" value="{{ old('situacao', $acN2->situacao ?? '') }}" required>
</div>

<div class="mb-3">
    <label for="credenciamento" class="form-label">Credenciamento</label>
    <input type="text" class="form-control" id="credenciamento" name="credenciamento" value="{{ old('credenciamento', $acN2->credenciamento ?? '') }}" required>
</div>

<div class="mb-3">
    <label for="telefone" class="form-label">Telefone</label>
    <input type="text" class="form-control" id="telefone" name="telefone" value="{{ old('telefone', $acN2->telefone ?? '') }}" required>
</div>

<!-- Seleção da AC -->
<div class="mb-3">
    <label for="ac_id" class="form-label">Selecione a AC</label>
    <select class="form-control" id="ac_id" name="ac_id" required>
        @foreach($acs as $ac)
            <option value="{{ $ac->id }}" {{ old('ac_id', $acN2->ac_id ?? '') == $ac->id ? 'selected' : '' }}>{{ $ac->nome }}</option>
        @endforeach
    </select>
</div>
