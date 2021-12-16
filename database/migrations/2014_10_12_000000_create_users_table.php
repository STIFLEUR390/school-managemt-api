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
            $table->string('code')->nullable();
            $table->longText('address')->nullable();
            $table->string('phone')->unique()->nullable();
            $table->string('image')->default('upload/avatar.jpg');
            $table->enum('role', ['superadmin', 'accountant', 'admin', 'librarian', 'parent', 'student', 'teacher'])->nullable();
            $table->rememberToken();
            $table->string('birthday')->nullable();
            // $table->string('gender')->nullable();
            $table->enum('gender', ['male', 'female', 'others'])->nullable();
            // $table->string('blood_group')->nullable();
            $table->enum('blood_group', ['O+', 'O-', 'A+', 'A-', 'B+', 'B-', 'AB+', 'AB-'])->nullable();
            $table->foreignId('school_id')->default('1')->constrained('schools')->cascadeOnDelete();
            $table->string('authentication_key')->nullable();
            $table->longText('watch_history')->nullable();
            $table->timestamps();
            $table->softDeletes();
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
