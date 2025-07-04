<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ospitalita extends Model
{
    use HasFactory;


     protected $fillable = [
        'nome',
        'chi_sei',
        'mail',
        'artista_evento', //boolean
        'paga_ospitalita', //boolean
        'lingua_italiano',
        'data_arrivo',
        'data_partenza',
        'numero_ospiti',
        'tipologia_stanza',
        'iscrizione',
        'mandata_mail',
        'eventi_extra', 
        'confermato',
        'pagato',
    ];

      protected $casts = [
        'nome'            => 'array',
        'eventi_extra'            => 'array',
    ];
}
