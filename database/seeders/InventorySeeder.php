<?php

namespace Database\Seeders;

use App\Models\Inventory\InventoryGood;
use Illuminate\Database\Seeder;
use App\Models\Inventory\InventoryGoodCategory;

class InventorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        InventoryGoodCategory::create([
            'name' => 'Barang',
            'description' => 'Kategori Barang.',
            'code_name' => 'PK1'
        ]);


        InventoryGoodCategory::create([
            'name' => 'Jasa',
            'description' => 'Kategori Jasa.',
            'code_name' => 'PK2'
        ]);


        InventoryGood::create([
            'good_category_id' => 1,
            'good_name' => 'RJ45',
            'code_name' => 'SG1',
            'merk' => 'AMP',
            'good_type' => 'Baru',
            'description' => 'RJ45 Kualitas Terbaik.',
        ]);

        InventoryGood::create([
            'good_category_id' => 1,
            'good_name' => 'Mikrotik',
            'code_name' => 'SG2',
            'merk' => 'Latvia',
            'good_type' => 'Baru',
            'description' => 'Mikrotik Tercanggih.',
        ]);

        InventoryGood::create([
            'good_category_id' => 1,
            'good_name' => 'Radio',
            'code_name' => 'SG3',
            'merk' => 'Sony',
            'good_type' => 'Baru',
            'description' => 'Radio Yang Memiliki Radius 10 KM.',
        ]);

        InventoryGood::create([
            'good_category_id' => 2,
            'good_name' => 'Pasang Jaringan',
            'code_name' => 'KV1',
            'merk' => 'Intynet',
            'good_type' => 'Baru',
            'description' => 'Jaringan Anti Mati.',
        ]);

        InventoryGood::create([
            'good_category_id' => 2,
            'good_name' => 'Pasang Wifi',
            'code_name' => 'KV2',
            'merk' => 'Intynet',
            'good_type' => 'Baru',
            'description' => 'Wifi 100 GB/s.',
        ]);
    }
}
