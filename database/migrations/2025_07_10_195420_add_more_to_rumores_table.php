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
        Schema::table('rumores', function($table) {
            $table->integer('soldi')->default(0)->nullable();
            $table->boolean('fatta_iscrizione')->nullable();
            $table->boolean('data_tessera')->nullable();
            $table->string('metodo_pagamento')->nullable();
            $table->boolean('mandata_mail')->nullable();
            $table->boolean('dentro_ca_monti')->nullable();
            $table->string('note')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('rumores', function($table) {
            $table->integer('soldi');
            $table->boolean('fatta_iscrizione');
            $table->boolean('data_tessera');
            $table->string('metodo_pagamento');
            $table->boolean('mandata_mail');
            $table->boolean('dentro_ca_monti');
            $table->string('note');

        });
    }
};
