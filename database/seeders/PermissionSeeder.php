<?php

namespace Database\Seeders;

use App\Models\Feature;
use Illuminate\Database\Seeder;
use App\Models\Permission;

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
                'HC:setting',
            ],
            [
                'Leap',
                'Leap:manage-lead',
                'Leap:manage-prospect',
            ],
            [
                'Opportunity',
                'Approval:survey-work-order',
                'Approval:view-boq-review',
                'Approval:update-boq-review',
                'Survey:manage-survey-request',
                'Survey:create-work-order',
                'Survey:manage-soft-survey',
                'Survey:manage-site-survey',
                'Boq:create-draft-boq',
                'Boq:view-draft-boq',
                'Boq:manage-price-request-boq',
                'Boq:view-only-price-request-boq',
                'Boq:publish-finalize-boq',
                'Boq:markup-price-boq',
                'Quot:manage-quot',
                'Quot:view-only-quot',
                'Quot:upload-attachment-quot',
                'Quot:print-quot'
            ],
        ];

        collect($feature)->map(function ($data) {
            $feature = Feature::create([
                "name" => $data[0],
            ]);
            collect($data)->map(function ($permission) use ($data, $feature) {
                if ($permission != $data[0]) {
                    $permission = Permission::create([
                        "name" => $permission,
                    ]);

                    $permission->features()->attach([$feature->id]);
                }
            });
        });
    }
}
