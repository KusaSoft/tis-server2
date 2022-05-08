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
        $intro->name_subject = "Introduccion a la programación";
        $intro->save();

        $elem = new Subject();
        $elem->name_subject = "Elementos de Programación Y Estructura De Datos"; 
        $elem->save();

        $metodos = new Subject();
        $metodos->name_subject = "Metodos Y Tecnicas De Programación "; 
        $metodos->save();

        $inter = new Subject();
        $inter->name_subject = "Interacción Humano Computador"; 
        $inter->save();

        $tall = new Subject();
        $tall->name_subject = "Taller De Ingeniería De Software"; 
        $tall->save();

        $talle = new Subject();
        $talle->name_subject = "Taller De Grado I"; 
        $talle->save();

        $sist = new Subject();
        $sist->name_subject = "Sistemas De Información I"; 
        $sist->save();

        $sistem = new Subject();
        $sistem->name_subject = "Sistemas De Información II"; 
        $sistem->save();

        $inge = new Subject();
        $inge->name_subject = "Ingeniería De Software"; 
        $inge->save();

        $algor = new Subject();
        $algor->name_subject = "Algoritmos Avanzados"; 
        $algor->save();

        $arqui = new Subject();
        $arqui->name_subject = "Arquitectura De Computadoras I"; 
        $arqui->save();

    }
}
