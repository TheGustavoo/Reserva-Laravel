<?php

namespace App\Http\Controllers;

use App\Models\Reserva;
use Illuminate\Http\Request;

class ReservaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reservas = \App\Models\Reserva::with(['professor', 'sala'])->get();

        return view('reservas.index', compact('reservas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $professores = \App\Models\Professor::all();
        $salas = \App\Models\Sala::all();
        $equipamentos =\App\Models\Equipamento::where('status', 'disponivel')->get();

    
        return view('reservas.create', compact('professores', 'salas', 'equipamentos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    $request->validate([
        'professor_id'   => 'required|exists:professores,id',
        'sala_id'        => 'required_without:equipamento_id|nullable|exists:salas,id',
        'equipamento_id' => 'required_without:sala_id|nullable|exists:equipamentos,id',
        'data_reserva'   => 'required|date|after_or_equal:today', // Não permite data no passado
        'hora_inicio'    => 'required|date_format:H:i',
        'hora_fim'       => 'required|date_format:H:i|after:hora_inicio', // Fim deve ser DEPOIS do início
    ], [
        
        'data_reserva.after_or_equal' => 'Não é possível fazer uma reserva em uma data que já passou.',
        'hora_fim.after'              => 'O horário de término deve ser maior que o horário de início.',
        'sala_id.required_without'    => 'Você deve selecionar pelo menos uma sala ou um equipamento.',
    ]);

    // 2. REGRA DE NEGÓCIO: VERIFICAÇÃO DE CHOQUE DE HORÁRIO
    // Lógica Matemática: Uma reserva conflita se (Novo Início < Fim Existente) E (Novo Fim > Início Existente)
    
    // Verifica conflito de Sala (Se uma sala foi selecionada)
    if ($request->sala_id) {
        $conflitoSala = \App\Models\Reserva::where('data_reserva', $request->data_reserva)
            ->where('sala_id', $request->sala_id)
            ->where(function ($query) use ($request) {
                $query->where('hora_inicio', '<', $request->hora_fim)
                      ->where('hora_fim', '>', $request->hora_inicio);
            })->exists();

        if ($conflitoSala) {
            return back()->withInput()->with('erro', 'Esta SALA já está reservada neste horário.');
        }
    }

    // Verifica conflito de Equipamento (Se um equipamento foi selecionado)
    if ($request->equipamento_id) {
        $conflitoEquipamento = \App\Models\Reserva::where('data_reserva', $request->data_reserva)
            ->where('equipamento_id', $request->equipamento_id)
            ->where(function ($query) use ($request) {
                $query->where('hora_inicio', '<', $request->hora_fim)
                      ->where('hora_fim', '>', $request->hora_inicio);
            })->exists();

        if ($conflitoEquipamento) {
            return back()->withInput()->with('erro', 'Este EQUIPAMENTO já está reservado neste horário.');
        }
    }

    // 3. SE PASSOU POR TUDO, SALVA NO BANCO
    try {
        $reserva = new \App\Models\Reserva;
        $reserva->fill($request->all());
        $reserva->save();

        return redirect()
            ->route('reservas.index')
            ->with('successo', 'Reserva agendada com sucesso!');
    } catch (\Exception $e) {
        return back()->withInput()->with('erro', 'Erro no banco de dados: ' . $e->getMessage());
    }
    }

    /**
     * Display the specified resource.
     */
    public function show(Reserva $reserva)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        // 1. Busca a reserva específica pelo ID
        $reserva = \App\Models\Reserva::findOrFail($id);
    
        // 2. Busca todas as opções para preencher os <select>
        $professores = \App\Models\Professor::all();
        $salas = \App\Models\Sala::all();
        $equipamentos = \App\Models\Equipamento::all();

        // 3. Manda tudo "limpo" para a View
        return view('reservas.edit', compact('reserva', 'professores', 'salas', 'equipamentos'));
    }

    /**
     * Update the specified resource in storage.
     */
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // 1. Valida os dados (regras básicas)
        $request->validate([
            'professor_id'   => 'required|exists:professores,id',
            'sala_id'        => 'required_without:equipamento_id|nullable|exists:salas,id',
            'equipamento_id' => 'required_without:sala_id|nullable|exists:equipamentos,id',
            'data_reserva'   => 'required|date',
            'hora_inicio'    => 'required|date_format:H:i',
            'hora_fim'       => 'required|date_format:H:i|after:hora_inicio',
        ], [
            'hora_fim.after'           => 'O horário de término deve ser maior que o horário de início.',
            'sala_id.required_without' => 'Você deve selecionar pelo menos uma sala ou um equipamento.',
        ]);

        // 2. VERIFICAÇÃO DE CONFLITO (Ignorando a própria reserva!)
        
        // Verifica conflito de Sala
        if ($request->sala_id) {
            $conflitoSala = \App\Models\Reserva::where('data_reserva', $request->data_reserva)
                ->where('sala_id', $request->sala_id)
                ->where('id', '!=', $id) // AQUI ESTÁ O SEGREDO: Ignora a própria reserva
                ->where(function ($query) use ($request) {
                    $query->where('hora_inicio', '<', $request->hora_fim)
                          ->where('hora_fim', '>', $request->hora_inicio);
                })->exists();

            if ($conflitoSala) {
                return back()->withInput()->with('erro', 'A SALA já possui outra reserva neste horário.');
            }
        }

        // Verifica conflito de Equipamento
        if ($request->equipamento_id) {
            $conflitoEquip = \App\Models\Reserva::where('data_reserva', $request->data_reserva)
                ->where('equipamento_id', $request->equipamento_id)
                ->where('id', '!=', $id) // AQUI ESTÁ O SEGREDO: Ignora a própria reserva
                ->where(function ($query) use ($request) {
                    $query->where('hora_inicio', '<', $request->hora_fim)
                          ->where('hora_fim', '>', $request->hora_inicio);
                })->exists();

            if ($conflitoEquip) {
                return back()->withInput()->with('erro', 'O EQUIPAMENTO já possui outra reserva neste horário.');
            }
        }

        // 3. Atualiza no Banco de Dados
        try {
            $reserva = \App\Models\Reserva::findOrFail($id);
            $reserva->update($request->all());

            return redirect()
                ->route('reservas.index')
                ->with('successo', 'Reserva atualizada com sucesso!');
                
        } catch (\Exception $e) {
            return back()->withInput()->with('erro', 'Erro no banco de dados: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reserva $reserva)
    {
        $reserva->delete();
        return redirect()
            ->route('reservas.index')
            ->with('successo', 'excluido com sucesso');
    }
}
