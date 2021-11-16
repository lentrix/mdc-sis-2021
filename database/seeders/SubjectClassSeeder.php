<?php

namespace Database\Seeders;

use App\Models\SubjectClass;
use Illuminate\Database\Seeder;

class SubjectClassSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $classes = [
            [
                'course_id' => 4,
                'teacher_id' => 2,
                'term_id' => 1,
                'department_id' => 12,
            ],
            [
                'course_id' => 6,
                'teacher_id' => 1,
                'term_id' => 1,
                'department_id' => 10,
            ],
            [
                'course_id' => 7,
                'teacher_id' => 1,
                'term_id' => 1,
                'department_id' => 10,
            ],
        ];

        foreach($classes as $class) {
            SubjectClass::create([
                'course_id' => $class['course_id'],
                'teacher_id' => $class['teacher_id'],
                'term_id' => $class['term_id'],
                'department_id' => $class['department_id'],
                'credit_units' => 3,
                'pay_units' => 3,
                'limit' => 40,
                'created_by' => 1,
                'updated_by' => 1,
            ]);
        }
    }
}
