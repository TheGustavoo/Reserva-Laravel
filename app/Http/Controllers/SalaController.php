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
    public function edit($id)
    {
        $sala = \App\Models\Sala::findOrFail($id);
        return view('salas.edit', compact('sala'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, String $id)
    {
       $request->validate([
            'descricao' => 'required|string|max:255',
            'capacidade' => 'required|integer|min:1',
        ], [
            'descricao.required' => 'A descrição da sala é obrigatória.',
            'capacidade.required' => 'A capacidade da sala é obrigatória.',
            'capacidade.min' => 'A capacidade deve ser de pelo menos 1 pessoa.',
        ]);

        // 2. Tenta atualizar o registro no banco de dados
        try {
            // Busca o registro original
            $sala = \App\Models\Sala::findOrFail($id);
            
            // Atualiza os dados usando Mass Assignment
            $sala->update($request->all());

            // Redireciona para a listagem com a mensagem de sucesso
            return redirect()
                ->route('salas.index')
                ->with('successo', 'Sala atualizada com sucesso!');

        } catch (\Exception $e) {
            // Se der algum erro de banco, volta para a tela anterior mantendo o que o usuário digitou
            return back()
                ->withInput()
                ->with('erro', 'Erro ao atualizar a sala: ' . $e->getMessage());
        }
    }
}

