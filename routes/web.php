<?php

use Illuminate\Support\Facades\Route;
use App\Models\Conto;


Route::get('/conto/{nome}', function ($nome) {
    $nome = str_replace('+', ' ', $nome);
    $conto = Conto::where('nome', $nome)->firstOrFail();
    return view('scontrino', compact('conto'));
});

Route::get('/', function () {
    return view('welcome');
});
