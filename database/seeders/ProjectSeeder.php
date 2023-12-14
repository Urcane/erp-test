<?php

namespace Database\Seeders;

use App\Models\ProjectManagement\WorkOrderCategory;
use App\Models\ProjectManagement\WorkProgressCategory;
use App\Models\ProjectManagement\WorkStatus;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        collect([
            [
                'name' => 'Done',
                'code' => 'DN',
            ],
            [
                'name' => 'In Progress',
                'code' => 'PR',
            ],
            [
                'name' => 'Freeze',
                'code' => 'FR',
            ],
            [
                'name' => 'Pending',
                'code' => 'PD',
            ],
        ])->map(function($item) {
            WorkStatus::create($item);
        });

        collect([
            [
                'name' => 'Survey',
                'code' => 'SRV',
            ],
            [
                'name' => 'Bill Of Quantities',
                'code' => 'BOQ',
            ],
            [
                'name' => 'Quotation',
                'code' => 'QUO',
            ],
            [
                'name' => 'Purchase Order',
                'code' => 'PCO',
            ],
            [
                'name' => 'Pra-Development',
                'code' => 'PRD',
            ],
        ])->map(function($item) {
            WorkProgressCategory::create($item);
        });

        collect([
            [
                'name' => 'Survey',
                'code' => 'SR',
            ],
            [
                'name' => 'Project',
                'code' => 'PJ',
            ],
            [
                'name' => 'Internal Maintenance',
                'code' => 'IM',
            ],
            [
                'name' => 'Customer Maintenance',
                'code' => 'CM',
            ],
            [
                'name' => 'Spare',
                'code' => 'SP',
            ],

        ])->map(function($item) {
            WorkOrderCategory::create($item);
        });
    }
}
