<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use \App\Models\Project;


class Projects extends Controller
{

    public function project(Project $projeto){
        if($projeto->id_user == auth()->user()->id){
            dd($projeto);
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
}
