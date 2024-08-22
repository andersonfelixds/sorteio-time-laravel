<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Players;

class PlayerController extends Controller
{
    public function store(Request $request)
    {
        // Validação dos dados
        // $request->validate([
        //     'nome' => 'required|string|max:255',
        //     'nivel' => 'required|integer|min:1|max:5',
        //     'goleiro' => 'required|boolean',
        // ]);

        // Criando o jogador
        $jogador = Players::create([
            'name' => $request->name,
            'level' => $request->level,
            'goalkeeper' => $request->goalkeeper,
            'present' => false, // Por padrão, o jogador não está presente
        ]);

        return response()->json($jogador, 201); // Retorna o jogador criado com status 201 (Created)
    }

    // Método para editar um jogador existente
    public function update(Request $request, $id)
    {
        // Busca o jogador pelo ID
        $jogador = Players::findOrFail($id);

        // Validação dos dados
        $request->validate([
            'name' => 'sometimes|string|max:255',
            'level' => 'sometimes|integer|min:1|max:5',
            'goalkeeper' => 'sometimes|boolean',
            'present' => 'sometimes|boolean',
        ]);

        // Atualiza os campos fornecidos no request
        $jogador->update($request->all());

        return response()->json($jogador, 200); // Retorna o jogador atualizado com status 200 (OK)
    }

    // Método para confirmar a presença de um jogador
    public function confirmarPresenca($id)
    {
        // Busca o jogador pelo ID
        $jogador = Players::findOrFail($id);

        // Confirma a presença
        $jogador->present = true;
        $jogador->save();

        return response()->json(['message' => 'Presença confirmada com sucesso'], 200);
    }
}
