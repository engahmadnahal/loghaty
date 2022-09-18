<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Father;
use Database\Factories\AdminFactory;
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
        $this->call(PlanSeeder::class);
        $this->call(PlanTeacherSeeder::class);
        $this->call(PermissionSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(CountrySeeder::class);
        $this->call(TeacherSeeder::class);
        $this->call(SemesterSeeder::class);
        $this->call(FatherSeeder::class);
        $this->call(ChildrenSeeder::class);
        $this->call(AdminSeeder::class);
    }
}
