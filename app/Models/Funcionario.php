<?php

/*
 * 
 *     Author: Daniel Rodrigues
 * 
 */

/**
 * Description of Funcionario
 *
 * @author danie
 */

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Database\Eloquent\Model;

class Funcionario extends Model implements AuthenticatableContract, AuthorizableContract {
    
    use Authenticatable, Authorizable;
    
    protected $table = 'funcionario';
    protected $primaryKey = 'CPF';
    
    protected $fillable = 
    [
        'CPF',
        'nome',
        'email',
        'senha',
        'salario'
    ];
    
    protected $hidden = 
    [
        'senha',
        'api_key'
    ];
    
    public $incrementing = false;
    public $timestamps = false;
    
    public function registro()
    {
        return $this->hasMany('App\Models\Registro', 'id_func', 'CPF');
    }
}
