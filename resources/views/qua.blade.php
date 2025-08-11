<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <title>QUA 2025</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://unpkg.com/alpinejs" defer></script>

    <style>
        .link {
            color: green;
            text-decoration: underline;
            cursor: pointer;
        }

        .box {
            border: 1px solid green;
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

        a{
            color: green !important;
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
            border: solid green;
            padding: 1rem 2rem;
            color: black !important;
        }
    </style>
</head>

<body>
     <h1>QUA @ Habitat</h1>
    <h3>Ca’ de Monti | 30-31 August 2025</h3>
    <h3>Suoni Selvatici e Massime Stratificazioni</h3>

            @if (session('success'))
             <h1 style="color: green; font-weight: bold; text-align: center; font-size: 3rem">
                {{ session('success') }}
             </h1>
        @endif


    <div class="container">

        Accumuli stravaganti di batteri, polline, polvere, spore, semi, radici, insetti, animali, funghi, sentieri, passi, sincopi, suoni, vibrazioni, frequenze, onde, circuiti, luci, ombre, odori, sapori, fiamme, legna, fascine, accendini, farine, lieviti, acqua, benzina, motori, freni, acceleratori, pneumatici, polmoni, muscoli, ossa, sangue, carne, pelle, capelli, unghie, denti, occhi, orecchie, bocca, naso, cervello, parole, sbadigli, saltelli.
        
        <br>        <br>

        con: tau contrib, le frit, perila, giulia rae, la festa delle rane, blossom, amaro, nodef, yulia kachan, callisto’s walk, di lucia palladino, tundra, habitat t.p.u. > herbalife, lamatigre, poni, torpedo

        <br>        <br>

        dalle ore 15 di sabato la terrazza sarà un campo di frequenze e insalate di persone 
                

 <p><s>First Release: 10€ (15 spots)</s></p>
 <p><s>Second Release: 20€ (20 spots)</s></p>
 <p>Third Release: 30€</p>

    {{-- <p> --}}
        {{-- entry: €30<br>Includes: --}}
        <ul>
            <li>access to the festival (Saturday afternoon 30th -> Sunday afternoon 31th)</li>
            <li>tent spot, compost toilets, outdoor showers</li>
            <li>drinking water</li>
            <li>Sunday's Breakfast</li>
        </ul>
    {{-- </p> --}}

    </div>

    <form method="POST" action="{{ route('qua.store') }}" x-data="formData()">
        @csrf

        <label>Name*</label><br>
        <input type="text" name="nome" required><br><br>

        <label>Surname*</label><br>
        <input type="text" name="cognome" required><br><br>

        <label>Contact Email*</label><br>
        <input type="email" name="email" required><br><br>
        (DOUBLE CHECK YOUR EMAIL)
        <br>
        <br>
        
        {{-- <label>Phone Number*</label><br> --}}
        {{-- <input type="text" name="numero_telefono" required><br><br> --}}

        <label>
            <input type="checkbox" name="pagato_iscrizione" value="1" required>
            Distretto A APS 2025 membership is required (€10) for the event<br>
            <a href="https://forms.gle/o531HuN5Rt7XyVzJ7" target="_blank">Please register here</a> then check the box

        </label>

        <div class="box">

            Saturday's dinner will be proposed by Habitat <i>Locanda Aperta</i> Unit and it will be a vegetarian (vegan option surely possible)
            meal made of a sourdough Lievito Mamma edible fossil and organic vegetables alchemically cooked in our wood oven. 
            Some beasts will provide their coagulated presents.<br>
            <br>
            If will be 7€ - If you have any allergies or intolerances let us know info@habitattt.it, we can also do a gluten free bread.<br>
            <br>
            Please note that stoves and open flames are NOT allowed.
        </div>
            
        <br>
        <br>
        <div x-data="{ metodo_pagamento: 'paypal' }">

        <label>(Pay first, and then send this form!) <br> I'm going to pay with:</label>

            <select x-model="metodo_pagamento" name="metodo_pagamento">
                <option value="paypal">PayPal</option>
                <option value="iban">IBAN</option>
            </select>

            <div x-show="metodo_pagamento === 'paypal'">
                <br>
               <a target="_blank" href="https://www.paypal.com/ncp/payment/PP9DSELGT4LBS">PayPal link to payment</a>
            </div>

            <div x-show="metodo_pagamento === 'iban'">
                
               <p>
                    DISTRETTO A APS  <br>
                    IBAN: IT88Q0623023704000030225469 <br>
                    Description: “Donazione evento Qua"
               </p>
            </div>

            </div>


          <br>  <br>
       
        <button type="submit">Send</button>
    </form>


</body>


</html>
