
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/style.css') }}">

<div class="container mt-5">
    <h2 class="fw-light mb-0">Cadastrar <span class="fw-bold">Novo Equipamento</span></h2>

    <form action="{{ route('equipamentos.store') }}" method="POST" class="row g-3 p-4 bg-white shadow rounded">
        @csrf

        <div class="col-md-6">
            <label for="descricao" class="form-label">Descrição</label>
            <input type="text" name="descricao" class="form-control" id="descricao" placeholder="Ex: Notebook" required>
        </div>

        <div class="col-md-6">
    <label class="form-label">Status Inicial</label>
    <select name="status" class="form-select" required>
        <option value="disponivel" selected>🟢 Disponível</option>
        <option value="manutencao">🟡 Em Manutenção</option>
        <option value="indisponivel">🔴 Indisponível</option>
    </select>
    <small class="text-muted">Defina a condição atual do equipamento.</small>
</div>
<div class="col-12 mt-4">
            <button type="submit" class="btn btn-primary px-5">Salvar Cadastro</button>
            <a href="{{ route('equipamentos.index') }}" class="btn btn-secondary">Voltar</a>
        </div>
    </form>
</div>


