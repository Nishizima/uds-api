<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pizza extends Model
{

    protected $fillable = [
        'codigo_tam',
        'codigo_sab'
    ];

    public function tamanho()
    {
        return $this->belongsTo(Tamanho::class);
    }

    public function sabor()
    {
        return $this->belongsTo(Sabor::class);
    }

    public function toppings()
    {
        return $this->belongsToMany(Topping::class);
    }
}
