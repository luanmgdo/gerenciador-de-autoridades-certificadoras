<div class="mb-3">
    <label for="nome" class="form-label">Nome</label>
    <input type="text" class="form-control" id="nome" name="nome" value="{{ old('nome', $ar->nome ?? '') }}" required>
</div>

<div class="mb-3">
    <label for="cnpj" class="form-label">CNPJ</label>
    <input type="text" class="form-control" id="cnpj" name="cnpj" value="{{ old('cnpj', $ar->cnpj ?? '') }}" required>
</div>

<div class="mb-3">
    <label for="tipo" class="form-label">Tipo</label>
    <input type="text" class="form-control" id="tipo" name="tipo" value="{{ old('tipo', $ar->tipo ?? '') }}" required>
</div>

<div class="mb-3">
    <label for="situacao" class="form-label">Situação</label>
    <input type="text" class="form-control" id="situacao" name="situacao" value="{{ old('situacao', $ar->situacao ?? '') }}" required>
</div>

<div class="mb-3">
    <label for="credenciamento" class="form-label">Credenciamento</label>
    <input type="text" class="form-control" id="credenciamento" name="credenciamento" value="{{ old('credenciamento', $ar->credenciamento ?? '') }}" required>
</div>

<div class="mb-3">
    <label for="telefone" class="form-label">Telefone</label>
    <input type="text" class="form-control" id="telefone" name="telefone" value="{{ old('telefone', $ar->telefone ?? '') }}" required>
</div>

<!-- Seleção da AC N2 -->
<div class="mb-3">
    <label for="ac_n2_id" class="form-label">Selecione a AC Nível 2</label>
    <select class="form-control" id="ac_n2_id" name="ac_n2_id" required>
        @foreach($acN2s as $acN2)
            <option value="{{ $acN2->id }}" {{ old('ac_n2_id', $ar->ac_n2_id ?? '') == $acN2->id ? 'selected' : '' }}>
                {{ $acN2->nome }}
            </option>
        @endforeach
    </select>
</div>
