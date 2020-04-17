<?php

/*
 * 
 *     Author: Daniel Rodrigues
 * 
 */

/**
 * Description of RegistroTest
 *
 * @author danie
 */
class RegistroTest extends TestCase {
    protected $class = 'App\Models\Registro';
    protected $url = 'api/registro/';
    
    public function testGetAll()
    {
        $this->get('/api/registros');

        $this->assertEquals(200, $this->response->status());
    }

    public function testGet()
    {
        $this->get($this->url.'1');

        $this->assertEquals(200, $this->response->status());
    }
    
//    public function testStore()
//    {
//        $registro = factory($this->class)->make();
//
//        $this->post($this->url,[
//            'id_func' => $registro->id_func,
//            'id_clien' => $registro->id_clien,
//            'id_prod' => $registro->id_prod
//        ]);
//
//        $this->assertEquals(201, $this->response->status());
//    }
//    
//    public function testUpdate()
//    {
//        $registro = factory($this->class)->make();
//
//        $this->put($this->url.$registro->cod_venda,[
//            'id_func' => $registro->id_func,
//            'id_clien' => $registro->id_clien,
//            'id_prod' => $registro->id_prod
//        ]);
//
//        $this->assertEquals(200, $this->response->status());
//    }
    
    public function testDestroy()
    {
        $registro = factory($this->class)->make();

        $this->delete($this->url.$registro->cod_venda);

        $this->assertEquals(200, $this->response->status());
    }
}
