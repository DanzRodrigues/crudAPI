<?php

/*
 * 
 *     Author: Daniel Rodrigues
 * 
 */

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\ClienteController;
use App\Models\Cliente;
use Illuminate\Http\Request;

/**
 * Description of InsertClienteCron
 *
 * @author danie
 */
class ClienteInsertCron extends Command 
{
    protected $signature = "customer:insert";

    protected $description = "Inserts a customer an hour";

    public function __construct(){
        
        parent::__construct();
    }

    public function handle()
    {        
        $clienteCntrl = new ClienteController(new Cliente());
        $cliente = factory($this->class)->make();

        $request = new Request([
            'CPF' => $cliente->CPF,
            'nome' => $cliente->nome,
            'sobrenome' => $cliente->sobrenome,
            'email' => $cliente->email,
        ]);
        
        echo $clienteCntrl->store($request);
    }
}
