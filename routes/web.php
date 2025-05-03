<?php

use Illuminate\Support\Facades\Route;
use App\Models\Conto;
use App\Http\Controllers\ContiHabitatBot;


Route::get('/conto/{nome}', function ($nome) {
    $nome = str_replace('+', ' ', $nome);
    $conto = Conto::where('nome', $nome)->firstOrFail();
    return view('scontrino', compact('conto'));
});

Route::get('/', function () {
    return view('welcome');
});

Route::post('/telegram/webhook', [ContiHabitatBot::class, 'webhook']);
