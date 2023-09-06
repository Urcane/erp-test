<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $superadmin = User::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@gmail.com',
            'password' => bcrypt('12345678'),
            'nip' => 0000,
            'sign_file' => 'sign-Super Admin.png',
            'department_id' => 2,
            'division_id' => 5,
            'team_id' => 1,
        ]);
        $superadmin->assignRole('administrator');
        $superadmin->givePermissionTo([
            'HC:view-all-request',
            'HC:change-all-status-request',
            'HC:view-attendance',
            'HC:edit-delete-attendance',
            'HC:export-attendance'
        ]);

        $cmrAdminProject = ['Nisa Fajrin Alfalah', 'Bagus Hariyadi'];
        $cmrAdminProjectEmail = ['nisa@comtelindo.com', 'agushaha@live.co.uk'];
        for ($i = 0; $i < count($cmrAdminProject); $i++) {
            $createcmrAdminProject = User::create([
                'name' => $cmrAdminProject[$i],
                'email' => $cmrAdminProjectEmail[$i],
                'password' => bcrypt('12345678'),
                'nip' => 0000,
                'sign_file' => 'sign-' . $cmrAdminProject[$i] . '.png',
                'department_id' => 1,
                'division_id' => 3,
                'team_id' => 1,
            ]);
            $createcmrAdminProject->assignRole('staff');
        }

        $cmrAccountManager = ['Rizky Rahmadani', 'Aden Agyandi'];
        $cmrAccountManagerEmail = ['rizky@comtelindo.com', 'aden@comtelindo.com'];
        for ($i = 0; $i < count($cmrAccountManager); $i++) {
            $createcmrAccountManager = User::create([
                'name' => $cmrAccountManager[$i],
                'email' => $cmrAccountManagerEmail[$i],
                'password' => bcrypt('12345678'),
                'nip' => 0000,
                'sign_file' => 'sign-' . $cmrAccountManager[$i] . '.png',
                'department_id' => 1,
                'division_id' => 2,
                'team_id' => 1,
            ]);
            $createcmrAccountManager->assignRole('staff');
        }

        $createcmrManager = User::create([
            'name' => 'Fajar Aulia Rahmatullah',
            'email' => 'fajar@comtelindo.com',
            'password' => bcrypt('12345678'),
            'nip' => 0000,
            'sign_file' => 'sign-Fajar Aulia Rahmatullah.png',
            'department_id' => 1,
            'division_id' => 1,
            'team_id' => 1,
        ]);
        $createcmrManager->assignRole('manager');

        // for ($i = 0; $i < 1000; $i++) {
        //     User::create([
        //         'name' => $this->_generateRandomString(15),
        //         'email' => $this->_generateRandomString(15) . '@comtelindo.com',
        //         'password' => bcrypt('12345678'),
        //         'nip' => 0000,
        //         'sign_file' => 'sign-Fajar Aulia Rahmatullah.png',
        //         'department_id' => 1,
        //         'division_id' => 1,
        //         'team_id' => 1,
        //     ]);
        // }
    }

    // private function _generateRandomString($length = 10) {
    //     $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    //     $charactersLength = strlen($characters);
    //     $randomString = '';

    //     for ($i = 0; $i < $length; $i++) {
    //         $randomString .= $characters[rand(0, $charactersLength - 1)];
    //     }

    //     return $randomString;
    // }
}
