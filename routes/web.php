<?php

use Illuminate\Support\Facades\Route;
use App\Models\Conto;
use App\Models\Rumore;
use Illuminate\Http\Request;


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


    $costo = 0;

    if (!($data['volontari'] ?? false)) {
        if (($data['cibo'] ?? false)) {
            $costo = 80;
        } else {
            $costo = 40;
        }
    }

    $data['costo_totale'] = $costo;
    $data['pagato_iscrizione'] = $request->has('pagato_iscrizione');
    $data['volontari'] = $request->has('volontari');
    $data['cibo'] = $request->has('cibo');

    Rumore::create($data);

    return redirect()->route('iscrizione.form')->with('success', '<h1>Iscrizione inviata con successo!</h1>');
})->name('iscrizione.store');