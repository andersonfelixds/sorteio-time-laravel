<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Players; // Certifique-se de importar o modelo Jogador

class TimeController extends Controller
{
    public function __construct()
    {
        // $this->middleware(function ($request, $next) {
        //     $response = $next($request);
        //      $response->header('Access-Control-Allow-Origin', '*');
        //      $response->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
        //      $response->header('Access-Control-Allow-Headers', 'Content-Type, Authorization');
        //      $response->header('Access-Control-Allow-Credentials', 'false');
        //     return $response;
        // });
    }
    // Função para sortear os times
    public function sortearTimes(Request $request)
    {
        $numeroDeJogadoresPorTime = $request->input('numero_de_jogadores_por_time');

        // Verifique se há jogadores suficientes para o sorteio
        $jogadores = Players::where('present', true)->get();
        if ($jogadores->count() < $numeroDeJogadoresPorTime * 2) {
            return response()->json(['error' => 'Número insuficiente de jogadores confirmados.'], 400);
        }

        // Filtrar goleiros e jogadores de linha
        $goleiros = $jogadores->where('goalkeeper', true);
        $jogadoresDeLinha = $jogadores->where('goalkeeper', false);

        $times = [];
        $timeCount = ceil($jogadores->count() / $numeroDeJogadoresPorTime);

        foreach (range(1, $timeCount) as $timeIndex) {
            $times[$timeIndex] = [
                'goleiro' => $goleiros->shift(),
                'jogadores' => $jogadoresDeLinha->splice(0, $numeroDeJogadoresPorTime - 1)
            ];
        }

         if ($jogadoresDeLinha->isNotEmpty()) {
            $times[$timeCount]['jogadores'] = $times[$timeCount]['jogadores']->merge($jogadoresDeLinha);
        }
        $response = response()->json(['times' => $times]);
        return $response;
    }
}
