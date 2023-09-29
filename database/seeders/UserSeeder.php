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
            // request
            'HC:view-all-request',
            'HC:change-all-status-request',

            // attendance
            'HC:view-attendance',
            'HC:edit-delete-attendance',

            // employee
            'HC:view-employee',
            'HC:update-profile',

            // setting
            'HC:setting'
        ]);

        $sofyan = User::create([
            'name' => 'Sofyan',
            'email' => 'sofyan@comtelindo.com',
            'password' => bcrypt('12345678'),
            'nip' => 0000,
            'sign_file' => 'sign-Super Admin.png',
            'department_id' => 2,
            'division_id' => 5,
            'team_id' => 1,
        ]);
        $sofyan->assignRole('staff');
        $sofyan->givePermissionTo([
            // request
            'HC:view-all-request',
            'HC:change-all-status-request',

            // attendance
            'HC:view-attendance',
            'HC:edit-delete-attendance',

            // employee
            'HC:view-employee',
            'HC:update-profile',

            // setting
            'HC:setting'
        ]);

        $alan = User::create([
            'name' => 'alan',
            'email' => 'alan@comtelindo.com',
            'password' => bcrypt('12345678'),
            'nip' => 0000,
            'sign_file' => 'sign-Super Admin.png',
            'department_id' => 2,
            'division_id' => 5,
            'team_id' => 1,
        ]);
        $alan->assignRole('staff');
        $alan->givePermissionTo([
            // request
            'HC:view-all-request',
            'HC:change-all-status-request',

            // attendance
            'HC:view-attendance',
            'HC:edit-delete-attendance',

            // employee
            'HC:view-employee',
            'HC:update-profile',

            // setting
            'HC:setting'
        ]);

        $hengki = User::create([
            'name' => 'Hengki',
            'email' => 'hengki@comtelindo.com',
            'password' => bcrypt('12345678'),
            'nip' => 0000,
            'sign_file' => 'sign-Super Admin.png',
            'department_id' => 2,
            'division_id' => 5,
            'team_id' => 1,
        ]);
        $hengki->assignRole('staff');
        $hengki->givePermissionTo([
            // request
            'HC:view-all-request',
            'HC:change-all-status-request',

            // attendance
            'HC:view-attendance',
            'HC:edit-delete-attendance',

            // employee
            'HC:view-employee',
            'HC:update-profile',

            // setting
            'HC:setting'
        ]);

        $owen = User::create([
            'name' => 'Owen',
            'email' => 'owen@comtelindo.com',
            'password' => bcrypt('12345678'),
            'nip' => 0000,
            'sign_file' => 'sign-Super Admin.png',
            'department_id' => 2,
            'division_id' => 5,
            'team_id' => 1,
        ]);
        $owen->assignRole('staff');
        $owen->givePermissionTo([
            // request
            'HC:view-all-request',
            'HC:change-all-status-request',

            // attendance
            'HC:view-attendance',
            'HC:edit-delete-attendance',

            // employee
            'HC:view-employee',
            'HC:update-profile',

            // setting
            'HC:setting'
        ]);

        $rizka = User::create([
            'name' => 'Rizka',
            'email' => 'rizka@comtelindo.com',
            'password' => bcrypt('12345678'),
            'nip' => 0000,
            'sign_file' => 'sign-Super Admin.png',
            'department_id' => 2,
            'division_id' => 5,
            'team_id' => 1,
        ]);
        $rizka->assignRole('spv');
        $rizka->givePermissionTo([
            // request
            'HC:view-all-request',
            'HC:change-all-status-request',

            // attendance
            'HC:view-attendance',
            'HC:edit-delete-attendance',

            // employee
            'HC:view-employee',
            'HC:update-profile',

            // setting
            'HC:setting'
        ]);

        $terano = User::create([
            'name' => 'Terano',
            'email' => 'terano@comtelindo.com',
            'password' => bcrypt('12345678'),
            'nip' => 0000,
            'sign_file' => 'sign-Super Admin.png',
            'department_id' => 2,
            'division_id' => 5,
            'team_id' => 1,
        ]);
        $terano->assignRole('staff');
        $terano->givePermissionTo([
            // request
            'HC:view-all-request',
            'HC:change-all-status-request',

            // attendance
            'HC:view-attendance',
            'HC:edit-delete-attendance',

            // employee
            'HC:view-employee',
            'HC:update-profile',

            // setting
            'HC:setting'
        ]);

        $kevin = User::create([
            'name' => 'Kevin',
            'email' => 'kevin@comtelindo.com',
            'password' => bcrypt('12345678'),
            'nip' => 0000,
            'sign_file' => 'sign-Super Admin.png',
            'department_id' => 2,
            'division_id' => 5,
            'team_id' => 1,
        ]);
        $kevin->assignRole('staff');
        $kevin->givePermissionTo([
            // request
            'HC:view-all-request',
            'HC:change-all-status-request',

            // attendance
            'HC:view-attendance',
            'HC:edit-delete-attendance',

            // employee
            'HC:view-employee',
            'HC:update-profile',

            // setting
            'HC:setting'
        ]);

        $yadi = User::create([
            'name' => 'yadi',
            'email' => 'yadi@comtelindo.com',
            'password' => bcrypt('12345678'),
            'nip' => 0000,
            'sign_file' => 'sign-Super Admin.png',
            'department_id' => 2,
            'division_id' => 5,
            'team_id' => 1,
        ]);
        $yadi->assignRole('staff');
        $yadi->givePermissionTo([
            // request
            'HC:view-all-request',
            'HC:change-all-status-request',

            // attendance
            'HC:view-attendance',
            'HC:edit-delete-attendance',

            // employee
            'HC:view-employee',
            'HC:update-profile',

            // setting
            'HC:setting'
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
