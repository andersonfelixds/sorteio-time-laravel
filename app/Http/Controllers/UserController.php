<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Http\Requests\UserCreateFormRequest;
use Laravel\Sanctum\NewAccessToken;


class UserController extends Controller
{
    public function authenticate(Request $request)
    {
        $user = User::where('email', $request->email)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            return response(['email' => 'The provided credentials are incorrect.'],203);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return response([
            'access_token' => $token,
                 'token_type' => 'Bearer',
            ],201);
    }

    public function user()
    {
        $user =  auth()->user(); 
    }

    public function store(UserCreateFormRequest $request)
    {
        $request->validated(); 
        $request->merge([
            'password' => bcrypt($request->password)
        ]);
        $user = User::query()->firstOrCreate($request->all());
        return response($user,201);
    }


    public function me(Request $request)
    {
        return $request->user();
    }

    public function updateEmail(ChangeEmailFormRequest $request)
    {
         /** @var User */
         $user = $request->user();
         $user->email = $request->email;
         $user->save();

         return [
                     'message' => 'User e-mail updated successfully!',
                     'user'    => $user
                ];
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        return [
            'message' => 'All user tokens were revoked !',
       ];

    }

}
