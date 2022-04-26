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
        $intro->name_subject = "1, Introduccion a la programacion";
        $intro->save();

        $elem = new Subject();
        $elem->name_subject = "Elementos de programacion";
        // $elem->group = "1";
        $elem->save();

        $arq = new Subject();
        $arq->name_subject = "Arquitectura de software";
        // $arq->group = "1";
        $arq->save();

        $fis = new Subject();
        $fis->name_subject = "Fisica general";
        // $fis->group = "1";
        $fis->save();

    }
}
