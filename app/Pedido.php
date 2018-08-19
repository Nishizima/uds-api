<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    //
    protected $fillable = ['pizza_id'];

    public function pizza()
    {
        return $this->belongsTo(Pizza::class);
    }
}
