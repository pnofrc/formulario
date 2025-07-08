<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ospitalita;
use App\Models\Movimento;
use App\Models\StatisticaCiboMensile;
use App\Services\CalcoloCiboMensileService;
use Carbon\Carbon;

class OspitalitaController extends Controller


{

    public function store(Request $request)
    {
        function convertiNomi(array $nomi): string {
            $arrayDiOggetti = array_map(fn($n) => ['nome' => $n], $nomi);
            return json_encode($arrayDiOggetti);
        }

        $validated = $request->validate([
            'tipologia_stanza' => 'required|string',
            'numero_ospiti' => 'required|integer|min:1',
            'nomi' => 'required|array|min:1',
            'nomi.*' => 'required|string',
            'data_arrivo' => 'required|date',
            'data_partenza' => 'required|date',
            'accettato' => 'accepted',
        ]);

        $ospitalita = new Ospitalita();
        $ospitalita->tipologia_stanza = $validated['tipologia_stanza'];
        $ospitalita->numero_ospiti = $validated['numero_ospiti'];
        $ospitalita->nome = json_decode(convertiNomi($validated['nomi'])) ;
        $ospitalita->data_arrivo = $validated['data_arrivo'];
        $ospitalita->data_partenza = $validated['data_partenza'];
        $ospitalita->save();

        return redirect()->route('conferma')->with('success', 'OK! Aspetta qualche giorno e ti arriverà una mail // Wait a few days for an email');
    }


public function calcolaCiboMensile($foodPerDay = 5)
{
    $mensili = collect();

    // 1. Calcola la parte ricavata dagli ospiti (stimato)
    Ospitalita::each(function ($ospitalita) use ($foodPerDay, &$mensili) {
        $start = Carbon::parse($ospitalita->data_arrivo);
        $end = Carbon::parse($ospitalita->data_partenza)->subDay(); // esclude il giorno di partenza

        $period = \Carbon\CarbonPeriod::create($start, $end);

        foreach ($period as $date) {
            $monthStart = $date->copy()->startOfMonth()->toDateString();

            $mese = $mensili->get($monthStart, [
                'mese' => $monthStart,
                'cibo_totale_ricavato' => 0,
                'cibo_totale_speso' => 0,
            ]);

            $mese['cibo_totale_ricavato'] += $ospitalita->numero_ospiti * $foodPerDay;

            $mensili->put($monthStart, $mese);
        }
    });

    // 2. Somma entrate legate al cibo
    Movimento::where('cibo', true)
        ->where('tipo', 'entrata')
        ->get()
        ->each(function ($movimento) use (&$mensili) {
            $monthStart = Carbon::parse($movimento->created_at)->startOfMonth()->toDateString();

            if (!$mensili->has($monthStart)) {
                $mensili->put($monthStart, [
                    'mese' => $monthStart,
                    'cibo_totale_ricavato' => 0,
                    'cibo_totale_speso' => 0,
                ]);
            }

            $mese = $mensili->get($monthStart);
            $mese['cibo_totale_ricavato'] += $movimento->importo;
            $mensili->put($monthStart, $mese);
        });

    // 3. Somma uscite legate al cibo
    Movimento::where('cibo', true)
        ->where('tipo', 'uscita')
        ->get()
        ->each(function ($movimento) use (&$mensili) {
            $monthStart = Carbon::parse($movimento->created_at)->startOfMonth()->toDateString();

            if (!$mensili->has($monthStart)) {
                $mensili->put($monthStart, [
                    'mese' => $monthStart,
                    'cibo_totale_ricavato' => 0,
                    'cibo_totale_speso' => 0,
                ]);
            }

            $mese = $mensili->get($monthStart);
            $mese['cibo_totale_speso'] += $movimento->importo;
            $mensili->put($monthStart, $mese);
        });

    // Output semplificato per verifica
    $output = $mensili->map(function ($mese) {
        return [
            'mese' => $mese['mese'],
            'cibo_totale_ricavato' => $mese['cibo_totale_ricavato'],
            'cibo_totale_speso' => $mese['cibo_totale_speso'],

        ];
    });

    // dd($output);
    return $output;
}


public function scontrinoMensile()
{
    // Ospitalità per mese
    $ospitalita = Ospitalita::all()->groupBy(function ($osp) {
        return Carbon::parse($osp->data_arrivo)->startOfMonth()->toDateString();
    });

    $statistiche = StatisticaCiboMensile::orderByDesc('mese')->get()->map(function ($stat) {
        $stat->chiave = $stat->mese->copy()->startOfMonth()->toDateString();
        return $stat;
    });
    // Tutti i movimenti cibo, raggruppati per mese
    $movimenti = Movimento::where('cibo', true)
        ->orderBy('created_at')
        ->get()
        ->groupBy(function ($movimento) {
            return Carbon::parse($movimento->created_at)->startOfMonth()->toDateString();
        });

    

    return view('statisticheCibo', compact('statistiche', 'movimenti', 'ospitalita'));
}



}
