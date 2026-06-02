<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Novo Equipamento</title>
    
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f4f7fe;
            color: #1e293b;
        }

        /* Botão de Voltar (Topo) */
        .back-icon {
            width: 48px;
            height: 48px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 14px;
            background: #ffffff;
            color: #475569;
            box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05);
            transition: all 0.3s ease;
            text-decoration: none;
        }
        .back-icon:hover {
            transform: translateX(-5px);
            color: #4338ca;
            box-shadow: 0 10px 15px -3px rgba(67, 56, 202, 0.15);
        }

        /* Card Principal */
        .card-custom {
            background: #ffffff;
            border: none;
            border-radius: 24px;
            box-shadow: 0 20px 40px -10px rgba(0, 0, 0, 0.05);
            padding: 3.5rem 3rem;
            position: relative;
            overflow: hidden;
        }
        
        /* Detalhe de cor no topo do card */
        .card-custom::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #4338ca, #818cf8);
        }

        /* Estilo dos Rótulos (Labels) */
        .form-label {
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            font-weight: 700;
            color: #64748b;
            margin-bottom: 0.6rem;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        
        /* Estilo das Caixas de Texto (Inputs/Selects) */
        .form-control, .form-select {
            border-radius: 12px;
            padding: 1rem 1.25rem; /* Mais alto e confortável */
            border: 2px solid #f1f5f9;
            background-color: #f8fafc;
            color: #0f172a;
            font-weight: 500;
            font-size: 0.95rem;
            transition: all 0.2s ease;
            box-shadow: none;
        }
        
        .form-control:focus, .form-select:focus {
            background-color: #ffffff;
            border-color: #818cf8;
            box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.1) !important;
        }

        /* Hint Text (Texto de Ajuda) */
        .hint-text {
            font-size: 0.8rem;
            color: #94a3b8;
            margin-top: 0.5rem;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        /* Botões de Ação do Formulário */
        .btn-action-group {
            display: flex;
            gap: 1rem;
            margin-top: 2.5rem;
        }

        .btn-cancel {
            flex: 1;
            background-color: #f1f5f9;
            color: #475569;
            border-radius: 12px;
            padding: 1rem;
            font-weight: 600;
            transition: all 0.2s ease;
            text-decoration: none;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 2px solid transparent;
        }
        .btn-cancel:hover {
            background-color: #e2e8f0;
            color: #1e293b;
        }

        .btn-save {
            flex: 2; /* O botão de salvar fica mais largo que o de cancelar */
            background: linear-gradient(135deg, #4338ca, #4f46e5);
            color: white;
            border-radius: 12px;
            padding: 1rem;
            font-weight: 600;
            transition: all 0.3s ease;
            border: none;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            box-shadow: 0 4px 12px rgba(67, 56, 202, 0.25);
        }
        .btn-save:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(67, 56, 202, 0.4);
            color: white;
        }
    </style>
</head>
<body class="p-4 p-md-5 d-flex align-items-center justify-content-center" style="min-height: 100vh;">

    <div class="container" style="max-width: 550px; width: 100%;">
        
        <div class="d-flex align-items-center mb-4 pb-2">
            <a href="{{ route('equipamentos.index') }}" class="back-icon me-4" title="Voltar para a lista">
                <i class="bi bi-arrow-left fs-5"></i>
            </a>
            <div>
                <p class="text-secondary mb-1 fw-bold text-uppercase" style="font-size: 0.75rem; letter-spacing: 1px; color: #64748b;">Novo Registro</p>
                <h2 class="fw-bold mb-0 text-dark" style="letter-spacing: -0.5px;">
                    Cadastrar <span style="color: #4338ca;">Equipamento</span>
                </h2>
            </div>
        </div>

        <div class="card-custom">
            <form action="{{ route('equipamentos.store') }}" method="POST">
                @csrf
                
                <div class="row g-4">
                    <div class="col-12">
                        <label for="descricao" class="form-label">
                            <i class="bi bi-box-seam fs-6 text-primary opacity-75"></i> Descrição do Equipamento
                        </label>
                        <input type="text" name="descricao" id="descricao" class="form-control" placeholder="Ex: Notebook Dell Inspiron" required autocomplete="off">
                    </div>

                    <div class="col-12">
                        <label for="status" class="form-label">
                            <i class="bi bi-activity fs-6 text-primary opacity-75"></i> Status Inicial
                        </label>
                        <select name="status" id="status" class="form-select" required>
                            <option value="disponivel" selected>Disponível (Pronto para uso)</option>
                            <option value="manutencao">Em Manutenção (Aguardando reparo)</option>
                            <option value="indisponivel">Indisponível (Fora de operação)</option>
                        </select>
                        <div class="hint-text">
                            <i class="bi bi-info-circle"></i> Defina a condição física atual do recurso.
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="btn-action-group">
                            <a href="{{ route('equipamentos.index') }}" class="btn-cancel">
                                Cancelar
                            </a>
                            <button type="submit" class="btn-save">
                                <i class="bi bi-cloud-arrow-up fs-5"></i> Salvar Equipamento
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
    @if ($errors->any())
        Swal.fire({
            icon: 'error',
            title: 'Inconsistência nos Dados',
            html: `
                <ul style="text-align: left; color: #475569; font-family: 'Inter', sans-serif; margin-bottom: 0; padding-left: 1.5rem;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            `,
            confirmButtonColor: '#4338ca',
            customClass: { popup: 'rounded-4' }
        });
    @endif

    @if (session('erro'))
        Swal.fire({
            icon: 'warning',
            title: 'Atenção!',
            text: "{{ session('erro') }}",
            confirmButtonColor: '#4338ca',
            customClass: { popup: 'rounded-4' }
        });
    @endif
    </script>
</body>
</html>