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
        $su->group = 1;
        $su->save();
        
        $su1 = new SubjectUser();
        $su1->user_id = 1;
        $su1->subject_id = 1;
        $su1->group = 2;
        $su1->save();
        
        $su2 = new SubjectUser();
        $su2->user_id = 2;
        $su2->subject_id = 1;
        $su2->group = 3;
        $su2->save();
        
        $su3 = new SubjectUser();
        $su3->user_id = 1;
        $su3->subject_id = 2;
        $su3->group = 1;
        $su3->save();
    }
}
