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

        form,
        .container {
            width: 75%;
        }

        .quote {
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
    <h1>A.A.A. Habitanti 2025</h1>

    <a href="http://habitattt.it/info/it">Info</a>
    <a href="https://habitattt.it/wiki/index.php?title=Commons">Commons</a>


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

        <label>Sono un*</label><br>
        <input type="text" name="identity" required><br><br>

        <label>Sono interessato a *</label><br>
        <input type="text" name="topics" required><br><br>

        <label for="room">Vorrei stare in: </label>
        <select name="room" id="room" class="form-control">
            <option value="opzione1">Camerata (9 beds)</option>
            <option value="opzione2">Cameratina (2 beds)</option>
            <option value="opzione3">Camerella (1 double bed)</option>
            <option value="opzione4">Studio (1 double bed) - Minimum stay 30 days</option>
        </select>
        <br><br><br>

        <label>
            <input type="checkbox" name="termini" value="1" required>
            Ho letto e accetto i <a href="https://habitattt.it/wiki/index.php?title=Commons" target="_blank">Termini e Condizioni</a>
        </label>
        <br><br><br>

        <br><br>

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