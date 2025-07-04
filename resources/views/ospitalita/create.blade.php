<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Richiesta Ospitalità</title>
    <script src="//unpkg.com/alpinejs" defer></script>
    <style>
        body { font-family: Arial, sans-serif; background: #f5f5f5; margin:0; padding:0; }
        .container { max-width: 700px; margin: 40px auto; padding: 20px; background: #fff; border-radius: 6px; box-shadow: 0 0 10px rgba(0,0,0,0.1);}
        label { display: block; margin-top: 15px; font-weight: bold; }
        input, select { width: 100%; padding: 8px; margin-top: 5px; }
        .names { margin-top: 10px; }
        .names input { margin-top: 5px; }
        .checkbox { display: flex; align-items: center; margin-top: 15px; }
        .checkbox input { width: auto; margin-right: 10px; }
        button { margin-top: 20px; padding: 10px 20px; background: #333; color: #fff; border: none; cursor: pointer; }
        button:hover { background: #555; }
        .lang-switch { margin-bottom: 15px; }
    </style>
</head>
<body>
<div class="container" x-data="ospitalitaForm()">
    <div class="lang-switch">
        <button type="button" @click="setLanguage('it')">🇮🇹 Italiano</button>
        <button type="button" @click="setLanguage('en')">🇬🇧 English</button>
    </div>
    <form method="POST" action="{{ route('ospitalita.store') }}" @submit="validate">
        @csrf

        <label x-text="labels.stanza"></label>
        <select name="tipologia_stanza" x-model="tipologia_stanza" required>
            <option value="camerata condivisa" x-text="labels.camerata"></option>
            <option value="camerella privata" x-text="labels.camerella"></option>
        </select>

        <label x-text="labels.numero_ospiti"></label>
        <input type="number" name="numero_ospiti" min="1" x-model.number="numero_ospiti" required>

        <template x-for="i in numero_ospiti" :key="i">
            <div class="names">
            <label x-text="labels.nome + ' ' + i"></label>
            <input type="text" x-model="nomi[i - 1]" :name="'nomi[' + (i - 1) + ']'" required>
            </div>
        </template>
        <input type="hidden" name="nomi_json" :value="JSON.stringify(nomi)">

        <label x-text="labels.data_arrivo"></label>
        <input type="date" name="data_arrivo" required>

        <label x-text="labels.data_partenza"></label>
        <input type="date" name="data_partenza" required>

        <div class="checkbox">
            <input type="checkbox" name="accettato" x-model="accettato" required>
            <span x-text="labels.accettato"></span>
        </div>

        <button type="submit" x-text="labels.invia"></button>
    </form>
</div>

<script>
function ospitalitaForm() {
    return {
        lingua: 'it',
        tipologia_stanza: '',
        numero_ospiti: 1,
        accettato: false,
        labels: {},
        testi: {
            it: {
                stanza: 'Tipologia Stanza',
                camerata: 'Camerata Condivisa',
                camerella: 'Camerella Privata',
                numero_ospiti: 'Numero di Ospiti',
                nome: 'Nome Ospite',
                data_arrivo: 'Data Arrivo',
                data_partenza: 'Data Partenza',
                accettato: 'Ho letto i Commons e mi iscriverò all\'associazione',
                invia: 'Invia Richiesta'
            },
            en: {
                stanza: 'Room Type',
                camerata: 'Shared Dormitory',
                camerella: 'Private Little Room',
                numero_ospiti: 'Number of Guests',
                nome: 'Guest Name',
                data_arrivo: 'Arrival Date',
                data_partenza: 'Departure Date',
                accettato: 'I have read the Commons and will join the association',
                invia: 'Submit Request'
            }
        },
        setLanguage(lang) {
            this.lingua = lang;
            this.labels = this.testi[lang];
        },
        validate(e) {
            if (!this.accettato) {
                e.preventDefault();
                alert(this.lingua === 'it'
                    ? 'Devi accettare i Commons per proseguire.'
                    : 'You must accept the Commons to proceed.');
            }
        },
        init() {
            this.setLanguage('it');
        }
    }
}
</script>
</body>
</html>
