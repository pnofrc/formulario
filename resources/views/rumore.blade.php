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

        form{
            width: 75%;
        }

        @media only screen and (max-width: 600px) {
          form{
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
            padding: 1rem 2rem
        }
    </style>
</head>

<body>
    <h1>Origini Future :: Rumore < b> @ Habitat 2025</h1>

    <a href="/iscrizioneRumore2025/en">Change in english!</a>

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
            Ti sei iscrittə e pagatə l'associazione di Habitat (Distretto A)?
        </label>
        <div><small>La tessera associativa ha un costo di 10€ e va versata all'iscrizione :) Fallo immediatamente! <a
                    href="https://forms.gle/o531HuN5Rt7XyVzJ7" target="_blank">Iscriviti cliccando qua</a></small></div>
        <br>

        <br><br><br>

        <label>
            <input type="checkbox" x-model="volontari" name="volontari" value="1">
            Vuoi partecipare al festival Origini Future come volontariə?
            <br><br>
            <i>
Arrivo a Cà dei Monti: tra lunedì 14 e giovedì 17 luglio, a seconda del tipo di supporto. <br>
Cose da fare: aiutare con le installazioni, cucinare, gestire workshop e spazi.<br>
Per ringraziarti del tuo aiuto: ingresso ridotto al festival (10€).<br>
Ti contatteremo al più presto via email per organizzarci :)</i>

        </label>
        
        <br><br>

                <div class="box" x-data="{ cibo: true }">

                    <label>
                        <input type="checkbox" x-model="cibo" name="cibo" value="1">
                        Vuoi includere colazione, pranzo e cena da venerdì a domenica?<br>

                    </label>

                    <div>NB. Il costo per i pasti durante il weekend è di 45 € (dal pranzo di venerdì al pranzo di domenica).<br>
                        NBB. Sei libero di portare cibo e bevande da casa, <b>ma i fornellini da campeggio non sono ammessi.</b> Il paese più vicino per eventuali rifornimenti è a 20 minuti di auto.<br>
                        <br>
                        NBBB.  Per ragioni logistiche, i pasti sono disponibili solo come pacchetto completo per tutta la durata del festival — non è possibile acquistare i pasti singolarmente.
                    </div>


        <br><br>

        <template x-if="cibo && volontari">

            <div>

                <label>Se hai allergie, intolleranze o segui una dieta vegana, ti preghiamo di indicarlo qui sotto.
                <br>
                Nota: Tutti i pasti offerti sono completamente vegetariani.
                </label><br>
                <input type="text" name="intolleranze"><br><br>


                <div class="box">
                    <p>10 euro ingresso festival + 45 euro cibo: <strong>€55</strong></p>
                    <a href="https://paypal.me/rumoreb/55" target="_blank" class="link">Paga con PayPal</a>
                </div>

            </div>
        </template>

        <template x-if="cibo && !volontari">
            <div>
                <label>Se hai allergie, intolleranze o segui una dieta vegana, ti preghiamo di indicarlo qui sotto.
                <br>
                Nota: Tutti i pasti offerti sono completamente vegetariani.
                </label><br>
                <input type="text" name="intolleranze"><br><br>

                <div class="box">
                    <p>40 euro ingresso festival + 45 euro cibo: <strong>€85</strong></p>
                    <a href="https://paypal.me/rumoreb/85" target="_blank" class="link">Paga con PayPal</a>
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
                <p>40 euro ingresso festival: <strong>€40</strong></p>
                <a href="https://paypal.me/rumoreb/40" target="_blank" class="link">Paga con PayPal</a>

            </div>
        </template>

        </div>
        </div>

        <br>

        @if(session('success'))
        <div style="color: green; font-weight: bold;">
            {{ session('success') }}
        </div>
        @endif

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