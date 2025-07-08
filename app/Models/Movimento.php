<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Services\CalcoloCiboMensileService;

class Movimento extends Model
{
    protected $fillable = [
        'tipo',
        'voce',
        'importo',
        'cibo',
        'metodo_pagamento',
        'pagato',
        'note',
    ];

    protected static function booted()
{
  $aggiorna = fn () => (new CalcoloCiboMensileService)->esegui();
    static::created($aggiorna);
    static::updated($aggiorna);
    static::deleted($aggiorna);
}

    
}


