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
            UserSeeder::class,
            ProjectSeeder::class,
            OpportunitySeeder::class,
            InventorySeeder::class,
        ]);
    }
}
