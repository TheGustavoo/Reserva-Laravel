<?php

namespace App\Http\Controllers;

use App\Models\Sala;
use Illuminate\Http\Request;

class SalaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $salas = Sala::all();
        return view('salas.index', compact('salas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('salas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {

            $sala= new Sala;
            $sala->fill($request->all());
            $sala->save();
            return redirect()
                ->route('salas.index')
                ->with('successo', 'sala salva com sucesso!');    
        }
        catch (Exception $e) {
            return 'Houve um erro no banco de dados';
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Sala $sala)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sala $sala)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Sala $sala)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sala $sala)
    {
        {
        $sala->delete();
        return redirect()
            ->route('salas.index')
            ->with('successo', 'excluido com sucesso');
    }
    }
}
