<?php

/*
 * 
 *     Author: Daniel Rodrigues
 * 
 */

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\ProdutoController;
use App\Models\Produto;
use Illuminate\Http\Request;

class PriceUpdateCron extends Command{
    
    protected $signature = "price:update";

    protected $description = "Weekly updates the price of every registered product product.";

    public function __construct(){
        
        parent::__construct();
    }

    public function handle(){
        
        $produto = new ProdutoController(new Produto());

        echo $produto->updatePrice();
    }
}
