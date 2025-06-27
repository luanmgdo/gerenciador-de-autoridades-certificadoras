@extends('layouts.dashboard')

@section('content')
<div class="form-container">
    <h2>Importar Arquivo JSON</h2>
    
    <!-- Formulário de Upload de JSON -->
    <form action="{{ route('json.store') }}" method="POST" enctype="multipart/form-data" id="json-upload-form">
        @csrf

        <div class="mb-3">
            <label for="json_file" class="form-label">Escolha o arquivo JSON</label>
            <input type="file" class="form-control" id="json_file" name="json_file" accept=".json" required>
        </div>

        <button type="submit" class="btn btn-custom">Importar</button>
    </form>

    <!-- Modal de Carregamento -->
    <div class="modal fade" id="loadingModal" tabindex="-1" aria-labelledby="loadingModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Carregando...</span>
                    </div>
                    <p class="mt-3">Processando arquivo, por favor aguarde...</p>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    // Mostrar o modal de loading quando o formulário for enviado
    document.getElementById('json-upload-form').addEventListener('submit', function() {
        // Exibir o modal de loading
        var loadingModal = new bootstrap.Modal(document.getElementById('loadingModal'));
        loadingModal.show();
    });
</script>
@endpush
