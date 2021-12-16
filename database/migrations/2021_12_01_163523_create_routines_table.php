<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoutinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('routines', function (Blueprint $table) {
            $table->id();
            $table->foreignId('class_id')->nullable()->constrained('classes')->cascadeOnDelete();
            $table->foreignId('section_id')->nullable()->constrained('sections')->cascadeOnDelete();
            $table->foreignId('subject_id')->nullable()->constrained('subjects')->cascadeOnDelete();
            $table->string('starting_hour')->nullable();
            $table->string('ending_hour')->nullable();
            $table->string('starting_minute')->nullable();
            $table->string('ending_minuteending_minute')->nullable();
            $table->string('day')->default('');
            $table->foreignId('teacher_id')->nullable()->constrained('teachers')->cascadeOnDelete();
            $table->foreignId('room_id')->nullable()->constrained('class_rooms')->cascadeOnDelete();
            $table->foreignId('session_app_id')->default('1')->constrained('schools')->cascadeOnDelete();
            $table->foreignId('session_id')->nullable()->constrained('session_apps')->cascadeOnDelete();
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
        Schema::dropIfExists('routines');
    }
}
