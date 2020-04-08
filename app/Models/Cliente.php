<?php

/*
 * 
 *     Author: Daniel Rodrigues
 * 
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Description of Cliente
 *
 * @author danie
 */
class Cliente extends Model {
    
    protected $table = "cliente";
    protected $primaryKey = 'CPF';
        
    protected $fillable = [
        'CPF',
        'nome',
        'sobrenome',
        'email'
    ];
    
    public $timestamps = false;
    
    public function registro()
    {
        return $this->hasMany('App\Models\Registro', 'id_clien', 'CPF');
    }
}
