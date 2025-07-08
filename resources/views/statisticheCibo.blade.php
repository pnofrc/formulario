<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>STATISTICA CIBO HABITAT</title>
    <style>
        body {
            font-family: monospace;
            background: #fff;
            color: #000;
            padding: 2em;
        }
        .box {
            border: 1px solid #ccc;
            padding: 1em;
            margin-bottom: 2em;
        }
        h2 {
            font-size: 1.2em;
            margin-bottom: 0.5em;
        }
        pre {
            background: #f4f4f4;
            padding: 1em;
            white-space: pre-wrap;
        }
        ul {
            padding-left: 1.5em;
        }
        li {
            margin-bottom: 0.25em;
        }
        .vuoto {
            color: #888;
            font-style: italic;
        }
    </style>
</head>
<body>

    <h1>LA STATISTICA DEL GNAM</h1>

    
    @foreach($statistiche as $riga)
        @php $chiave = $riga->chiave; @endphp

        <div class="box">
            <h2>{{ \Carbon\Carbon::parse($riga->mese)->translatedFormat('F Y') }}</h2>

            <pre>
Ricavato:  € {{ number_format($riga->cibo_totale_ricavato, 2, ',', '.') }}
Speso:     € {{ number_format($riga->cibo_totale_speso, 2, ',', '.') }}
Saldo:     € {{ number_format($riga->cibo_saldo, 2, ',', '.') }}
            </pre>

            @php
                $chiave = \Carbon\Carbon::parse($riga->mese)->startOfMonth()->toDateString();
            @endphp

            @if(isset($movimenti[$chiave]) && $movimenti[$chiave]->count())
                <h3>Flussi denaro cibo:</h3>
                <ul>
                    @foreach($movimenti[$chiave] as $mov)
                        <li>
                            [{{ $mov->created_at->format('d/m') }}]
                            {{ strtoupper($mov->tipo) }} – {{ $mov->voce }} –
                            € {{ number_format($mov->importo, 2, ',', '.') }}
                            ({{ $mov->metodo_pagamento ?? 'n/d' }})
                        </li>
                    @endforeach
                </ul>
            @else
                <p class="vuoto">Nessun movimento cibo per questo mese.</p>
            @endif

            @if(isset($ospitalita[$chiave]) && $ospitalita[$chiave]->count())
    <h3>Contributi dagli ospiti:</h3>
    <ul>
        @foreach($ospitalita[$chiave] as $osp)
            @php
                $dataArrivo = \Carbon\Carbon::parse($osp->data_arrivo);
                $dataPartenza = \Carbon\Carbon::parse($osp->data_partenza);
                $giorni = $dataPartenza->diffInDays($dataArrivo); // esclusivo
                $totale = $giorni * $osp->numero_ospiti * 5;
            @endphp

      

            @php
    $nomi = collect($osp->nome)->pluck('nome')->join(', ');
@endphp

            <li>
                {{ $dataArrivo->format('d/m') }}–{{ $dataPartenza->format('d/m') }}:
                {{ $osp->numero_ospiti }} ospite{{ $osp->numero_ospiti > 1 ? 'i' : '' }}
                (@foreach ($osp->nome as $index => $name) {{$name['nome']}}@if(!$loop->last),@endif @endforeach) × {{ $giorni }} gg = 
                € {{ number_format($totale, 2, ',', '.') }}
            </li>
        @endforeach
    </ul>
    @else
        <p class="vuoto">Nessuna ospitalità registrata per questo mese.</p>
    @endif
        </div>
    @endforeach

</body>
</html>
