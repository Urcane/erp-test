<?php

namespace Database\Seeders;

use App\Models\Master\InternetServiceType;
use App\Models\Master\ServiceType;
use App\Models\Master\TransmissionMedia;
use App\Models\Master\CameraType;
use App\Models\Opportunity\Survey\SiteSurveyInternet;
use App\Models\Opportunity\Survey\TypeOfSurvey;
use Illuminate\Database\Seeder;

use function PHPSTORM_META\map;

class OpportunitySeeder extends Seeder
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
                'name' => 'Internet',
                'model_name' => 'App\Models\Opportunity\Survey\SiteSurveyInternet'
            ],
            [
                'name' => 'CCTV',
                'model_name' => 'App\Models\Opportunity\Survey\SiteSurveyCCTV'
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
        ])->map(function($item) {
            ServiceType::create($item);
        });

        collect([
            ['name' => 'Dedicated'],
            ['name' => 'Broadband'],
            ['name' => 'Metro'],
            ['name' => 'VPN'],
            ['name' => 'MPLS'],
        ])->map(function($item) {
            InternetServiceType::create($item);
        });

        collect([
            ['name' => 'Soft Survey'],
            ['name' => 'Survey On Site']
        ])->map(function($item) {
            TypeOfSurvey::create($item);
        });

        collect([
            ['name' => 'FO'],
            ['name' => 'Radio'],
            ['name' => 'VSAT'],
        ])->map(function($item) {
            TransmissionMedia::create($item);
        });

        collect([
            ['name' => 'IPCAM'],
            ['name' => 'ANALOG'],
            ['name' => 'PTZ']
        ])->map(function($item) {
            CameraType::create($item);
        });
    }
}
