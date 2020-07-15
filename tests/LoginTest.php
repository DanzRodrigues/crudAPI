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
        $funcionario = factory('App\Models\Funcionario')->make();
        $senha = $funcionario['senha'];
        $funcionario['senha'] = \md5($funcionario['senha']);
        $funcionario->save();

        $this->actingAs($funcionario)->post('api/login',[
            'email' => $funcionario->email,
            'senha' => $senha
        ]);

        $this->assertEquals(200, $this->response->status());
    }
}
