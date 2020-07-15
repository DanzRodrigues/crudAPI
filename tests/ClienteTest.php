<?php

/*
 * 
 *     Author: Daniel Rodrigues
 * 
 */

/**
 * Description of ClienteTest
 *
 * @author danie
 */
class ClienteTest extends TestCase 
{
    protected $class = 'App\Models\Cliente';
    protected $url = 'api/cliente/';
    
    public function testGetAll()
    {
        $this->get('api/clientes');

        $this->assertEquals(200, $this->response->status());
    }

    public function testGet()
    {
        $this->get($this->url.'1');

        $this->assertEquals(200, $this->response->status());
    }
    
    public function testStore()
    {
        $cliente = factory($this->class)->make();

        $this->post($this->url,[
            'CPF' => $cliente->CPF,
            'nome' => $cliente->nome,
            'sobrenome' => $cliente->sobrenome,
            'email' => $cliente->email,
        ]);

        $this->assertEquals(201, $this->response->status());
    }
    
    public function testUpdate()
    {
        $cliente = factory($this->class)->make();

        $this->put($this->url.$cliente->CPF,[
            'CPF' => $cliente->CPF,
            'nome' => $cliente->nome,
            'sobrenome' => $cliente->sobrenome,
            'email' => $cliente->email,
        ]);

        $this->assertEquals(200, $this->response->status());
    }
    
    public function testDestroy()
    {
        $cliente = factory($this->class)->make();

        $this->delete($this->url.$cliente->CPF);

        $this->assertEquals(200, $this->response->status());
    }
}
