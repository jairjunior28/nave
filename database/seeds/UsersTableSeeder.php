<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
        	'name' => 'Jair Júnior',
            'username' => 'jairjunior',
            'email' => 'jairjunio242011@gmail.com',
            'password' => bcrypt('1234'),
            'admin' => true
        ]);
    }
}
