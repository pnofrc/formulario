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
        Schema::create('rumores', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
             $table->string('cognome');
              $table->string('email');
            $table->string('numero_telefono');

            $table->boolean('volontari')->default(false);

            $table->boolean('pagato_iscrizione')->default(false);

            $table->boolean('cibo')->default('true');
             $table->string('intolleranze')->nullable();

            $table->decimal('costo_totale', 8, 2)->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rumores');
    }
};
