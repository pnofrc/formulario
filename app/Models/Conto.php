<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Conto extends Model
{
    protected $fillable = [
        'nome',
        'artista_evento',
        'paga_ospitalita',
        'paga_biancheria',
        'pagato_iscrizione',
        'lingua_italiano',
        'data_arrivo',
        'data_partenza',
        'numero_ospiti',
        'tipologia_stanza',
        'costo_pasto_giornaliero',
        'eventi_extra', 'pagato'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'eventi_extra'            => 'array',
    ];

}
