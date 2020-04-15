<?php

/* 
 * 
 *     Author: Daniel Rodrigues
 * 
 */

namespace App\Http\Controllers;

use App\Models\Produto;
use App\Messages\Message;
use App\Models\Validation;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class ProdutoController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Produto $produto)
    {
        $this->model = $produto;
    }

    public function getAll(){
        try{    
            $produtos = $this->model->all();

            if(count($produtos)>0){
                
                return response()->json($produtos, Response::HTTP_OK);
            } else {
                
                return response()->json(Message::DB_NO_ENTRIES, Response::HTTP_OK);
            }
        } catch(QueryException $exc){
            
            return response()->json(Message::DB_ERROR, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    
    public function get($id){
        try{
            $produto = $this->model->find($id);

            if($produto==null){
                
                return response()->json(Message::DB_NO_ENTRIES, Response::HTTP_OK);
            } else {
                
                return response()->json($produto, Response::HTTP_OK);
            }
        } catch(QueryException $exc){
            
            return response()->json(Message::DB_ERROR, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    
    public function store(Request $request){
        try{
            $validator = Validator::make($request->all(), Validation::RULE_PRODUTO);

            if($validator->fails()){
                
                return response()->json($validator->errors(), Response::HTTP_BAD_REQUEST);
            } else {
                
                $produto = $this->model->create($request->all());
                
                return response()->json($produto, Response::HTTP_CREATED);
            }    
        } catch(QueryException $exc){
            
            return response()->json(Message::DB_ERROR, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    
    public function update($id, Request $request){
        try{
            $validator = Validator::make($request->all(), Validation::RULE_PRODUTO);

            if($validator->fails()){
                
                return response()->json($validator->errors(), Response::HTTP_BAD_REQUEST);
            } else {
                
                $produto = $this->model->find($id)
                    ->update($request->all());

                return response()->json($produto, Response::HTTP_OK);
            }
        } catch(QueryException $exc){
            
            return response()->json(Message::DB_ERROR, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    
    public function updatePrice(){
        try {
            $produtos = $this->model->all();

            if($produtos == null){
                
                return response(json(Message::UPDATE_NULL, Response::HTTP_OK));
            } else {
            
                foreach ($produtos as $prod){
                    $prod->preco += $prod->preco*(0.02);
                    $prod->save();
                }

                return response()->json(Message::UPDATE_SUCCESS, Response::HTTP_OK);
            }
            
        } catch(QueryException $exc){
            
            return response()->json(Message::UPDATE_FAILURE, Response::HTTP_INTERNAL_SERVER_ERROR);
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