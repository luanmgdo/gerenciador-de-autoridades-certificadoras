@extends('layouts.dashboard')

@section('content')
<h1>Autoridades de Registro (AR)</h1>
<div class="row">
  @foreach($ars as $ar)
    <div class="col-md-4 mb-4">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">{{ $ar->nome }}</h5>
          <div class="d-flex justify-content-between">
            <a href="{{ route('ar.show', $ar) }}" class="btn btn-sm btn-primary">Visualizar</a>
            <a href="{{ route('ar.edit', $ar) }}" class="btn btn-sm btn-warning">Editar</a>
            <button class="btn btn-primary" onclick="generateQRCode({{ $ar->id }})">Gerar QRCode</button>
            <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteArModal{{ $ar->id }}">Excluir</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal for confirming deletion -->
    <div class="modal fade" id="deleteArModal{{ $ar->id }}" tabindex="-1" aria-labelledby="deleteArModalLabel{{ $ar->id }}" aria-hidden="true">
      <div class="modal-dialog">
        <form action="{{ route('ar.destroy', $ar) }}" method="POST">
          @csrf @method('DELETE')
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="deleteArModalLabel{{ $ar->id }}">Confirmar Exclusão</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
              Tem certeza que deseja excluir a AR: {{ $ar->nome }}?
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
              <button type="submit" class="btn btn-danger">Excluir</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  @endforeach
</div>

<a href="{{ route('ar.create') }}" class="btn btn-success">Nova AR</a>
<!-- Modal para exibir o QR Code -->
    <div class="modal fade" id="qrcodeModal" tabindex="-1" aria-labelledby="qrcodeModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="qrcodeModalLabel">QR Code</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- O QR Code será exibido aqui -->
                    <div id="qrcode-container"></div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    // Função para gerar QRCode e exibir no modal
function generateQRCode(acId) {
    const url = 'generate-qrcode/ar/' + acId;

    // Enviar requisição AJAX para gerar o QRCode
    fetch(url)
        .then(response => {
            // Verificar se a resposta foi bem sucedida
            if (!response.ok) {
                throw new Error('Erro na resposta da API');
            }
            return response.json(); // Tenta converter a resposta para JSON
        })
        .then(data => {
            // Verifica se a chave 'qrcode' está presente no JSON
            if (data.qrcode) {
                const qrCodeContainer = document.getElementById('qrcode-container');
                qrCodeContainer.innerHTML = data.qrcode; // Exibe o QRCode gerado

                // Exibir o modal com o QRCode
                var myModal = new bootstrap.Modal(document.getElementById('qrcodeModal'));
                myModal.show();
            } else {
                console.error('QR Code não encontrado na resposta');
                alert('Erro ao gerar QR Code');
            }
        })
        .catch(error => {
            console.error('Erro ao gerar o QRCode:', error);
            alert('Erro ao gerar o QR Code. Tente novamente.');
        });
}
</script>
@endpush
