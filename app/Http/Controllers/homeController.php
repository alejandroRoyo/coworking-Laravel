<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $comentarios = \App\Models\Comentario::latest()->get();
        return view('home.index', compact('comentarios'));
    }
}
