<?php

namespace App\Services;

use App\Models\Movimento;
use App\Models\Ospitalita;
use App\Models\StatisticaCiboMensile;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Support\Collection;

class CalcoloCiboMensileService
{
    public function esegui($foodPerDay = 5): void
    {
        $mensili = collect();

        // 1. Calcolo base da Ospitalità
        Ospitalita::each(function ($ospitalita) use ($foodPerDay, &$mensili) {
            $start = Carbon::parse($ospitalita->data_arrivo);
            $end = Carbon::parse($ospitalita->data_partenza)->subDay(); // escluso giorno di partenza

            $period = CarbonPeriod::create($start, $end);

            foreach ($period as $date) {
                $monthStart = $date->copy()->startOfMonth();
                $key = $monthStart->toDateString();

                $mese = $mensili->get($key, [
                    'mese' => $monthStart,
                    'ospiti_totali' => 0,
                    'giorni_totali' => 0,
                    'cibo_totale_ricavato' => 0,
                    'cibo_totale_speso' => 0,
                ]);

                $mese['ospiti_totali'] += $ospitalita->numero_ospiti;
                $mese['giorni_totali'] += 1;
                $mese['cibo_totale_ricavato'] += $ospitalita->numero_ospiti * $foodPerDay;

                $mensili->put($key, $mese);
            }
        });

        // 2. Aggiunta delle entrate/uscite di tipo "cibo"
        Movimento::where('cibo', true)->get()->each(function ($movimento) use (&$mensili) {
            $mese = Carbon::parse($movimento->created_at)->startOfMonth();
            $key = $mese->toDateString();

            $dati = $mensili->get($key, [
                'mese' => $mese,
                'ospiti_totali' => 0,
                'giorni_totali' => 0,
                'cibo_totale_ricavato' => 0,
                'cibo_totale_speso' => 0,
            ]);

            if ($movimento->tipo === 'entrata') {
                $dati['cibo_totale_ricavato'] += $movimento->importo;
            } elseif ($movimento->tipo === 'uscita') {
                $dati['cibo_totale_speso'] += $movimento->importo;
            }

            $mensili->put($key, $dati);
        });

        // 3. Salvataggio finale nel DB
        foreach ($mensili as $key => $dati) {
            StatisticaCiboMensile::updateOrCreate(
                ['mese' => $dati['mese']],
                $dati
            );
        }
    }
}
