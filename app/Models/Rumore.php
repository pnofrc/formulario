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

        'soldi',
        'fatta_iscrizione',
        'data_tessera',
        'metodo_pagamento',
        'mandata_mail',
        'dentro_ca_monti',
        'note'
    ];
}
