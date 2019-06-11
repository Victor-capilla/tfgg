<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class mensajes extends Model
{
    protected $table = 'mensajes';

    public $timestamps = false;

    public function temas()
    {
        return $this->belongsTo('App\temas' , 'id_tema');
    }

    public function cuentas()
    {
        return $this->hasMany('App\cuentas' , 'id_cuenta');
    }

    public function fotos()
    {
        return $this->hasMany('App\fotos' , 'id_mensaje');
    }
}
