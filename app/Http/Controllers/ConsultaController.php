<?php

namespace App\Http\Controllers;

use App\Models\Consulta;
use App\Models\Medico;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ConsultaController extends Controller
{   

    
    public function create()
    {
        $medicos = Medico::all();
        return view('consulta', ['medicos' => $medicos]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_medico' => 'required|exists:medicos,id', 
            'horario_inicio' => 'required|date_format:H:i', 
            'horario_termino' => 'required|date_format:H:i|after:horario_inicio', 
            'duracao' => 'required|integer|min:1', 
            'data' => 'required|date', 
        ]);

        $user = Auth::user();

        if (!$user || !$user->paciente) {
            return redirect()->back()->withErrors(['error' => 'Paciente não encontrado.']);
        }

        $medico = Medico::find($request->input('id_medico'));

        if (!$medico) {
            return redirect()->back()->withErrors(['error' => 'Médico não encontrado.']);
        }

        $consulta = Consulta::create([
            'id_medico' => $medico->id,
            'id_paciente' => $user->paciente->id,
            'horario_inicio' => $request->input('horario_inicio') . ':00',
            'horario_termino' => $request->input('horario_termino'). ':00',
            'duracao' => $request->input('duracao'),
            'data' => $request->input('data'),
        ]);

        return redirect()->route('consulta')->with('success', 'Consulta agendada com sucesso.');
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

        return response()->json(['consultas' => $consultas]);
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


        return response()->json(['consultas' => $consultas]);
    }
}
