<?php

namespace Database\Seeders;

use App\Models\BussinesType;
use App\Models\LeadReference;
use App\Models\Team\City;
use App\Models\Team\Team;
use App\Models\Team\TeamCity;
use Illuminate\Database\Seeder;

class TeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   
        $bussinesType = ['Goverment','Manufacture','Supplier','Hospitality','Oil & Gas'];
        $leadReference = ['Canvasing','Referensi Internet','Rekomendasi','Referensi Internal','Telemarketing'];

        for ($i=0; $i < count($leadReference); $i++) { 
            LeadReference::create([
                'lead_reference_name'=>$leadReference[$i],
            ]);
        }

        for ($i=0; $i < count($bussinesType); $i++) { 
            BussinesType::create([
                'type_name'=>$bussinesType[$i],
            ]);
        }

        $list = ['Tim Balikpapan','Tim Bontang & Kutim','Tim Kutim','Tim Tanah Bumbu','Tim Mahulu','Tim Jakarta','Tim Yogyakarta','Tim Berau','Tim Muara Teweh'];
        $city = ['Balikpapan','Samarinda'];

        for ($i=0; $i < count($list); $i++) { 
            Team::create([
                'team_name'=>$list[$i],
            ]);
        }

        for ($j=0; $j < count($city); $j++) { 
            City::create([
                'city_name'=>$city[$j],
            ]);
        }

        TeamCity::create([
            'team_id'=>1,
            'city_id'=>1,
        ]);
    }
}
