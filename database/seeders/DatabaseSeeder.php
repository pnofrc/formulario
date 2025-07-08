<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(MovimentoSeeder::class);
        $this->call(OspitalitaSeeder::class);

        User::updateOrCreate(
            ['email' => 'a@a.a'],
            [
                'name' => 'Admin',
                'password' => Hash::make('a'),
            ]
        );
    }
}
