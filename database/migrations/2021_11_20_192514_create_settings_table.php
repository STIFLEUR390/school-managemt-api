<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('school_id')->default('1')->constrained('schools')->cascadeOnDelete();
            $table->string('system_name')->nullable();
            $table->string('system_title')->nullable();
            $table->string('system_email')->nullable();
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->string('system_currency')->nullable();
            $table->string('language')->nullable();
            $table->string('student_email_verification')->nullable();
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
        Schema::dropIfExists('settings');
    }
}
