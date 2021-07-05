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

Route::post('/login',function(Request $req){

    $login_ok = false;

    switch($req->input('user')){
        case 'renan': 
            $login_ok = $req->input('passwd') === "senharenan";
            break;
        case 'rafael':
            $login_ok = $req->input('passwd') === "senharafael";
            break;
        case 'default':
            $login_ok = false;

    }

    if($login_ok){
        return response("Login",200);

    }
    else{
        return response("Erro no login",404);
    }
});