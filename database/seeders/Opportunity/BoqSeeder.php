<?php

namespace Database\Seeders\Opportunity;

use App\Models\Opportunity\BoQ\ItemableBillOfQuantity;
use Illuminate\Database\Seeder;

class BoqSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $boq = collect([
            [
                "prospect_id" => 1,
                "gpm" => 200000,
                "modal" => 100000,
                "npm" => 100000,
                "percentage" => abs(100000/2000000 * 100),
                "is_draft" => 0,
                "is_done" => 1,
                "is_final" => 1,
                "approval_manager_sales" => 1,
                "approval_manager_sales_date" => now(),
                "approval_manager_operation" => 1,
                "approval_manager_operation_date" => now(),
                "approval_director" => 1,
                "approval_director_date" => now(),
                "approval_finman" => 1,
                "approval_finman_date" => now(),
            ]
        ])->map(function($item) {
            return ItemableBillOfQuantity::create($item);
        });

        $boqItem = collect([
            [
                "inventory_good_id" => 1,
                "quantity" => 1,
                "unit" => "PCS",
                "purchase_price" => 100000,
                "total_price" => 100000,
                "markup_price" => 200000
            ]
        ])->map(function($item) use($boq) {
            return $boq[0]->itemable()->create($item);
        });
    }
}
