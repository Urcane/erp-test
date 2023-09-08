<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permission = [
            // Request (Approval)
            'Approval:view-request',
            'Approval:change-status-request',

            // request
            'HC:view-all-request',
            'HC:change-all-status-request',

            // attendance
            'HC:view-attendance',
            'HC:edit-delete-attendance',

            // employee
            'HC:view-employee',
            'HC:update-profile',

            // setting
            'HC:setting'
        ];

        collect($permission)->map(function ($data) {
            Permission::create([
                "name" => $data
            ]);
        });
    }
}
