<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use \App\Models\Project;
use \App\Models\task;
use DB;

class Projects extends Controller
{
    //REQUER QUE O USUÁRIO ESTEJA LOGADO!
    public function __construct(){
        $this->middleware('auth');
    }

    //Retorna a index do projeto
    public function project(Project $projeto){
        if(count($projeto->tasks()->get()) == count($projeto->tasks()->where('complete', 1)->get())){  //CASO TODAS AS TAREFAS TENHAM SIDO CUMPRIDAS
            $projeto->finished =  1;
            $projeto->finished_at = date('Y-m-d');
            $projeto->save();
        }
        if($projeto->id_user == auth()->user()->id){
            return view('tasks', ['projeto'=>$projeto]);
        }
        else{
            return redirect()->back()->with('error', 'Não é possível acessar esse projeto');
        }
    }

    //Retorna informações do projeto
    public function getProject(Project $projeto){
        if(auth()->user()->id == $projeto->id_user){
            return $projeto;
        }else{
            return false;
        }
    }
    
    //Atualiza informações do projeto
    public function updateProjeto(Project $projeto, Request $request){
        if($projeto->id_user != auth()->user()->id){
            return redirect()->back()->with('error', 'Permissão para deletar projeto Negada');
        }
        if($request->projeto == null || $request->projeto == "" || $request->projeto == " "){
            return redirect()->back()->with('error', 'Insira um nome válido para o projeto');
        }
        $projeto->project = $request->projeto;
        $projeto->description = $request->description;
        $projeto->dead_line = $request->dead_line;
        if($projeto->save()){
            return redirect()->back()->with('success', 'Projeto atualizado com sucesso');
        }else{
            return redirect()->back()->with('error', 'Falha ao atualizar projeto');
        }
    }

    //Deleta o Projeto
    public function deleteProjeto(Project $projeto){
        if($projeto->id_user != auth()->user()->id){
            return redirect()->back()->with('error', 'Permissão para deletar projeto Negada');
        }
        if($projeto->delete()){
            return redirect()->back()->with('success', 'Projeto excluido com sucesso');
        }else{
            return redirect()->back()->with('error', 'Falha ao excluir projeto');
        }
    }

    //Salva o projeto na base de dados
    public function storeProject(Request $request){
        if($request->projeto == null || $request->projeto == "" || $request->projeto == " "){
            return redirect()->back()->with('error', 'Insira um nome válido para o projeto');
        }
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



    //Salva a tarefa na base de dados
    public function storeTask(Project $projeto, Request $request){
        if($request->task == null || $request->task == "" || $request->task == " "){
            return redirect()->back()->with('error', 'Insira um nome válido para a tarefa');
        }
        if($request->description == null || $request->description == '' || $request->description == " "){
            return redirect()->back()->with('error', 'A descrição da tarefa é obrigatória');
        }
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

    //Retorna informações da tarefa
    public function getTask(Task $tarefa){
        if(count(auth()->user()->projects()->where('id', $tarefa->id_project)->get())>=0){
            return $tarefa;
        }else{
            return false;
        }
    }
    
    //Set todas as tarefas como feita
    public function checkAll(project $projeto){
        $atualizar = DB::table('tasks')->where('id_project', $projeto->id)->update(['complete' => 1, 'finished_at'=> date('Y-m-d')]);
        if($atualizar){
            $projeto->finished =  1;
            $projeto->finished_at = date('Y-m-d');
            $projeto->save();
            return redirect()->back()->with('success', 'Todas as tarefas foram atualizadas');
        }else{
            return redirect()->back()->with('error', 'Houve um erro ao atualizar todas as tarefas');
        }
    }

    //Set status da tarefa como feita
    public function changeStatus(Task $tarefa){
        if(count(auth()->user()->projects()->where('id', $tarefa->id_project)->get())>=0){
            $tarefa->complete = true;
            $tarefa->finished_at = date('Y-m-d'); 
            $projeto = Project::where('id', $tarefa->id_project)->first();
            if(count($projeto->tasks()->get()) == count($projeto->tasks()->where('complete', 1)->get())){  //CASO TODAS AS TAREFAS TENHAM SIDO CUMPRIDAS
                $projeto->finished =  1;
                $projeto->finished_at = date('Y-m-d');
                $projeto->save();
            }

            if($tarefa->save()){
                return redirect()->back()->with('success', 'Tarefa concluida com sucesso!');
            }else{
                return redirect()->back()->with('error', 'Houve um erro ao atualizar status da tarefa');
            }
        }else{
            return redirect()->back()->with('error', 'O acesso a essa tarefa foi negado');
        }
    }

    //Atualiza informações da tarefa
    public function updateTask(Task $tarefa, Request $request){
        if($request->task == null || $request->task == "" || $request->task == " "){
            return redirect()->back()->with('error', 'Insira um nome válido para a tarefa');
        }
        if($request->description == null || $request->description == '' || $request->description == " "){
            return redirect()->back()->with('error', 'A descrição da tarefa é obrigatória');
        }
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

    //Apaga Tarefa
    public function dropTask(Task $tarefa){
        if(count(auth()->user()->projects()->where('id', $tarefa->id_project)->get())>=0){
            if($tarefa->delete()){
                return redirect()->back()->with('success', 'Tarefa Apagada com sucesso!');
            }else{
                return redirect()->back()->with('error', 'Falha ao apagar a tarefa');
            }
        }else{
            return false;
        }
    }
}
