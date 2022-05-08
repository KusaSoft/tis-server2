<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\SubjectUser;

class SubjectUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $su = new SubjectUser();
        $su->user_id = 1;
        $su->subject_id = 1;
        $su->group = 2;
        $su->save();

        $su1 = new SubjectUser();
        $su1->user_id = 2;
        $su1->subject_id = 1;
        $su1->group = 7;
        $su1->save();

        $su2 = new SubjectUser();
        $su2->user_id = 5;
        $su2->subject_id = 1;
        $su2->group = 1;
        $su2->save();

        $su3 = new SubjectUser();
        $su3->user_id = 5;
        $su3->subject_id = 1;
        $su3->group = 6;
        $su3->save();

        $su4 = new SubjectUser();
        $su4->user_id = 6;
        $su4->subject_id = 1;
        $su4->group = 2;
        $su4->save();

        $su5 = new SubjectUser();
        $su5->user_id = 6;
        $su5->subject_id = 1;
        $su5->group = 5;
        $su5->save();

        $su6 = new SubjectUser();
        $su6->user_id = 6;
        $su6->subject_id = 1;
        $su6->group = 9;
        $su6->save();

        $su7 = new SubjectUser();
        $su7->user_id = 7;
        $su7->subject_id = 1;
        $su7->group = 4;
        $su7->save();

        $su8 = new SubjectUser();
        $su8->user_id = 8;
        $su8->subject_id = 1;
        $su8->group = 10;
        $su8->save();

        $su9 = new SubjectUser();
        $su9->user_id = 9;
        $su9->subject_id = 1;
        $su9->group = 1;
        $su9->save();

        $su10 = new SubjectUser();
        $su10->user_id = 9;
        $su10->subject_id = 1;
        $su10->group = 8;
        $su10->save();

        $su11 = new SubjectUser();
        $su11->user_id = 10;
        $su11->subject_id = 1;
        $su11->group = 3;
        $su11->save();

        $su12 = new SubjectUser();
        $su12->user_id = 10;
        $su12->subject_id = 1;
        $su12->group = 11;
        $su12->save();

        $su13 = new SubjectUser();
        $su13->user_id = 1;
        $su13->subject_id = 2;
        $su13->group = 2;
        $su13->save();

        $su14 = new SubjectUser();
        $su14->user_id = 1;
        $su14->subject_id = 2;
        $su14->group = 3;
        $su14->save();

        $su15 = new SubjectUser();
        $su15->user_id = 11;
        $su15->subject_id = 2;
        $su15->group = 1;
        $su15->save();

        $su16 = new SubjectUser();
        $su16->user_id = 11;
        $su16->subject_id = 2;
        $su16->group = 5;
        $su16->save();

        $su17 = new SubjectUser();
        $su17->user_id = 12;
        $su17->subject_id = 2;
        $su17->group = 4;
        $su17->save();

        $su18 = new SubjectUser();
        $su18->user_id = 12;
        $su18->subject_id = 2;
        $su18->group = 8;
        $su18->save();

        $su19 = new SubjectUser();
        $su19->user_id = 2;  
        $su19->subject_id = 3; 
        $su19->group =1;
        $su19->save();

        $su20 = new SubjectUser();
        $su20->user_id = 6;  
        $su20->subject_id = 3; 
        $su20->group =3;
        $su20->save();

        $su21 = new SubjectUser();
        $su21->user_id = 9;  
        $su21->subject_id = 3; 
        $su21->group =2;
        $su21->save();

        $su22 = new SubjectUser();
        $su22->user_id = 13;  
        $su22->subject_id = 3; 
        $su22->group =5;
        $su22->save();

        $su23 = new SubjectUser();
        $su23->user_id = 14;  
        $su23->subject_id = 3; 
        $su23->group =6;
        $su23->save();

        $su24 = new SubjectUser();
        $su24->user_id = 2;  
        $su24->subject_id = 4; 
        $su24->group =1;
        $su24->save();

        $su25 = new SubjectUser();
        $su25->user_id = 1;  
        $su25->subject_id = 5; 
        $su25->group =2;
        $su25->save();

        $su26 = new SubjectUser();
        $su26->user_id = 2;  
        $su26->subject_id = 5; 
        $su26->group =1;
        $su26->save();

        $su27 = new SubjectUser();
        $su27->user_id = 15;  
        $su27->subject_id = 5; 
        $su27->group =3;
        $su27->save();

        $su28 = new SubjectUser();
        $su28->user_id = 16;  
        $su28->subject_id = 5; 
        $su28->group =4;
        $su28->save();

        $su29 = new SubjectUser();   
        $su29->user_id = 2;  
        $su29->subject_id = 6; 
        $su29->group =6;
        $su29->save();

        $su30 = new SubjectUser();
        $su30->user_id = 16;  
        $su30->subject_id = 6; 
        $su30->group =7;
        $su30->save();

        $su31 = new SubjectUser();
        $su31->user_id = 5;  
        $su31->subject_id = 7; 
        $su31->group =1;
        $su31->save();

        $su32 = new SubjectUser();
        $su32->user_id = 5;  
        $su32->subject_id = 7; 
        $su32->group =2;
        $su32->save();

        $su33 = new SubjectUser();
        $su33->user_id = 5;  
        $su33->subject_id = 8; 
        $su33->group =3;
        $su33->save();

        $su34 = new SubjectUser();
        $su34->user_id = 18;  
        $su34->subject_id = 8; 
        $su34->group =2;
        $su34->save();

        $su35 = new SubjectUser();
        $su35->user_id = 19;  
        $su35->subject_id = 8; 
        $su35->group =1;
        $su35->save();

        $su36 = new SubjectUser();
        $su36->user_id = 17;  
        $su36->subject_id = 9; 
        $su36->group =2;
        $su36->save();

        $su37 = new SubjectUser();
        $su37->user_id = 11;  
        $su37->subject_id = 9; 
        $su37->group =1;
        $su37->save();

        $su38 = new SubjectUser();
        $su38->user_id = 1;  
        $su38->subject_id = 10; 
        $su38->group =1;
        $su38->save();

        $su39 = new SubjectUser();
        $su39->user_id = 1;  
        $su39->subject_id = 11; 
        $su39->group =2;
        $su39->save();

        $su40 = new SubjectUser();
        $su40->user_id = 20;  
        $su40->subject_id = 11; 
        $su40->group =1;
        $su40->save();
    }
}
