<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prontuario extends Model
{
    protected $fillable = [
        'id_consulta',
        'sintomas',
        'alergias',
        'historico_familiar',
        'tipo_saguineo',
        'medicacoes'
    ];

    public function consulta()
    {
        return $this->belongsTo(Consulta::class, 'id_consulta');
    }
}