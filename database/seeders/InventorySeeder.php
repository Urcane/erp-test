<?php

namespace Database\Seeders;

use App\Models\Inventory\InventoryGood;
use Illuminate\Database\Seeder;
use App\Models\Inventory\InventoryGoodCategory;
use App\Models\Inventory\InventoryUnitMaster;

use function PHPSTORM_META\map;

class InventorySeeder extends Seeder
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
                'name' => 'Barang',
                'description' => 'Kategori Barang.',
                'code_name' => 'BRG'
            ],
            [
                'name' => 'Jasa',
                'description' => 'Kategori Jasa.',
                'code_name' => 'JS'
            ],
            [
                'name' => 'Internet',
                'description' => 'Kategori Internet.',
                'code_name' => 'INT'
            ],
            [
                'name' => 'CCTV',
                'description' => 'Kategori CCTV.',
                'code_name' => 'CCTV'
            ],
            [
                'name' => 'GSM Booster',
                'description' => 'Kategori GSM Booster.',
                'code_name' => 'GB'
            ],
        ])->map(function($item) {
            InventoryGoodCategory::create($item);
        });

        collect([
            [
                'name' => 'Centimeter',
                'code' => 'CM'
            ],
            [
                'name' => 'Pcs',
                'code' => 'PCS'
            ],
            [
                'name' => 'Bulan',
                'code' => 'MTH'
            ],
            [
                'name' => 'Meter',
                'code' => 'M'
            ],
        ])->map(function($item) {
            InventoryUnitMaster::create($item);
        });

        collect([
            [
                'good_category_id' => 1,
                'good_name' => 'RJ45',
                'good_type' => 'Baru',
                'code_name' => 'SG1',
                'merk' => 'AMP',
                'description' => 'RJ45 Kualitas Terbaik.',
            ],
            [
                'good_category_id' => 1,
                'good_name' => 'Mikrotik',
                'good_type' => 'Baru',
                'code_name' => 'SG2',
                'merk' => 'Latvia',
                'description' => 'Mikrotik Tercanggih.',
            ],
            [
                'good_category_id' => 1,
                'good_name' => 'Radio',
                'good_type' => 'Baru',
                'code_name' => 'SG3',
                'merk' => 'Sony',
                'description' => 'Radio Yang Memiliki Radius 10 KM.',
            ],
            [
                'good_category_id' => 2,
                'good_name' => 'Pasang Jaringan',
                'good_type' => 'Baru',
                'code_name' => 'KV1',
                'merk' => 'Intynet',
                'description' => 'Jaringan Anti Mati.',
            ],
            [
                'good_category_id' => 2,
                'good_name' => 'Pasang Wifi',
                'good_type' => 'Baru',
                'code_name' => 'KV2',
                'merk' => 'Intynet',
                'description' => 'Wifi 100 GB/s.',
            ]
        ])->map(function($items) {
            InventoryGood::create($items);
        });
    }
}
