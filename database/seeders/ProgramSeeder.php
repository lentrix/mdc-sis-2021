<?php

namespace Database\Seeders;

use App\Models\Program;
use Illuminate\Database\Seeder;

class ProgramSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $programs = [
            [
                'short_name' => 'Pre-K',
                'full_name' => 'Pre-Elementary',
                'program_head' => 'Vivien Mascarinas',
                'department_id' => 2
            ],
            [
                'short_name' => 'Elem',
                'full_name' => 'Elementary',
                'program_head' => 'Vivien Mascarinas',
                'department_id' => 1
            ],
            [
                'short_name' => 'JHS',
                'full_name' => 'Junior High School',
                'program_head' => 'Jasmin M. Sumipo',
                'department_id' => 4
            ],
            [
                'short_name' => 'SHS',
                'full_name' => 'Senior High School',
                'program_head' => 'Jasmin M. Sumipo',
                'department_id' => 5
            ],
            [
                'short_name' => 'BEED',
                'full_name' => 'Bachelor of Elementary Education',
                'program_head' => 'Ninfa S. Reserva',
                'department_id' => 11
            ],
            [
                'short_name' => 'BSIT',
                'full_name' => 'Bachelor of Science in Information Technology',
                'program_head' => 'Josefina Pangan',
                'department_id' => 9
            ],
            [
                'short_name' => 'BSCRIM',
                'full_name' => 'Bachelor of Science in Criminology',
                'program_head' => 'Avelino Lofranco',
                'department_id' => 10
            ],
            [
                'short_name' => 'BSHRM',
                'full_name' => 'Bachelor of Science in Hotel & Restaurant Management',
                'program_head' => 'Sheila Monte de Ramos',
                'department_id' => 8
            ],
            [
                'short_name' => 'BSA',
                'full_name' => 'Bachelor of Science in Accountancy',
                'program_head' => 'Angelica Balatucan',
                'department_id' => 7
            ],
            [
                'short_name' => 'BSN',
                'full_name' => 'Bachelor of Science in Nursing',
                'program_head' => 'Rosario Poligrates',
                'department_id' => 12
            ],
        ];

        foreach($programs as $program) {
            Program::create($program);
        }
    }
}
