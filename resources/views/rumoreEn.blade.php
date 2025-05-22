<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <title>Origini Future</title>
    <script src="https://unpkg.com/alpinejs" defer></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">

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


        form{
            width: 75%;
        }

        @media only screen and (max-width: 600px) {
          form{
            width: 90%;
        }
        }
    </style>
</head>

<body>
    <h1>Origini Future :: Rumore < b> @ Habitat 2025</h1>

    <a href="/iscrizioneRumore2025">Change in italian!</a>

    <form method="POST" action="{{ route('iscrizione.store') }}" x-data="formData()">
        @csrf

        <label>Name*</label><br>
        <input type="text" name="nome" required><br><br>

        <label>Surname*</label><br>
        <input type="text" name="cognome" required><br><br>

        <label>Email*</label><br>
        <input type="email" name="email" required><br><br>

        <label>Telephon number*</label><br>
        <input type="text" name="numero_telefono" required><br><br>

        <label>
            <input type="checkbox" name="pagato_iscrizione" value="1" required>
           Have you registered and paid the Habitat Association (Distretto A)?
        </label>
        <div><small>The membership card costs €10 and must be paid upon registration :) Do it immediately! <a
                    href="https://forms.gle/o531HuN5Rt7XyVzJ7" target="_blank">Register clicking here</a></small></div>
        <br>

        <br><br><br>

        <label>
            <input type="checkbox" x-model="volontari" name="volontari" value="1">
           Would you like to volunteer at the Origini Future festival?
            <br><br>
            <i>
                Arrival at Cà dei Monti: between July 16 and July 17 <br>
                <b>Things to do</b>: help with installations, kitchen, workshop and space management <br>

            In return for your help: discounted festival entry €10</i>

        </label>
        
        <br><br>

                <div class="box" x-data="{ cibo: true }">

                    <label>
                        <input type="checkbox" x-model="cibo" name="cibo" value="1">
                        Would you like breakfast/lunch/dinner included from Friday to Sunday?<br>

                    </label>

                    <div>Note: Meal cost Fri–Sun: 45 euro<br>
                       Important: You can bring your own food and drinks, but <b>camping stoves are not allowed!</b> The nearest town is a 20-minute drive for supplies. <br>
                       Also: For logistical reasons, the meal package is only available for the full duration of the festival — single meals cannot be purchased!<br>
                    </div>


        <br><br>

        <template x-if="cibo && volontari">

            <div>

                <label>If you have allergies, intolerances, or specific diets (vegan/vegetarian, etc.), please write them below:</label><br>
                <input type="text" name="intolleranze"><br><br>

                 <a href="mailto:">Thanks for your interest!
                    Send an email <b>first</b>to rumore.b.b@gmail.com to apply (limited spots – applications will be considered in order of receipt and date availability).</a>

                <div class="box">
                    <p>10 euro ingresso festival + 45 euro cibo: <strong>€55</strong></p>
                    <a href="https://paypal.me/rumoreb/55" target="_blank" class="link">Paga con PayPal</a>
                </div>

            </div>
        </template>

        <template x-if="cibo && !volontari">
            <div>
                <label>If you have allergies, intolerances, or specific diets (vegan/vegetarian, etc.), please write them below:</label><br>
                <input type="text" name="intolleranze"><br><br>

                <div class="box">
                    <p>€40 festival entry + €45 food: <strong>€85</strong></p>
                    <a href="https://paypal.me/rumoreb/85" target="_blank" class="link">Pay with PayPal</a>
                </div>

            </div>
        </template>

        <template x-if="volontari && !cibo">
      

            <div class="box">


                 <a href="mailto:">Thanks for your interest!
                    Send an email <b>first</b>to rumore.b.b@gmail.com to apply (limited spots – applications will be considered in order of receipt and date availability).</a>


                <p>10 festival entry: <strong>€10</strong></p>
                <a href="https://paypal.me/rumoreb/10" target="_blank" class="link">Pay with PayPal</a>
            </div>
        </template>

        <template x-if="!cibo && !volontari">
            <div class="box">
                <p>€40 festival entry: <strong>€40</strong></p>
                <a href="https://paypal.me/rumoreb/40" target="_blank" class="link">Pay with PayPal</a>

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