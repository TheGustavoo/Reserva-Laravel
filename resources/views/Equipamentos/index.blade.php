<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Equipamentos</title>
    
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f4f7fe;
            color: #1e293b;
        }

        .card-custom {
            background: #ffffff;
            border: none;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.03);
            overflow: hidden;
        }

        .card-header-custom {
            background: #ffffff;
            border-bottom: 1px solid #f1f5f9;
            padding: 1.5rem 2rem;
        }

        .btn-add {
            background-color: #4338ca;
            color: white;
            border-radius: 12px;
            padding: 0.6rem 1.2rem;
            font-weight: 500;
            transition: all 0.3s ease;
            border: none;
            box-shadow: 0 4px 10px rgba(67, 56, 202, 0.2);
        }
        .btn-add:hover {
            background-color: #3730a3;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(67, 56, 202, 0.3);
        }

        .table > :not(caption) > * > * {
            padding: 1.2rem 2rem;
            vertical-align: middle;
            border-bottom-color: #f1f5f9;
        }
        .table thead th {
            background-color: #f8fafc;
            color: #64748b;
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-weight: 600;
            border-bottom: 2px solid #e2e8f0;
        }

        /* Status Pills Modernas */
        .status-pill {
            padding: 0.4rem 0.8rem;
            border-radius: 8px;
            font-weight: 600;
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.3px;
            border: 1px solid transparent;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }
        .status-pill::before {
            content: '';
            width: 6px;
            height: 6px;
            border-radius: 50%;
        }

        .status-available { background: #ecfdf5; color: #065f46; border-color: #d1fae5; }
        .status-available::before { background: #10b981; }

        .status-maintenance { background: #fffbeb; color: #92400e; border-color: #fef3c7; }
        .status-maintenance::before { background: #f59e0b; }

        .status-unavailable { background: #fef2f2; color: #991b1b; border-color: #fee2e2; }
        .status-unavailable::before { background: #ef4444; }

        .action-icon {
            width: 36px;
            height: 36px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 10px;
            transition: 0.2s;
            color: #64748b;
            background: #f8fafc;
            border: 1px solid transparent;
            text-decoration: none;
        }
        .action-icon.edit:hover { color: #4338ca; background: #e0e7ff; border-color: #c7d2fe; }
        .action-icon.delete:hover { color: #e11d48; background: #ffe4e6; border-color: #fecdd3; }

        .text-id { color: #94a3b8; font-family: monospace; font-size: 0.85rem; }
    </style>
</head>
<body class="p-4 p-md-5">

    <div class="container" style="max-width: 1100px;">
        
        <div class="d-flex align-items-center mb-4">
            <a href="{{ route('reservas.index') }}" class="text-dark text-decoration-none me-3">
                <div class="action-icon" style="width: 45px; height: 45px; border-radius: 12px; background: white; box-shadow: 0 2px 10px rgba(0,0,0,0.05);">
                    <i class="bi bi-arrow-left fs-5"></i>
                </div>
            </a>
            <div>
                <p class="text-secondary mb-0 fw-medium" style="font-size: 0.85rem; letter-spacing: 0.5px;">CONTROLE DE ATIVOS</p>
                <h3 class="fw-bold mb-0 text-dark">Equipamentos <span style="color: #4338ca;">Cadastrados</span></h3>
            </div>
        </div>
        
        <div class="card-custom">
            <div class="card-header-custom d-flex justify-content-between align-items-center">
                <h6 class="mb-0 fw-bold text-secondary">Inventário de Recursos</h6>
                <a href="{{ route('equipamentos.create') }}" class="btn-add text-decoration-none">
                    <i class="bi bi-plus-lg me-1"></i> Novo Equipamento
                </a>
            </div>
            
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead>
                        <tr>
                            <th class="ps-4">ID</th>
                            <th>Recurso / Descrição</th>
                            <th>Status Operacional</th>
                            <th class="text-center">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($equipamentos as $equipamento)
                        <tr>
                            <td class="ps-4">
                                <span class="text-id">#{{ str_pad($equipamento->id, 4, '0', STR_PAD_LEFT) }}</span>
                            </td>

                            <td>
                                <div class="fw-semibold text-dark">{{ $equipamento->descricao }}</div>
                            </td>

                            <td>
                                @if($equipamento->status == 'disponivel')
                                    <span class="status-pill status-available">Disponível</span>
                                @elseif($equipamento->status == 'manutencao')
                                    <span class="status-pill status-maintenance">Manutenção</span>
                                @else
                                    <span class="status-pill status-unavailable">Indisponível</span>
                                @endif
                            </td>

                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="{{ route('equipamentos.edit', $equipamento->id) }}" class="action-icon edit" title="Editar">
                                        <i class="bi bi-pencil-fill"></i>
                                    </a>

                                    <form action="{{ route('equipamentos.destroy', $equipamento->id) }}" method="POST" id="form-delete-{{ $equipamento->id }}" class="m-0">
                                        @csrf 
                                        @method('DELETE') 
                                        <button type="button" class="action-icon delete" onclick="confirmDelete({{ $equipamento->id }})" title="Excluir">
                                            <i class="bi bi-trash3-fill"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center py-5">
                                <i class="bi bi-box-seam fs-1 text-secondary opacity-25 d-block mb-3"></i>
                                <h6 class="fw-bold text-dark">Nenhum equipamento localizado</h6>
                                <p class="text-muted small">Adicione novos itens para gerenciar o inventário.</p>
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
            title: 'Excluir Equipamento?',
            text: "Esta ação removerá o item permanentemente do inventário.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#e11d48',
            cancelButtonColor: '#64748b',
            confirmButtonText: 'Sim, excluir',
            cancelButtonText: 'Cancelar',
            reverseButtons: true,
            customClass: { popup: 'rounded-4' }
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('form-delete-' + id).submit();
            }
        })
    }

    @if(session('successo'))
        Swal.fire({
            icon: 'success',
            title: 'Sucesso!',
            text: "{{ session('successo') }}",
            timer: 2500,
            showConfirmButton: false,
            customClass: { popup: 'rounded-4' }
        });
    @endif
    </script>
</body>
</html>