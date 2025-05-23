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
            padding: 1rem 2rem
        }
    </style>
</head>

<body>
    <h1>Origini Future :: Rumore < b> @ Habitat 18-20 Lug 2025</h1>

    <a href="/iscrizioneRumore2025/en">Change in english!</a>

    <div class="container">
    <p>Carə umanə benvenutə al form di iscrizione/pagamento/prenotazioni pasti di ORIGINI FUTURE 25  ✨✨</p>
    <p>Per partire, il micro-festival è pensato come un esperimento comunitario, dove il confine tra partecipantə, artistə e organizzatorə si dissolve. siamo dichiaratamente non a scopo di lucro e le cifre richieste servono esclusivamente per ripagare le spese di realizzazione, speriamo vengano comprese :)</p>

    <p>🎫 il sistema di ticketing prevede un ingresso unico di 40€ che comprende:
        <ul>
            <li>acceso al festival ed utilizzo spazi esterni di Ca’ de monti, da mattina venerdì 18 a Domenica 20 luglio inclusi</li>
            <li>accesso a workshops e musica</li>
            <li>posto tenda e uso bagni e docce esterne</li>
            <li> acqua potabile</li>
        </ul>
    </p>
    <p>è necessaria inoltre, la tessera associativa Habitat ad un costo di 10€.</p>
    <br>
    <i class="quote">a costruirlo insieme, <br>
    dolci baci.</i>
    <br><br>
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
            📌 metti la x se sei in possesso di tessera associativa Habitat. <br>
        La tessera è necessaria per poter usare gli spazi di Ca’ de monti. Per iscriversi clicca qui, e poi torna a mettere la x (obbligatoria) dopo esserti iscrittə.
        </label>
        <div><small><a
                    href="https://forms.gle/o531HuN5Rt7XyVzJ7" target="_blank">Iscriviti cliccando qua</a></small></div>
        <br>

        <br><br><br>

        <label>
            <input type="checkbox" x-model="volontari" name="volontari" value="1">
            📌 hai energie creative per il building up i giorni prima del festival? ti senti ispirato per un po’ di chop chop in cucina o altri compiti che manco noi sappiamo? ORIGINI FUTURE non funziona senza di voi, metti una x per dare una mano come volontariə (e abbassare il costo del ticket da 40€ a 10€).
            <br><br>
            <i>
                Arrivo a Cà dei Monti: tra lunedì 14 e giovedì 17 luglio, a seconda del tipo di supporto. <br>
                Cose da fare: aiutare con le installazioni, cucinare, gestire workshop e spazi.<br>
                Ti contatteremo al più presto via email per organizzarci :)</i>

        </label>

        <br><br>

        <div class="box">

            <label>
                <input type="checkbox" x-model="cibo" name="cibo" value="1">
                📌 ORIGINI FUTURE sarà anche cucina e buon cibo. In ottica anti spreco, chiediamo la prenotazione e pagamento dei pasti anticipati. La cucina sarà vegetariana, ed ha un costo unico di 40€. Comprende dal pranzo del venerdì al pranzo della domenica (7 pasti, meno di 6€/cada uno!), indipendentemente dal momento di arrivo. metti una x se vuoi includere.<br>

            </label>

            <div>
                NB si è liberə di portare il proprio cibo da casa e di raggiungere la prima cittadina a 20min di macchina ! vietati però fornelli e fuochi per rischio incendio.
            </div>

            <br>
            <br>

            <template x-if="cibo && volontari">

                <div>
                    <label>Indica qui se hai allergie, intolleranze o diete particolari. 
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
                    <label>Indica qui se hai allergie, intolleranze o diete particolari. 
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

        <p>Sappiamo essere tempi difficili per spendere soldi nel divertimento. abbiamo tentato il massimo per contenere i prezzi di ticketing e cucina. 
            <br>Se per te non è sufficiente, sentiti liber di contattarci privatamente a rumore.b.b@gmail.com, felici di aiutare :) </p>
        </div>

        <br>

        @if (session('success'))
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
