<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProdutoControlador extends Controller
{
    //
    private $produtos = ["Televisao 40", "Notebook Acer", "Impressora HP", "HD Externo"];

    public function __construct(){
        $this->middleware(\App\Http\Middleware\ProdutoAdmin::class);
    }

    public function index(){
        $p = $this->produtos;
        return $p;
    }
}
