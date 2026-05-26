<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Equipamentos</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body class="bg-light">

    <div class="container mt-5">
         <div class="d-flex align-items-center mb-3">
            <a href="{{ route('reservas.index') }}" class="text-dark text-decoration-none me-3">
                <i class="bi bi-arrow-left fs-4"></i>
            </a>
            <h3 class="fw-normal mb-0 text-dark">Equipamentos <span class="fw-bold">Cadastrados</span></h3>
        </div>
        
        <div class="card shadow">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <a href="{{ route('equipamentos.create') }}" class="btn btn-light btn-sm">Novo Equipamento</a>
                
                
            </div>
            
            <div class="card-body">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Descrição</th>
                            <th>Status</th>
                            <th class="text-center">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($equipamentos as $equipamento)
                        <tr>
                            <td>{{ $equipamento->id }}</td>
                            <td>{{ $equipamento->descricao }}</td>
                            <td class="align-middle">
    @if($equipamento->status == 'disponivel')
        <span class="badge bg-success-subtle text-success border border-success-subtle px-3 py-2 rounded-pill fw-medium">
            🟢 Disponível
        </span>
    @elseif($equipamento->status == 'manutencao')
        <span class="badge bg-warning-subtle text-warning-emphasis border border-warning-subtle px-3 py-2 rounded-pill fw-medium">
            🟡 Em Manutenção
        </span>
    @else
        <span class="badge bg-danger-subtle text-danger border border-danger-subtle px-3 py-2 rounded-pill fw-medium">
            🔴 Indisponível
        </span>
    @endif
</td>
                            <td class="text-center"> <a href="{{ route('equipamentos.edit', $equipamento->id) }}" class="btn btn-link text-primary p-1 me-2" title="Editar Equipamento"><i class="bi bi-pencil-square"></i></a>

                            <form action="{{ route('equipamentos.destroy', $equipamento->id) }}" method="POST" id="form-delete-{{ $equipamento->id }}" style="display:inline;">@csrf @method('DELETE') <button type="button" class="btn btn-link text-danger p-1" onclick="confirmDelete({{ $equipamento->id }})" title="Excluir"><i class="bi bi-trash"></i>
                        </button>
                     </form>
                    </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<script>
function confirmDelete(id) {
    Swal.fire({
        title: 'Tem certeza?',
        text: "Você não poderá reverter esta exclusão!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#94a3b8', // Cinza do seu sistema
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sim, excluir!',
        cancelButtonText: 'Cancelar',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            // Se o usuário confirmar, envia o formulário
            document.getElementById('form-delete-' + id).submit();
        }
    })
}
</script>