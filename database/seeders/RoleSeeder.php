<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            [
                'role' => 'admin',
                'description' => 'For all systems administrator'
            ],
            [
                'role' => 'student',
                'description' => 'For all students'
            ],
            [
                'role' => 'teacher',
                'description' => 'For all teachers'
            ],
            [
                'role' => 'registrar',
                'description' => 'For the registrar and all staff in the registrar\'s office'
            ],
            [
                'role' => 'finance',
                'description' => 'For all finance office staff'
            ],
            [
                'role' => 'sao',
                'description' => 'For the student affairs officer and staff'
            ],
            [
                'role' => 'head',
                'description' => 'For all the deans, principals and program heads'
            ],

        ];

        foreach($roles as $role) {
            Role::create($role);
        }
    }
}
