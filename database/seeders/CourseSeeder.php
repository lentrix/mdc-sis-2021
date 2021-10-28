<?php

namespace Database\Seeders;

use App\Models\Course;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $courses = [
            [
                'name' => 'Eng G1',
                'description' => 'First Grade English',
                'credit' => 1,
                'department_id' => 1,
                'program_id' => 2
            ],
            [
                'name' => 'Fil G7',
                'description' => 'Seventh Grade Filipino',
                'credit' => 1,
                'department_id' => 4,
                'program_id' => 3
            ],
            [
                'name' => 'Sci G11',
                'description' => 'Eleventh Grade Science',
                'credit' => 1,
                'department_id' => 5,
                'program_id' => 4
            ],
            [
                'name' => 'Math 117',
                'description' => 'Abstract Algebra',
                'credit' => 3,
                'department_id' => 6
            ],
            [
                'name' => 'ITE 405',
                'description' => 'Artificial Intelligence',
                'credit' => 3,
                'department_id' => 10,
                'program_id' => 6
            ],
        ];

        foreach($courses as $course) {
            Course::create($course);
        }
    }
}
