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
        Schema::create('contos', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string(column: 'artista_evento');
            $table->boolean('paga_ospitalita')->default(true);
            $table->boolean('paga_biancheria')->default(false);
            $table->boolean('pagato_iscrizione')->default(false);
            $table->boolean('lingua_italiano')->default(true);
            $table->timestamp('data_partenza')->nullable();
            $table->timestamp('data_arrivo')->nullable();
            // $table->unsignedInteger('notti')->nullable();
            $table->unsignedTinyInteger('numero_ospiti')->default(1)->nullable();
            $table->string('tipologia_stanza')->nullable();
            $table->decimal('costo_pasto_giornaliero', 8, 2)->default(5.00)->nullable();
            $table->json('eventi_extra')->nullable();
            $table->boolean('pagato')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contos');
    }
};
