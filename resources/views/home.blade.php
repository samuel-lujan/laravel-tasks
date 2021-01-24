@extends('adminlte::page')

@section('title', 'Projetos')

@section('content_header')
    <h1 class="m-0 text-dark">Mídia Simples Task Manager</h1>
@stop

@section('content')
    @if(auth()->user() && auth()->user()->tasks_complete==0 && count(auth()->user()->projects()->get())==0)
        <div class="alert alert-success">
            Crie seu primeiro projeto
        </div>
    @endif 
    <div class="card">
        <div class="card-header bg-info">
            <h3 class="card-title"><b>Meus Projetos</b></h3>
            <div class="card-tools">
                <button type="button" class="btn btn-sm btn-success" data-toggle="modal" href="#addModal"><i class="fas fa-plus-circle"></i></button>
                <button type="button" class="btn btn-sm btn-secondary" data-toggle="modal" href="#infoModal"><i class="fas fa-info-circle"></i></button>
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
            </div>
        </div>
        <div class="card-body">
            @include('alerts')
            @if(count(auth()->user()->projects()->get())>0)
                @forelse ($projetos as $projeto)
                    <div class="panel-group" id="accordion">
                        <div class="panel panel-default" >
                            <div class="panel-heading 
                            @if(count($projeto->tasks()->get()) == count($projeto->tasks()->where('complete', 1)->get()) && count($projeto->tasks()->get()) != 0)
                                bg-success
                            @else
                                bg-warning
                            @endif
                            ">
                                <a style="color: black; bold -webkit-text-stroke: 0.5px whitesmoke;" data-toggle="collapse" data-parent="#accordion" href="#collapse{{$loop->index}}">
                                    <p class="panel-title" style="padding: 5px"> <b style="font-size: 20px">{{$projeto->project}}</b> &nbsp;&nbsp;&nbsp;
                                        @if(count($projeto->tasks()->get()) == count($projeto->tasks()->where('complete', 1)->get()) && count($projeto->tasks()->get()) != 0)
                                            Finalizdo
                                        @else
                                            Em Andamento
                                        @endif
                                    </p> 
                                </a>
                            </div>
                            <div id="collapse{{$loop->index}}" class="panel-collapse collapse in bg-light">
                                <div class="panel-body">
                                    <a href="{{route('projects', ['projeto'=>$projeto->id])}}" class="float-right"><button type="button" class="btn btn-info btn-sm" onclick="getbike({{$projeto->id}})"><i class="fas fa-angle-right"></i> Abrir</button></a>
                                    &nbsp;&nbsp;&nbsp;&nbsp;
                                    <button type="button" class="btn btn-sm btn-warning float-right"  data-toggle="modal" href="#editModal" onclick="getProject({{$projeto->id}})"><i class="fas fa-edit"></i>Editar</button>
                                    <button type="button" class="btn btn-sm btn-danger float-right"   data-toggle="modal" href="#dropProject" onclick="getProject({{$projeto->id}})">  <i class="fas fa-trash-alt"></i>Apagar</button>
                                    <br>
                                    <div class="container">
                                        <div class="row">
                                            <div class="col">
                                                <b>Data de Criação:</b> {{date('d/m/Y', strtotime($projeto->created_at))}} <br>
                                                <b>Data limite</b> @if($projeto->dead_line != null){{date('d/m/Y', strtotime($projeto->dead_line))}}@else - @endif<br>
                                                <b>Descrição: </b> {{$projeto->description}} <br>
                                                <b>Status: </b>
                                                @if($projeto->finished == 0 )
                                                    Em Andamento
                                                @else
                                                    Finalizado
                                                @endif
                                                <br>
                                            </div>
                                            <div class="col">
                                                <b>Total de tarefas: </b> {{count($projeto->tasks()->get())}} <br>
                                                <b>Tarefas Concluidas:</b> {{count($projeto->tasks()->where('complete', 1)->get())}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                @empty
                @endforelse
            @else
                <p>Adicione seu Primeiro Projeto</p>
            @endif
        </div>
        <div class="card-footer bg-light">

        </div>
    </div>
    @include('includes.Projects.infoModalProjetos')
    @include('includes.Projects.addModalProjetos')
    @include('includes.Projects.editModalProjetos')
    @include('includes.Projects.deleteModalProjetos')
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
        function getProject(id){
            var route = "{{route('get.project', ['projeto'=>0])}}";
            route = route.replace('0', id);
            var route_form_edit = "{{route('update.project', ['projeto'=> 0])}}";
            route_form_edit = route_form_edit.replace('0', id);
            var route_form_delete = "{{route('delete.project',['projeto'=>0])}}";
            route_form_delete = route_form_delete.replace('0', id);
            $.get(
                route,
                {

                },
                function(c){
                    if(c != false){
                        //Valores no modal de edição de projeto
                            $('#form_edit').attr('action', route_form_edit);
                            $('#edit_projeto').val(c.project);
                            $('#edit_description').val(c.description);
                            $("#edit_dead_line").val(c.dead_line);
                        //Valores no modal de deletar projeto
                            $('#form_delete').attr('action', route_form_delete);
                    }

                }   
            );
        }
    </script>
@stop