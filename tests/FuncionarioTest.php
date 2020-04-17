<?php

/*
 * 
 *     Author: Daniel Rodrigues
 * 
 */

/**
 * Description of FuncionarioTest
 *
 * @author danie
 */
class FuncionarioTest extends TestCase 
{
    protected $class = 'App\Models\Funcionario';
    protected $url = 'api/funcionario/';
    
    public function testGetAll()
    {
        $this->get('/api/funcionarios');

        $this->assertEquals(200, $this->response->status());
    }

    public function testGet()
    {
        $this->get($this->url.'1');

        $this->assertEquals(200, $this->response->status());
    }
    
    public function testStore()
    {
        $funcionario = factory($this->class)->make();

        $this->post($this->url,[
            'CPF' => $funcionario->CPF,
            'nome' => $funcionario->nome,
            'email' => $funcionario->email,
            'senha' => $funcionario->senha,
            'salario' => $funcionario->salario
        ]);

        $this->assertEquals(201, $this->response->status());
    }
    
    public function testUpdate()
    {
        $funcionario = factory($this->class)->make();

        $this->put($this->url.$funcionario->CPF,[
            'CPF' => $funcionario->CPF,
            'nome' => $funcionario->nome,
            'email' => $funcionario->email,
            'senha' => $funcionario->senha,
            'salario' => $funcionario->salario
        ]);

        $this->assertEquals(200, $this->response->status());
    }
    
    public function testDestroy()
    {
        $funcionario = factory($this->class)->make();

        $this->delete($this->url.$funcionario->CPF);

        $this->assertEquals(200, $this->response->status());
    }
}
