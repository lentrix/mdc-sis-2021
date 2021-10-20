<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $perms = [
            [
                'permission' => 'Delete Course',
                'description' => 'Can delete an existing course'
            ],
            [
                'permission' => 'Edit Course',
                'description' => 'Can edit an existing course'
            ]
        ];

        foreach($perms as $p) {
            Permission::create($p);
        }
    }
}
