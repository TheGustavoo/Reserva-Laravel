<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Reservas - Início</title>
    
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
        .avatar-circle {
            width: 38px;
            height: 38px;
            background-color: #94a3b8; /* Cinza suave estilo profissional */
            color: #ffffff;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.9rem;
            font-weight: 600;
            text-transform: uppercase;
            flex-shrink: 0;
        }

        .prof-info {
            display: flex;
            align-items: center;
            gap: 12px;
        }
    </style>
</head>
<body class="p-4 p-md-5">

    <div class="container max-w-6xl">
        <h1 class="fw-light mb-5">Sistema de <span class="fw-bold">Reserva de Salas</span></h1>

        <div class="row g-4 mb-5">
            <div class="col-md-3">
                <a href="{{ route('reservas.index') }}" class="card card-menu p-4 text-center active-menu">
                    <span class="display-6 mb-2"></span>
                    <span class="h5 mb-0 text-primary fw-bold">RESERVAS</span>
                </a>
            </div>

            <div class="col-md-3">
                <a href="{{ route('professores.index') }}" class="card card-menu p-4 text-center bg-white">
                    <span class="display-6 mb-2"></span>
                    <span class="h5 mb-0 text-dark">PROFESSORES</span>
                </a>
            </div>

            <div class="col-md-3">
                <a href="{{ route('equipamentos.index') }}" class="card card-menu p-4 text-center bg-white">
                    <span class="display-6 mb-2"></span>
                    <span class="h5 mb-0 text-dark">EQUIPAMENTOS</span>
                </a>
            </div>

            <div class="col-md-3">
                <a href="{{ route('salas.index') }}" class="card card-menu p-4 text-center bg-white">
                    <span class="display-6 mb-2"></span>
                    <span class="h5 mb-0 text-dark">SALAS</span>
                </a>
            </div>
        </div>

        <div class="card table-card overflow-hidden">
            <div class="card-header bg-white p-3 border-bottom d-flex justify-content-between align-items-center">
                <h5 class="mb-0 fw-bold text-secondary">Reservas Agendadas</h5>
                <a href="{{ route('reservas.create') }}" class="btn btn-primary shadow-sm fw-medium">
    <i class="bi bi-plus-lg me-2"></i> Nova Reserva
</a>
            </div>
            
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr class="text-secondary small text-uppercase">
                            <th class="ps-4">Professor / Equipamento</th>
                            <th>Sala</th>
                            <th>Data</th>
                            <th>Horário</th>
                            <th class="text-center">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($reservas as $reserva)
                        <tr>
                            <td class="ps-4">
                                <div class="d-flex align-items-center">
                                    <div class="avatar-circle me-3 shadow-sm">
                                        @php
                                            $nomes = explode(' ', $reserva->professor->nome);
                                            $iniciais = strtoupper(substr($nomes[0], 0, 1));
                                            if (count($nomes) > 1) {
                                                $iniciais .= strtoupper(substr(end($nomes), 0, 1));
                                            }
                                        @endphp
                                        {{ $iniciais }}
                                    </div>
                                    
                                    <div>
                                        <div class="fw-bold text-dark">{{ $reserva->professor->nome }}</div>
                                        <div class="mt-1">
                                            @if($reserva->equipamento)
                                                <span class="badge bg-light text-secondary border rounded-pill px-2 py-1" style="font-size: 0.75rem;">
                                                     {{ $reserva->equipamento->descricao }}
                                                </span>
                                            @else
                                                <span class="badge bg-light text-secondary border rounded-pill px-2 py-1" style="font-size: 0.75rem;">
                                                     Sem equipamento extra
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </td>

                            <td>
                                @if($reserva->sala)
                                    <span class="badge bg-light text-dark border"> {{ $reserva->sala->descricao }}</span>
                                @else
                                    <span class="text-muted fst-italic" style="font-size: 0.85rem;">Apenas Equipamento</span>
                                @endif
                            </td>

                            <td>{{ date('d/m/Y', strtotime($reserva->data_reserva)) }}</td>
                            <td>
                                <small class="text-muted">
                                    <i class="bi bi-clock"></i> {{ $reserva->hora_inicio }} - {{ $reserva->hora_fim }}
                                </small>
                            </td>

                            <td class="text-center"> <a href="{{ route('reservas.edit', $reserva->id) }}" class="btn btn-link text-primary p-1 me-2" title="Editar Reserva"><i class="bi bi-pencil-square"></i></a>

                            <form action="{{ route('reservas.destroy', $reserva->id) }}" method="POST" id="form-delete-{{ $reserva->id }}" style="display:inline;">@csrf @method('DELETE') <button type="button" class="btn btn-link text-danger p-1" onclick="confirmDelete({{ $reserva->id }})" title="Excluir"><i class="bi bi-trash"></i>
                        </button>
                     </form>
                    </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="p-5 text-center text-muted">
                                <i class="bi bi-calendar-x display-4 d-block mb-3"></i>
                                <span class="fst-italic">Nenhuma reserva encontrada. Comece realizando uma!</span>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
    function confirmDelete(id) {
        Swal.fire({
            title: 'Tem certeza?',
            text: "Você não poderá reverter esta exclusão!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#94a3b8',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sim, excluir!',
            cancelButtonText: 'Cancelar',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('form-delete-' + id).submit();
            }
        })
    }
    
    // Alerta de sucesso se houver mensagem na sessão
    @if(session('successo'))
        Swal.fire({
            icon: 'success',
            title: 'Sucesso!',
            text: "{{ session('successo') }}",
            timer: 3000,
            showConfirmButton: false
        });
    @endif
    </script>
</body>
</html>