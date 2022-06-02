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
        $intro->name_subject = "Introduccion a la programacion";
        $intro->save();

        $elem = new Subject();
        $elem->name_subject = "Elementos de Programacion Y Estructura De Datos"; 
        $elem->save();

        $metodos = new Subject();
        $metodos->name_subject = "Metodos Y Tecnicas De Programacion"; 
        $metodos->save();

        $inter = new Subject();
        $inter->name_subject = "Interaccion Humano Computador"; 
        $inter->save();

        $tall = new Subject();
        $tall->name_subject = "Taller de Ingenieria de Software"; 
        $tall->save();

        $talle = new Subject();
        $talle->name_subject = "Taller De Grado I"; 
        $talle->save();

        $sist = new Subject();
        $sist->name_subject = "Sistemas De Informacion I"; 
        $sist->save();

        $sistem = new Subject();
        $sistem->name_subject = "Sistemas De Informacion II"; 
        $sistem->save();

        $inge = new Subject();
        $inge->name_subject = "Ingenieria De Software"; 
        $inge->save();

        $algor = new Subject();
        $algor->name_subject = "Algoritmos Avanzados"; 
        $algor->save();

        $arqui = new Subject();
        $arqui->name_subject = "Arquitectura De Computadoras I"; 
        $arqui->save();

    }
}
