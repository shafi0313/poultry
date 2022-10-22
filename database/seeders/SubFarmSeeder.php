<?php

namespace Database\Seeders;

use App\Models\SubFarm;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SubFarmSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SubFarm::create([
            'user_id' => 1,
            'farm_id' => 1,
            'room_no' => '1',
        ]);
    }
}
