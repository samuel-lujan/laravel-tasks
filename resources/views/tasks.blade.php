@extends('adminlte::page')

@section('title', 'Tarefas')

@section('content_header')
    <h1 class="m-0 text-dark">Mídia Simples Task Manager</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header bg">
            <h3 class="card-title">
                <a href="{{route('projetos')}}">
                    <button class="btn bg-info"><i class="fas fa-angle-left"></i></button>
                </a>
                &nbsp;
                <b>Tarefas do Projeto:</b> {{$projeto->project}}
            </h3>
            <div class="card-tools">
                <button type="button" class="btn btn-sm btn-success" data-toggle="modal" href="#addModal"><i class="fas fa-plus-circle"></i></button>
                <button type="button" class="btn btn-sm btn-secondary" data-toggle="modal" href="#infoModal"><i class="fas fa-info-circle"></i></button>
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
            </div>
        </div>
        <div class="card-body">
            @include('alerts')
            <h3 class="bg-info" align="center"> Tarefas para fazer: </h3>

            @forelse ($projeto->tasks()->where('complete', 0)->get() as $tarefa) 
                <li style="list-style: none;">                   
                    <div align="center">
                        <div class="icheck-primary d-inline ml-2">
                            <input type="checkbox" value="" name="todo1" id="todoCheck1">
                            <label for="todoCheck1"></label>
                        </div>
                        <span class="text"><b>{{$tarefa->task}}</b></span>
                            <button type="button" class="btn btn-sm btn-warning" data-toggle="modal" href="#edit" onclick=""><i class="fas fa-edit"></i></button>
                            <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" href="#drop" onclick=""><i class="fas fa-trash-alt"></i></button>
                            
                            <i class="fas fa-trash-o"></i>
                    </div>
                </li>
                {{$tarefa}}
            @empty
                <p align="center">Nenhuma tarefa pra Fazer</p>
            @endforelse

            <h3 class="bg-success" align="center"> Tarefas concluidas: </h3>
            @forelse ($projeto->tasks()->where('complete', 1)->get() as $tarefas)
                {{$tarefas}}
            @empty
                <p align="center">Nenhuma tarefa Concluida</p>
            @endforelse

            <h3 class="bg-warning" align="center"> Tarefas para atrasadas: </h3>
            @forelse ($projeto->tasks()->where('dead_line', '<', date("Y-m-d"))->get() as $tarefas)
                {{$tarefas}}
            @empty
                <p align="center">Nenhuma tarefa atrasada</p>
            @endforelse
        </div>
        <div class="card-footer"></div>    
    </div>    
    @include('includes.addModalTasks')
@stop

@section('footer')
    <div align="center">
        <div >
            <div>
                <a href="https://www.facebook.com/M%C3%ADdia-Simples-114685880384785" style="color: gray"><i class="fab fa-facebook fa-2x"></i></a>
                <a href="https://www.instagram.com/midia_simples/" style="color: gray"><i class="fab fa-instagram fa-2x"></i></a>
            </div>
        </div>
        <hr>
        <div >
            <p class="text-center">Um projeto desenvolvido por Samuel Lujan<br>@Midia Simples - 2021</p>
        </div>
    </div>
@stop