<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoUsuario extends Model
{
    protected $fillable = ['nome'];

    public function usuarios()
    {
        return $this->hasMany(User::class, 'tipo_usuario');
    }
}
