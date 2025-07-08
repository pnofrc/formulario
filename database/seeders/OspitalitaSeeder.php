<?php

// database/seeders/OspitalitaSeeder.php

namespace Database\Seeders;

use App\Models\Ospitalita;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class OspitalitaSeeder extends Seeder
{
    public function run(): void
    {
        Ospitalita::truncate();

        $arrivi = [
        ];

        foreach ($arrivi as $arrivo) {
            Ospitalita::create($arrivo);
        }
    }
}

