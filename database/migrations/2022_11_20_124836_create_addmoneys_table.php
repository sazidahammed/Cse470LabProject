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
        Schema::create('addmoneys', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('company');
            $table->integer('amount');
            $table->integer('month');
            $table->timestamps();
        });

         //   CREATE TABLE addmoneys (
        //    id int
        //    user_id int(11),
        //    company varchar(255),
        //    amount int(11),
        //    month int(11),
        //    `date` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
        //)
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('addmoneys');
    }
};
