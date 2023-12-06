<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MedicoEspecialidade extends Model
{
    protected $fillable = ['nome'];

    public function medicos()
    {
        return $this->hasMany(Medico::class, 'id_especialidade');
    }
}