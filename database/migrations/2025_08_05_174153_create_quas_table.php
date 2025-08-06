<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('quas', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('cognome');
            $table->string('email');

            $table->boolean('pagato_iscrizione')->default(false);

            $table->boolean('fatta_iscrizione')->nullable();
            $table->boolean('data_tessera')->nullable();
            $table->string('metodo_pagamento')->nullable();

            $table->boolean('mandata_mail')->nullable();
            $table->boolean('dentro_ca_monti')->nullable();
            $table->string('note')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quas');
    }
};
