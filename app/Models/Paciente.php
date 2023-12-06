<?php

// app\Models\Paciente.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
    protected $fillable = [
        'id_usuario', 
        'cpf', 
        'rg', 
        'telefone', 
        'data_nascimento', 
        'convenio', 
        'bairro', 
        'cidade',
        'logradouro'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_usuario');
    }

    
    public function consultas()
    {
        return $this->hasMany(Consulta::class, 'id_paciente');
    }
}

