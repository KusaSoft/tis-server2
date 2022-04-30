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
                "total_students" => "100",
                "register_date" => '2022-04-15 00:00:00',
                "reservation_date" => '2022-04-15',
                "request_reason" => 'Primer parcial de introduccion',
                "horario_ini" => "12:45",
                "horario_end" => "14:15",
                "state" => "sent",
                "group_list" => "1 2",
                "other_groups" => "3"
            ],
            [
                "user_id" => 1,
                "subject_id" => 2,
                "classroom_id" => 4,
                "total_students" => "40",
                "register_date" => '2022-05-18 00:00:00',
                "reservation_date" => '2022-05-18',
                "request_reason" => 'Examen de elementos',
                "horario_ini" => "15:45",
                "horario_end" => "17:15",
                "state" => "sent",
                "group_list" => "1",
                "other_groups" => ""
            ],
            [
                "user_id" => 1,
                "subject_id" => 1,
                "classroom_id" => 6,
                "total_students" => "52",
                "register_date" => '2022-04-04 00:00:00',
                "reservation_date" => '2022-04-04',
                "request_reason" => null,
                "horario_ini" => "09:25",
                "horario_end" => null,
                "state" => "draft",
                "group_list" => null,
                "other_groups"=>null
            ],
        ];
        DB::table('user_booking')->insert($data);
    }
}
