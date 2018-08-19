<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Topping extends Model
{
    //
    protected $fillable = [
        'nome_top',
        'valor_top',
        'tempo_top'
    ];
}
