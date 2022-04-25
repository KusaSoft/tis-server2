<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rent extends Model
{
    protected $table = "Rent";

    public function client(){
        return $this->belongsTo(Client::class);
    }
    use HasFactory;
}
