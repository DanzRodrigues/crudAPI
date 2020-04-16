<?php

/*
 * 
 *     Author: Daniel Rodrigues
 * 
 */

/**
 * Description of LoginTest
 *
 * @author danie
 */
class LoginTest extends TestCase 
{
    public function testLogin()
    {
        $funcionario = factory('App\Models\Funcionario')->create();

        $this->actingAs($funcionario)->post('api/login',[
            'email' => $funcionario->email,
            'senha' => $funcionario->senha
        ]);

        $this->assertEquals(200, $this->response->status());
    }
}
