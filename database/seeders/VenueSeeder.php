<?php

namespace Database\Seeders;

use App\Models\Venue;
use Illuminate\Database\Seeder;

class VenueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $venues = [
            [
                'name' => 'A201',
                'building'=> 'Administrative Building',
                'capacity'=>55
            ],
            [
                'name' => 'J100',
                'building'=> 'JHS Building',
                'capacity'=>55
            ],
            [
                'name' => 'S100',
                'building'=> 'SHS Building',
                'capacity'=>55
            ],
            [
                'name' => 'A202',
                'building'=> 'Administrative Building',
                'capacity'=>55
            ],
            [
                'name' => 'Multi Media',
                'building'=> 'Library Complex',
                'capacity'=>150
            ],

        ];

        foreach($venues as $venue) {
            Venue::create($venue);
        }
    }
}
