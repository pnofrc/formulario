<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ospitalita;

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

        return redirect()->route('ospitalita.create')->with('success', 'Richiesta inviata!');
    }
}
