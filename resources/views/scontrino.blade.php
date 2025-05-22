<html>
    
    <head>
        <title>
         {{$conto->nome}}
        </title>
    </head>
<body>
    

<pre>
    @php

    use Carbon\Carbon;

    $it = $conto->lingua_italiano;
    $totale = number_format($conto->costo_totale, 2);
    
    $arrivo =  Carbon::parse($conto->data_arrivo);
    $partenza =  Carbon::parse($conto->data_partenza);
    $giorni = $arrivo->diffInDays($partenza);
$guests = $conto->numero_ospiti;
    @endphp
    
    @if ($it)
Conto per {{ $conto->nome }}
    
    ==========================

    🍽️ Cibo ({{ $giorni }} giorni): 
    €{{ number_format(($conto->costo_pasto_giornaliero ?? 0) * $giorni * $guests, 2) }}

    (Preferibilmente in contanti..!)

    @if ($conto->paga_ospitalita)
==========================

    🛏️ {{ $conto->tipologia_stanza }}, {{ $conto->numero_ospiti }} ospite/i, {{ $giorni }} notti: 
    €{{ number_format(permanenza($conto, $giorni), 2) }}
    

    @if ($conto->paga_biancheria)
🧺 Lenzuola: 
    €{{ number_format(5 * $conto->numero_ospiti, 2) }}
    @endif
    @endif

    @if (count($conto->eventi_extra ?? []))
🎟️ Eventi extra (x{{ $conto->numero_ospiti }} ospite/i):
    @foreach ($conto->eventi_extra as $evento)
    - {{ $evento['descrizione'] }}: €{{ number_format($evento['costo'] * $conto->numero_ospiti, 2) }}
    @endforeach
    @endif
    
    @php
    $tot = 0;
    $guests = $conto->numero_ospiti;

    if (! $conto->paga_ospitalita) {
        $tot += ($conto->costo_pasto_giornaliero ?? 0) * $giorni;
    } else {
        $tot += permanenza($conto, $giorni);
        if ($conto->paga_biancheria) {
            $tot += 5 * $guests;
        }
    }

    $tot += totale_extra($conto->eventi_extra ?? [], $guests);
    @endphp
💰 Contributo ospitalità: €{{ number_format($tot, 2) }}
    --------------------------
    
    Possibili metodi di pagamento:

    Contanti :D

    Paypal:
    <a href="https://www.paypal.com/paypalme/habitattt">https://www.paypal.com/paypalme/habitattt</a>
    (Se possibile: Seleziona pagamento per amici :)
       

    Trasferimento bancario: 
    Intestato a: DISTRETTO A APS 
    IBAN: IT88Q0623023704000030225469
    Causale: Offerta per associazione

    ==========================
    
    🙏 Se hai partecipato a degli 
    eventi con offerta libera, 
    valuta se dare un contributo 
    maggiore :)

    ==========================
        
    @if (! $conto->pagato_iscrizione)
⚠️ Per favore iscriviti e paga 
    l'iscrizione alla nostra associazione 
    Distretto A (la transazione deve 
    essere un pagamento differente):  
    <a href="https://forms.gle/o531HuN5Rt7XyVzJ7">https://forms.gle/o531HuN5Rt7XyVzJ7</a>
    @endif
    
    @else

    Invoice for {{ $conto->nome }}
    ==========================
    

    
    🍽️ Food ({{ $giorni }} days) : 
    €{{ number_format(($conto->costo_pasto_giornaliero ?? 0) * $giorni  * $guests, 2) }}

     @if ($conto->paga_ospitalita)
==========================

    🛏️ ({{ $conto->tipologia_stanza }}, {{ $conto->numero_ospiti }} guest(s), {{ $giorni }} nights): 
    €{{ number_format(permanenza($conto,$giorni), 2) }}
    
    @endif

    @if (count($conto->eventi_extra ?? []))
🎟️ Extra events: (x{{ $conto->numero_ospiti }} guest/s):
    @foreach ($conto->eventi_extra as $evento)
    - {{ $evento['descrizione'] }}: €{{ number_format($evento['costo'] * $conto->numero_ospiti, 2) }}
    @endforeach
    @endif
    @php
    $tot = 0;
    $guests = $conto->numero_ospiti;

    if (! $conto->paga_ospitalita) {
        $tot += ($conto->costo_pasto_giornaliero ?? 0) * $giorni;
    } else {
        $tot += permanenza($conto, $giorni);
        if ($conto->paga_biancheria) {
            $tot += 5 * $guests;
        }
    }

    $tot += totale_extra($conto->eventi_extra ?? [], $guests);
    @endphp
    💰 Hospitality contribution:  €{{ number_format($tot, 2) }}
    --------------------------

    Payment methods:

    Cash :D

    Paypal:
    <a href="https://www.paypal.com/paypalme/habitattt">https://www.paypal.com/paypalme/habitattt</a>
    (If possible: Select payment for friends :)

    Bank transfer:
    To: DISTRETTO A APS

    IBAN: IT88Q0623023704000030225469
    Object: Offer for association

    ==========================

    🙏 If you attended events with free donations, 
    please consider contributing more :)

    ==========================
    
    @if (! $conto->pagato_iscrizione)
⚠️ Please register and pay the subscription
    to our association Distretto A  
    (PAY ATTENTION: It has to be a different transaction 
    rather than the staying):
    <a href="https://forms.gle/o531HuN5Rt7XyVzJ7">https://forms.gle/o531HuN5Rt7XyVzJ7</a>
   
    @endif

    @endif
    </pre>
    
    {{-- @php
    function permanenza($conto, $giorni) {
        $guests = $conto->numero_ospiti ?? 1;
        $tot = 0;
        switch ($conto->tipologia_stanza) {
            case 'camerata':
                $tot += 20 * $giorni * $guests;
                break;
            case 'cameratina':
                 $tot += 25 * $giorni * $guests;
                break;
            case 'camerella':
                if ($guests == 2) {
                    $tot += 45 * $giorni;
                } elseif ($guests == 1) {
                    $tot += 25 * $giorni;
                }
                break;
        }

        return $tot;
    }


    function totale_extra($extra, $numero_ospiti) {
    $totale = 0;

    foreach ($extra as $evento) {
        $totale += ($evento['costo'] ?? 0) * $numero_ospiti;
    }

    return $totale;
}

    @endphp --}}

    </body>
    </html>