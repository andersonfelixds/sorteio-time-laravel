<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Players;

class PlayerController extends Controller
{
    public function store(Request $request)
    {
        $jogador = Players::create([
            'name' => $request->name,
            'level' => $request->level,
            'goalkeeper' => $request->goalkeeper,
            'present' => false, 
        ]);

        return response()->json($jogador, 201); 
    }

    public function update(Request $request, $id)
    {
        $jogador = Players::findOrFail($id);

        $request->validate([
            'name' => 'sometimes|string|max:255',
            'level' => 'sometimes|integer|min:1|max:5',
            'goalkeeper' => 'sometimes|boolean',
            'present' => 'sometimes|boolean',
        ]);

        $jogador->update($request->all());
        return response()->json($jogador, 200); 
    }

    public function list()
    {
        $jogador = Players::get();
        return response()->json($jogador, 200);
    }

    public function confirmarPresenca(Request $request)
    {
        foreach($request->presenca as $presenca) {
            $jogador = Players::findOrFail($presenca);
            $jogador->present = true;
            $jogador->save();  
        }
      
        return response()->json(['message' => 'Presença confirmada com sucesso'], 200);
    }

    
}
