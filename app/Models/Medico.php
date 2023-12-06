<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Medico extends Model
{
    protected $fillable = [
        'id_usuario', 
        'crm', 
        'id_especialidade',
        'bairro',
        'cidade',
        'logradouro',
        'preco_consulta'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_usuario'); 
    }
    public function usuario()
    {
        return $this->belongsTo(User::class, 'id_usuario');
    }

    public function consultas()
    {
        return $this->hasMany(Consulta::class, 'id_medico');
    }

    public function especialidade()
    {
        return $this->belongsTo(MedicoEspecialidade::class, 'id_especialidade');
    }
}