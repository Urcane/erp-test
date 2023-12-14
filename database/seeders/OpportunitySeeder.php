<?php

namespace Database\Seeders;

use App\Models\Customer\Customer;
use App\Models\Customer\CustomerContact;
use App\Models\Customer\CustomerProspect;
use App\Models\Customer\CustomerProspectLog;
use App\Models\Master\BuildingType;
use App\Models\Master\CctvRecordDuration;
use App\Models\Master\CctvStorageCapacity;
use App\Models\Master\GbConnectivityData;
use App\Models\Master\GbNaturalFrequency;
use App\Models\Master\GbRepeaterType;
use App\Models\Master\InternetBandwidth;
use App\Models\Master\OutdoorCableType;
use App\Models\Master\PowerSource;
use App\Models\Opportunity\Survey\Master\SiteSurveyServiceType;
use App\Models\Master\ServiceType;
use App\Models\Master\TransportationAccess;
use App\Models\Opportunity\Survey\Master\SiteSurveyInterface;
use App\Models\Opportunity\Survey\SiteSurveyInternet;
use App\Models\Opportunity\Survey\TypeOfSurvey;
use Database\Seeders\Opportunity\BoqSeeder;
use Database\Seeders\Opportunity\LeapSeeder;
use Database\Seeders\Opportunity\QuotationSeeder;
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
                'name' => 'GSM Booster',
                'model_name' => 'App\Models\Opportunity\Survey\SiteSurveyGSMBooster'
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
            [
                'name' => 'Dedicated',
                'category' => 'INTERNET'
            ],
            [
                'name' => 'Broadband',
                'category' => 'INTERNET'
            ],
            [
                'name' => 'Metro',
                'category' => 'INTERNET'
            ],
            [
                'name' => 'VPN',
                'category' => 'INTERNET'
            ],
            [
                'name' => 'MPLS',
                'category' => 'INTERNET'
            ],
            [
                'name' => 'Local Loop',
                'category' => 'INTERNET'
            ],
            [
                'name' => 'Local LAN',
                'category' => 'INTERNET'
            ],
            [
                'name' => 'Akses Point',
                'category' => 'INTERNET'
            ],
            [
                'name' => 'PABX',
                'category' => 'INTERNET'
            ],
            [
                'name' => 'VOIP',
                'category' => 'INTERNET'
            ],
            [
                'name' => 'MPLS',
                'category' => 'INTERNET'
            ],
            [
                'name' => 'IPCAM',
                'category' => 'CCTV'
            ],
            [
                'name' => 'Analog',
                'category' => 'CCTV'
            ],
        ])->map(function($item) {
            SiteSurveyServiceType::create($item);
        });

        collect([
            ['name' => 'Soft Survey'],
            ['name' => 'Survey On Site']
        ])->map(function($item) {
            TypeOfSurvey::create($item);
        });

        collect([
            ['name' => 'Warehouse'],
            ['name' => 'Workshop'],
            ['name' => 'Kantor']
        ])->map(function($item) {
            BuildingType::create($item);
        });

        collect([
            ['name' => '7 Hari'],
            ['name' => '14 Hari'],
            ['name' => '30 Hari']
        ])->map(function($item) {
            CctvRecordDuration::create($item);
        });

        collect([
            ['name' => '500 GB'],
            ['name' => '1 TB'],
            ['name' => '4 TB']
        ])->map(function($item) {
            CctvStorageCapacity::create($item);
        });

        collect([
            ['name' => 'Edge'],
            ['name' => '3G'],
            ['name' => '4G'],
        ])->map(function($item) {
            GbConnectivityData::create($item);
        });

        collect([
            ['name' => 'G900'],
            ['name' => 'L1800'],
            ['name' => 'L2100'],
            ['name' => 'L2300'],
        ])->map(function($item) {
            GbNaturalFrequency::create($item);
        });

        collect([
            ['name' => '1 Watt'],
            ['name' => '5 Watt'],
            ['name' => '20 Watt'],
        ])->map(function($item) {
            GbRepeaterType::create($item);
        });

        collect([
            ['name' => '10 Mbps'],
            ['name' => '20 Mbps'],
            ['name' => '50 Mbps'],
            ['name' => '100 Mbps'],
            ['name' => '200 Mbps'],
        ])->map(function($item) {
            InternetBandwidth::create($item);
        });

        collect([
            ['name' => 'STP'],
            ['name' => 'FO'],
            ['name' => 'IF'],
        ])->map(function($item) {
            OutdoorCableType::create($item);
        });

        collect([
            ['name' => 'PLN'],
            ['name' => 'PLN & Genset'],
            ['name' => 'Genset'],
            ['name' => 'PLTS'],
        ])->map(function($item) {
            PowerSource::create($item);
        });

        collect([
            ['name' => 'Perkotaan'],
            ['name' => 'Hauling'],
            ['name' => 'Sawit'],
        ])->map(function($item) {
            TransportationAccess::create($item);
        });

        collect([
            [
                'name' => 'Ethernet',
                'category' => 'INTERNET'
            ],
            [
                'name' => 'RG6',
                'category' => 'INTERNET'
            ],
            [
                'name' => 'SFP',
                'category' => 'INTERNET'
            ],
            [
                'name' => 'Ethernet',
                'category' => 'CCTV'
            ],
            [
                'name' => 'SFP',
                'category' => 'CCTV'
            ],
            [
                'name' => 'Converter',
                'category' => 'CCTV'
            ],
        ])->map(function($item) {
            SiteSurveyInterface::create($item);
        });

        // collect([
        //     ['name' => 'FO'],
        //     ['name' => 'Radio'],
        //     ['name' => 'VSAT'],
        // ])->map(function($item) {
        //     TransmissionMedia::create($item);
        // });

        // collect([
        //     ['name' => 'IPCAM'],
        //     ['name' => 'ANALOG'],
        //     ['name' => 'PTZ']
        // ])->map(function($item) {
        //     CameraType::create($item);
        // });


        // Dummy Data for leap and boq
        $this->call([
            LeapSeeder::class,
            BoqSeeder::class,
            QuotationSeeder::class,
        ]);
    }
}
