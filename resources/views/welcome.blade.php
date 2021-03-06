@extends('adminlte::page')

@section('title', 'Home')

@section('content_header')
    <h1 class="m-0 text-dark">Mídia Simples Task Manager</h1>
@stop

@section('content')
    <div class="row">
        <div class="card col-8">
            <img src="imgs/logo.jpeg" alt="">
        </div>
        <div class="card col-4">
            <div class="card-header">
                <h3 class="card-title"><b>Exemplo</b></h3>
            </div>
            <div class="card-body">
                    <div class="card">
                        <div class="card-header bg-warning">
                            <h3 class="card-title"><b>Tarefas de exemplo 1</b></h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="card-body" >
                            <div class="">
                                <div class="icheck-primary d-inline ml-2">
                                    <input type="checkbox" value="" name="todo1" id="todoCheck1">
                                    <label for="todoCheck1"></label>
                                </div>
                                <span class="text">Conheça <b>Mídia Simples Task Manager</b></span>
                                <!-- Emphasis label -->
                                <div class="tools">
                                </div>   
                            </div>
                            <div class="">
                                <div class="icheck-primary d-inline ml-2">
                                    <input type="checkbox" value="" name="todo2" id="todoCheck2">
                                    <label for="todoCheck2"></label>
                                </div>
                                <span class="text">Crie sua conta</span>
                                <!-- Emphasis label -->
                                <div class="tools">
                                </div>   
                            </div>
                            <div class="">
                                <div class="icheck-primary d-inline ml-2">
                                    <input type="checkbox" value="" name="todo3" id="todoCheck3">
                                    <label for="todoCheck3"></label>
                                </div>
                                <span class="text">Comece a gerenciar suas Tarefas</span>
                                <!-- Emphasis label -->
                                <div class="tools">
                                </div>   
                            </div>    
                        </div>
                        <div class="card-footer">
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header bg-warning">
                            <h3 class="card-title"><b>Tarefas de exemplo 2</b></h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="">
                                <div class="icheck-primary d-inline ml-2">
                                    <input type="checkbox" value="" name="todo1" id="todoCheck1">
                                    <label for="todoCheck1"></label>
                                </div>
                                <span class="text">Seus objetivos rápido e fácil</span>
                                <!-- Emphasis label -->
                                <div class="tools">
                                </div>   
                            </div>
                            <div class="">
                                <div class="icheck-primary d-inline ml-2">
                                    <input type="checkbox" value="" name="todo1" id="todoCheck1">
                                    <label for="todoCheck1"></label>
                                </div>
                                <span class="text">Crie e edite suas tarefas</span>
                                <!-- Emphasis label -->
                                <div class="tools">
                                </div>   
                            </div>
                        </div>
                        <div class="card-footer">
                            
                        </div>
                    </div>
            </div>
            <div class="card-footer">
            </div>
        </div>
    </div>
    @if(!auth()->user()) 
        <div class="row">
            <div class="col small-box bg-info">
                <div class="inner">
                    <h3>Login</h3>
                    <br>
                    <p></p>
                </div>
                <div class="icon">
                <i class="fas fa-sign-in-alt"></i>
                </div>
                <a href="{{route('projetos')}}" class="small-box-footer">
                entrar <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>    
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <div class="col small-box bg-warning">
                <div class="inner">
                    <h3>Crie sua conta</h3>
                    <br>
                    <p> </p>
                </div>
                <div class="icon">
                <i class="fas fa-user-plus"></i>
                </div>
                <a href="{{route('register')}}" class="small-box-footer">
                    Registrar <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
    @endif  
            
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