<?php

namespace Database\Seeders;

use App\Models\Farm;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FarmSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Farm::create([
            'user_id' => 1,
            'name' => 'Farm 1',
            'phone' => '022',
            'address' => 'Test',
        ]);
    }
}
