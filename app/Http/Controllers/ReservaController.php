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

    
        return view('reservas.create', compact('professores', 'salas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {

            $reserva= new Reserva;
            $reserva->fill($request->all());
            $reserva->save();
            return redirect()
                ->route('reservas.index')
                ->with('successo', 'reserva salvo com sucesso!');    
        }
        catch (Exception $e) {
            return 'Houve um erro no banco de dados';
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
    public function edit(Reserva $reserva)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Reserva $reserva)
    {
        //
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
