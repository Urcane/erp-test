<?php

namespace Database\Seeders;

use App\Models\Master\InternetServiceType;
use App\Models\Master\ServiceType;
use App\Models\Master\TransmissionMedia;
use App\Models\MasterData\CameraType;
use App\Models\Opportunity\Survey\TypeOfSurvey;
use Illuminate\Database\Seeder;

class OpportunitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ServiceType::create([
            [
                'name' => 'Internet',
            ],
            [
                'name' => 'CCTV',
            ],
            [
                'name' => 'Aplikasi Web',
            ],
            [
                'name' => 'Android',
            ],
            [
                'name' => 'IOS',
            ],
            [
                'name' => 'IoT',
            ]
        ]);

        InternetServiceType::create([
            ['name' => 'Dedicated'],
            ['name' => 'Broadband'],
            ['name' => 'Metro'],
            ['name' => 'VPN'],
            ['name' => 'MPLS'],
        ]);

        TypeOfSurvey::create([
            ['name' => 'Soft Survey'],
            ['name' => 'Survey On Site']
        ]);

        TransmissionMedia::create([
            ['name' => 'FO'],
            ['name' => 'Radio'],
            ['name' => 'VSAT'],
        ]);

        CameraType::create([
            ['name' => 'IPCAM'],
            ['name' => 'ANALOG'],
            ['name' => 'PTZ']
        ]);

        
    }
}
