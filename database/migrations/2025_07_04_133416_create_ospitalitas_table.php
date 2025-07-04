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
        Schema::create('ospitalitas', function (Blueprint $table) {
            $table->id();
            $table->json('nome');
            $table->string('chi_sei')->nullable();
            $table->boolean('artista_evento')->nullable();
            $table->boolean('paga_ospitalita')->default(true);
            $table->boolean('iscrizione')->default(false);
            $table->boolean('lingua_italiano')->default(true);
            $table->timestamp('data_partenza')->nullable();
            $table->timestamp('data_arrivo')->nullable();
            $table->unsignedTinyInteger('numero_ospiti')->default(1)->nullable();
            $table->string('tipologia_stanza')->nullable();
            $table->json('eventi_extra')->nullable();
            $table->boolean('mandata_mail')->default(false);
            $table->boolean('pagato')->default(false);
            $table->boolean('confermato')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ospitalitas');
    }
};
