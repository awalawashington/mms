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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('username')->unique();
            $table->string('phone');
            $table->string('address')->nullable();
            $table->string('email')->unique();
            $table->boolean('role')->default(false);
            $table->string('bio')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->timestamp('dob')->nullable();
            $table->unsignedInteger('height')->nullable();
            $table->unsignedInteger('weight')->nullable();
            $table->string('color')->nullable();
            $table->string('gender')->nullable();
            $table->string('marital_status')->nullable();

            $table->unsignedBigInteger('nationality')->nullable();
            $table->foreign('nationality')->references('id')->on('world_countries')->onDelete('cascade');
            
            $table->string('active')->default(false);
            $table->string('profile')->nullable();
            $table->string('password');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
