<div class="mb-3">
    <label for="nome" class="form-label">Nome</label>
    <input type="text" class="form-control" id="nome" name="nome" value="{{ old('nome', $ac->nome ?? '') }}" required>
</div>

<div class="mb-3">
    <label for="cnpj" class="form-label">CNPJ</label>
    <input type="text" class="form-control" id="cnpj" name="cnpj" value="{{ old('cnpj', $ac->cnpj ?? '') }}" required>
</div>

<div class="mb-3">
    <label for="tipo" class="form-label">Tipo</label>
    <input type="text" class="form-control" id="tipo" name="tipo" value="{{ old('tipo', $ac->tipo ?? '') }}" required>
</div>

<div class="mb-3">
    <label for="situacao" class="form-label">Situação</label>
    <input type="text" class="form-control" id="situacao" name="situacao" value="{{ old('situacao', $ac->situacao ?? '') }}" required>
</div>

<div class="mb-3">
    <label for="credenciamento" class="form-label">Credenciamento</label>
    <input type="text" class="form-control" id="credenciamento" name="credenciamento" value="{{ old('credenciamento', $ac->credenciamento ?? '') }}" required>
</div>

<div class="mb-3">
    <label for="telefone" class="form-label">Telefone</label>
    <input type="text" class="form-control" id="telefone" name="telefone" value="{{ old('telefone', $ac->telefone ?? '') }}" required>
</div>
