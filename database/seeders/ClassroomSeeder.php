<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Classroom;
class ClassroomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $c1 = new Classroom();
        $c1->name_classroom = "690-A Aula biologia";
        $c1->total_students = 75;
        $c1->edifice = "Edificio academico 2";
        $c1->floor = "planta baja";
        $c1->save();

        $c2 = new Classroom();
        $c2->name_classroom = "690-B Aula comun";
        $c2->total_students = 75;
        $c2->edifice = "Edificio academico 2";
        $c2->floor = "planta baja";
        $c2->save();

        $c3 = new Classroom();
        $c3->name_classroom = "690-C Aula comun";
        $c3->total_students = 65;
        $c3->edifice = "Edificio academico 2";
        $c3->floor = "planta baja";
        $c3->save();

        $c4 = new Classroom();
        $c4->name_classroom = "690-D Aula comun";
        $c4->total_students = 75;
        $c4->edifice = "Edificio academico 2";
        $c4->floor = "planta baja";
        $c4->save();

        $c5 = new Classroom();
        $c5->name_classroom = "690-E Aula comun";
        $c5->total_students = 30;
        $c5->edifice = "Edificio academico 2";
        $c5->floor = "planta baja";
        $c5->save();

        $c6 = new Classroom();
        $c6->name_classroom = "690-Mat Aula comun";
        $c6->total_students = 30;
        $c6->edifice = "Edificio academico 2";
        $c6->floor = "planta baja";
        $c6->save();
    }
}
