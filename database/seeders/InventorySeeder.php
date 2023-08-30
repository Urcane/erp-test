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
            'code_name' => 'PK'
        ]);


        InventoryGoodCategory::create([
            'name' => 'Jasa',
            'description' => 'Kategori Jasa.',
            'code_name' => 'PS'
        ]);

        InventoryGoodCategory::create([
            'name' => 'Internet',
            'description' => 'Kategori Internet.',
            'code_name' => 'CX'
        ]);


        InventoryGood::create([
            'good_category_id' => 1,
            'good_name' => 'RJ45',
            'code_name' => 'PK1',
            'merk' => 'AMP',
            'good_type' => 'Baru',
            'description' => 'RJ45 Kualitas Terbaik.',
        ]);

        InventoryGood::create([
            'good_category_id' => 1,
            'good_name' => 'Mikrotik',
            'code_name' => 'PK2',
            'merk' => 'Latvia',
            'good_type' => 'Baru',
            'description' => 'Mikrotik Tercanggih.',
        ]);

        InventoryGood::create([
            'good_category_id' => 1,
            'good_name' => 'Radio',
            'code_name' => 'PK3',
            'merk' => 'Sony',
            'good_type' => 'Baru',
            'description' => 'Radio Yang Memiliki Radius 10 KM.',
        ]);

        InventoryGood::create([
            'good_category_id' => 2,
            'good_name' => 'Pasang Jaringan',
            'code_name' => 'PS1',
            'merk' => 'Intynet',
            'good_type' => 'Baru',
            'description' => 'Jaringan Anti Mati.',
        ]);

        InventoryGood::create([
            'good_category_id' => 2,
            'good_name' => 'Pasang Wifi',
            'code_name' => 'PS2',
            'merk' => 'Intynet',
            'good_type' => 'Baru',
            'description' => 'Wifi 100 GB/s.',
        ]);

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
    }
}
