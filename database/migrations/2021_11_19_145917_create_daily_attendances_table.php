<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDailyAttendancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        Schema::create('daily_attendances', function (Blueprint $table) {
            $table->id();
            $table->string('timestamp')->nullable();
            $table->unsignedBigInteger('class_id')->nullable();
            $table->unsignedBigInteger('section_id')->nullable();
            $table->unsignedBigInteger('student_id')->nullable();
            $table->unsignedBigInteger('status')->nullable();
            $table->unsignedBigInteger('session_id')->nullable();
            $table->unsignedBigInteger('school_id')->nullable();
            $table->timestamps();
            $table->foreign('class_id')->references('id')->on('classes');
            $table->foreign('section_id')->references('id')->on('sections');
            $table->foreign('student_id')->references('id')->on('students');
            $table->foreign('session_id')->references('id')->on('sessions');
            $table->foreign('school_id')->references('id')->on('schools');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('daily_attendances');
    }
}
