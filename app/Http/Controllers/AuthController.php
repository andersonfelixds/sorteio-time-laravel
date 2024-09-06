<?php 

namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Routing\Controller;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        // Valide a requisição
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Verifique as credenciais
        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            // Gere o token (nomeie o token, se necessário)
            $token = $user->createToken('auth_token')->plainTextToken;

            // Retorne o token e outros dados do usuário
            return response()->json([
                'token' => $token,
                'user' => $user,
            ]);
        }

        return response()->json(['error' => 'Unauthorized'], 401);
    }
}
