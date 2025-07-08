<?php

// database/seeders/OspitalitaSeeder.php

namespace Database\Seeders;

use App\Models\ospitalita;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class OspitalitaSeeder extends Seeder
{
    public function run(): void
    {
        ospitalita::truncate();

        $arrivi = [
        ];

        foreach ($arrivi as $arrivo) {
            ospitalita::create($arrivo);
        }
    }
}

