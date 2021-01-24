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
                @if(count($projeto->tasks()->get())>0)
                    <button type="button" class="btn btn-sm btn-info" data-toggle="modal" href="#checkAll"><i class="fas fa-check"></i></button>
                @endif
                <button type="button" class="btn btn-sm btn-success" data-toggle="modal" href="#addModal"><i class="fas fa-plus-circle"></i></button>
                <button type="button" class="btn btn-sm btn-secondary" data-toggle="modal" href="#infoModal"><i class="fas fa-info-circle"></i></button>
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
            </div>
        </div>
        <div class="card-body">
            @include('alerts')
            <h3 class="bg-info" align="center"> Tarefas para fazer: </h3>
            @forelse ($projeto->tasks()->where('complete', 0)->where('dead_line', '>=', date("Y-m-d"))->orWhere('dead_line', null)->where('complete', 0)->get() as $tarefa) 
                <li style="list-style: none;">                   
                    <div align="center">
                        <div class="icheck-primary d-inline ml-2">
                            <input type="checkbox" value="" name="todo1" id="checkbox_{{$tarefa->id}}" data-toggle="modal" href="#changeStatus" onclick="buildChangeStatus({{$tarefa->id}})">
                            <label for="checkbox_{{$tarefa->id}}"></label>
                        </div>
                        <span class="text"><b>{{$tarefa->task}}</b></span>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <button type="button" class="btn btn-sm btn-info" data-toggle="modal" href="#taskModal" onclick="getTask({{$tarefa->id}})"><i class="fas fa-info-circle"></i></button>
                            <button type="button" class="btn btn-sm btn-warning" data-toggle="modal" href="#editModal" onclick="getTask({{$tarefa->id}})"><i class="fas fa-edit"></i></button>
                            <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" href="#dropTask" onclick="getTask({{$tarefa->id}})"><i class="fas fa-trash-alt"></i></button>
                    </div>
                </li>
                <br>
            @empty
                <p align="center">Nenhuma tarefa pra Fazer</p>
            @endforelse

            <h3 class="bg-warning" align="center"> Tarefas atrasadas: </h3>
            @forelse ($projeto->tasks()->where('dead_line', '<', date("Y-m-d"))->where('complete', 0)->get() as $tarefa)
            <li style="list-style: none;">                   
                <div align="center">
                    <div class="icheck-primary d-inline ml-2">
                        <input type="checkbox" value="" name="todo1" id="checkbox_{{$tarefa->id}}"  data-toggle="modal" href="#changeStatus" onclick="buildChangeStatus({{$tarefa->id}})" >
                        <label for="checkbox_{{$tarefa->id}}"></label>
                    </div>
                    <span class="text"><b>{{$tarefa->task}}</b></span>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <button type="button" class="btn btn-sm btn-info" data-toggle="modal" href="#taskModal" onclick="getTask({{$tarefa->id}})"><i class="fas fa-info-circle"></i></button>
                        <button type="button" class="btn btn-sm btn-warning" data-toggle="modal" href="#editModal" onclick="getTask({{$tarefa->id}})"><i class="fas fa-edit"></i></button>
                        <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" href="#dropTask" onclick="getTask({{$tarefa->id}})"><i class="fas fa-trash-alt"></i></button>
                </div>
            </li>
            <br>
            @empty
                <p align="center">Nenhuma tarefa atrasada</p>
            @endforelse

            <h3 class="bg-success" align="center"> Tarefas concluidas: </h3>
            @forelse ($projeto->tasks()->where('complete', 1)->get() as $tarefa)
                <li style="list-style: none;">                   
                    <div align="center">
                        <div class="icheck-primary d-inline ml-2">
                            <input type="checkbox" value="" name="todo1" id="checkbox_{{$tarefa->id}}" checked onclick="return null;" disabled>
                            <label for="checkbox_{{$tarefa->id}}"></label>
                        </div>
                        <span class="text"><b>{{$tarefa->task}}</b></span>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <button type="button" class="btn btn-sm btn-info" data-toggle="modal" href="#taskModal" onclick="getTask({{$tarefa->id}})"><i class="fas fa-info-circle"></i></button>
                    </div>
                </li>
                <br>
            @empty
                <p align="center">Nenhuma tarefa Concluida</p>
            @endforelse
        </div>
        <div class="card-footer"></div>    
    </div>    
    @include('includes.Tasks.addModalTasks')
    @include('includes.Tasks.infoModalTasks')
    @include('includes.Tasks.chageStatusModal')
    @include('includes.Tasks.editModalTasks')
    @include('includes.Tasks.infoModalTask')
    @include('includes.Tasks.deleteModalTask')
    @include('includes.Tasks.checkAllModal')
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

@section('js')

    <script>
        function buildChangeStatus(id){
            $( "#checkbox_"+id).prop('checked', false);
            var route = "{{route('get.task', ['tarefa' =>0])}}";
            route = route.replace('0', id);
            var route_form = "{{route('change.status.task', ['tarefa' => 0])}}";
            route_form = route_form.replace('0', id);
            $.get(
                route,
                {

                },
                function(c){
                    $("#form_change_status").attr('action', route_form);
                }
            );
            return null;
        }
    </script>
    <script>
        function getTask(id){
            var route = "{{route('get.task', ['tarefa' =>0])}}";
            route = route.replace('0', id);
            var route_form_edit = "{{route('update.task', ['tarefa' => 0])}}";
            route_form_edit = route_form_edit.replace('0', id);
            var route_form_delete = "{{route('delete.task', ['tarefa' => 0])}}";
            route_form_delete = route_form_delete.replace('0', id);
            $.get(
                route, 
                {

                },
                function(c){
                    if(c != false){
                        //Modal de edição da tarefa
                            $("#edit_modal").attr('action', route_form_edit);
                            $('#edit_task').val(c.task);
                            $('#edit_description').val(c.description);
                            $('#edit_dead_line').val(c.dead_line);
                        //Modal de informações da tarefa
                            $("#info_task").html("<b>Tarefa: </b>&nbsp;"+c.task);
                            var d = new Date(c.created_at),
                                month = '' + (d.getMonth() + 1),
                                day = '' + d.getDate(),
                                year = d.getFullYear();

                            if (month.length < 2) 
                                month = '0' + month;
                            if (day.length < 2) 
                                day = '0' + day;                            
                            $('#info_creation').html('<b>Data de Criação:</b>&nbsp;'+[day, month, year].join('/'));
                            if(c.dead_line==null){
                                $('#info_dead_line').html("<b>Data Limite:</b>&nbsp;Não cadastrado");
                            }else{
                                var d = new Date(c.dead_line),
                                month = '' + (d.getMonth() + 1),
                                day = '' + d.getDate(),
                                year = d.getFullYear();

                            if (month.length < 2) 
                                month = '0' + month;
                            if (day.length < 2) 
                                day = '0' + day;     
                                $('#info_dead_line').html('<b>Data de Criação:</b>&nbsp;'+[day, month, year].join('/'));
                            }
                            $('#info_description').html('<b>Descrição:</b> &nbsp;'+c.description);
                        //Modal de deleção de tarefa
                            $("#form_delete_task").attr('action', route_form_delete);
                    }
                }
            );
        }
    </script>
@stop