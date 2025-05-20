<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $userData = [
            [
                'name' => 'Maxy Academy',
                'email' => 'admin@gmail.com',
                'role' => 'company relationship',
                'password' => bcrypt('valid123')
            ],

            [
                'name' => 'PT. Linkdataku Solusi Indonesia',
                'email' => 'admin123@gmail.com',
                'role' => 'company relationship',
                'password' => bcrypt('password123')
            ],

            [
                'name' => 'Triputra Group',
                'email' => 'triputra@gmail.com',
                'role' => 'perusahaan',
                'password' => bcrypt('123123')
            ],

            [
                'name' => 'Isaac Munandar',
                'email' => 'mentor@gmail.com',
                'role' => 'mentor',
                'password' => bcrypt('123123')
            ],

            [
                'name' => 'Putri Indira',
                'email' => 'putri@gmail.com',
                'role' => 'maxians',
                'password' => bcrypt('123123')
            ]
        ];

        foreach ($userData as $key => $val) {
            User::create($val);
        }
    }
}
