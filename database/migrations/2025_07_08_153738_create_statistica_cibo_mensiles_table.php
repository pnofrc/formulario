<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   
        public function up()
        {
            Schema::create('statistica_cibo_mensile', function (Blueprint $table) {
                $table->id();

                $table->date('mese')->unique(); // es: 2025-07-01

                $table->unsignedInteger('ospiti_totali')->default(0);
                $table->unsignedInteger('giorni_totali')->default(0);

                $table->decimal('cibo_totale_ricavato', 10, 2)->default(0); // entrate cibo
                $table->decimal('cibo_totale_speso', 10, 2)->default(0);    // uscite cibo

                $table->timestamps();
            });
        }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('statistica_cibo_mensiles');
    }
};
