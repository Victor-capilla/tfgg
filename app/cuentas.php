<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use app\grupos;

class cuentas extends Model
{
    protected $table = 'cuentas';

    public $timestamps = false;

    public function temas()
    {
        return $this->hasMany('App\temas' , 'id_cuenta');
    }

    public function mensajess()
    {
        return $this->hasMany('App\mensajes' , 'id_cuenta');
    }

    public function grupos()
    {
        return $this->belongsToMany('App\grupos' , 'id_grupo', 'id');
    }
}
