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
    <h1>Origini Future :: rumore b @ Habitat 18-20 Jul 2025</h1>

     @if (session('success'))
            <div style="color: green; font-weight: bold; font-size: 3rem">
                {{ session('success') }}
            </div>
        @endif


    <a href="/iscrizioneRumore2025/en">Cambia in italiano!</a>

    <div class="container">
    <p>Sweet humans, welcome to the registration / payment / meal booking form for ORIGINI FUTURE 25! ✨✨</p>
    <p>Our micro-festival is a collective experiment. A space where the lines between participants, artists and organizers gently blur. we are intentionally non-profit: the amounts below exist only to cover the basic costs of making this happen, hope to get your understanding.</p>

    <p>🎫 the ticketing system includes a single 40€ entry, which gives you access to:
        <ul>
            <li>festival and use of outdoor spaces of Ca’ de Monti, from Friday 18.07 to Sunday 20.07, included;</li>
            <li>workshops and music throughout the weekend</li>
            <li>tent spot, compost toilets and ext. showers</li>
            <li>drinking water </li>
        </ul>
    </p>
    <p>you’ll also need a Habitat association card 2025, which costs €10.</p>
    {{-- <p>below, you’ll find the section to join as a VOLUNTEER (we need our community, and the ticket price drops!), and most importantly KITCHEN: to avoid waste and plan well (big challenge for us cooking for 100+ people), meals must be purchased IN ADVANCE below — no on-site meal sales!! </p> --}}
    <br>

    <i class="quote">
        warm and soft hugs,<br>
        see you soon.</i>
    <br><br>
    </div>

    <form method="POST" action="{{ route('iscrizione.store') }}" x-data="formData()">
        @csrf

        <label>Name*</label><br>
        <input type="text" name="nome" required><br><br>

        <label>Surname*</label><br>
        <input type="text" name="cognome" required><br><br>

        <label>Email*</label><br>
        <input type="email" name="email" required><br><br>

        <label>Phone Number*</label><br>
        <input type="text" name="numero_telefono" required><br><br>

        <label>
            <input type="checkbox" name="pagato_iscrizione" value="1" required>
            📌 check this box if you already have a Habitat association card.
the card is required to access the spaces at Ca’ dei Monti. to get one, <a
                    href="https://forms.gle/o531HuN5Rt7XyVzJ7" target="_blank">CLICK HERE</a> to sign up, then come back and tick this box.

        </label>

        <br><br><br>

        {{-- <label>
            <input type="checkbox" x-model="volontari" name="volontari" value="1">
📌 into communal creative jamming and want to help in building up for the days leading up to the festival ? feel inspired for some chop chop in the rumore veg kitchen or for other tasks we haven’t even thought of yet ? ORIGINI FUTURE isn’t  possible without you. Check the box here if you want to help in running the festival as a volunteer (and see your ticket price dropping down from 40€ to 10€ as a thank you for you help :)).            <br><br>
            <i>
                We will contact you soon :)</i>

        </label> --}}

        <br><br>

        <div class="box">

            <label>
                <input type="checkbox" x-model="cibo" name="cibo" value="1">
📌 ORIGINI FUTURE also means good food 🫕🥬  <br>
to avoid waste, we kindly ask you to book/pay NOW!   <br> <br>
a few deets: the kitchen will be vegetarian and serve 3 meals + snacks daily, from Friday lunch to Sunday lunch included. regardless of when you arrive, it’s a flat rate of €40 (that’s 7 meals, under €6 each! plus snacks 🧃🧃). meals won’t be available for purchase on site!! tick the box if you want in.  

            </label>

            <div>
            NB. PS: you’re free to bring your own food and/or drive to the nearest town (20 min by car – not ideal, but doable!). <b>no stoves or open flames allowed due to fire risk. </b>          </div>

            <br>
            <br>

            <template x-if="cibo && volontari">

                <div>
                    <label>please let us know here if you have any allergies, intolerances or specific dietary needs:
                        <br>
                        (All meals are vegetarian)
                    </label><br>
                    <input type="text" name="intolleranze"><br><br>


                    <div class="box">
                        <p>10 euro entrance festival + 40 euro foos: <strong>€50</strong></p>
                        <a href="https://paypal.me/rumoreb/50" target="_blank" class="link">Paga con PayPal</a>
                    </div>

                </div>
            </template>

            <template x-if="cibo && !volontari">
                <div>
                    <label>please let us know here if you have any allergies, intolerances or specific dietary needs:
                        <br>
                    (All meals are vegetarian)
                    </label><br>
                    <input type="text" name="intolleranze"><br><br>

                    <div class="box">
                        <p>40 euro entrance festival + 40 euro food: <strong>€80</strong></p>
                        <a href="https://paypal.me/rumoreb/80" target="_blank" class="link">Pay with PayPal</a>
                    </div>

                </div>
            </template>

            <template x-if="volontari && !cibo">


                <div class="box">


                    <p>10 euro entrance festival: <strong>€10</strong></p>
                    <a href="https://paypal.me/rumoreb/10" target="_blank" class="link">Pay with PayPal</a>
                </div>
            </template>

            <template x-if="!cibo && !volontari">
                <div class="box">
                    <p>40 euro entrance festival: <strong>€40</strong></p>
                    <a href="https://paypal.me/rumoreb/40" target="_blank" class="link">Pay with PayPal</a>

                </div>
            </template>

        </div>

        <p>We know times are tough right now to commit to spend money on weekends out. We’ve done our best to keep ticket and food prices as low as possible.
            <br> if you are in need of more accessible ticket, feel free to reach out privately at rumore.b.b@gmail.com, we’ll be glad to help :) </p>
        </div>

        <br>

       
        <button type="submit">Send</button>
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
