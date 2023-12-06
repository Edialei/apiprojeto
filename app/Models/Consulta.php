<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Consulta extends Model
{
    protected $fillable = [
        'id_medico', 
        'id_paciente', 
        'horario_inicio', 
        'horario_termino', 
        'duracao', 
        'data'
    ];

    public function medico()
    {
        return $this->belongsTo(Medico::class, 'id_medico');
    }

    public function paciente()
    {
        return $this->belongsTo(Paciente::class, 'id_paciente');
    }

    public function prontuario()
    {
        return $this->hasOne(Prontuario::class, 'id_consulta');
    }
}
