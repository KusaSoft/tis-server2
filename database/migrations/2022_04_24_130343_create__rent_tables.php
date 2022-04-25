<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRentTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Rent', function (Blueprint $table) {
            $table->id();
            $table->string("description");
            $table->unsignedDecimal("cost");
            
            $table->unsignedBigInteger("client_id");
            
            $table->foreign("client_id")->references("id")->on("Client")->onDelete("cascade");
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Rent');
    }
}
