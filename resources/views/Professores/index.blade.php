<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Professores</title>
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
            <h3 class="fw-normal mb-0 text-dark">Professores <span class="fw-bold">Cadastrados</span></h3>
        </div>
        
        <div class="card shadow">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <a href="{{ route('professores.create') }}" class="btn btn-light btn-sm">Novo Professor</a>
                
                
            </div>
            
            <div class="card-body">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>Matéria</th>
                            <th class="text-center">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($professores as $professor)
                        <tr>
                            <td>{{ $professor->id }}</td>
                            <td>{{ $professor->nome }}</td>
                            <td>{{ $professor->materia }}</td>

                            <td class="text-center"> <a href="{{ route('professores.edit', $professor->id) }}" class="btn btn-link text-primary p-1 me-2" title="Editar Professor"><i class="bi bi-pencil-square"></i></a>

                            <form action="{{ route('professores.destroy', $professor->id) }}" method="POST" id="form-delete-{{ $professor->id }}" style="display:inline;">@csrf @method('DELETE') <button type="button" class="btn btn-link text-danger p-1" onclick="confirmDelete({{ $professor->id }})" title="Excluir"><i class="bi bi-trash"></i>
                        </button>
                     </form>
                    </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>''

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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    @if(session('successo'))
        Swal.fire({
            icon: 'success',
            title: 'Show!',
            text: "{{ session('successo') }}",
            timer: 3000,
            showConfirmButton: false,
            customClass: { popup: 'rounded-4' }
        });
    @endif
</script>