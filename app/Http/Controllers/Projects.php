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

    public function getTask(Task $tarefa){
        if(count(auth()->user()->projects()->where('id', $tarefa->id_project)->get())>=0){
            return $tarefa;
        }else{
            return false;
        }
    }
    
    public function changeStatus(Task $tarefa){
        if(count(auth()->user()->projects()->where('id', $tarefa->id_project)->get())>=0){
            $tarefa->complete = true;
            $tarefa->finished_at = date('Y-m-d'); 
            if($tarefa->save()){
                return redirect()->back()->with('success', 'Tarefa concluida com sucesso!');
            }else{
                return redirect()->back()->with('error', 'Houve um erro ao atualizar status da tarefa');
            }
        }else{
            return redirect()->back()->with('error', 'O acesso a essa tarefa foi negado');
        }
    }

    public function updateTask(Task $tarefa, Request $request){
        if(count(auth()->user()->projects()->where('id', $tarefa->id_project)->get())>=0){
            $tarefa->task = $request->task;
            $tarefa->description =  $request->description;
            $tarefa->dead_line = $request->dead_line;
            if($tarefa->save()){
                return redirect()->back()->with('success', 'Tarefa atualizada com sucesso');
            }else{
                return redirect()->back()->with('error', 'Falha ao atualizar a tarefa');
            }
        }else{
            return redirect()->back()->with('error', 'O acesso a essa tarefa foi negado');
        }
    }
}
