<?php

namespace Database\Seeders;

use App\Models\Attendance\GlobalDayOff;
use Illuminate\Database\Seeder;

class HolidaySeeder extends Seeder
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
                "name" => "Hari Tahun Baru",
                "start_date" => "2023-01-01",
                "end_date" => "2023-01-02"
            ],
            [
                "name" => "Tahun Baru Imlek",
                "start_date" => "2023-01-22",
                "end_date" => "2023-01-23"
            ],
            [
                "name" => "Cuti Bersama Tahun Baru Imlek",
                "start_date" => "2023-01-23",
                "end_date" => "2023-01-24"
            ],
            [
                "name" => "Isra Mikraj Nabi Muhammad",
                "start_date" => "2023-02-18",
                "end_date" => "2023-02-19"
            ],
            [
                "name" => "Hari Suci Nyepi (Tahun Baru Saka)",
                "start_date" => "2023-03-22",
                "end_date" => "2023-03-23"
            ],
            [
                "name" => "Cuti Bersama Hari Suci Nyepi (Tahun Baru Saka)",
                "start_date" => "2023-03-23",
                "end_date" => "2023-03-24"
            ],
            [
                "name" => "Wafat Isa Almasih",
                "start_date" => "2023-04-07",
                "end_date" => "2023-04-08"
            ],
            [
                "name" => "Cuti Bersama Idul Fitri",
                "start_date" => "2023-04-19",
                "end_date" => "2023-04-20"
            ],
            [
                "name" => "Cuti Bersama Idul Fitri",
                "start_date" => "2023-04-20",
                "end_date" => "2023-04-21"
            ],
            [
                "name" => "Cuti Bersama Idul Fitri",
                "start_date" => "2023-04-21",
                "end_date" => "2023-04-22"
            ],
            [
                "name" => "Hari Idul Fitri",
                "start_date" => "2023-04-22",
                "end_date" => "2023-04-23"
            ],
            [
                "name" => "Hari Idul Fitri",
                "start_date" => "2023-04-23",
                "end_date" => "2023-04-24"
            ],
            [
                "name" => "Cuti Bersama Idul Fitri",
                "start_date" => "2023-04-24",
                "end_date" => "2023-04-25"
            ],
            [
                "name" => "Cuti Bersama Idul Fitri",
                "start_date" => "2023-04-25",
                "end_date" => "2023-04-26"
            ],
            [
                "name" => "Hari Buruh Internasional / Pekerja",
                "start_date" => "2023-05-01",
                "end_date" => "2023-05-02"
            ],
            [
                "name" => "Kenaikan Isa Al Masih",
                "start_date" => "2023-05-18",
                "end_date" => "2023-05-19"
            ],
            [
                "name" => "Hari Lahir Pancasila",
                "start_date" => "2023-06-01",
                "end_date" => "2023-06-02"
            ],
            [
                "name" => "Cuti Bersama Waisak",
                "start_date" => "2023-06-02",
                "end_date" => "2023-06-03"
            ],
            [
                "name" => "Hari Raya Waisak",
                "start_date" => "2023-06-04",
                "end_date" => "2023-06-05"
            ],
            [
                "name" => "Idul Adha (Lebaran Haji)",
                "start_date" => "2023-06-29",
                "end_date" => "2023-06-30"
            ],
            [
                "name" => "Satu Muharam / Tahun Baru Hijriah",
                "start_date" => "2023-07-19",
                "end_date" => "2023-07-20"
            ],
            [
                "name" => "Hari Proklamasi Kemerdekaan R.I.",
                "start_date" => "2023-08-17",
                "end_date" => "2023-08-18"
            ],
            [
                "name" => "Maulid Nabi Muhammad",
                "start_date" => "2023-09-28",
                "end_date" => "2023-09-29"
            ],
            [
                "name" => "Hari Raya Natal",
                "start_date" => "2023-12-25",
                "end_date" => "2023-12-26"
            ],
            [
                "name" => "Cuti Bersama Natal (Hari Tinju)",
                "start_date" => "2023-12-26",
                "end_date" => "2023-12-27"
            ]
        ])->map(function ($data) {
            GlobalDayOff::create($data);
        });
    }
}
