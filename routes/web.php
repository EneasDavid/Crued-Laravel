<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AlunosController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//Criar aluno
Route::get('/', [AlunosController::class, 'listarAluno']);
Route::get('/criarAluno', [AlunosController::class, 'criarAluno']);
Route::post('/Forms-Aluno-Criar',[AlunosController::class, 'criarAlunoForms'])->name('criarAluno');
Route::delete('/destruir/{id}',[AlunosController::class, 'destruirAluno'])->name('destruirAluno');
Route::get('/editarAluno/{id}', [AlunosController::class, 'editarAluno']);
Route::POST('/Forms-Aluno-Editar/{id}',[AlunosController::class, 'editarAlunoForms']);
