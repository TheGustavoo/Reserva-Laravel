<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Professores</title>
    
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f4f7fe; /* Fundo moderno, levemente azulado */
            color: #1e293b;
        }

        /* Estilo do Card Principal */
        .card-custom {
            background: #ffffff;
            border: none;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.03);
            overflow: hidden;
        }

        /* Cabeçalho do Card */
        .card-header-custom {
            background: #ffffff;
            border-bottom: 1px solid #f1f5f9;
            padding: 1.5rem 2rem;
        }

        /* Botão Novo Professor */
        .btn-add {
            background-color: #4338ca; /* Azul índigo moderno */
            color: white;
            border-radius: 12px;
            padding: 0.6rem 1.2rem;
            font-weight: 500;
            font-size: 0.95rem;
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

        /* Tabela */
        .table > :not(caption) > * > * {
            padding: 1rem 2rem;
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
        .table tbody tr:hover { background-color: #f8fafc; }

        /* Avatares Iniciais */
        .avatar {
            width: 42px;
            height: 42px;
            background: #e0e7ff;
            color: #4338ca;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 0.95rem;
            flex-shrink: 0;
            border: 2px solid #ffffff;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
        }

        /* Badge da Matéria */
        .badge-materia {
            background-color: #f1f5f9;
            color: #475569;
            padding: 0.4rem 0.8rem;
            border-radius: 8px;
            font-weight: 500;
            font-size: 0.85rem;
            border: 1px solid #e2e8f0;
            display: inline-block;
        }

        /* Botões de Ação na Tabela */
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
            <a href="{{ route('reservas.index') }}" class="text-dark text-decoration-none me-3 transition-transform" style="transition: transform 0.2s;">
                <div class="action-icon" style="width: 45px; height: 45px; border-radius: 12px; background: white; box-shadow: 0 2px 10px rgba(0,0,0,0.05);">
                    <i class="bi bi-arrow-left fs-5 text-dark"></i>
                </div>
            </a>
            <div>
                <p class="text-secondary mb-0 fw-medium" style="font-size: 0.85rem; letter-spacing: 0.5px;">DIRETÓRIO DOCENTE</p>
                <h3 class="fw-bold mb-0 text-dark">Professores <span style="color: #4338ca;">Cadastrados</span></h3>
            </div>
        </div>
        
        <div class="card-custom">
            <div class="card-header-custom d-flex justify-content-between align-items-center">
                <h6 class="mb-0 fw-bold text-secondary">Equipe Acadêmica</h6>
                <a href="{{ route('professores.create') }}" class="btn-add text-decoration-none">
                    <i class="bi bi-plus-lg me-1"></i> Novo Professor
                </a>
            </div>
            
            <div class="table-responsive">
                <table class="table mb-0">
                    <thead>
                        <tr>
                            <th class="ps-4">ID</th>
                            <th>Professor</th>
                            <th>Matéria / Disciplina</th>
                            <th class="text-center">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($professores as $professor)
                        <tr>
                            <td class="ps-4">
                                <span class="text-id">#{{ str_pad($professor->id, 4, '0', STR_PAD_LEFT) }}</span>
                            </td>

                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="avatar me-3">
                                        @php
                                            $nomes = explode(' ', $professor->nome);
                                            $iniciais = strtoupper(substr($nomes[0], 0, 1));
                                            if (count($nomes) > 1) {
                                                $iniciais .= strtoupper(substr(end($nomes), 0, 1));
                                            }
                                        @endphp
                                        {{ $iniciais }}
                                    </div>
                                    <div>
                                        <div class="fw-semibold text-dark">{{ $professor->nome }}</div>
                                    </div>
                                </div>
                            </td>

                            <td>
                                <span class="badge-materia">
                                    <i class="bi bi-book me-1 text-secondary"></i> {{ $professor->materia }}
                                </span>
                            </td>

                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="{{ route('professores.edit', $professor->id) }}" class="action-icon edit" title="Editar Professor">
                                        <i class="bi bi-pencil-fill"></i>
                                    </a>

                                    <form action="{{ route('professores.destroy', $professor->id) }}" method="POST" id="form-delete-{{ $professor->id }}" class="m-0">
                                        @csrf 
                                        @method('DELETE') 
                                        <button type="button" class="action-icon delete" onclick="confirmDelete({{ $professor->id }})" title="Excluir Professor">
                                            <i class="bi bi-trash3-fill"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center py-5">
                                <div class="d-inline-flex align-items-center justify-content-center rounded-circle mb-3" style="width: 80px; height: 80px; background: #f8fafc; border: 2px dashed #cbd5e1;">
                                    <i class="bi bi-person-x fs-1 text-secondary opacity-50"></i>
                                </div>
                                <h6 class="fw-bold text-dark">Nenhum professor cadastrado</h6>
                                <p class="text-muted small mb-0">Clique no botão "Novo Professor" para adicionar o primeiro docente.</p>
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
            title: 'Remover Professor?',
            text: "Esta ação apagará permanentemente o registro deste professor.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#e11d48', // Vermelho moderno
            cancelButtonColor: '#64748b', // Cinza moderno
            confirmButtonText: 'Sim, remover',
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>