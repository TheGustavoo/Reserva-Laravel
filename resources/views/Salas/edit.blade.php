<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Sala</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
</head>
<body class="bg-light p-4 p-md-5">

    <div class="container" style="max-width: 700px;">
        <div class="d-flex align-items-center mb-4">
            <a href="{{ route('salas.index') }}" class="text-dark text-decoration-none me-3">
                <i class="bi bi-arrow-left fs-4"></i>
            </a>
            <h3 class="fw-normal mb-0 text-dark">Editar <span class="fw-bold">Sala/Lab</span></h3>
        </div>

        <div class="card border-0 shadow-sm rounded-3">
            <div class="card-body p-4 py-5">
                <form action="{{ route('salas.update', $sala->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="row g-4">
                        <div class="col-md-8">
                            <label for="nome" class="form-label fw-medium text-dark mb-1">Nome da Sala</label>
                            <input type="text" name="nome" id="nome" class="form-control" value="{{ $sala->nome }}" required>
                        </div>

                        <div class="col-md-4">
                            <label for="capacidade" class="form-label fw-medium text-dark mb-1">Capacidade</label>
                            <input type="number" name="capacidade" id="capacidade" class="form-control" value="{{ $sala->capacidade }}" required>
                        </div>

                        <div class="col-12">
                            <label for="descricao" class="form-label fw-medium text-dark mb-1">Descrição</label>
                            <input type="text" name="descricao" id="descricao" class="form-control" value="{{ $sala->descricao }}" required>
                        </div>

                        <div class="col-12 mt-4 pt-2">
                            <button type="submit" class="btn btn-primary px-4 fw-medium shadow-sm me-2">
                                <i class="bi bi-arrow-clockwise me-1"></i> Atualizar
                            </button>
                            <a href="{{ route('salas.index') }}" class="btn btn-light px-4 fw-medium border text-decoration-none">Cancelar</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
<script>
    @if ($errors->any())
        Swal.fire({
            icon: 'error',
            title: 'Ops! Algo está incorreto.',
            html: `
                <ul style="text-align: left;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            `,
            confirmButtonColor: '#0d6efd'
        });
    @endif

    @if (session('erro'))
        Swal.fire({
            icon: 'warning',
            title: 'Atenção!',
            text: "{{ session('erro') }}",
            confirmButtonColor: '#0d6efd'
        });
    @endif
    </script>
</body>
</html>