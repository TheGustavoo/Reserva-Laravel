<?php

namespace App\Http\Controllers;
use App\Models\Equipamento;
use Illuminate\Http\Request;

class EquipamentoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $equipamentos = Equipamento::all();
        return view('equipamentos.index', compact('equipamentos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('equipamentos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         try {

            $equipamento= new Equipamento;
            $equipamento->fill($request->all());
            $equipamento->save();
            return redirect()
                ->route('equipamentos.index')
                ->with('successo', 'Equipamento salvo com sucesso!');    
        }
        catch (Exception $e) {
            return 'Houve um erro no banco de dados';
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
   public function edit($id)
    {
         // 1. Busca o equipamento específica pelo ID
        $equipamento = \App\Models\Equipamento::findOrFail($id);

        // 3. Manda tudo "limpo" para a View
        return view('equipamentos.edit', compact( 'equipamento'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
         $request->validate([
            'descricao' => 'required|string|max:255',
        ], [
            'descricao.required' => 'O descrição do equipamento é obrigatório.',
        ]);

        // 2. Tenta atualizar o registro no banco de dados
        try {
            // Busca o registro original
            $equipamento = \App\Models\Equipamento::findOrFail($id);
            
            // Atualiza os dados usando Mass Assignment
            $equipamento->update($request->all());

            // Redireciona para a listagem com a mensagem de sucesso
            return redirect()
                ->route('equipamentos.index')
                ->with('successo', 'equipamento atualizado com sucesso!');

        } catch (\Exception $e) {
            // Se der algum erro de banco, volta para a tela anterior mantendo o que o usuário digitou
            return back()
                ->withInput()
                ->with('erro', 'Erro ao atualizar o equipamento: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Equipamento $equipamento)
    {
         $equipamento->delete();
        return redirect()
            ->route('equipamentos.index')
            ->with('successo', 'excluido com sucesso');
    }
}
