<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\UserBooking;

class UserBookingSeeder extends Seeder
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
                "user_id" => 2,
                "subject_id" => 1,
                "classroom_id" => 3,
                "date" => '2022-04-15',
                "request_reason" => 'Primer parcial de introduccion',
                "horario_ini" => "12:45",
                "horario_fin" => "14:15",
                "state" => "sent",
                "group" => 3,
                "description" => '[{"name":"Vladimir","group_list":[4,2]},{"name":"Corina","group_list":[3]}]'
            ],
            [
                "user_id" => 1,
                "subject_id" => 2,
                "classroom_id" => 4,
                "date" => '2022-05-18',
                "request_reason" => 'Examen de elementos',
                "horario_ini" => "15:45",
                "horario_fin" => "17:15",
                "state" => "sent",
                "group" => 1,
                "description" => ''
            ],
            [
                "user_id" => 1,
                "subject_id" => 1,
                "classroom_id" => 6,
                "date" => '2022-04-04',
                "request_reason" => null,
                "horario_ini" => "09:25",
                "horario_fin" => null,
                "state" => "eraser",
                "group" => null,
                "description" => ''
            ],
        ];
        DB::table('user_booking')->insert($data);
    }
}
