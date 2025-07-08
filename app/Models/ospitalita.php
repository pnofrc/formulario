<?php

namespace App\Models;

use App\Services\CalcoloCiboMensileService;
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

protected static function booted()
{
  $aggiorna = fn () => (new CalcoloCiboMensileService)->esegui();
    static::created($aggiorna);
    static::updated($aggiorna);
    static::deleted($aggiorna);
}


}
