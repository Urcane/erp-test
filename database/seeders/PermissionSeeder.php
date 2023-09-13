<?php

namespace Database\Seeders;

use App\Models\Feature;
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
        $feature = [
            [
                'HC',
                // Request (Approval)
                'Approval:view-request',
                'Approval:change-status-request',
                // Request
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
            ],
        ];

        collect($feature)->map(function ($data) {
            $feature = Feature::create([
                "name" => $data[0],
            ]);
            collect($data)->map(function ($permission) use ($data, $feature) {
                if ($permission != $data[0]) {
                    Permission::create([
                        "name" => $permission,
                        "feature_id" => $feature->id,
                    ]);
                }
            });
        });
    }
}
