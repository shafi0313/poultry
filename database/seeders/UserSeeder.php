<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::create([
            'name' => 'Developer',
            'email' => 'admin@shafi95.com',
            'type' => '1',
            'password' =>  bcrypt('##Zxc1234'),
        ]);
        $admin->assignRole(['admin']);
        $user = User::create([
            'name' => 'Developer',
            'email' => 'user@shafi95.com',
            'type' => '2',
            'password' =>  bcrypt('##Zxc1234'),
        ]);
        $user->assignRole(['user']);
    }
}
