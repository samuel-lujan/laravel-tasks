<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct(){
        $this->middleware('auth', ['except' => ['index']]);
    }

    public function index(){
        return view('welcome');
    }

    public function projetos(){
        return view('home', ['projetos'=>auth()->user()->projects()->get()]);
    }
}
