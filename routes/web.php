<?php

use Illuminate\Support\Facades\Route;

use Illuminate\Http\Request;

use App\Http\Controllers\ProdutoControlador;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('produtos', [ProdutoControlador::class, 'index']);

Route::get('negado', function(){
    return "Acesso Negado. você precisa estar logado para acessar a pagina";
})->name('negado');

Route::get('negadologin', function(){
    return "Prezado usuario você precisa ser administrador para acessar";
})->name('negadologin');

Route::post('login', function(Request $req){
    $login_ok = false;
    $admin = false;

    switch ($req->input('user')) {
        case 'admin':
            $login_ok = $req->input('passwd') === "123";
            $admin = true;
            break;
        case 'root':
            $login_ok = $req->input('passwd') === "abc";
            break;
        case "default":
            $login_ok = false;
            break;
    }

    if($login_ok){

        $login = ['user'=>$req->input('user'), 'admin'=>$admin];

        $req->session()->put('login', $login);
        return response("Login OK", 200);

    }else{

        $req->session()->flush;
        return response("Erro no login", 404);

    }
});

Route::get('logout', function(Request $req){
    $req->session()->flush();
    return response('Deslogado com sucesso',200);
});
