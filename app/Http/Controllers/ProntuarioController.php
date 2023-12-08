<?php

namespace App\Http\Controllers;


use App\Models\Prontuario;
use Illuminate\Http\Request;

class ProntuarioController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->json()->all();

        $validatedDdata = $this->validate($request,[
            'id_consulta' => 'required|exists:consultas,id',
            'sintomas' => 'required'
            
        ]);
            
        $prontuario = Prontuario::create($data);

        return response()->json($prontuario, 201);
    }
}
