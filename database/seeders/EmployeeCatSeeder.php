<?php

namespace Database\Seeders;

use App\Models\EmployeeCat;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class EmployeeCatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = EmployeeCat::create([
            'name' => 'SEO',
        ]);
    }
}
