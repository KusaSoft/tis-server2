<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Classroom;
use Illuminate\Support\Facades\DB;
class ClassroomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        // $data = [
        //     [
        //         'name_classroom' => '690A',
        //         'total_students' => '120',
        //         'building' => 'Edificio Nuevo',
        //         'floor' => 'Planta baja'
        //     ],
        //     [

        //     ]
        // ];
        // DB::table('users')->insert($data);

        $c1 = new Classroom();
        $c1->name_classroom = "690A";
        $c1->total_students = 30;
        $c1->save();
        
        $c2 = new Classroom();
        $c2->name_classroom = "690B";
        $c2->total_students = 40;
        $c2->save();
        
        $c3 = new Classroom();
        $c3->name_classroom = "690C";
        $c3->total_students = 35;
        $c3->save();
        
        $c4 = new Classroom();
        $c4->name_classroom = "691A";
        $c4->total_students = 120;
        $c4->save();
        
        $c5 = new Classroom();
        $c5->name_classroom = "691B";
        $c5->total_students = 130;
        $c5->save();
        
        $c6 = new Classroom();
        $c6->name_classroom = "691C";
        $c6->total_students = 120;
        $c6->save();
        
        $c7 = new Classroom();
        $c7->name_classroom = "691D";
        $c7->total_students = 100;
        $c7->save();
        
        $c8 = new Classroom();
        $c8->name_classroom = "691E";
        $c8->total_students = 60;
        $c8->save();
    }
}
