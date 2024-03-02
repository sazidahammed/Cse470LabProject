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
        Schema::create('addcosts', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('company');
            $table->string('describe');
            $table->float('dailycost');
            $table->string('marketby');
            $table->string('date');
            $table->integer('month');
            $table->timestamps();
        });
    }

    //   CREATE TABLE addmeals (
        //    id int
        //    user_id int(11),
        //    company varchar(255),
        //    describe varchar(255),
        //    dailycost varchar(255),
        //    marketby varchar(255),
        //    date varchar(255),
        //    month int(11),
        //    `date` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
        //)

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('addcosts');
    }
};
