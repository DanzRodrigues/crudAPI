<?php

/* 
 * 
 *     Author: Daniel Rodrigues
 * 
 */

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Messages\Message;
use App\Models\Validation;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class ClienteController extends Controller {
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Cliente $cliente){
        $this->model = $cliente;
    }

    public function getAll(){
        try{    
            $clientes = $this->model->all();

            if(count($clientes)>0){
                return response()->json($clientes, Response::HTTP_OK);
            } else{
                return response()->json(Message::DB_NO_ENTRIES, Response::HTTP_OK);
            }
        } catch(QueryException $exc){
            return response()->json(Message::DB_ERROR, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    
    public function get($id){
        try{
            $cliente = $this->model->find($id);

            if($cliente==null){
                return response()->json(Message::DB_NO_ENTRIES, Response::HTTP_OK);
            } else{
                return response()->json($cliente, Response::HTTP_OK);
            }
        } catch(QueryException $exc){
            return response()->json(Message::DB_ERROR, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    
    public function store(Request $request){
        try{
            $validator = Validator::make($request->all(), Validation::RULE_CLIENTE);

            if($validator->fails()){
                return response()->json($validator->errors(), Response::HTTP_BAD_REQUEST);
            } else {
                $cliente = $this->model->create($request->all());
                return response()->json($cliente, Response::HTTP_CREATED);
            }    
        } catch(QueryException $exc){
            return response()->json($exc->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    
    public function update($id, Request $request){
        try{
            $validator = Validator::make($request->all(), Validation::RULE_CLIENTE);

            if($validator->fails()){
                return response()->json($validator->errors(), Response::HTTP_BAD_REQUEST);
            } else {
                $cliente = $this->model->find($id)
                    ->update($request->all());

                return response()->json($cliente, Response::HTTP_OK);
            }
        } catch(QueryException $exc){
            return response()->json(Message::DB_ERROR, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    
    public function destroy($id){
        try{
            $this->model->find($id)->delete();
            return response()->json(null, Response::HTTP_OK);
        } catch(QueryException $exc){
            return response()->json(Message::DB_ERROR, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}