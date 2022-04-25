<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
{
    use HasFactory;



    public function users(){
        return $this->belogsToMany(User::class);

    }

    public function subjet (){
        return $this->belogsToMany(Subjet::class);
    } 
    
    public function user_bookings(){
        return $this->hasMany(UserBooking::class);
    }
}
