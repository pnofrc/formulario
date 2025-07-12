<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <title>Origini Future</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://unpkg.com/alpinejs" defer></script>

    <style>
        .link {
            color: blue;
            text-decoration: underline;
            cursor: pointer;
        }

        .box {
            border: 1px solid blue;
            padding: 1em;
            margin: 1em 0;
        }

        body {
            display: flex;
            flex-direction: column;
            align-items: center;
            font-family: Arial, Helvetica, sans-serif;
        }

        form, .container{
            width: 75%;
        }

        .quote{
            text-align: right;
            display: block;
            width: 100%;
        }

        @media only screen and (max-width: 600px) {
            form {
                width: 90%;
            }
        }

        input[type=text],
        input[type=email] {
            width: 100%;
        }

        button {
            width: 100%;
            background: none;
            border: solid blue;
            padding: 1rem 2rem;
            color: black !important;
        }
    </style>
</head>

<body>
    <h1>Origini Future :: rumore b @ Habitat</h1>
    <h3>Ca’ de Monti | 18–20 Luglio 2025</h3>
    <h3>Micro-festival tra arte, comunità e territorio</h3>

            @if (session('success'))
             <h1 style="color: green; font-weight: bold; text-align: center; font-size: 3rem">
                {{ session('success') }}
             </h1>
        @endif

    <a href="/iscrizioneRumore2025/en">Change in english!</a>

    <div class="container">
    {{-- <p>Carə umanə benvenutə al form di iscrizione/pagamento/prenotazioni pasti di ORIGINI FUTURE 25  ✨✨</p> --}}
    {{-- <p>Per partire, il micro-festival è pensato come un esperimento comunitario, dove il confine tra partecipantə, artistə e organizzatorə si dissolve. siamo dichiaratamente non a scopo di lucro e le cifre richieste servono esclusivamente per ripagare le spese di realizzazione, speriamo vengano comprese :)</p> --}}
        <p>
            ORIGINI FUTURE è un festival indipendente, non a scopo di lucro. <br>
            La quota serve solo a coprire le spese vive per renderlo possibile 
            <br><a href="http://habitattt.it/habitare/estate2025#next" target="_blank">Qua il programma</a>

        </p>
    <p>Ingresso: 40€ <br>Include:
        <ul>
            <li>acceso al festival (da Venerdì 18 mattina a Domenica 20 primo pomeriggio)</li>
            <li>workshops, musica e attività</li>
            <li>posto tenda, bagni, docce esterne</li>
            <li>acqua potabile</li>
        </ul>
    </p>
   
    {{-- <p>qui sotto infine, si trova la sezione dedicata al partecipare come VOLONTARI (abbiam bisogno della nostra comunità, e il ticket diventa ridotto!), e soprattutto CUCINA: in ottica anti-spreco e buona programmazione del lavoro (grande sfida per noi cucinare per 100+ persone), i pasti sono da acquistare IN ANTICIPO qui giù, non sarà possibile acquistare in loco !!</p> --}}
    {{-- <br>
    <i class="quote">a costruirlo insieme, <br>
    dolci baci.</i>
    <br><br> --}}
    </div>

    <form method="POST" action="{{ route('iscrizione.store') }}" x-data="formData()">
        @csrf

        <label>Nome*</label><br>
        <input type="text" name="nome" required><br><br>

        <label>Cognome*</label><br>
        <input type="text" name="cognome" required><br><br>

        <label>Email*</label><br>
        <input type="email" name="email" required><br><br>

        <label>Numero di telefono*</label><br>
        <input type="text" name="numero_telefono" required><br><br>

        <label>
            <input type="checkbox" name="pagato_iscrizione" value="1" required>
             È obbligatoria la tessera Habitat 2025 (10€) <br>
         <a href="https://forms.gle/o531HuN5Rt7XyVzJ7" target="_blank">Iscriviti qui</a>, poi spunta la casella
        </label>


        {{-- <label>
            <input type="checkbox" x-model="volontari" name="volontari" value="1">
📌 hai energie creative per il building up i giorni prima del festival? ti senti ispirato per un po’ di chop chop in cucina o altri compiti che manco noi sappiamo ? ORIGINI FUTURE non funzia senza di voi, metti una x per dare una mano come VOLONTARIO/A (e abbassare il costo del ticket da 40€ a 10€).
            <br><br>
            <i>
                Ti contatteremo al più presto via email per organizzarci :)</i>

        </label> --}}


        <div class="box">

            <label>
                <input type="checkbox" x-model="cibo" name="cibo" value="1">
               Pasti (opzionale, 40€) <br>
            Cucina vegetariana. 3 pasti al giorno + merende da venerdì pranzo a domenica pranzo (7 pasti).<br>
            Prezzo fisso, indipendentemente dall’arrivo, prenotazione obbligatoria ora.

            </label>

            <div>
                È possibile portare cibo da casa ma sono ammessi fornelli o fuochi.            
            </div>

            <br>
            <br>
        </div>

            <template x-if="cibo && volontari">

                <div>
                    <label>Indica qui se hai allergie, intolleranze o diete particolari. 
                    </label><br>
                    <input type="text" name="intolleranze"><br><br>


                    <div class="box">
                        <p>10 euro ingresso festival + 40 euro cibo: <strong>€50</strong></p>
                        <a href="https://paypal.me/rumoreb/50" target="_blank" class="link">Paga con PayPal</a>
                    </div>

                </div>
            </template>

            <template x-if="cibo && !volontari">
                <div>
                    <label>Indica qui se hai allergie, intolleranze o diete particolari. 
                        <br>
                        Nota: Tutti i pasti offerti sono completamente vegetariani.
                    </label><br>
                    <input type="text" name="intolleranze"><br><br>

                    <div class="box">
                        <p>40 euro ingresso festival + 40 euro cibo: <strong>€80</strong></p>
                        <a href="https://paypal.me/rumoreb/80" target="_blank" class="link">Paga con PayPal</a>
                    </div>

                </div>
            </template>

            <template x-if="volontari && !cibo">

                <div class="box">

                    <p>10 euro ingresso festival: <strong>€10</strong></p>
                    <a href="https://paypal.me/rumoreb/10" target="_blank" class="link">Paga con PayPal</a>
                </div>
            </template>

            <template x-if="!cibo && !volontari">
                <div class="box">
                    <p>Ingresso festival: <strong>€40</strong></p>
                    <a href="https://paypal.me/rumoreb/40" target="_blank" class="link">Paga con PayPal</a>

                </div>
            </template>

      <p>Sappiamo essere tempi difficili per spendere soldi nel divertimento. abbiamo tentato il massimo per contenere i prezzi di ticketing e cucina. 
            <br>Se per te non è sufficiente, sentiti liber di contattarci privatamente a rumore.b.b@gmail.com, felici di aiutare :) </p>

        <br>

        <button type="submit">Invia</button>
    </form>

    <script>
        function formData() {
            return {
                volontari: false,
                cibo: false,
            }
        }
    </script>
</body>

</html>
