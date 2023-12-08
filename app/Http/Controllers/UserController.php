<?php

namespace App\Http\Controllers;

use App\Models\MedicoEspecialidade;
use App\Models\User;
use App\Models\Medico;
use App\Models\Paciente;
use App\Models\TipoUsuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    
    public function store(Request $request)
{
    $validatedData = $request->validate([
        'firstName' => 'required|string|max:255',
        'lastName' => 'required|string|max:255',
        'email' => 'required|email|unique:users|max:255',
        'usuario' => 'required|string|unique:users|max:255',
        'password' => 'required|string|min:8|confirmed',
        'tipoUsuario' => 'required|in:medico,paciente',
    ]);

    $tipoUsuario = TipoUsuario::where('nome', $validatedData['tipoUsuario'])->first();

    if (!$tipoUsuario) {
        $tipoUsuario = TipoUsuario::create(['nome' => $validatedData['tipoUsuario']]);
    }

    $user = User::create([
        'firstName' => $validatedData['firstName'],
        'lastName' => $validatedData['lastName'],
        'email' => $validatedData['email'],
        'usuario' => $validatedData['usuario'],
        'password' => Hash::make($validatedData['password']),
        'tipo_usuario' => $tipoUsuario->id
    ]);

    if ($validatedData['tipoUsuario'] === 'medico') {
        $medicoEspecialidade = MedicoEspecialidade::where('nome', $request->input('medicoEspecialidade'))->first();

        if (!$medicoEspecialidade) {
            $medicoEspecialidade = MedicoEspecialidade::create(['nome' => $request->input('medicoEspecialidade')]);
        }

        Medico::create([
            'id_usuario' => $user->id,
            'crm' => $request->input('medico_crm'),
            'id_especialidade' => $medicoEspecialidade->id,
            'bairro' => $request->input('medico_bairro'),
            'cidade' => $request->input('medico_cidade'),
            'logradouro' => $request->input('medico_logradouro'),
            'preco_consulta' => $request->input('medico_preco'),
        ]);
    } elseif ($validatedData['tipoUsuario'] === 'paciente') {
        Paciente::create([
            'id_usuario' => $user->id,
            'cpf' => $request->input('paciente_cpf'),
            'rg' => $request->input('paciente_rg'),
            'telefone' => $request->input('paciente_telefone'),
            'data_nascimento' => $request->input('paciente_data_nascimento'),
            'convenio' => $request->input('paciente_convenio'),
            'bairro' => $request->input('paciente_bairro'),
            'cidade' => $request->input('paciente_cidade'),
            'logradouro' => $request->input('paciente_logradouro'),
        ]);
    }

    // Retorna os dados do usuário criado
    return response()->json($user, 201);
}
}