<?php

namespace Database\Seeders;

use App\Models\Inventory\InventoryGoods;
use App\Models\Inventory\InventoryGoodCategories;
use Illuminate\Database\Seeder;

class InventorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        InventoryGoodCategories::create([
            'name' => 'Barang',
            'description' => 'Sample Barang.',
            'code_name' => 'PK1'
        ]);


        InventoryGoodCategories::create([
            'name' => 'Jasa',
            'description' => 'Sample Jasa.',
            'code_name' => 'PK2'
        ]);


        InventoryGoods::create([
            'good_category_id' => 1,
            'good_name' => 'RJ45',
            'code_name' => 'SG1',
            'merk' => 'Ajinomoto',
            'good_type' => 'Bagus',
            'description' => 'Sample RJ45.',
        ]);

        InventoryGoods::create([
            'good_category_id' => 1,
            'good_name' => 'Mikrotik',
            'code_name' => 'SG2',
            'merk' => 'Masako',
            'good_type' => 'Bagus',
            'description' => 'Sample Mikrotik.',
        ]);

        InventoryGoods::create([
            'good_category_id' => 1,
            'good_name' => 'Pasang Jaringan',
            'code_name' => 'KV1',
            'merk' => 'Philips',
            'good_type' => 'Bagus',
            'description' => 'Sample Jaringan.',
        ]);

       
    }
}
