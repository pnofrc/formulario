<?php

use Illuminate\Support\Facades\Route;
use App\Models\Conto;
use App\Models\Rumore;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;


Route::get('/conto/{nome}', function ($nome) {
    $nome = str_replace('+', ' ', $nome);
    $conto = Conto::where('nome', $nome)->firstOrFail();
    return view('scontrino', compact('conto'));
});

Route::get('/', function () {
    return view('welcome');
});



Route::get('/iscrizioneRumore2025', function () {
    return view('rumore');
})->name('iscrizione.form');

Route::get('/iscrizioneRumore2025/en', function () {
    return view('rumoreEn');
})->name('iscrizione.form');

Route::post('/iscrizione', function (Request $request) {
    $data = $request->validate([
        'nome' => 'required|string|max:255',
        'cognome' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'numero_telefono' => 'required|string|max:30',
        'pagato_iscrizione' => 'nullable|boolean',
        'volontari' => 'nullable|boolean',
        'cibo' => 'nullable|boolean',
        'intolleranze' => 'nullable|string|max:255',
    ]);

    $data['volontari'] = $request->has('volontari');
    $costo = 0;

    if (!($data['volontari'])) {
        if (($data['cibo'] ?? false)) {
            $costo = 80;
        } else {
            $costo = 40;
        }
    } else {
        if (($data['cibo'] ?? false)) {
            $costo = 50;
        } else {
            $costo = 10;
        }
    }

    $data['costo_totale'] = $costo;
    $data['pagato_iscrizione'] = $request->has('pagato_iscrizione');
    $data['cibo'] = $request->has('cibo');

    Rumore::create($data);

    return redirect()->route('iscrizione.form')->with('success', 'Iscrizione inviata con successo!');
})->name('iscrizione.store');


Route::get('/form2025', function () {
    return view('form');
})->name('form.form');


Route::get('/shifts', function () {
    return view('shifts');
})->name('form.form');

Route::get('/groceries2', function () {
    return view('groceries');
})->name('form.form');

Route::get('/groceries', function () {
    $csvUrl = 'https://docs.google.com/spreadsheets/d/19xMdfh1qiPwGz2ThXRsiuGYAn7K6KPi-7AAN87WMY0w/export?format=csv&gid=0';

    $response = Http::get($csvUrl);

    if (!$response->successful()) {
        abort(500, 'Impossibile recuperare i dati dal foglio Google.');
    }

    $rows = array_map('str_getcsv', explode("\n", $response->body()));
    $header = array_map(fn($h) => strtolower(trim($h)), array_shift($rows)); // Pulizia intestazioni

    $items = [];

    foreach ($rows as $row) {
        if (count($row) !== count($header)) continue;

        $assoc = array_combine($header, $row);

        $itemName = trim($assoc['item'] ?? 'Unknown');
        $toBuyRaw = $assoc['to buy'] ?? 0;
        $toBuy = floatval(str_replace(',', '.', $toBuyRaw));

        if ($toBuy > 0 && $itemName !== '') {
            $items[] = [
                'name' => $itemName,
                'to_buy' => $toBuy
            ];
        }
    }

    return view('groceries', ['items' => $items]);
});
