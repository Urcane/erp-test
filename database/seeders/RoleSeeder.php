<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = ['administrator','manager','spv','staff'];
        for ($i=0; $i < count($role); $i++) {
            Role::create([
                'name'=>$role[$i],
            ]);
        }
    }
}
