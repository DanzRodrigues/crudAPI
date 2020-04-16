<?php

/*
 * 
 *     Author: Daniel Rodrigues
 * 
 */

/**
 * Description of RegisterTest
 *
 * @author danie
 */
class RegisterTest extends TestCase 
{
    public function testRegister()
    {
        $funcionario = factory('App\Models\Funcionario')->create();

        $this->actingAs($funcionario)->post('api/register',[
            'CPF' => $funcionario->CPF,
            'nome' => $funcionario->nome,
            'email' => $funcionario->email,
            'senha' => $funcionario->senha,
            'salario' => $funcionario->salario
        ]);

        $this->assertEquals(201, $this->response->status());
    }
}
