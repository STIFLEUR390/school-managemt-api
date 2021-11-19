<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookIssuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        Schema::create('book_issues', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('book_id')->nullable();
            $table->unsignedBigInteger('class_id')->nullable();
            $table->unsignedBigInteger('student_id')->nullable();
            $table->string('issue_date')->nullable();
            $table->unsignedBigInteger('status')->default('0');
            $table->unsignedBigInteger('school_id')->nullable();
            $table->string('session')->nullable();
            $table->timestamps();
            $table->foreign('book_id')->references('id')->on('books');
            $table->foreign('class_id')->references('id')->on('classes');
            $table->foreign('student_id')->references('id')->on('students');
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
        Schema::dropIfExists('book_issues');
    }
}
