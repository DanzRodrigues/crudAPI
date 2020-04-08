<?php

/* 
 * 
 *     Author: Daniel Rodrigues
 * 
 */

namespace App\Messages;

class Message {
    const WELCOME = ['message' => 'Bem-vindo!'];
    
    const NOT_ALLOWED = ['message' => 
        'Acesso nao autorizado. Utilize .../login '
        . 'para efetuar o login ou .../register para cadastrar.'
        ];
    
    const LOGIN_SUCCESS = ['message' => 'Login efetuado com sucesso.'];
    
    const LOGIN_FAILURE = ['message' => 'Email ou senha incorretos.'];
    
    const DB_NO_ENTRIES =  ['message' => 'Nenhum registro encontrado.'];
    
    const DB_ERROR = ['message' => 'Erro ao se conectar ao banco de dados.'];
}