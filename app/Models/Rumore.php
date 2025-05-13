<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rumore extends Model
{
     protected $fillable = [
        'nome',
        'cognome',
        'email',
        'numero_telefono',
        'volontari',
        'cibo',
        'costo_totale',
    ];
}
