<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'usuario' => 'required', 
            'password' => 'required|min:8'
        ]);

        $credentials = $request->only('usuario', 'password');

        if (!Auth::attempt($credentials) || !Hash::check($request->password, Auth::user()->password)) {
            return response()->json(['error' => 'Usuário ou senha inválidos'], 401);
        }

        $user = Auth::user();
        $token = $user->createToken('TokenName')->plainTextToken;

        return response()->json([
            'user' => [
                'id' => $user->id,
                'firstName' => $user->firstName,
                'lastName' => $user->lastName,
                'email' => $user->email,
                'created_at' => $user->created_at,
                'updated_at' => $user->updated_at
            ],
            'token' => $token,
            'auth' => true,
        ]);
    }


    public function destroy()
    {
        Auth::logout();
    }
}

