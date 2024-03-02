<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
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
            $table->string('company');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone');
            $table->string('role')->default(22);
            $table->string('type');
            $table->string('profile_pic')->default('default_pic.jpg');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });


        //CREATE TABLE users (
        //    id int
        //    company varchar(255),
        //    name varchar(255),
        //    email varchar(255),
        //    phone varchar(255),
        //    role varchar(255) DEFAULT '22',
        //    type varchar(255),
        //    profile_pic varchar(255) DEFAULT 'default_pic.jpg',
        //    email_verified_at varchar(255),
        //    password varchar(255),
        //    rememberToken varchar(255),
        //    `date` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
        //    UNIQUE ('email'),
        //
        //)
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
};
