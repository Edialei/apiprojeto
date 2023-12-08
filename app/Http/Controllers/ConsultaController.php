<?php

namespace App\Http\Controllers;

use App\Models\Consulta;
use App\Models\Paciente;
use App\Models\Medico;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ConsultaController extends Controller
{   

    public function storeConsulta(Request $request)
    {
        $validatedData = $request->validate([
            'id_medico' => 'required|exists:medicos,id',
            'horario_consulta' => 'required|date_format:H:i',
            'duracao' => 'required|integer|min:1',
            'data' => 'required|date',
        ]);
    
        // Autenticar o usuário corretamente
        $user = Auth::user();
    
        // Certificar-se de que o usuário autenticado tem um perfil de paciente
        if (!$user || !$user->paciente) {
            return response()->json(['error' => 'Usuário não autorizado ou perfil de paciente não encontrado.'], 401);
        }
    
        $medico = Medico::find($validatedData['id_medico']);
    
        if (!$medico) {
            return response()->json(['error' => 'Médico não encontrado.'], 400);
        }
        
        $horarioTermino = \Carbon\Carbon::createFromFormat('H:i', $validatedData['horario_consulta'])
            ->addMinutes($validatedData['duracao'])
            ->format('H:i:s');
    
        $consulta = Consulta::create([
            'id_medico' => $medico->id,
            'id_paciente' => $user->paciente->id,
            'horario_inicio' => $validatedData['horario_consulta'] . ':00',
            'horario_termino' => $horarioTermino,
            'duracao' => $validatedData['duracao'],
            'data' => $validatedData['data'],
        ]);
    
        return response()->json([
            'id_consulta' => $consulta->id,
            'data' => $consulta->data,
            'horario_inicio' => $consulta->horario_inicio,
            'horario_termino' => $consulta->horario_termino,
        ], 201);
    }



    public function medicoConsulta()
    {
            $consultas = DB::table('consultas')
            ->join('medicos', 'consultas.id_medico', '=', 'medicos.id')
            ->join('users as medico_user', 'medicos.id_usuario', '=', 'medico_user.id')
            ->join('medico_especialidades', 'medicos.id_especialidade', '=', 'medico_especialidades.id')
            ->join('pacientes', 'consultas.id_paciente', '=', 'pacientes.id') 
            ->select(
                'consultas.id as id_consulta',
                'medicos.id as id_medico',
                'medico_user.firstName as medico_firstName',
                'medico_user.lastName as medico_lastName',
                'medico_especialidades.nome as medico_especialidade',
                'medicos.preco_consulta',
                'medicos.crm', 
                'consultas.data',
                'consultas.horario_inicio',
                'consultas.horario_termino',
                'medicos.logradouro',
                'medicos.bairro',
                'medicos.cidade'
            )
            ->get();

        return response()->json($consultas);
    }

    public function pacienteConsulta()
    {
        $consultas = DB::table('consultas')
            ->join('medicos', 'consultas.id_medico', '=', 'medicos.id')
            ->join('users as medico_user', 'medicos.id_usuario', '=', 'medico_user.id')
            ->join('medico_especialidades', 'medicos.id_especialidade', '=', 'medico_especialidades.id')
            ->join('pacientes', 'consultas.id_paciente', '=', 'pacientes.id')
            ->join('users as paciente_user', 'pacientes.id_usuario', '=', 'paciente_user.id')
            ->select(
                'consultas.id as id_consulta',
                'pacientes.id as id_paciente',
                'paciente_user.firstName as paciente_firstName',
                'paciente_user.lastName as paciente_lastName',
                'medico_especialidades.nome as medico_especialidade',
                'pacientes.telefone as paciente_telefone',
                'medicos.preco_consulta',
                'consultas.data',
                'consultas.horario_inicio',
                'consultas.horario_termino',
                'pacientes.logradouro',
                'pacientes.bairro',
                'pacientes.cidade'
            )
            ->get();


        return response()->json($consultas);
    }

    public function indexConsultasByMedicoId($id)
    {
        $medico = Medico::find($id); 

        $consultas = DB::table('consultas')
            ->join('medicos', 'consultas.id_medico', '=', 'medicos.id')
            ->join('users as medico_user', 'medicos.id_usuario', '=', 'medico_user.id')
            ->join('medico_especialidades', 'medicos.id_especialidade', '=', 'medico_especialidades.id')
            ->join('pacientes', 'consultas.id_paciente', '=', 'pacientes.id')
            ->join('users as paciente_user', 'pacientes.id_usuario', '=', 'paciente_user.id')
            ->where('id_medico', '=', $id)
            ->select(
                'consultas.id as id_consulta',
                'medicos.id as id_medico',
                'pacientes.id as id_paciente',
                'paciente_user.firstName as paciente_firstName',
                'paciente_user.lastName as paciente_lastName',
                'medico_especialidades.nome as medico_especialidade',
                'pacientes.telefone as paciente_telefone',
                'medicos.preco_consulta',
                'medicos.aceita_convenio',
                'consultas.data',
                'consultas.horario_inicio',
                'consultas.horario_termino',               
            )
            ->get();

        return response()->json($consultas);
    }

    public function indexConsultasByPacienteId($id)
    {
        $paciente= Paciente::find($id);

        $consultas = DB::table('consultas')
            ->join('medicos', 'consultas.id_medico', '=', 'medicos.id')
            ->join('users as medico_user', 'medicos.id_usuario', '=', 'medico_user.id')
            ->join('medico_especialidades', 'medicos.id_especialidade', '=', 'medico_especialidades.id')
            ->join('pacientes', 'consultas.id_paciente', '=', 'pacientes.id')
            ->join('users as paciente_user', 'pacientes.id_usuario', '=', 'paciente_user.id')
            ->where('id_paciente', '=', $id)
            ->select(
                'consultas.id as id_consulta',
                'pacientes.id as id_paciente',
                'medico_user.firstName as medico_firstName',
                'medico_user.lastName as medico_lastName',
                'medico_especialidades.nome as medico_especialidade',
                'pacientes.telefone as paciente_telefone',
                'medicos.preco_consulta',
                'consultas.data',
                'consultas.horario_inicio',
                'consultas.horario_termino',
                'pacientes.possui_convenio',
                'pacientes.logradouro',
                'pacientes.bairro',
                'pacientes.cidade'
            )
            ->get();


        return response()->json($consultas);

    }
}
