<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('login');
    }

    public function store(Request $request)
    {
        $request->validate([
            'usuario' => 'required', 
            'password' => 'required|min:8'
        ], [
            'usuario.required' => 'Este campo de usuário é obrigatório.', 
            'password.required' => 'Este campo de senha é obrigatório.',
            'password.min' => 'Este campo deve ter no mínimo :min caracteres.',
        ]);

        $credentials = $request->only('usuario', 'password'); 
        $authenticated = Auth::attempt($credentials);

        if (!$authenticated) {
            return redirect()->route('login.index')->withErrors(['error' => 'Usuário ou senha inválidos.']);
        }

        //return redirect()->route('mostrar_medicos')->with('success', 'Logado com sucesso.');

    }

    public function destroy()
    {
        Auth::logout();
        return redirect()->route('login.index');
    }
}

