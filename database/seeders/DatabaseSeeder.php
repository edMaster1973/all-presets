<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Segment;
use App\Models\Style;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            SegmentSeeder::class,
            MarcaSeeder::class,
            CategorySeeder::class,
            StyleSeeder::class,
            EquipamentSeeder::class,
        ]);

        \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'Master',
            'email' => 'suporte.ed.master@gmail.com',
        ]);
    }
}
