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
        $users = [
            [
                'user' => 'lentrix',
                'lname' => 'Lenteria',
                'fname' => 'Benjie',
                'email' => 'benjielenteria@mdc.ph',
                'password' =>'password123'
            ],
            [
                'user' => 'jrba',
                'lname' => 'Alampayan',
                'fname' => 'Jose Ruel',
                'email' => 'mdcregoff@yahoo.com',
                'password' => 'password123'
            ],
            [
                'user' => 'fina',
                'lname' => 'Pangan',
                'fname' => 'Josefina',
                'email' => 'j1fina@yahoo.com',
                'password' => 'password123'
            ],
        ];

        foreach($users as $user) {
            User::create([
                'user' => $user['user'],
                'lname' => $user['lname'],
                'fname' => $user['fname'],
                'email' => $user['email'],
                'password' => bcrypt($user['password']),
            ]);
        }
    }
}
