<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProntuariosTable extends Migration
{
    public function up()
    {
        Schema::create('prontuarios', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_consulta')->constrained('consulta', 'ConsultaID');
            $table->string('sintomas'); 
            $table->string('alergias');
            $table->string('historico_familiar'); 
            $table->string('tipo_sanguineo'); 
            $table->string('medicacoes');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('prontuarios');
    }
}

