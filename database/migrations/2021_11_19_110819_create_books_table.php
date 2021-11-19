<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('author')->nullable();
            $table->unsignedBigInteger('copies')->nullable();
            $table->unsignedBigInteger('school_id')->nullable();
            $table->string('session')->nullable();
            $table->timestamps();
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
        Schema::dropIfExists('books');
    }
}
