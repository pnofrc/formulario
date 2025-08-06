<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Qua extends Model
{
    use HasFactory;

      protected $fillable = [
        'nome',
        'cognome',
        'email',
        'numero_telefono',
       
        'fatta_iscrizione',
        'data_tessera',
        'metodo_pagamento',
       
        'mandata_mail',
        'dentro_ca_monti',
        'note'
      ];
}
