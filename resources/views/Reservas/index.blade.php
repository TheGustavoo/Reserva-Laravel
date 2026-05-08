<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Reserva de Salas - Início</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 p-10">

    <div class="max-w-6xl mx-auto">
        <h1 class="text-3xl font-bold text-gray-800 mb-8">Sistema de Reserva de Salas</h1>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-10">
            <a href="{{ route('professores.index') }}" class="bg-white p-6 rounded-lg shadow hover:shadow-md transition text-center border-b-4 border-teal-400">
                <span class="block text-2xl mb-2">👨‍🏫</span>
                <span class="font-bold text-teal-600"> Professores</span>
            </a>

            
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-10">
            <a href="{{ route('salas.index') }}" class="bg-white p-6 rounded-lg shadow hover:shadow-md transition text-center border-b-4 border-teal-400">
                <span class="block text-2xl mb-2">👨‍🏫</span>
                <span class="font-bold text-teal-600"> Salas</span>
            </a>

            
        </div>



        <div class="bg-white rounded-lg shadow overflow-hidden">
            <div class="p-4 border-b bg-gray-50">
                <h2 class="font-bold text-gray-700">Reservas Agendadas</h2>
            </div>
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-100 text-gray-600 uppercase text-xs">
                        <th class="p-4 border-b">Professor</th>
                        <th class="p-4 border-b">Sala</th>
                        <th class="p-4 border-b">Data</th>
                        <th class="p-4 border-b">Horário</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($reservas as $reserva)
                    <tr class="hover:bg-gray-50">
                        <td class="p-4 border-b">{{ $reserva->professor->nome }}</td>
                        <td class="p-4 border-b">{{ $reserva->sala->nome }}</td>
                        <td class="p-4 border-b">{{ date('d/m/Y', strtotime($reserva->data_reserva)) }}</td>
                        <td class="p-4 border-b">{{ $reserva->hora_inicio }} às {{ $reserva->hora_fim }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="p-10 text-center text-gray-500 italic">
                            Nenhuma reserva encontrada. Comece realizando uma!
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>