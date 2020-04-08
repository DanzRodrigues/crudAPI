<?php

/*
 * 
 *     Author: Daniel Rodrigues
 * 
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Description of Registro
 *
 * @author danie
 */
class Registro extends Model {
    
    protected $table = "registro_venda";
    protected $primaryKey = 'cod_venda';
    
    protected $fillable = [
        'id_func',
        'id_clien',
        'id_prod'
    ];
    
    public $timestamps = false;
    
    public function funcionario(){
        
        return $this->belongsTo('App\Models\Funcionario', 'id_func', 'CPF');
    }
    
    public function cliente(){
        
        return $this->belongsTo('App\Models\Cliente', 'id_clien', 'CPF');
    }
    
    public function produto(){
        
        return $this->belongsTo('App\Models\Produto', 'id_prod', 'cod');
    }
}
