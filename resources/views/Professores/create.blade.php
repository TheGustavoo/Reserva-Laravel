
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/style.css') }}">

<div class="container mt-5">
    <h2 class="fw-light mb-0">Cadastrar <span class="fw-bold">Novo Professor</span></h2>

    <form action="{{ route('professores.store') }}" method="POST" class="row g-3 p-4 bg-white shadow rounded">
        @csrf

        <div class="col-md-6">
            <label for="nome" class="form-label">Nome Completo</label>
            <input type="text" name="nome" class="form-control" id="nome" placeholder="Ex: Gustavo Silva" required>
        </div>

        <div class="col-md-6">
            <label for="materia" class="form-label">Matéria / Disciplina</label>
            <input type="text" name="materia" class="form-control" id="materia" placeholder="Ex: Programação Web" required>
        </div>

        <div class="col-12 mt-4">
            <button type="submit" class="btn btn-primary px-5">Salvar Cadastro</button>
            <a href="{{ route('professores.index') }}" class="btn btn-secondary">Voltar</a>
        </div>
    </form>
</div>

