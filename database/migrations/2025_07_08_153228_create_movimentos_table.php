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
       Schema::create('movimentos', function (Blueprint $table) {
            $table->id();
            $table->enum('tipo', ['entrata', 'uscita']);
            $table->string('voce');
            $table->decimal('importo', 10, 2);
            $table->boolean('cibo')->default(false); // se è legato al cibo
            $table->string('metodo_pagamento')->nullable(); 
            $table->boolean('pagato')->default(true); // solo per le uscite
            $table->text('note')->nullable();
            $table->string('foto_scontrino')->nullable()->after('note');
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movimentos');
    }
};
