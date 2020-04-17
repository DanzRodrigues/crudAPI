<?php

/*
 * 
 *     Author: Daniel Rodrigues
 * 
 */

/**
 * Description of ProdutoTest
 *
 * @author danie
 */
class ProdutoTest extends TestCase {
    protected $class = 'App\Models\Produto';
    protected $url = 'api/produto/';
    
    public function testGetAll()
    {
        $this->get('/api/produtos');

        $this->assertEquals(200, $this->response->status());
    }

    public function testGet()
    {
        $this->get($this->url.'1');

        $this->assertEquals(200, $this->response->status());
    }
    
    public function testStore()
    {
        $produto = factory($this->class)->make();

        $this->post($this->url,[
            'cod' => $produto->cod,
            'nome' => $produto->nome,
            'categoria' => $produto->categoria,
            'preco' => $produto->preco,
        ]);

        $this->assertEquals(201, $this->response->status());
    }
    
    public function testUpdate()
    {
        $produto = factory($this->class)->make();

        $this->put($this->url.$produto->cod,[
            'cod' => $produto->cod,
            'nome' => $produto->nome,
            'categoria' => $produto->categoria,
            'preco' => $produto->preco,
        ]);

        $this->assertEquals(200, $this->response->status());
    }
    
    public function testDestroy()
    {
        $produto = factory($this->class)->make();

        $this->delete($this->url.$produto->cod);

        $this->assertEquals(200, $this->response->status());
    }
}
