<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Reserva</title>
    
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
</head>
<body class="bg-light p-4 p-md-5">

    <div class="container" style="max-width: 700px;">
        <div class="d-flex align-items-center mb-4">
            <a href="{{ route('reservas.index') }}" class="text-dark text-decoration-none me-3">
                <i class="bi bi-arrow-left fs-4"></i>
            </a>
            <h3 class="fw-normal mb-0 text-dark">Editar <span class="fw-bold">Reserva #{{ $reserva->id }}</span></h3>
        </div>

        <div class="card border-0 shadow-sm rounded-3">
            <div class="card-body p-4 py-5">
                <form action="{{ route('reservas.update', $reserva->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="row g-4">
                        <div class="col-12">
                            <label for="professor_id" class="form-label fw-medium text-dark mb-1">Professor responsável</label>
                            <select name="professor_id" id="professor_id" class="form-select" required>
                                <option value="" disabled>Selecionar professor(a)...</option>
                                @foreach($professores as $professor)
                                    <option value="{{ $professor->id }}" {{ $reserva->professor_id == $professor->id ? 'selected' : '' }}>
                                        {{ $professor->nome }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-12">
                            <label for="sala_id" class="form-label fw-medium text-dark mb-1">Sala / Laboratório</label>
                            <select name="sala_id" id="sala_id" class="form-select">
                                <option value="">Selecionar sala...</option>
                                @foreach($salas as $sala)
                                    <option value="{{ $sala->id }}" {{ $reserva->sala_id == $sala->id ? 'selected' : '' }}>
                                        {{ $sala->descricao ?? $sala->nome }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="form-text">Deixe em branco para reservar apenas equipamento.</div>
                        </div>

                        <div class="col-12">
                            <label for="equipamento_id" class="form-label fw-medium text-dark mb-1">Equipamento Extra</label>
                            <select name="equipamento_id" id="equipamento_id" class="form-select">
                                <option value="">Selecionar equipamento...</option>
                                @foreach($equipamentos as $equipamento)
                                    <option value="{{ $equipamento->id }}" {{ $reserva->equipamento_id == $equipamento->id ? 'selected' : '' }}>
                                        {{ $equipamento->descricao }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="form-text">Deixe em branco se não precisar de equipamento extra.</div>
                        </div>

                        <div class="col-12">
                            <label for="data_reserva" class="form-label fw-medium text-dark mb-1">Data do Agendamento</label>
                            <input type="date" name="data_reserva" id="data_reserva" class="form-control" value="{{ $reserva->data_reserva }}" required>
                        </div>

                        <div class="col-md-6">
                            <label for="hora_inicio" class="form-label fw-medium text-dark mb-1">Início</label>
                            <input type="time" name="hora_inicio" id="hora_inicio" class="form-control" value="{{ date('H:i', strtotime($reserva->hora_inicio)) }}" required>
                        </div>

                        <div class="col-md-6">
                            <label for="hora_fim" class="form-label fw-medium text-dark mb-1">Término</label>
                            <input type="time" name="hora_fim" id="hora_fim" class="form-control" value="{{ date('H:i', strtotime($reserva->hora_fim)) }}" required>
                        </div>

                        <div class="col-12 mt-4 pt-2">
                            <button type="submit" class="btn btn-primary px-4 fw-medium shadow-sm me-2">
                                <i class="bi bi-arrow-clockwise me-1"></i> Atualizar Reserva
                            </button>
                            <a href="{{ route('reservas.index') }}" class="btn btn-light px-4 fw-medium border text-decoration-none">Cancelar</a>
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
