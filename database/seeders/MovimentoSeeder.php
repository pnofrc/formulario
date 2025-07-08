<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Movimento;
use Carbon\Carbon;

class MovimentoSeeder extends Seeder
{
    public function run()
    {
        Movimento::create([
            'tipo' => 'entrata',
            'voce' => 'donazione',
            'importo' => 200.00,
            'cibo' => false,
            'metodo_pagamento' => 'contanti',
            'pagato' => true, // anche se per entrata non serve, mettiamo true
            'note' => 'Donazione da evento esterno',
            'created_at' => Carbon::now()->subDays(15),
            'updated_at' => Carbon::now()->subDays(15),
        ]);

        Movimento::create([
            'tipo' => 'uscita',
            'voce' => 'spesa supermercato',
            'importo' => 120.50,
            'cibo' => true,
            'metodo_pagamento' => 'carta di credito',
            'pagato' => true,
            'note' => 'Acquisto alimenti freschi',
            'created_at' => Carbon::now()->subDays(10),
            'updated_at' => Carbon::now()->subDays(10),
        ]);

        Movimento::create([
            'tipo' => 'uscita',
            'voce' => 'spesa utensili',
            'importo' => 45.00,
            'cibo' => false,
            'metodo_pagamento' => 'bonifico',
            'pagato' => false,
            'note' => 'Attrezzature da cucina, pagamento in sospeso',
            'created_at' => Carbon::now()->subDays(5),
            'updated_at' => Carbon::now()->subDays(5),
        ]);

        Movimento::create([
            'tipo' => 'entrata',
            'voce' => 'vendita cibo',
            'importo' => 350.00,
            'cibo' => true,
            'metodo_pagamento' => 'paypal',
            'pagato' => true,
            'note' => 'Incasso da vendite alimentari',
            'created_at' => Carbon::now()->subDays(2),
            'updated_at' => Carbon::now()->subDays(2),
        ]);
    }
}
