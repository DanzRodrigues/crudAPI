<?php

/*
 * 
 *     Author: Daniel Rodrigues
 * 
 */

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Produto;
use App\Models\Registro;
use App\Messages\Message;
use App\Models\Validation;
use App\Models\Funcionario;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class RegistroController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Registro $registro) {
        $this->model = $registro;
    }

    public function getAll() {
        try {
            $registros = $this->model->all();

            if (count($registros) > 0) {
                return response()->json($registros, Response::HTTP_OK);
            } else {
                return response()->json(Message::DB_NO_ENTRIES, Response::HTTP_OK);
            }
        } catch (QueryException $exc) {
            return response()->json($exc->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function get($id) {
        try {
            $registro = $this->model->find($id);

            if ($registro == null) {
                return response()->json(Message::DB_NO_ENTRIES, Response::HTTP_OK);
            } else {
                $answer = [
                    'Cod da venda' => $registro->cod_venda,
                    'Funcionario' => $registro->funcionario->nome,
                    'Cliente' => $registro->cliente->nome . ' ' .
                        $registro->cliente->sobrenome,
                    'Produto' => $registro->produto->nome,
                    'Valor' => $registro->produto->preco
                ];
                
                return response()->json($answer,
                    Response::HTTP_OK);
            }
        } catch (QueryException $exc) {
            return response()->json($exc->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function store(Request $request) {
        try {
            $validator = Validator::make($request->all(), Validation::RULE_REGISTRO);

            if ($validator->fails()) {
                return response()->json($validator->errors(), Response::HTTP_BAD_REQUEST);
            } else {
                $registro = $this->model->create($request->all());
                return response()->json($registro, Response::HTTP_CREATED);
            }
        } catch (QueryException $exc) {
            return response()->json($exc->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function update($id, Request $request) {
        try {
            $validator = Validator::make($request->all(), Validation::RULE_REGISTRO);

            if ($validator->fails()) {
                return response()->json($validator->errors(), Response::HTTP_BAD_REQUEST);
            } else {
                $registro = $this->model->find($id)
                        ->update($request->all());

                return response()->json($registro, Response::HTTP_OK);
            }
        } catch (QueryException $exc) {
            return response()->json(Message::DB_ERROR, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function destroy($id) {
        try {
            $this->model->find($id)->delete();
            return response()->json(null, Response::HTTP_OK);
        } catch (QueryException $exc) {
            return response()->json(Message::DB_ERROR, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

}
