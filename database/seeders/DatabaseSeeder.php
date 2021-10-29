<?php

namespace Database\Seeders;

use App\Models\UserRole;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(UserSeeder::class);
        $this->call(RoleSeeder::class);
        UserRole::create(['user_id'=>1,'role_id'=>1]);
        $this->call(PermissionSeeder::class);
        $this->call(DepartmentSeeder::class);
        $this->call(ProgramSeeder::class);
        $this->call(CourseSeeder::class);
        $this->call(TeacherSeeder::class);
    }
}
