<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use SebastianBergmann\CodeCoverage\Report\Xml\Project;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            RoleSeeder::class,
            TeamSeeder::class,
            DepartmentSeeder::class,
            PermissionSeeder::class,
            UserSeeder::class,

            ProjectSeeder::class,
            InventorySeeder::class,
            HolidaySeeder::class,
            HCDataSeeder::class,
            LeaveSeeder::class,

            AssignmentSeeder::class,
            OpportunitySeeder::class,
        ]);
    }
}
