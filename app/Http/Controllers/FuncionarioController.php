<?php

/*
 * 
 *     Author: Daniel Rodrigues
 * 
 */

namespace App\Http\Controllers;

use App\Messages\Message;
use App\Models\Validation;
use App\Models\Funcionario;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;

class FuncionarioController extends Controller 
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Funcionario $funcionario)
    {
        $this->model = $funcionario;
    }

    public function getAll()
    {
        try {    
            $funcionarios = $this->model->all();

            if(count($funcionarios)>0){
                return response()->json($funcionarios, Response::HTTP_OK);
            } else {
                return response()->json(Message::DB_NO_ENTRIES, Response::HTTP_OK);
            }
        } catch(QueryException $exc){
            return response()->json($exc->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    
    public function get($id)
    {
        try {
            $funcionario = $this->model->find($id);

            if($funcionario==null){
                return response()->json(Message::DB_NO_ENTRIES, Response::HTTP_OK);
            } else {
                return response()->json($funcionario, Response::HTTP_OK);
            }
        } catch(QueryException $exc){
            return response()->json($exc->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), Validation::RULE_FUNCIONARIO);

            if($validator->fails()){
                return response()->json($validator->errors(), Response::HTTP_BAD_REQUEST);
            } else {                
                $request['senha'] = \md5($request->input('senha'));
                $funcionario = $this->model->create($request->all());
                
                return response()->json($funcionario, Response::HTTP_CREATED);
            }    
        } catch(QueryException $exc){
            return response()->json($exc->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function update($id, Request $request)
    {
        try {
            $validator = Validator::make($request->all(), Validation::RULE_FUNCIONARIO);

            if($validator->fails()){
                return response()->json($validator->errors(), Response::HTTP_BAD_REQUEST);
            } else {
                $funcionario = $this->model->find($id);
                
                if($funcionario == null){
                    return response()->json(Message::DB_NO_ENTRIES, Response::HTTP_OK);
                } else {
                    $request['senha'] = \md5($request->input('senha'));
                    $funcionario->update($request->all());              
                    
                    return response()->json($funcionario, Response::HTTP_OK);    
                }
            }
        } catch(QueryException $exc){
            return response()->json(Message::DB_ERROR, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    
    public function destroy($id)
    {
        try {
            $funcionario = $this->model->find($id);
            
            if($funcionario == null){
                return response()->json(Message::DB_NO_ENTRIES, Response::HTTP_OK);
            } else {
                $funcionario->delete();
                return response()->json(Message::DELETE_SUCCESS, Response::HTTP_OK);
            }
        } catch(QueryException $exc) {
            return response()->json(Message::DB_ERROR, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    
    public function authenticate(Request $request)
    {

        $this->validate($request, Validation::RULE_LOGIN);
        $funcionario = Funcionario::where('email', $request->input('email'))->first();
        $request['senha'] = \md5($request->input('senha'));

        if($request->input('senha') == $funcionario->senha){
            $apikey = base64_encode(Str::random(40));
            Funcionario::where('email', $request->input('email'))
                    ->update(['api_key' => "$apikey"]);

            return response()->json(Message::LOGIN_SUCCESS, Response::HTTP_OK);
        } else {
            return response()->json(Message::LOGIN_FAILURE, Response::HTTP_UNAUTHORIZED);
        }
    }
}
