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
            // Profile

            // Employee

            // Attendance
            'HC:view-attendance',
            'HC:edit-delete-attendance',

            // Request (Approval)
            'Approval:view-request',
            'Approval:change-status-request',

            'HC:view-all-request',
            'HC:change-all-status-request',

            // Settings
        ];

        collect($permission)->map(function ($data) {
            Permission::create([
                "name" => $data
            ]);
        });
    }
}
