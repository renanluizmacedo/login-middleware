<?php

use App\Http\Controllers\ProdutoControlador;
use Illuminate\Support\Facades\Route;

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
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/produtos',[ProdutoControlador::class,'index']);

Route::get('/negado',function(){
    return "Acesso Negado.Você precisa estar logado para acessar esta pagina!";
})->name('negado');

Route::get('/negadologin',function(){
    return "Acesso Negado!Você não tem os privilégios de administrador!";
})->name('negadologin');

Route::post('/login',function(Request $req){

    $login_ok = false;

    switch($req->input('user')){
        case 'renan': 
            $login_ok = $req->input('passwd') === "senharenan";
            $admin = true;
            break;
        case 'rafael':
            $login_ok = $req->input('passwd') === "senharafael";
            $admin = false;

            break;
        case 'default':
            $login_ok = false;

    }

    if($login_ok){
        $login = ['user' => $req->input('user'),'admin' => $admin];
        $req->session()->put('login',$login);
        return response("Login OK",200);

    }
    else{
        $req->session()->flush();
        return response("Erro no login",404);
    }
});

Route::get('/logout',function(Request $request){
    $request->session()->flush();
    return response('Deslogado com sucesso',200);
});