<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Salas</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body class="bg-light">

    <div class="container mt-5">
        <div class="card shadow">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <h3 class="mb-0">Salas Cadastradas</h3>
                <a href="{{ route('salas.create') }}" class="btn btn-light btn-sm">Nova Sala</a>
                
                
            </div>
            
            <div class="card-body">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>Capacidade</th>
                            <th class="text-center">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($salas as $sala)
                        <tr>
                            <td>{{ $sala->id }}</td>
                            <td>{{ $sala->nome }}</td>
                            <td>{{ $sala->capacidade }}</td>
                            <td class="text-center">

                                <a href="#" class="btn btn btn-link btn-sm"><i class="bi bi-pencil-square"></i> </a> 

                                <form action="{{ route('salas.destroy', $sala->id) }}" method="POST" style="display:inline;">@csrf @method('DELETE') <button type="submit" class="btn btn-link text-danger p-1" onclick="return confirm('Tem certeza que deseja excluir?')"><i class="bi bi-trash"></i></button></form>
                                
                                
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>