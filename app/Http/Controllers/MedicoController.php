<?php

namespace App\Http\Controllers;

use App\Models\MedicoEspecialidade;
use App\Models\Medico;
use Illuminate\Http\Request;

class MedicoController extends Controller
{
    public function mostrarMedicosDisponiveis()
    {
        $medicos = Medico::all();
        return response()->json($medicos);
    }
    public function mostrarMedicoEspecialidade()
    {
        $especialidades = MedicoEspecialidade::all();
        return response()->json($especialidades);
    }
}
