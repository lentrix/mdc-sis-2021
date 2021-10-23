<?php

namespace Database\Seeders;

use App\Models\Period;
use App\Models\Term;
use Illuminate\Database\Seeder;

class TermsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $terms = [
            [
                'accronym' => '1T21-22',
                'name' => '1st Semester AY 2021-2022',
                'type' => 'sem',
                'enrol_start' => '2021-08-20',
                'enrol_end' => '2021-09-10',
                'start' => '2021-09-01',
                'end' => '2021-12-21',
                'periods' => [
                    [
                        'name' => 'Midterm',
                        'start'=> '2021-09-01',
                        'end' => '2021-10-23'
                    ],
                    [
                        'name' => 'Final',
                        'start'=> '2021-09-01',
                        'end' => '2021-10-23'
                    ],
                ],
            ],
            [
                'accronym' => '2T21-22',
                'name' => '2nd Semester AY 2021-2022',
                'type' => 'sem',
                'enrol_start' => '2022-01-01',
                'enrol_end' => '2022-01-27',
                'start' => '2022-01-15',
                'end' => '2022-04-26',
                'periods' => [
                    [
                        'name' => 'Midterm',
                        'start'=> '2022-09-01',
                        'end' => '2021-10-23'
                    ],
                    [
                        'name' => 'Final',
                        'start'=> '2021-09-01',
                        'end' => '2021-10-23'
                    ],
                ],
            ],
            [
                'accronym' => 'AY 22-23',
                'name' => 'Academic Year 2022-2023',
                'type' => 'annual',
                'enrol_start' => '2021-07-15',
                'enrol_end' => '2021-08-27',
                'start' => '2021-08-15',
                'end' => '2022-05-26',
                'periods' => [
                    [
                        'name' => '1st Quarter',
                        'start'=> '2021-09-01',
                        'end' => '2021-10-23'
                    ],
                    [
                        'name' => '2nd Quarter',
                        'start'=> '2021-09-01',
                        'end' => '2021-10-23'
                    ],
                    [
                        'name' => '3rd Quarter',
                        'start'=> '2021-09-01',
                        'end' => '2021-10-23'
                    ],
                    [
                        'name' => '4th Quarter',
                        'start'=> '2021-09-01',
                        'end' => '2021-10-23'
                    ],
                ],
            ],
        ];

        foreach($terms as $term) {
            $t = Term::create([
                'accronym' => $term['accronym'],
                'name' => $term['name'],
                'type' => $term['type'],
                'enrol_start' => $term['enrol_start'],
                'enrol_end' => $term['enrol_end'],
                'start' => $term['start'],
                'end' => $term['end'],
            ]);
            foreach($term['periods'] as $period) {
                Period::create([
                    'term_id' => $t->id,
                    'name' => $period['name'],
                    'start' => $period['start'],
                    'end' => $period['end'],
                ]);
            }
        }
    }
}
