<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class temas extends Model
{
    protected $table = 'temas';

    public $timestamps = false;

    public function cuenta()
    {
        return $this->belongsTo('App\cuentas' , 'id_cuenta', 'id');
    }

    public function mensajess()
    {
        return $this->hasMany('App\mensajes' , 'id_tema');
    }
}
