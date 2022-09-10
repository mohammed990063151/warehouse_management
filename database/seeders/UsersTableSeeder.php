<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user =\App\Models\User::create([
            'first_name' => 'super',
            'last_name'  => 'admin',
            'email' => 'obiymustafa@gmail.com',
            'password' =>bcrypt('0912150229'),

        ]);
        $user->attachRole('super_admin');
        
    }
}
