<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatisticaCiboMensile extends Model
{
    use HasFactory;

     protected $table = 'statistica_cibo_mensile';

    protected $fillable = [
        'mese',
        'ospiti_totali',
        'giorni_totali',
        'cibo_totale_ricavato',
        'cibo_totale_speso',
    ];

    protected $casts = [
        'mese' => 'date',
    ];

    // colonna virtuale
    public function getCiboSaldoAttribute(): float
    {
        return $this->cibo_totale_ricavato - $this->cibo_totale_speso;
    }
}
