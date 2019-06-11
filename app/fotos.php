<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class fotos extends Model
{
    protected $table = 'FOTOS';

    public $timestamps = false;

    public function mensajes()
    {
        return $this->belongsTo('App\mensajes , id_mensaje');
    }
}
