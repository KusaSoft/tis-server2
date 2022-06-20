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
        $c1 = new Classroom();
        $c1->name_classroom = "690-A Aula biologia";
        $c1->total_students = 75;
        $c1->edifice = "Edificio academico 2";
        $c1->floor = "Planta baja";
        $c1->save();

        $c2 = new Classroom();
        $c2->name_classroom = "690-B Aula comun";
        $c2->total_students = 75;
        $c2->edifice = "Edificio academico 2";
        $c2->floor = "Planta baja";
        $c2->save();

        $c3 = new Classroom();
        $c3->name_classroom = "690-C Aula comun";
        $c3->total_students = 65;
        $c3->edifice = "Edificio academico 2";
        $c3->floor = "Planta baja";
        $c3->save();

        $c4 = new Classroom();
        $c4->name_classroom = "690-D Aula comun";
        $c4->total_students = 75;
        $c4->edifice = "Edificio academico 2";
        $c4->floor = "Planta baja";
        $c4->save();

        $c5 = new Classroom();
        $c5->name_classroom = "690-E Aula comun";
        $c5->total_students = 30;
        $c5->edifice = "Edificio academico 2";
        $c5->floor = "Planta baja";
        $c5->save();

        $c6 = new Classroom();
        $c6->name_classroom = "690-Mat Aula comun";
        $c6->total_students = 30;
        $c6->edifice = "Edificio academico 2";
        $c6->floor = "Planta baja";
        $c6->save();
        
        $c7 = new Classroom();
        $c7->name_classroom = "691-A Aula comun";
        $c7->total_students = 180;
        $c7->edifice = "Edificio academico 2";
        $c7->floor = "Primer piso";
        $c7->save();

        $c8 = new Classroom();
        $c8->name_classroom = "691-B Aula comun";
        $c8->total_students = 180;
        $c8->edifice = "Edificio academico 2";
        $c8->floor = "Primer piso";
        $c8->save();

        $c9 = new Classroom();
        $c9->name_classroom = "691-C Aula comun";
        $c9->total_students = 120;
        $c9->edifice = "Edificio academico 2";
        $c9->floor = "Primer piso";
        $c9->save();

        $c10 = new Classroom();
        $c10->name_classroom = "691-D Aula comun";
        $c10->total_students = 125;
        $c10->edifice = "Edificio academico 2";
        $c10->floor = "Primer piso";
        $c10->save();

        $c11 = new Classroom();
        $c11->name_classroom = "691-E Aula comun";
        $c11->total_students = 180;
        $c11->edifice = "Edificio academico 2";
        $c11->floor = "Primer piso";
        $c11->save();

        $c12 = new Classroom();
        $c12->name_classroom = "691-F Aula comun";
        $c12->total_students = 180;
        $c12->edifice = "Edificio academico 2";
        $c12->floor = "Primer piso";
        $c12->save();

        $c13 = new Classroom();
        $c13->name_classroom = "692-A Aula comun";
        $c13->total_students = 180;
        $c13->edifice = "Edificio academico 2";
        $c13->floor = "Segundo piso";
        $c13->save();

        $c14 = new Classroom();
        $c14->name_classroom = "692-B Aula comun";
        $c14->total_students = 180;
        $c14->edifice = "Edificio academico 2";
        $c14->floor = "Segundo piso";
        $c14->save();

        $c15 = new Classroom();
        $c15->name_classroom = "692-C Aula comun";
        $c15->total_students = 125;
        $c15->edifice = "Edificio academico 2";
        $c15->floor = "Segundo piso";
        $c15->save();

        $c16 = new Classroom();
        $c16->name_classroom = "692-D Aula comun";
        $c16->total_students = 125;
        $c16->edifice = "Edificio academico 2";
        $c16->floor = "Segundo piso";
        $c16->save();

        $c17 = new Classroom();
        $c17->name_classroom = "692-E Aula comun";
        $c17->total_students = 180;
        $c17->edifice = "Edificio academico 2";
        $c17->floor = "Segundo piso";
        $c17->save();

        $c18 = new Classroom();
        $c18->name_classroom = "692-F Aula comun";
        $c18->total_students = 180;
        $c18->edifice = "Edificio academico 2";
        $c18->floor = "Segundo piso";
        $c18->save();

        $c19 = new Classroom();
        $c19->name_classroom = "692-G Aula comun";
        $c19->total_students = 80;
        $c19->edifice = "Edificio academico 2";
        $c19->floor = "Segundo piso";
        $c19->save();

        $c20 = new Classroom();
        $c20->name_classroom = "692-H Aula comun";
        $c20->total_students = 80;
        $c20->edifice = "Edificio academico 2";
        $c20->floor = "Segundo piso";
        $c20->save();
        
        $c21 = new Classroom();
        $c21->name_classroom = "693-A Aula comun";
        $c21->total_students = 160;
        $c21->edifice = "Edificio academico 2";
        $c21->floor = "Tercer piso";
        $c21->save();
                
        $c22 = new Classroom();
        $c22->name_classroom = "693-B Aula comun";
        $c22->total_students = 160;
        $c22->edifice = "Edificio academico 2";
        $c22->floor = "Tercer piso";
        $c22->save();

        $c23 = new Classroom();
        $c23->name_classroom = "693-C Aula comun";
        $c23->total_students = 125;
        $c23->edifice = "Edificio academico 2";
        $c23->floor = "Tercer piso";
        $c23->save();
            
        $c24 = new Classroom();
        $c24->name_classroom = "693-D Aula comun";
        $c24->total_students = 125;
        $c24->edifice = "Edificio academico 2";
        $c24->floor = "Tercer piso";
        $c24->save();

        $c25 = new Classroom();
        $c25->name_classroom = "Auditorio Academico II";
        $c25->total_students = 450;
        $c25->edifice = "Edificio academico 2";
        $c25->floor = "Tercer piso";
        $c25->save();

        $c26 = new Classroom();
        $c26->name_classroom = "660 Aula comun";
        $c26->total_students = 90;
        $c26->edifice = "Bloque trencito";
        $c26->floor = "Planta baja";
        $c26->save();

        $c27 = new Classroom();
        $c27->name_classroom = "661 Aula comun";
        $c27->total_students = 90;
        $c27->edifice = "Bloque trencito";
        $c27->floor = "Planta baja";
        $c27->save();

        $c28 = new Classroom();
        $c28->name_classroom = "Laboratorio de computo 1";
        $c28->total_students = 40;
        $c28->edifice = "Departamento Inf-Sis";
        $c28->floor = "Aulas INFLAB";
        $c28->save();
        
        $c29 = new Classroom();
        $c29->name_classroom = "Laboratorio de computo 2";
        $c29->total_students = 30;
        $c29->edifice = "Departamento Inf-Sis";
        $c29->floor = "Aulas INFLAB";
        $c29->save();

        $c30 = new Classroom();
        $c30->name_classroom = "Laboratorio de redes";
        $c30->total_students = 15;
        $c30->edifice = "Departamento Inf-Sis";
        $c30->floor = "Aulas INFLAB";
        $c30->save();
        
        $c31 = new Classroom();
        $c31->name_classroom = "Laboratorio de desarrollo";
        $c31->total_students = 15;
        $c31->edifice = "Departamento Inf-Sis";
        $c31->floor = "Aulas INFLAB";
        $c31->save();

        $c32 = new Classroom();
        $c32->name_classroom = "Laboratorio de mantenimiento";
        $c32->total_students = 15;
        $c32->edifice = "Departamento Inf-Sis";
        $c32->floor = "Aulas INFLAB";
        $c32->save();

        $c33 = new Classroom();
        $c33->name_classroom = "Laboratorio de computo 3";
        $c33->total_students = 30;
        $c33->edifice = "Departamento Inf-Sis";
        $c33->floor = "Edificio MEMI";
        $c33->save();
        
        $c34 = new Classroom();
        $c34->name_classroom = "Laboratorio de virtualizacion (Labo 4)";
        $c34->total_students = 30;
        $c34->edifice = "Departamento Inf-Sis";
        $c34->floor = "Edificio MEMI";
        $c34->save();
        
        $c35 = new Classroom();
        $c35->name_classroom = "Auditorio de uso multiple";
        $c35->total_students = 50;
        $c35->edifice = "Departamento Inf-Sis";
        $c35->floor = "Edificio MEMI";
        $c35->save();

        $c36 = new Classroom();
        $c36->name_classroom = "667-A Aula Lab elektro 1";
        $c36->total_students = 60;
        $c36->edifice = "Edificio Elektro";
        $c36->floor = "Planta baja";
        $c36->save();

        $c37 = new Classroom();
        $c37->name_classroom = "667-B Aula Lab elektro 2";
        $c37->total_students = 60;
        $c37->edifice = "Edificio Elektro";
        $c37->floor = "Planta baja";
        $c37->save();

        $c38 = new Classroom();
        $c38->name_classroom = "668  Aula Lab elektro 3";
        $c38->total_students = 75;
        $c38->edifice = "Edificio Elektro";
        $c38->floor = "Planta baja";
        $c38->save();

        $c39 = new Classroom();
        $c39->name_classroom = "668-A Aula Lab elektro 4";
        $c39->total_students = 75;
        $c39->edifice = "Edificio Elektro";
        $c39->floor = "Primer piso";
        $c39->save();

        $c40 = new Classroom();
        $c40->name_classroom = "669-B Aula Lab elektro 5";
        $c40->total_students = 75;
        $c40->edifice = "Edificio Elektro";
        $c40->floor = "Primer piso";
        $c40->save();

        $c41 = new Classroom();
        $c41->name_classroom = "670   Aula Lab elektro 6";
        $c41->total_students = 75;
        $c41->edifice = "Edificio Elektro";
        $c41->floor = "Primer piso";
        $c41->save();

        $c42 = new Classroom();
        $c42->name_classroom = "671   Aula Lab elektro 7";
        $c42->total_students = 60;
        $c42->edifice = "Edificio Elektro";
        $c42->floor = "Segundo piso";
        $c42->save();

        $c43 = new Classroom();
        $c43->name_classroom = "671-A Aula Lab elektro 8";
        $c43->total_students = 60;
        $c43->edifice = "Edificio Elektro";
        $c43->floor = "Segundo piso";
        $c43->save();

        $c44 = new Classroom();
        $c44->name_classroom = "671-B Aula proyectos";
        $c44->total_students = 40;
        $c44->edifice = "Edificio Elektro";
        $c44->floor = "Segundo piso";
        $c44->save();

        $c45 = new Classroom();
        $c45->name_classroom = "671-C Aula Lab elektro 10";
        $c45->total_students = 40;
        $c45->edifice = "Edificio Elektro";
        $c45->floor = "Segundo piso";
        $c45->save();

        $c46 = new Classroom();
        $c46->name_classroom = "672   Aula Lab elektro 11";
        $c46->total_students = 40;
        $c46->edifice = "Edificio Elektro";
        $c46->floor = "Segundo piso";
        $c46->save();

        $c47 = new Classroom();
        $c47->name_classroom = "674-A Aula Telecom";
        $c47->total_students = 30;
        $c47->edifice = "Edificio Elektro";
        $c47->floor = "Tercer piso";
        $c47->save();

        $c48 = new Classroom();
        $c48->name_classroom = "674-B Aula control";
        $c48->total_students = 30;
        $c48->edifice = "Edificio Elektro";
        $c48->floor = "Tercer piso";
        $c48->save();

        $c49 = new Classroom();
        $c49->name_classroom = "675   Sala de tesistas";
        $c49->total_students = 40;
        $c49->edifice = "Edificio Elektro";
        $c49->floor = "Tercer piso";
        $c49->save();

        $c50 = new Classroom();
        $c50->name_classroom = "607   Aula comun";
        $c50->total_students = 40;
        $c50->edifice = "Departamento de Biologia";
        $c50->floor = "Planta baja";
        $c50->save();

        $c51 = new Classroom();
        $c51->name_classroom = "608   Aula Lab Biologia 2";
        $c51->total_students = 30;
        $c51->edifice = "Departamento de Biologia";
        $c51->floor = "Planta baja";
        $c51->save();

        $c52 = new Classroom();
        $c52->name_classroom = "609   Aula Lab Biologia 3";
        $c52->total_students = 30;
        $c52->edifice = "Departamento de Biologia";
        $c52->floor = "Planta baja";
        $c52->save();

        $c53 = new Classroom();
        $c53->name_classroom = "608-A Aula Lab Biologia 4";
        $c53->total_students = 30;
        $c53->edifice = "Departamento de Biologia";
        $c53->floor = "Planta baja";
        $c53->save();

        $c54 = new Classroom();
        $c54->name_classroom = "608-B Aula Lab Biologia 5";
        $c54->total_students = 30;
        $c54->edifice = "Departamento de Biologia";
        $c54->floor = "Planta baja";
        $c54->save();

        $c55 = new Classroom();
        $c55->name_classroom = "609-A Aula Lab Biologia 6";
        $c55->total_students = 30;
        $c55->edifice = "Departamento de Biologia";
        $c55->floor = "Planta baja";
        $c55->save();

        $c56 = new Classroom();
        $c56->name_classroom = "612   Aula comun";
        $c56->total_students = 120;
        $c56->edifice = "Departamento de Biologia";
        $c56->floor = "Planta baja";
        $c56->save();

        $c57 = new Classroom();
        $c57->name_classroom = "606 Aula Auditorio Biologia 6";
        $c57->total_students = 40;
        $c57->edifice = "Departamento de Biologia";
        $c57->floor = "Primer piso";
        $c57->save();

        $c58 = new Classroom();
        $c58->name_classroom = "613   Aula Lab Quimica 1";
        $c58->total_students = 30;
        $c58->edifice = "Departamento de Quimica";
        $c58->floor = "Planta baja";
        $c58->save();

        $c59 = new Classroom();
        $c59->name_classroom = "614   Aula Lab Quimica 2";
        $c59->total_students = 50;
        $c59->edifice = "Departamento de Quimica";
        $c59->floor = "Planta baja";
        $c59->save();

        $c60 = new Classroom();
        $c60->name_classroom = "615   Aula Lab Quimica 3";
        $c60->total_students = 50;
        $c60->edifice = "Departamento de Quimica";
        $c60->floor = "Planta baja";
        $c60->save();

        $c61 = new Classroom();
        $c61->name_classroom = "616   Aula Lab Quimica 4";
        $c61->total_students = 50;
        $c61->edifice = "Departamento de Quimica";
        $c61->floor = "Planta baja";
        $c61->save();

        $c62 = new Classroom();
        $c62->name_classroom = "616-A Aula Lab Quimica 5";
        $c62->total_students = 50;
        $c62->edifice = "Departamento de Quimica";
        $c62->floor = "Primer piso";
        $c62->save();

        $c63 = new Classroom();
        $c63->name_classroom = "617   Aula comun";
        $c63->total_students = 187;
        $c63->edifice = "Departamento de Quimica";
        $c63->floor = "Primer piso";
        $c63->save();

        $c64 = new Classroom();
        $c64->name_classroom = "617-B Aula comun";
        $c64->total_students = 60;
        $c64->edifice = "Departamento de Quimica";
        $c64->floor = "Planta baja";
        $c64->save();

        $c65 = new Classroom();
        $c65->name_classroom = "617-C Aula comun";
        $c65->total_students = 120;
        $c65->edifice = "Departamento de Quimica";
        $c65->floor = "Planta baja";
        $c65->save();

        $c66 = new Classroom();
        $c66->name_classroom = "618   Aula Lab Fisica 1";
        $c66->total_students = 45;
        $c66->edifice = "Departamento de Fisica";
        $c66->floor = "Planta baja";
        $c66->save();

        $c67= new Classroom();
        $c67->name_classroom = "619   Aula Lab Fisica 2";
        $c67->total_students = 45;
        $c67->edifice = "Departamento de Fisica";
        $c67->floor = "Planta baja";
        $c67->save();

        $c68= new Classroom();
        $c68->name_classroom = "619-A Aula Lab Fisica 3";
        $c68->total_students = 45;
        $c68->edifice = "Departamento de Fisica";
        $c68->floor = "Planta baja";
        $c68->save();

        $c69 = new Classroom();
        $c69->name_classroom = "620   Aula Lab Fisica 4";
        $c69->total_students = 30;
        $c69->edifice = "Departamento de Fisica";
        $c69->floor = "Planta baja";
        $c69->save();

        $c70= new Classroom();
        $c70->name_classroom = "620-B Aula Lab Fisica 5";
        $c70->total_students = 30;
        $c70->edifice = "Departamento de Fisica";
        $c70->floor = "Planta baja";
        $c70->save();

        $c71= new Classroom();
        $c71->name_classroom = "621   Aula Lab Fisica 6";
        $c71->total_students = 30;
        $c71->edifice = "Departamento de Fisica";
        $c71->floor = "Planta baja";
        $c71->save();

        $c72 = new Classroom();
        $c72->name_classroom = "621-A Aula Lab Fisica 7";
        $c72->total_students = 30;
        $c72->edifice = "Departamento de Fisica";
        $c72->floor = "Planta baja";
        $c72->save();

        $c73 = new Classroom();
        $c73->name_classroom = "622 Aula comun";
        $c73->total_students = 120;
        $c73->edifice = "Departamento de Fisica";
        $c73->floor = "Planta baja";
        $c73->save();

        $c74 = new Classroom();
        $c74->name_classroom = "623 Aula comun";
        $c74->total_students = 120;
        $c74->edifice = "Departamento de Fisica";
        $c74->floor = "Planta baja";
        $c74->save();

        $c75 = new Classroom();
        $c75->name_classroom = "624 Aula Comun";
        $c75->total_students = 120;
        $c75->edifice = "Departamento de Fisica";
        $c75->floor = "Planta baja";
        $c75->save();

        $c76 = new Classroom();
        $c76->name_classroom = "631 Aula Comun";
        $c76->total_students = 50;
        $c76->edifice = "Departamento de Industrial";
        $c76->floor = "Planta baja";
        $c76->save();

        $c77 = new Classroom();
        $c77->name_classroom = "632 Aula Comun";
        $c77->total_students = 50;
        $c77->edifice = "Departamento de Industrial";
        $c77->floor = "Planta baja";
        $c77->save();

        $c78 = new Classroom();
        $c78->name_classroom = "635 Aula Gabinete computo";
        $c78->total_students = 50;
        $c78->edifice = "Departamento de Industrial";
        $c78->floor = "Primer piso";
        $c78->save();

        //
        $c79= new Classroom();
        $c79->name_classroom = "640 Aula-Lab MTM";
        $c79->total_students = 50;
        $c79->edifice = "Sector laboratorios Mecanica";
        $c79->floor = "Planta baja";
        $c79->save();

        $c80 = new Classroom();
        $c80->name_classroom = "642 Aula comun";
        $c80->total_students = 120;
        $c80->edifice = "Sector laboratorios Mecanica";
        $c80->floor = "Planta baja";
        $c80->save();

        $c81 = new Classroom();
        $c81->name_classroom = "643 Aula-Lab ACM";
        $c81->total_students = 50;
        $c81->edifice = "Sector laboratorios Mecanica";
        $c81->floor = "Planta baja";
        $c81->save();

        $c82 = new Classroom();
        $c82->name_classroom = "644   Aula comun";
        $c82->total_students = 80;
        $c82->edifice = "Edificio CAD-CAM";
        $c82->floor = "Primer piso";
        $c82->save();

        $c83 = new Classroom();
        $c83->name_classroom = "644-A Aula comun";
        $c83->total_students = 80;
        $c83->edifice = "Edificio CAD-CAM";
        $c83->floor = "Primer piso";
        $c83->save();

        $c84 = new Classroom();
        $c84->name_classroom = "Auditorio Civil";
        $c84->total_students = 80;
        $c84->edifice = "Edificio CAD-CAM";
        $c84->floor = "Tercer piso";
        $c84->save();
        //
        $c85 = new Classroom();
        $c85->name_classroom = "651 Aula comun";
        $c85->total_students = 75;
        $c85->edifice = "Bloque central-Edificio decanatura";
        $c85->floor = "planta baja";
        $c85->save();

        $c86 = new Classroom();
        $c86->name_classroom = "652 Aula comun";
        $c86->total_students = 30;
        $c86->edifice = "Bloque central-Edificio decanatura";
        $c86->floor = "planta baja";
        $c86->save();

        $c87 = new Classroom();
        $c87->name_classroom = "655 Aula comun";
        $c87->total_students = 50;
        $c87->edifice = "Bloque central-Edificio decanatura";
        $c87->floor = "planta baja";
        $c87->save();

        $c88 = new Classroom();
        $c88->name_classroom = "Auditorio Mecanica";
        $c88->total_students = 80;
        $c88->edifice = "Bloque central-Edificio decanatura";
        $c88->floor = "Segundo piso";
        $c88->save();

        $c89 = new Classroom();
        $c89->name_classroom = "Aula Magna Civil";
        $c89->total_students = 100;
        $c89->edifice = "Bloque central-Edificio decanatura";
        $c89->floor = "Segundo piso";
        $c89->save();

        //
        
        $c90 = new Classroom();
        $c90->name_classroom = "680-A Aula comun";
        $c90->total_students = 50;
        $c90->edifice = "Edificio de Laboratorios Basicos";
        $c90->floor = "Planta baja";
        $c90->save();

        $c91 = new Classroom();
        $c91->name_classroom = "680-B Aula comun";
        $c91->total_students = 50;
        $c91->edifice = "Edificio de Laboratorios Basicos";
        $c91->floor = "Planta baja";
        $c91->save();

        $c92 = new Classroom();
        $c92->name_classroom = "680-C Aula comun";
        $c92->total_students = 50;
        $c92->edifice = "Edificio de Laboratorios Basicos";
        $c92->floor = "Planta baja";
        $c92->save();

        $c93 = new Classroom();
        $c93->name_classroom = "680-E Lab Quimica sala de balanzas";
        $c93->total_students = 50;
        $c93->edifice = "Edificio de Laboratorios Basicos";
        $c93->floor = "Planta baja";
        $c93->save();

        $c94 = new Classroom();
        $c94->name_classroom = "680-F Lab Quimica 1 Organica";
        $c94->total_students = 50;
        $c94->edifice = "Edificio de Laboratorios Basicos";
        $c94->floor = "Planta baja";
        $c94->save();

        $c95 = new Classroom();
        $c95->name_classroom = "680-G Lab Quimica 2 Industrial";
        $c95->total_students = 50;
        $c95->edifice = "Edificio de Laboratorios Basicos";
        $c95->floor = "Planta baja";
        $c95->save();

        $c96 = new Classroom();
        $c96->name_classroom = "680-H Lab Quimica 3 Cuantitativa";
        $c96->total_students = 50;
        $c96->edifice = "Edificio de Laboratorios Basicos";
        $c96->floor = "Planta baja";
        $c96->save();

        $c97 = new Classroom();
        $c97->name_classroom = "680-I Lab Quimica 4";
        $c97->total_students = 50;
        $c97->edifice = "Edificio de Laboratorios Basicos";
        $c97->floor = "Planta baja";
        $c97->save();
        //
        $c98 = new Classroom();
        $c98->name_classroom = "681-A Aula comun";
        $c98->total_students = 50;
        $c98->edifice = "Edificio de Laboratorios Basicos";
        $c98->floor = "Primer piso";
        $c98->save();

        $c99 = new Classroom();
        $c99->name_classroom = "681-B Aula comun";
        $c99->total_students = 50;
        $c99->edifice = "Edificio de Laboratorios Basicos";
        $c99->floor = "Primer piso";
        $c99->save();

        $c100 = new Classroom();
        $c100->name_classroom = "681-C Aula comun";
        $c100->total_students = 50;
        $c100->edifice = "Edificio de Laboratorios Basicos";
        $c100->floor = "Primer piso";
        $c100->save();

        $c101 = new Classroom();
        $c101->name_classroom = "681-D Aula comun";
        $c101->total_students = 50;
        $c101->edifice = "Edificio de Laboratorios Basicos";
        $c101->floor = "Primer piso";
        $c101->save();

        $c102 = new Classroom();
        $c102->name_classroom = "681-E Lab Mec 1 Materiales";
        $c102->total_students = 50;
        $c102->edifice = "Edificio de Laboratorios Basicos";
        $c102->floor = "Primer piso";
        $c102->save();

        $c103 = new Classroom();
        $c103->name_classroom = "681-F Lab Mec 2 Fluidos";
        $c103->total_students = 50;
        $c103->edifice = "Edificio de Laboratorios Basicos";
        $c103->floor = "Primer piso";
        $c103->save();

        $c104 = new Classroom();
        $c104->name_classroom = "681-G Lab Mec 3 Automatizacion";
        $c104->total_students = 50;
        $c104->edifice = "Edificio de Laboratorios Basicos";
        $c104->floor = "Primer piso";
        $c104->save();

        $c105 = new Classroom();
        $c105->name_classroom = "681-H Lab Mec 4 Metrologia";
        $c105->total_students = 50;
        $c105->edifice = "Edificio de Laboratorios Basicos";
        $c105->floor = "Primer piso";
        $c105->save();

        $c106 = new Classroom();
        $c106->name_classroom = "681-I Lab Matematica 1";
        $c106->total_students = 50;
        $c106->edifice = "Edificio de Laboratorios Basicos";
        $c106->floor = "Primer piso";
        $c106->save();

        $c107 = new Classroom();
        $c107->name_classroom = "681-J Lab Matematicas 2";
        $c107->total_students = 50;
        $c107->edifice = "Edificio de Laboratorios Basicos";
        $c107->floor = "Primer piso";
        $c107->save();

        $c108 = new Classroom();
        $c108->name_classroom = "681-K Lab Matematicas 3";
        $c108->total_students = 50;
        $c108->edifice = "Edificio de Laboratorios Basicos";
        $c108->floor = "Primer piso";
        $c108->save();

        $c109 = new Classroom();
        $c109->name_classroom = "681-L Lab Matematicas 4";
        $c109->total_students = 50;
        $c109->edifice = "Edificio de Laboratorios Basicos";
        $c109->floor = "Primer piso";
        $c109->save();
        //
        $c110 = new Classroom();
        $c110->name_classroom = "682-A Aula comun";
        $c110->total_students = 75;
        $c110->edifice = "Edificio de Laboratorios Basicos";
        $c110->floor = "Segundo piso";
        $c110->save();

        $c111 = new Classroom();
        $c111->name_classroom = "682-B Aula comun";
        $c111->total_students = 75;
        $c111->edifice = "Edificio de Laboratorios Basicos";
        $c111->floor = "Segundo piso";
        $c111->save();

        $c112 = new Classroom();
        $c112->name_classroom = "682-C Aula comun";
        $c112->total_students = 75;
        $c112->edifice = "Edificio de Laboratorios Basicos";
        $c112->floor = "Segundo piso";
        $c112->save();

        $c113 = new Classroom();
        $c113->name_classroom = "682-D Aula comun";
        $c113->total_students = 75;
        $c113->edifice = "Edificio de Laboratorios Basicos";
        $c113->floor = "Segundo piso";
        $c113->save();

        $c114 = new Classroom();
        $c114->name_classroom = "682-E Lab Elc 1 Circuitos I,II,III";
        $c114->total_students = 40;
        $c114->edifice = "Edificio de Laboratorios Basicos";
        $c114->floor = "Segundo piso";
        $c114->save();

        $c115 = new Classroom();
        $c115->name_classroom = "682-F Lab Elc 2 Analogica I,II";
        $c115->total_students = 40;
        $c115->edifice = "Edificio de Laboratorios Basicos";
        $c115->floor = "Segundo piso";
        $c115->save();

        $c116 = new Classroom();
        $c116->name_classroom = "682-G Lab Elc 3 Electrotecnica";
        $c116->total_students = 40;
        $c116->edifice = "Edificio de Laboratorios Basicos";
        $c116->floor = "Segundo piso";
        $c116->save();

        $c117 = new Classroom();
        $c117->name_classroom = "682-H Lab Elc 4 Automatizacion";
        $c117->total_students = 40;
        $c117->edifice = "Edificio de Laboratorios Basicos";
        $c117->floor = "Segundo piso";
        $c117->save();

        $c118 = new Classroom();
        $c118->name_classroom = "682-I Lab Ind 1 - Manufactura";
        $c118->total_students = 40;
        $c118->edifice = "Edificio de Laboratorios Basicos";
        $c118->floor = "Segundo piso";
        $c118->save();

        $c119 = new Classroom();
        $c119->name_classroom = "682-J Lab Ind 2 - Seg.Industrial";
        $c119->total_students = 40;
        $c119->edifice = "Edificio de Laboratorios Basicos";
        $c119->floor = "Segundo piso";
        $c119->save();

        $c120 = new Classroom();
        $c120->name_classroom = "682-K Lab Ind 3 - Metodos";
        $c120->total_students = 40;
        $c120->edifice = "Edificio de Laboratorios Basicos";
        $c120->floor = "Segundo piso";
        $c120->save();

        $c121 = new Classroom();
        $c121->name_classroom = "682-L Lab Ind 4 - Pymes";
        $c121->total_students = 40;
        $c121->edifice = "Edificio de Laboratorios Basicos";
        $c121->floor = "Segundo piso";
        $c121->save();
        //
        $c122 = new Classroom();
        $c122->name_classroom = "683-A Aula comun";
        $c122->total_students = 75;
        $c122->edifice = "Edificio de Laboratorios Basicos";
        $c122->floor = "Tercer piso";
        $c122->save();

        $c123 = new Classroom();
        $c123->name_classroom = "683-B Aula comun";
        $c123->total_students = 75;
        $c123->edifice = "Edificio de Laboratorios Basicos";
        $c123->floor = "Tercer piso";
        $c123->save();

        $c124 = new Classroom();
        $c124->name_classroom = "683-C Aula comun";
        $c124->total_students = 75;
        $c124->edifice = "Edificio de Laboratorios Basicos";
        $c124->floor = "Tercer piso";
        $c124->save();

        $c125 = new Classroom();
        $c125->name_classroom = "683-D Aula comun";
        $c125->total_students = 75;
        $c125->edifice = "Edificio de Laboratorios Basicos";
        $c125->floor = "Tercer piso";
        $c125->save();

        $c126 = new Classroom();
        $c126->name_classroom = "683-E Laboratorio Alimentos 1";
        $c126->total_students = 40;
        $c126->edifice = "Edificio de Laboratorios Basicos";
        $c126->floor = "Tercer piso";
        $c126->save();

        $c127 = new Classroom();
        $c127->name_classroom = "683-F Laboratorio Alimentos 2";
        $c127->total_students = 40;
        $c127->edifice = "Edificio de Laboratorios Basicos";
        $c127->floor = "Tercer piso";
        $c127->save();

        $c128 = new Classroom();
        $c128->name_classroom = "683-G Laboratorio Alimentos 3";
        $c128->total_students = 40;
        $c128->edifice = "Edificio de Laboratorios Basicos";
        $c128->floor = "Tercer piso";
        $c128->save();

        $c129 = new Classroom();
        $c129->name_classroom = "683-H Laboratorio Alimentos 4";
        $c129->total_students = 40;
        $c129->edifice = "Edificio de Laboratorios Basicos";
        $c129->floor = "Tercer piso";
        $c129->save();

        $c130 = new Classroom();
        $c130->name_classroom = "683-I Laboratorio Biologia 1";
        $c130->total_students = 40;
        $c130->edifice = "Edificio de Laboratorios Basicos";
        $c130->floor = "Tercer piso";
        $c130->save();

        $c131 = new Classroom();
        $c131->name_classroom = "683-J Laboratorio Biologia 2";
        $c131->total_students = 40;
        $c131->edifice = "Edificio de Laboratorios Basicos";
        $c131->floor = "Tercer piso";
        $c131->save();

        $c132 = new Classroom();
        $c132->name_classroom = "683-K Laboratorio Biologia 3";
        $c132->total_students = 40;
        $c132->edifice = "Edificio de Laboratorios Basicos";
        $c132->floor = "Tercer piso";
        $c132->save();

        $c133 = new Classroom();
        $c133->name_classroom = "683-L Laboratorio Biologia 4";
        $c133->total_students = 40;
        $c133->edifice = "Edificio de Laboratorios Basicos";
        $c133->floor = "Tercer piso";
        $c133->save();

        $c134 = new Classroom();
        $c134->name_classroom = "684-A Aula comun";
        $c134->total_students = 75;
        $c134->edifice = "Edificio de Laboratorios Basicos";
        $c134->floor = "Cuarto piso";
        $c134->save();

        $c135 = new Classroom();
        $c135->name_classroom = "684-B Aula comun";
        $c135->total_students = 75;
        $c135->edifice = "Edificio de Laboratorios Basicos";
        $c135->floor = "Cuarto piso";
        $c135->save();

        $c136 = new Classroom();
        $c136->name_classroom = "684-C Aula comun";
        $c136->total_students = 75;
        $c136->edifice = "Edificio de Laboratorios Basicos";
        $c136->floor = "Cuarto piso";
        $c136->save();

        $c137 = new Classroom();
        $c137->name_classroom = "684-D Aula comun";
        $c137->total_students = 75;
        $c137->edifice = "Edificio de Laboratorios Basicos";
        $c137->floor = "Cuarto piso";
        $c137->save();

        $c138 = new Classroom();
        $c138->name_classroom = "684-E Lab Herbario 1 - Coleccion";
        $c138->total_students = 40;
        $c138->edifice = "Edificio de Laboratorios Basicos";
        $c138->floor = "Cuarto piso";
        $c138->save();

        $c139 = new Classroom();
        $c139->name_classroom = "684-F Lab Herbario 2 - Investigacion";
        $c139->total_students = 40;
        $c139->edifice = "Edificio de Laboratorios Basicos";
        $c139->floor = "Cuarto piso";
        $c139->save();

        $c140 = new Classroom();
        $c140->name_classroom = "684-G Lab Herbario 3 - Iden montaje";
        $c140->total_students = 40;
        $c140->edifice = "Edificio de Laboratorios Basicos";
        $c140->floor = "Cuarto piso";
        $c140->save();

        $c141 = new Classroom();
        $c141->name_classroom = "684-H Laboratorio Fisica 1";
        $c141->total_students = 40;
        $c141->edifice = "Edificio de Laboratorios Basicos";
        $c141->floor = "Cuarto piso";
        $c141->save();

        $c142 = new Classroom();
        $c142->name_classroom = "684-I Laboratorio Fisica 2";
        $c142->total_students = 40;
        $c142->edifice = "Edificio de Laboratorios Basicos";
        $c142->floor = "Cuarto piso";
        $c142->save();

        $c143 = new Classroom();
        $c143->name_classroom = "684-J Laboratorio Fisica 3";
        $c143->total_students = 40;
        $c143->edifice = "Edificio de Laboratorios Basicos";
        $c143->floor = "Cuarto piso";
        $c143->save();

        $c144 = new Classroom();
        $c144->name_classroom = "684-K Laboratorio Fisica 4";
        $c144->total_students = 40;
        $c144->edifice = "Edificio de Laboratorios Basicos";
        $c144->floor = "Cuarto piso";
        $c144->save(); 

    }
}
