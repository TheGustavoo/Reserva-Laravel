
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/style.css') }}">

<div class="container mt-5">
    
     <h2 class="fw-light mb-0">Cadastrar <span class="fw-bold">Nova Sala</span></h2>

    <form action="{{ route('salas.store') }}" method="POST" class="row g-3 p-4 bg-white shadow rounded">
        @csrf

         <div class="col-md-8">
                        <label class="form-label">Descrição da Sala / Laboratório</label>
                        <input type="text" name="descricao" class="form-control" placeholder="Ex: Laboratório de Informática 01" required>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Capacidade (Pessoas)</label>
                        <input type="number" name="capacidade" class="form-control" placeholder="Ex: 30">
                    </div>

        <div class="col-12 mt-4">
            <button type="submit" class="btn btn-primary px-5">Salvar Cadastro</button>
            <a href="{{ route('salas.index') }}" class="btn btn-secondary">Voltar</a>
        </div>
    </form>
</div>

