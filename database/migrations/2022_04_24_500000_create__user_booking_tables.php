<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserBookingTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_booking', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('subject_id');
            $table->unsignedBigInteger('classroom_id');
            $table->dateTime("register_date")->nullable();
            $table->date('reservation_date')->nullable();
            $table->string("request_reason")->nullable();
            $table->string("horario_ini")->nullable();
            $table->string("horario_end")->nullable();
            $table->string("total_students")->nullable();
            $table->string("state");
            $table->string("group_list");
            $table->string("other_groups",100);
            $table->string("rejection_reason")->nullable();
            $table->string("assigned_classrooms")->nullable();

            $table->string("emisor_id")->nullable();
            $table->date("notification_date")->nullable();
            $table->boolean("read")->nullable();

            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('subject_id')->references('id')->on('subjects')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('classroom_id')->references('id')->on('classrooms')->onUpdate('cascade')->onDelete('cascade');

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
        Schema::dropIfExists('user_booking');
    }
}
