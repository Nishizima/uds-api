<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sabor extends Model
{
    protected $fillable = [
        'nome_sab',
        'valor_sab',
        'tempo_sab'
    ];
}
