<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use app\cuentas;

class grupos extends Model
{
    protected $table = 'grupos';

    public $timestamps = false;


    public function cuentas()
    {
        return $this->hasToMany('App\cuentas' , 'id_cuenta' );
    }
}
