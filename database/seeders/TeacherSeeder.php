<?php

namespace Database\Seeders;

use App\Models\Teacher;
use Illuminate\Database\Seeder;

class TeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $teachers = [
            [
                'user_id' => 1,
                'name' => 'Benjie B. Lenteria',
                'specialization' => 'Computer & Information Technology',
                'phone' => '09173035716',
                'department_id' => 10
            ],
            [
                'user_id' => 3,
                'name' => 'Josefina J. Pangan',
                'specialization' => 'Computer & Information Technology',
                'phone' => '123456789',
                'department_id' => 10
            ],
            [
                'user_id' => 2,
                'name' => 'Jose Ruel B. Alampayan',
                'specialization' => 'Natural Sciences',
                'phone' => '321654987',
                'department_id' => 12
            ],

        ];

        foreach($teachers as $teacher) {
            Teacher::create($teacher);
        }
    }
}
