<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Reservas - Início</title>
    
    <!-- Bootstrap & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    
    <style>
        body { background-color: #f8f9fa; color: #444; }
        .card-menu {
            border: none;
            border-radius: 12px;
            transition: all 0.3s;
            text-decoration: none;
            border-bottom: 4px solid #dee2e6;
        }
        .card-menu:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 15px rgba(0,0,0,0.1);
        }
        .active-menu { border-bottom-color: #0d6efd !important; background-color: #f0f7ff; }
        .table-card { border: none; border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.05); }
    </style>
</head>
<body class="p-4 p-md-5">

    <div class="container max-w-6xl">
        <h1 class="fw-light mb-5">Sistema de <span class="fw-bold">Reserva de Salas</span></h1>

        <!-- Menu de Atalhos -->
        <div class="row g-4 mb-5">

        <!-- Reservas (Ativo) -->
            <div class="col-md-4">
                <a href="{{ route('reservas.index') }}" class="card card-menu p-4 text-center active-menu">
                    <span class="display-6 mb-2"></span>
                    <span class="h5 mb-0 text-primary fw-bold">RESERVAS</span>
                </a>
            </div>
            
            <!-- Professores -->
            <div class="col-md-4">
                <a href="{{ route('professores.index') }}" class="card card-menu p-4 text-center bg-white">
                    <span class="display-6 mb-2"></span>
                    <span class="h5 mb-0 text-dark">PROFESSORES</span>
                </a>
            </div>

            <!-- Salas -->
            <div class="col-md-4">
                <a href="{{ route('salas.index') }}" class="card card-menu p-4 text-center bg-white">
                    <span class="display-6 mb-2"></span>
                    <span class="h5 mb-0 text-dark">SALAS</span>
                </a>
            </div>

        </div>

        <!-- Tabela de Reservas -->
        <div class="card table-card overflow-hidden">
            <div class="card-header bg-white p-3 border-bottom d-flex justify-content-between align-items-center">
                <h5 class="mb-0 fw-bold text-secondary">Reservas Agendadas</h5>
                <a href="{{ route('reservas.create') }}" class="btn btn-primary btn-sm shadow-sm">
                    <i class="bi bi-calendar-plus"></i> Nova Reserva
                </a>
            </div>
            
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr class="text-secondary small text-uppercase">
                            <th class="ps-4">Professor</th>
                            <th>Sala</th>
                            <th>Data</th>
                            <th>Horário</th>
                            <th class="text-center">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($reservas as $reserva)
                        <tr>
                            <td class="ps-4 fw-bold">{{ $reserva->professor->nome }}</td>
                            <td><span class="badge bg-light text-dark border">{{ $reserva->sala->nome }}</span></td>
                            <td>{{ date('d/m/Y', strtotime($reserva->data_reserva)) }}</td>
                            <td>
                                <small class="text-muted">
                                    <i class="bi bi-clock"></i> {{ $reserva->hora_inicio }} - {{ $reserva->hora_fim }}
                                </small>
                            </td>
                            

                            <td>
                                <form action="{{ route('reservas.destroy', $reserva->id) }}" method="POST" style="display:inline;">@csrf @method('DELETE') <button type="submit" class="btn btn-link text-danger p-1" onclick="return confirm('Tem certeza que deseja excluir?')"><i class="bi bi-trash"></i></button></form>
                            </td>


                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="p-5 text-center text-muted">
                                <i class="bi bi-calendar-x display-4 d-block mb-3"></i>
                                <span class="italic">Nenhuma reserva encontrada. Comece realizando uma!</span>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</body>
</html>