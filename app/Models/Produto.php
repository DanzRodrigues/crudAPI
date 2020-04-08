<?php

/*
 * 
 *     Author: Daniel Rodrigues
 * 
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Description of Produto
 *
 * @author danie
 */
class Produto extends Model {
    
    protected $table = "produto";
    protected $primaryKey = 'cod';
    
    protected $fillable = [
        'cod',
        'nome',
        'categoria',
        'preco'
    ];

    public $timestamps = false;
    
    public function registro()
    {
        return $this->hasMany('App\Models\Registro', 'id_prod', 'cod');
    }
}
