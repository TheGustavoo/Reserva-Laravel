<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Nova Reserva</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        body { background-color: #f8f9fa; color: #444; }
        .card { border: none; border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.05); }
        .form-label { font-weight: 500; color: #666; }
        .form-control, .form-select { border-radius: 8px; border: 1px solid #dee2e6; padding: 10px; }
        .btn-primary { background-color: #5a67d8; border: none; border-radius: 8px; padding: 10px 25px; }
    </style>
</head>
<body>
    <div class="container mt-5" style="max-width: 800px;">
        <div class="d-flex align-items-center mb-4">
            <a href="{{ route('reservas.index') }}" class="btn btn-link text-decoration-none p-0 me-3">
                <i class="bi bi-arrow-left fs-4"></i>
            </a>
            <h2 class="fw-light mb-0">Agendar <span class="fw-bold">Nova Reserva</span></h2>
        </div>

        <div class="card">
            <div class="card-body p-4">
                <form action="{{ route('reservas.store') }}" method="POST">
                    @csrf

                    <div class="row g-3">
                        <!-- Seleção de Professor -->
                        <div class="col-md-6">
                            <label class="form-label">Professor responsável</label>
                            <select name="professor_id" class="form-select" required>
                                <option value="">Selecione o professor...</option>
                                @foreach($professores as $professor)
                                    <option value="{{ $professor->id }}">{{ $professor->nome }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Seleção de Sala -->
                        <div class="col-md-6">
                            <label class="form-label">Sala / Laboratório</label>
                            <select name="sala_id" class="form-select" required>
                                <option value="">Selecione a sala...</option>
                                @foreach($salas as $sala)
                                    <option value="{{ $sala->id }}">{{ $sala->nome }} (Capacidade: {{ $sala->capacidade }})</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Data da Reserva -->
                        <div class="col-md-12">
                            <label class="form-label">Data do Agendamento</label>
                            <input type="date" name="data_reserva" class="form-control" required>
                        </div>

                        <!-- Horários -->
                        <div class="col-md-6">
                            <label class="form-label">Início</label>
                            <input type="time" name="hora_inicio" class="form-control" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Término</label>
                            <input type="time" name="hora_fim" class="form-control" required>
                        </div>

                        <div class="col-12 mt-4 border-top pt-4">
                            <button type="submit" class="btn btn-primary shadow-sm">
                                <i class="bi bi-check2-circle me-1"></i> Confirmar Reserva
                            </button>
                            <a href="{{ route('reservas.index') }}" class="btn btn-light ms-2">Cancelar</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>