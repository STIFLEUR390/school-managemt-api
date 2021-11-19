<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            // $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->longText('address')->nullable();
            $table->string('phone')->nullable();
            // $table->string('role')->nullable();
            $table->enum('role', ['superadmin', 'accountant', 'admin', 'librarian', 'parent', 'student', 'teacher'])->nullable();
            $table->rememberToken();
            $table->string('birthday')->nullable();
            $table->string('gender')->nullable();
            $table->string('blood_group')->nullable();
            $table->unsignedBigInteger('school_id')->nullable();
            $table->string('authentication_key')->nullable();
            $table->longText('watch_history')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('school_id')->references('id')->on('schools')
                ->onDelete('restrict')
                ->onUpdate('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
