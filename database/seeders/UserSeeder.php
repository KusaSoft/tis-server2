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
                'enabled' => true,
                'email' => 'leticia@gmail.com'
            ],
            [
                'role_id' => '1',
                'name' => 'Corina Flores',
                'password' => '12345',
                'enabled' => true,
                'email' => 'corina@gmail.com'
            ],
            [
                'role_id' => '2',
                'name' => 'Juan Zarate',
                'password' => '12345',
                'enabled' => true,
                'email' => 'juan@gmail.com'
            ],
            [
                'role_id' => '3',
                'name' => 'Alfredo Guzman',
                'password' => '12345',
                'enabled' => true,
                'email' => 'alfredo@gmail.com'
            ],
            [
                'role_id' => '1',
                'name' => 'Salazar Serrudo Carla',
                'password' => '12345',
                'enabled' => false,
                'email' => 'carla@gmail.com'
            ],
            [
                'role_id' => '1',
                'name' => 'MontaÃ±o Quiroga Victor Hugo',
                'password' => '189273g',
                'enabled' => true,
                'email' => 'victor@gmail.com'
            ],
            [
                'role_id' => '1',
                'name' => 'Ustariz Vargas Hernan',
                'password' => '1ugd64o',
                'enabled' => true,
                'email' => 'ustariz@gmail.com'
            ],
            [
                'role_id' => '1',
                'name' => 'Costas Jauregui Vladimir Abel',
                'password' => '18het49',
                'enabled' => true,
                'email' => 'vladimir@gmial.com'
            ],
            [
                'role_id' => '1',
                'name' => 'Manzur Soria Carlos',
                'password' => '1298rwq',
                'enabled' => true,
                'email' => 'manzur@gmail.com'
            ],
            [
                'role_id' => '1',
                'name' => 'Villaroel Tapia Henrry Frank',
                'password' => '18gs763',
                'enabled' => true,
                'email' => 'villaroel@gmail.com'
            ],
            [
                'role_id' => '1',
                'name' => 'Torrico Bascope Rosemary',
                'password' => '12879d7',
                'enabled' => true,
                'email' => 'rosemary@gmail.com'
            ],
            [
                'role_id' => '1',
                'name' => 'Fernado Guzman Helder Octavio',
                'password' => '16728ey',
                'enabled' => true,
                'email' => 'helder@gmail.com'
            ],
            [
                'role_id' => '1',
                'name' => 'Montoya Burgos Yony Richard',
                'password' => '172dhis9',
                'enabled' => true,
                'email' => 'montoya@gmail.com'
            ],
            [
                'role_id' => '1',
                'name' => 'Villaroel Novillo Jimmy',
                'password' => 'u83bg61',
                'enabled' => true,
                'email' => 'jimmy@gmail.com'
            ],
            [
                'role_id' => '1',
                'name' => 'Escalera Fernado David ',
                'password' => '92yt36s1',
                'enabled' => true,
                'email' => 'fernando@gmail.com'
            ],
            [
                'role_id' => '1',
                'name' => 'Rodriguez Bilboa Ericka Patricia ',
                'password' => '936yhe6',
                'enabled' => true,
                'email' => 'rodriguez@gmail.com'
            ],
            [
                'role_id' => '1',
                'name' => 'Camacho del Castillo Indira',
                'password' => '9u37e1q',
                'enabled' => true,
                'email' => 'indira@gmail.com'
            ],
            [
                'role_id' => '1',
                'name' => 'Jaldin Rosales Rolando',
                'password' => '9273he7',
                'enabled' => true,
                'email' => 'jaldin@gmail.com'
            ],
            [
                'role_id' => '1',
                'name' => 'Flores Soliz Juan Marcelo',
                'password' => '9e3u84j1',
                'enabled' => true,
                'email' => 'flores@gmail.com'
            ],
            [
                'role_id' => '1',
                'name' => 'Acha Perez Samuel',
                'password' => '83h471w',
                'enabled' => true,
                'email' => 'acha_perez@gmai.com'
            ],
        ];
        DB::table('users')->insert($data);
    }
}
