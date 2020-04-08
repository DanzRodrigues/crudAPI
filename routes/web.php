<?php

/** @var \Laravel\Lumen\Routing\Router $router */

use App\Messages\Message;
use Symfony\Component\HttpFoundation\Response;

$router->post("api/login", "FuncionarioController@authenticate");
$router->post("api/register", "FuncionarioController@store");

$router->group(['prefix'=>"api"/*, 'middleware' => 'auth'*/], function() use ($router){    
    $router->get("/funcionarios", "FuncionarioController@getAll");
    $router->get("/clientes", "ClienteController@getAll");
    $router->get("/produtos", "ProdutoController@getAll");
    $router->get("/registros", "RegistroController@getAll");
});

$router->group(['prefix'=>"api/funcionario"/*, 'middleware' => 'auth'*/], function() use ($router){
    $router->get("/{id}", "FuncionarioController@get");
    $router->post("/", "FuncionarioController@store");
    $router->put("/{id}", "FuncionarioController@update");
    $router->delete("/{id}", "FuncionarioController@destroy");  
});

$router->group(['prefix'=>"api/cliente"/*, 'middleware' => 'auth'*/], function() use ($router){
    $router->get("/{id}", "ClienteController@get");
    $router->post("/", "ClienteController@store");
    $router->put("/{id}", "ClienteController@update");
    $router->delete("/{id}", "ClienteController@destroy");  
});

$router->group(['prefix'=>"api/produto"/*, 'middleware' => 'auth'*/], function() use ($router){
    $router->get("/{id}", "ProdutoController@get");
    $router->post("/", "ProdutoController@store");
    $router->put("/{id}", "ProdutoController@update");
    $router->delete("/{id}", "ProdutoController@destroy");  
});

$router->group(['prefix'=>"api/registro"/*, 'middleware' => 'auth'*/], function() use ($router){
    $router->get("/{id}", "RegistroController@get");
    $router->post("/", "RegistroController@store");
    $router->put("/{id}", "RegistroController@update");
    $router->delete("/{id}", "RegistroController@destroy");  
});

$router->get('/', function(){
    return response()->json(Message::WELCOME, Response::HTTP_OK);
});
