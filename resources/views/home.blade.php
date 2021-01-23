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
        <div class="card-header bg-warning">
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
                <table id="bike" class="table table-hover dataTable" role="grid">
                    <thead align="center" class="sorting_asc bg-secondary">
                        <th class="sorting_asc" colspan="1" aria-sort="ascending" aria-label="projetos">Projetos</th>
                        <th>Data Limite</th>
                        <!--<th>Processo</th>-->
                        <th>Finalizado</th>
                        <th>Ações</th>
                    </thead>
                    <tbody align="center">
                        @foreach ($projetos as $projeto)
                            <tr role="row" class="odd">
                                <th>{{$projeto->project}}</th>
                                <th>{{date('d/m/Y', strtotime($projeto->dead_line))}}</th>
                                <!--<th>

                                </th>-->
                                <th>
                                    @if($projeto->finished==0)
                                        <input type="checkbox" name="finished" id="finished" onclick="return false;" disabled>
                                    @else
                                        <input type="checkbox" name="finished" id="finished" onclick="return false;" disabled checked>
                                    @endif
                                </th>
                                <th>
                                    <a href="{{route('projects', ['projeto'=>$projeto->id])}}"><button type="button" class="btn btn-info btn-sm" onclick="getbike({{$projeto->id}})"><i class="fas fa-pen"></i> Abrir</button></a>
                                </th>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p>Adicione seu Primeiro Projeto</p>
            @endif
        </div>
        <div class="card-footer bg-light">

        </div>
    </div>
    @include('includes.infoModalProjetos')
    @include('includes.addModalProjetos')
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