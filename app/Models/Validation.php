<?php

/*
 * 
 *     Author: Daniel Rodrigues
 * 
 */

namespace App\Models;

/**
 * Regras de validação das queries
 *
 * @author danie
 */
class Validation {
    
    const RULE_LOGIN = [
        'email' => 'required',
        'senha' => 'required'
    ];
    const RULE_FUNCIONARIO = [
        'CPF' => 'required | max:11 | min:11',
        'nome' => 'required | max:100 | min:2',
        'email' => 'required | max:100 | min:2',
        'senha' => 'required',
        'salario' => 'required'
    ];
    
    const RULE_CLIENTE = [
        'CPF' => 'required | max:11 | min:11',
        'nome' => 'required | max:100 | min:2',
        'sobrenome' => 'required | max:100 | min:2',
        'email' => 'required | max:100 | min:2'
    ];
    
    const RULE_PRODUTO = [
        'cod' => 'required | max:11 | min:11',
        'nome' => 'required | max:30 | min:2',
        'categoria' => 'required | max:30 | min:1',
        'preco' => 'required'
    ];
    
    const RULE_REGISTRO = [
        'id_func' => 'required | max:11 | min:11',
        'id_clien' => 'required | max:11 | min:11',
        'id_prod' => 'required | max:11 | min:11',
    ];
}
