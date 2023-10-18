<?php

namespace Database\Seeders;

use App\Models\Inventory\InventoryGood;
use Illuminate\Database\Seeder;
use App\Models\Inventory\InventoryGoodCategory;
use App\Models\Inventory\InventoryGoodCondition;
use App\Models\Inventory\InventoryGoodStatus;
use App\Models\Inventory\InventoryUnitMaster;
use App\Models\Inventory\Warehouse;
use App\Models\Inventory\WarehouseGood;

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

        InventoryGood::create([
            'good_category_id' => 2,
            'good_name' => 'Pasang Kabel',
            'code_name' => 'PS3',
            'merk' => 'Intynet',
            'good_type' => 'Baru',
            'description' => 'Kabel Anti Mati.',
        ]);

        InventoryGood::create([
            'good_category_id' => 3,
            'good_name' => 'Dedicated - Internet 10 MB',
            'code_name' => 'CX1',
            'merk' => 'Intynet',
            'good_type' => 'Baru',
            'description' => 'Internet 10 MB.',
        ]);

        InventoryGood::create([
            'good_category_id' => 3,
            'good_name' => 'Broadband - Internet 20 MB',
            'code_name' => 'CX2',
            'merk' => 'Intynet',
            'good_type' => 'Baru',
            'description' => 'Internet 20 MB.',
        ]);

        InventoryGood::create([
            'good_category_id' => 3,
            'good_name' => 'VPN - Internet 30 MB',
            'code_name' => 'CX3',
            'merk' => 'Intynet',
            'good_type' => 'Baru',
            'description' => 'Internet 30 MB.',
        ]);

        InventoryGood::create([
            'good_category_id' => 3,
            'good_name' => 'Dedicated - Internet From 10 MB - 40 MB',
            'code_name' => 'CX4',
            'merk' => 'Intynet',
            'good_type' => 'Baru',
            'description' => 'Internet 40 MB.',
        ]);

        InventoryGood::create([
            'good_category_id' => 3,
            'good_name' => 'Broadband - Internet From 20 MB - 40 MB',
            'code_name' => 'CX5',
            'merk' => 'Intynet',
            'good_type' => 'Baru',
            'description' => 'Internet 40 MB.',
        ]);

        InventoryGoodCondition::create([
            'name' => 'Baik'
        ]);

        InventoryGoodCondition::create([
            'name' => 'Rusak Ringan'
        ]);

        InventoryGoodCondition::create([
            'name' => 'Rusak Berat'
        ]);

        InventoryGoodStatus::create([
            'name' => 'Baru'
        ]);

        InventoryGoodStatus::create([
            'name' => 'Bekas'
        ]);

        Warehouse::create([
            'name' => 'Gudang Balikpapan',
            'latitude' => '-1.265386',
            'longitude' => '116.831200'
        ]);

        Warehouse::create([
            'name' => 'Gudang Samarinda',
            'latitude' => '-0.502106',
            'longitude' => '117.153709'
        ]);

        Warehouse::create([
            'name' => 'Gudang Bontang',
            'latitude' => '0.133855',
            'longitude' => '117.500921'
        ]);
    }
}
