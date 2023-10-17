<?php

namespace Database\Seeders\Opportunity;

use App\Models\Customer\Customer;
use App\Models\Customer\CustomerContact;
use App\Models\Customer\CustomerProspect;
use App\Models\Customer\CustomerProspectLog;
use Illuminate\Database\Seeder;

class LeapSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $customers = collect([
            [
                "user_id" => 1,
                "city_id" => 1,
                "lead_reference_id" => 1,
                "bussines_type_id" => 1,
                "customer_name" => "PT. Nusantara Abadi Jaya",
                "customer_address" => "Jln. Marsma Iswahyudi",
                "approval_manager" => 1,
            ]
        ])->map(function($item) {
            return Customer::create($item);
        });

        $contact = collect([
            [
                "customer_id" => $customers[0]->id,
                "customer_contact_name" => "-",
                "customer_contact_job" => "-",
                "customer_contact_phone" => "0"
            ]
        ])->map(function($item) {
            return CustomerContact::create($item);
        });

        $prospect = collect([
            [
                "customer_id" => $customers[0]->id,
                "prospect_title" => "Prospect Installasi CCTV dan Internet PT. NAJ",
            ]
        ])->map(function($item) {
            return CustomerProspect::create($item);
        });

        $prospectLogs = collect([
            [
                "customer_prospect_id" => $prospect[0]->id,
                "prospect_update" => "Pembukaan Prospect Awal",
                "prospect_next_action" => "Ketemuan dengan calon pelanggan",
                "next_action_plan_date" => now(),
            ],
            [
                "customer_prospect_id" => $prospect[0]->id,
                "prospect_update" => "Ketemuan",
                "prospect_next_action" => "Deal",
                "next_action_plan_date" => now(),
                "status" => 2,
            ],
        ])->map(function($item) use($customers) {
            $prospectLog = CustomerProspectLog::create($item);

            Customer::find($customers[0]->id)->update([
                "prospect_status" => 1,
                "status" => 2,
            ]);

            return $prospectLog;
        });
    }
}
