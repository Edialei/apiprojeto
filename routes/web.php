<?php


use App\Http\Controllers\ConsultaController;
use App\Http\Controllers\ProntuarioController;
use App\Http\Controllers\MedicoController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;


/* Route::prefix('login')->group(function () {
    Route::get('/', [LoginController::class, 'index'])->name('login.index');
    Route::post('/', [LoginController::class, 'store'])->name('login.store');
});  */

Route::post('/api/login', [LoginController::class, 'store'])->name('api.login');
Route::get('/destroy', [LoginController::class, 'destroy'])->name('login.destroy');

//Route::get('/register', [UserController::class, 'create'])->name('register');
Route::post('/api/registro', [UserController::class, 'store'])->name('api.regsitro');

Route::get('/medico', [MedicoController::class, 'mostrarMedicosDisponiveis'])->name('mostrar_medico');
Route::get('/especialidade', [MedicoController::class, 'mostrarMedicoEspecialidade']);


Route::get('/medico_consultas', [ConsultaController::class, 'medicoConsulta'])->name('medico_consulta');

Route::get('/paciente_consultas', [ConsultaController::class, 'pacienteConsulta'])->name('paciente_consulta');

Route::post('/consultas', [ConsultaController::class, 'storeConsulta']);

Route::get('/medico/{id}/consultas', [ConsultaController::class, 'indexConsultasByMedicoId']);
Route::get('/paciente/{id}/consultas', [ConsultaController::class, 'indexConsultasByPacienteId']);

Route::post('/prontuario', [ProntuarioController::class, 'store']);