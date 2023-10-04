<?php

namespace Database\Seeders;

use App\Models\Assignment\Assignment;
use App\Models\Assignment\UserAssignment;
use Illuminate\Database\Seeder;

class AssignmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        collect([
            [1, '2023-10-01', '2023-10-05', false, 'Projek Pinjem Seratus', 'Comtelindo Balikpapan', 0.0, 0.0, 'Agar Silahturami Tidak terputus', '10:00', '19:00'],
            [2, '2023-10-08', '2023-10-12', true, 'Projek Kembalikan Pinjaman', 'Comtelindo Jakarta', 0.0, 0.0, 'Menyelesaikan tugas', '08:00', '17:00'],
            [3, '2023-10-15', '2023-10-19', false, 'Projek Pengembangan Sistem', 'Comtelindo Surabaya', 0.0, 0.0, 'Meningkatkan efisiensi sistem', '09:00', '18:00'],
        ])->map(function ($data) {
            Assignment::create([
                "number" => uniqid() . "/CMT-WO/OPS/VIII/2023",
                "user_id" => $data[0],
                "start_date" => $data[1],
                "end_date" => $data[2],
                "override_holiday" => $data[3],
                "name" => $data[4],
                "location" => $data[5],
                "latitude" => $data[6],
                "longitude" => $data[7],
                "purpose" => $data[8],
                "working_start" => $data[9],
                "working_end" => $data[10],
            ]);
        });

        collect([
            [1, 2, null, null, null],
            [1, null, 'Arief', 'Manager', '1234567890'],
            [1, 3, null, null, null],
            [2, 1, null, null, null],
            [2, null, 'Budi', 'Programmer', '0987654321'],
            [2, 3, null, null, null],
            [3, 1, null, null, null],
            [3, null, 'Budi', 'BoD', '0987654321'],
            [3, 3, null, null, null],
        ])->map(function ($data) {
            UserAssignment::create([
                "assignment_id" => $data[0],
                "user_id" => $data[1],
                "name" => $data[2],
                "position" => $data[3],
                "nik" => $data[4],
            ]);
        });
    }
}
