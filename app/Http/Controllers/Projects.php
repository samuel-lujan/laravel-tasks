<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use \App\Models\Project;
use \App\Models\task;


class Projects extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function project(Project $projeto){
        if($projeto->id_user == auth()->user()->id){
            return view('tasks', ['projeto'=>$projeto]);
        }
        else{
            return redirect()->back()->with('error', 'Não é possível acessar esse projeto');
        }
    }

    public function storeProject(Request $request){
        if(auth()->user()){
            auth()->user()->projects()->create([
                'project'       => $request->projeto, 
                'description'   => $request->description,
                'dead_line'     => $request->dead_line, 
                'finished_at'   => null, 
                'finished'      => false,
                'id_user'       => auth()->user()->id,
            ]);
            if(auth()->user()->save()){
                return redirect()->back()->with('success', 'Projeto Cadastrado com sucesso');
            }else{
                return redirect()->back()->with('error', 'Houve um erro ao cadastrar o projeto');
            }
        }else{
            return redirect()->back()->with('error', 'Para criar um projeto é necessário estar logado');
        }
    }

    public function storeTask(Project $projeto, Request $request){
        if($projeto->id_user != auth()->user()->id){
            return redirect()->back()->with('error', 'Só é possível adicionar tarefas em seus projetos');
        }

        $task = new Task();
        $task->task = $request->task;
        $task->description = $request->description;
        $task->dead_line = $request->dead_line;
        $task->complete = false;
        $task->id_project = $projeto->id;

        if($task->save()){
            return redirect()->back()->with('success', 'Tarefa Salva com sucesso');
        }else{
            return redirect()->back()->with('error', 'Falha ao cadastrar tarefa');
        }
    }
}
