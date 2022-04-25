<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MovieRent extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('MovieRent', function(Blueprint $table){
            $table->id();
            $table->foreignId('movie_id')
                ->references('id')
                ->on('Movie')
                ->onDelete('cascade');
            $table->foreignId('rent_id')
                ->references('id')
                ->on('Rent')
                ->onDelete('cascade') ;
            $table->bigInteger('group');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('MovieRent');
    }
}
