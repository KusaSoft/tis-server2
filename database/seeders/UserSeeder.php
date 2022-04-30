<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
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
        $data = [
            [
                'role_id' => '1',
                'name' => 'Leticia Blanco',
                'password' => '12345',
                'email' => 'leticia@gmail.com'
            ],
            [
                'role_id' => '1',
                'name' => 'Corina Flores',
                'password' => '12345',
                'email' => 'corina@gmail.com'
            ],
            [
                'role_id' => '2',
                'name' => 'Juan Zarate',
                'password' => '12345',
                'email' => 'juan@gmail.com'
            ],
            [
                'role_id' => '3',
                'name' => 'Alfredo Guzman',
                'password' => '12345',
                'email' => 'alfredo@gmail.com'
            ],
            [
                'role_id' => '1',
                'name' => 'Carla Salazar    ',
                'password' => '12345',
                'email' => 'carla@gmail.com'
            ]

        ];
        DB::table('users')->insert($data);
    }
}
