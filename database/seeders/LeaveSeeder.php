<?php

namespace Database\Seeders;

use App\Models\Leave\LeaveQuota;
use App\Models\Leave\LeaveRequestCategory;
use Illuminate\Database\Seeder;

class LeaveSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        LeaveQuota::create([
            "quotas" => 12,
            "min_works" => 12,
            "expired" => 18,
        ]);

        collect([
            [
                "name" => "Sakit",
                "code" => "SKT",
                "effective_date" => "2023-09-19",
                "attachment" => 1,
                "show_in_request" => 1,
                "max_request" => null,
                "use_quota" => 0,
                "min_notice" => 0,
                "unlimited_balance" => 1,
                "min_works" => 0,
                "balance" => null,
                "balance_type" => "Anniversary",
                "expired" => 0,
                "carry_amount" => null,
                "carry_expired" => null,
                "half_day" => 0,
                "minus_amount" => null,
                "duration" => null,
            ],
            [
                "name" => "Ijin Telat",
                "code" => "TLT",
                "effective_date" => "2023-09-18",
                "attachment" => 0,
                "show_in_request" => 1,
                "max_request" => null,
                "use_quota" => 0,
                "min_notice" => 0,
                "unlimited_balance" => 1,
                "min_works" => 0,
                "balance" => null,
                "balance_type" => "Anniversary",
                "expired" => 0,
                "carry_amount" => null,
                "carry_expired" => null,
                "half_day" => 1,
                "minus_amount" => null,
                "duration" => null,
            ],
            [
                "name" => "Pakai Kuota",
                "code" => "PK",
                "effective_date" => "2023-09-18",
                "attachment" => 1,
                "show_in_request" => 1,
                "max_request" => null,
                "use_quota" => 1,
                "min_notice" => 0,
                "unlimited_balance" => 0,
                "min_works" => 12,
                "balance" => 12,
                "balance_type" => "Anniversary",
                "expired" => 0,
                "carry_amount" => null,
                "carry_expired" => null,
                "half_day" => 0,
                "minus_amount" => null,
                "duration" => null,
            ],
            [
                "name" => "Pakai Durasi",
                "code" => "PD",
                "effective_date" => "2023-09-19",
                "attachment" => 0,
                "show_in_request" => 1,
                "max_request" => null,
                "use_quota" => 0,
                "min_notice" => 0,
                "unlimited_balance" => 0,
                "min_works" => 12,
                "balance" => 40,
                "balance_type" => "Monthly",
                "expired" => 0,
                "carry_amount" => null,
                "carry_expired" => null,
                "half_day" => 0,
                "minus_amount" => 2,
                "duration" => 15,
            ],
            [
                "name" => "Pakai Minus",
                "code" => "PM",
                "effective_date" => "2023-09-18",
                "attachment" => 0,
                "show_in_request" => 1,
                "max_request" => null,
                "use_quota" => 1,
                "min_notice" => 0,
                "unlimited_balance" => 1,
                "min_works" => 0,
                "balance" => null,
                "balance_type" => "Anniversary",
                "expired" => 0,
                "carry_amount" => null,
                "carry_expired" => null,
                "half_day" => 0,
                "minus_amount" => 2,
                "duration" => 17,
            ]
        ])->map(function ($data) {
            LeaveRequestCategory::create($data);
        });
    }
}
