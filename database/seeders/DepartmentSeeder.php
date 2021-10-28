<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $depts = [
            [
                //ID = 1
                'accronym'=>'ELEM',
                'name' => 'Elementary Department',
            ],
            [
                'accronym'=>'PRE-K',
                'name' => 'Preschool Department',
                'parent_id' =>  1
            ],
            [
                //ID = 3
                'accronym'=>'HS',
                'name' => 'High School Department',
            ],
            [
                'accronym'=>'JHS',
                'name' => 'Junior High School',
                'parent_id' =>  3
            ],
            [
                'accronym'=>'SHS',
                'name' => 'Senior High School',
                'parent_id' =>  3
            ],
            [
                //ID = 6
                'accronym'=>'College',
                'name' => 'College Department',
            ],
            [
                //ID = 7
                'accronym'=>'CABM',
                'name' => 'College of Business & Accountancy',
                'parent_id' =>  6
            ],
            [
                'accronym'=>'CABM-B',
                'name' => 'Business Department',
                'parent_id' =>  7
            ],
            [
                'accronym'=>'CABM-H',
                'name' => 'Hospitality Department',
                'parent_id' =>  7
            ],
            [
                'accronym'=>'CAST',
                'name' => 'College of Arts, Sciences, & Technology',
                'parent_id' =>  6
            ],
            [
                'accronym'=>'CCJ',
                'name' => 'College of Criminal Justice',
                'parent_id' =>  6
            ],
            [
                'accronym'=>'COE',
                'name' => 'College of Education',
                'parent_id' =>  6
            ],
            [
                'accronym'=>'CON',
                'name' => 'College of Nursing',
                'parent_id' =>  6
            ],
        ];

        foreach($depts as $dept) {
            Department::create($dept);
        }
    }
}
