<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Subject;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $intro = new Subject();
        $intro->name_subject = "INTRODUCCION A LA PROGRAMACION";
        $intro->save();

        $elem = new Subject();
        $elem->name_subject = "ELEMENTOS DE PROGRAMACION Y ESTRUCTURA DE DATOS"; 
        $elem->save();

        $metodos = new Subject();
        $metodos->name_subject = "METODOS Y TECNICAS DE PROGRAMACION"; 
        $metodos->save();

        $inter = new Subject();
        $inter->name_subject = "INTERACCION HUMANO COMPUTADOR"; 
        $inter->save();

        $tall = new Subject();
        $tall->name_subject = "TALLER DE INGENIERIA DE SOFTWARE"; 
        $tall->save();

        $talle = new Subject();
        $talle->name_subject = "TALLER DE GRADO I"; 
        $talle->save();


        $sist = new Subject();
        $sist->name_subject = "SISTEMAS DE INFORMACION I"; 
        $sist->save();

        $sistem = new Subject();
        $sistem->name_subject = "SISTEMAS DE INFORMACION II"; 
        $sistem->save();

        $inge = new Subject();
        $inge->name_subject = "INGENIERIA DE SOFTWARE"; 
        $inge->save();

        $algor = new Subject();
        $algor->name_subject = "ALGORITMOS AVANZADOS"; 
        $algor->save();

        $arqui = new Subject();
        $arqui->name_subject = "ARQUITECTURA DE COMPUTADORAS I"; 
        $arqui->save();

    }
}
