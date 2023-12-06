<?php


use App\Http\Controllers\ConsultaController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MedicoController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::prefix('login')->group(function () {
    Route::get('/', [LoginController::class, 'index'])->name('login.index');
    Route::post('/', [LoginController::class, 'store'])->name('login.store');
    Route::get('/destroy', [LoginController::class, 'destroy'])->name('login.destroy');
});

Route::get('/register', [UserController::class, 'create'])->name('register');
Route::post('/register', [UserController::class, 'store']);

Route::get('/medicos', [MedicoController::class, 'mostrarMedicosDisponiveis'])->name('mostrar_medicos');
Route::get('/especialidade', [MedicoController::class, 'mostrarMedicoEspecialidade']);


Route::get('/medico_consultas', [ConsultaController::class, 'medicoConsulta'])->name('medico_consulta');
Route::get('/paciente_consultas', [ConsultaController::class, 'pacienteConsulta'])->name('paciente_consulta');
Route::get('/consulta', [ConsultaController::class, 'create'])->name('consulta');
Route::post('/consulta', [ConsultaController::class, 'store']);