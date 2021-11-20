<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNoticeboardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        Schema::create('noticeboards', function (Blueprint $table) {
            $table->id();
            $table->longText('notice_title')->nullable();
            $table->longText('notice')->nullable();
            $table->string('date')->nullable();
            $table->unsignedBigInteger('status')->default('1');
            $table->unsignedBigInteger('show_on_website')->default('0');
            $table->text('image')->nullable();
            $table->unsignedBigInteger('school_id')->nullable();
            $table->unsignedBigInteger('session')->nullable();
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
        Schema::dropIfExists('noticeboards');
    }
}
