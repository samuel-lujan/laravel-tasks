<?php

use Illuminate\Support\Facades\Route;

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

Auth::routes();

Route::get('/',         [App\Http\Controllers\HomeController::class, 'index']);
Route::get('/home',     [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/projetos',  [App\Http\Controllers\HomeController::class, 'projetos'])->name('projetos');

//Projetos
    Route::post('/salvar-projeto',             [App\Http\Controllers\Projects::class, 'storeProject'])->name('store.project');
    Route::post('/salvar-tarefa/{projeto}',    [App\Http\Controllers\Projects::class, 'storeTask'])->name('store.task');
    Route::get('/projeto/{projeto}',           [App\Http\Controllers\Projects::class, 'project'])->name('projects');

//Tasks
    Route::get('/buscar-tarefa/{tarefa}',      [App\Http\Controllers\Projects::class, 'getTask'])->name('get.task');
    Route::put('/atualizar-tarefa/{tarefa}',   [App\Http\Controllers\Projects::class, 'updateTask'])->name('update.task');
    Route::put('/marcar-como-feito/{tarefa}',  [App\Http\Controllers\Projects::class, 'changeStatus'])->name('change.status.task');
    Route::DELETE('/apagar-tarefa/{tarefa}',   [App\Http\Controllers\Projects::class, 'dropTask'])->name('delete.task');