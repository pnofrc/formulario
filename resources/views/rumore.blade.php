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

    <a href="en">Change in english!</a>

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
            <i>Arrivo a Cà dei Monti: tra lun. 14 e merc. 16 luglio <br>
                <b>Cose da fare</b>: aiuto con installazioni, cucina, gestione workshop e spazi<br>
                Per ringraziarti dell’aiuto: ingresso ridotto al festival (10€)<br></i>

        </label>
        
        <br><br>

                <div class="box" x-data="{ cibo: true }">

                    <label>
                        <input type="checkbox" x-model="cibo" name="cibo" value="1">
                        Vuoi avere comprese colazioni/pranzi/cene tra venerdi e domenica?<br>

                    </label>

                    <div>NB. Costo pasti ven-dom: 45 euro<br>
                        NBB. Si possono portare cibo e bere da casa, ma <b>non si possono usare fornelli da
                            campeggio!</b> <br>
                        Il paesino più vicino è a 20 minuti di macchina per eventuali rifornimenti. <br>
                        NBBB. Per motivi logistici, offriamo un pacchetto cibo solo per tutta la durata del festival,
                        <br>
                        quindi non sarà possibile comprare i pasti singolarmente!<br>
                    </div>


        <br><br>

        <template x-if="cibo && volontari">

            <div>

                <label>Se hai allergie, intolleranze, diete specifiche (veganə/vegetarianə..) scrivilo qua
                    sotto:</label><br>
                <input type="text" name="intolleranze"><br><br>

                 <a href="mailto:">Grazie! Per favore scrivici una mail immediatamente! (Ma invia il form in ogni
                    caso)</a>

                <div class="box">
                    <p>10 euro ingresso festival + 45 euro cibo: <strong>€55</strong></p>
                    <a href="https://paypal.me/rumoreb/55" target="_blank" class="link">Paga con PayPal</a>
                </div>

            </div>
        </template>

        <template x-if="cibo && !volontari">
            <div>
                <label>Se hai allergie, intolleranze, diete specifiche (veganə/vegetarianə..) scrivilo qua
                    sotto:</label><br>
                <input type="text" name="intolleranze"><br><br>

                <div class="box">
                    <p>40 euro ingresso festival + 45 euro cibo: <strong>€85</strong></p>
                    <a href="https://paypal.me/rumoreb/85" target="_blank" class="link">Paga con PayPal</a>
                </div>

            </div>
        </template>

        <template x-if="volontari && !cibo">
      

            <div class="box">

            <a href="mailto:">Grazie! Per favore scrivici una mail immediatamente! (Ma invia il form in ogni caso)</a>


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