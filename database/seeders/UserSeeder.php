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
                'name' => 'Blanco Coca Leticia',
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
                'name' => 'Salazar Serrudo Carla',
                'password' => '12345',
                'email' => 'carla@gmail.com'
            ],
            [
                'role_id' => '1',
                'name' => 'MontaÃ±o Quiroga Victor Hugo',
                'password' => '189273g',
                'email' => 'victor@gmail.com'
            ],
            [
                'role_id' => '1',
                'name' => 'Ustariz Vargas Hernan',
                'password' => '1ugd64o',
                'email' => 'ustariz@gmail.com'
            ],
            [
                'role_id' => '1',
                'name' => 'Costas Jauregui Vladimir Abel',
                'password' => '18het49',
                'email' => 'vladimir@gmial.com'
            ],
            [
                'role_id' => '1',
                'name' => 'Manzur Soria Carlos',
                'password' => '1298rwq',
                'email' => 'manzur@gmail.com'
            ],
            [
                'role_id' => '1',
                'name' => 'Villaroel Tapia Henrry Frank',
                'password' => '18gs763',
                'email' => 'villaroel@gmail.com'
            ],
            [
                'role_id' => '1',
                'name' => 'Torrico Bascope Rosemary',
                'password' => '12879d7',
                'email' => 'rosemary@gmail.com'
            ],
            [
                'role_id' => '1',
                'name' => 'Fernado Guzman Helder Octavio',
                'password' => '16728ey',
                'email' => 'helder@gmail.com'
            ],
            [
                'role_id' => '1',
                'name' => 'Montoya Burgos Yony Richard',
                'password' => '172dhis9',
                'email' => 'montoya@gmail.com'
            ],
            [
                'role_id' => '1',
                'name' => 'Villaroel Novillo Jimmy',
                'password' => 'u83bg61',
                'email' => 'jimmy@gmail.com'
            ],
            [
                'role_id' => '1',
                'name' => 'Escalera Fernado David ',
                'password' => '92yt36s1',
                'email' => 'fernando@gmail.com'
            ],
            [
                'role_id' => '1',
                'name' => 'Rodriguez Bilboa Ericka Patricia ',
                'password' => '936yhe6',
                'email' => 'rodriguez@gmail.com'
            ],
            [
                'role_id' => '1',
                'name' => 'Camacho del Castillo Indira',
                'password' => '9u37e1q',
                'email' => 'indira@gmail.com'
            ],
            [
                'role_id' => '1',
                'name' => 'Jaldin Rosales Rolando',
                'password' => '9273he7',
                'email' => 'jaldin@gmail.com'
            ],
            [
                'role_id' => '1',
                'name' => 'Flores Soliz Juan Marcelo',
                'password' => '9e3u84j1',
                'email' => 'flores@gmail.com'
            ],
            [
                'role_id' => '1',
                'name' => 'Acha Perez Samuel',
                'password' => '83h471w',
                'email' => 'acha_perez@gmai.com'
            ]
        ];
        DB::table('users')->insert($data);
    }
}
