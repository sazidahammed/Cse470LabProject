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
        Schema::create('addmeals', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('company');
            $table->integer('package_id')->default(0);
            $table->float('lunch');
            $table->float('dinner');
            $table->string('date');
            $table->integer('month');
            $table->timestamps();
        });


        //   CREATE TABLE addmeals (
        //    id int
        //    user_id int(11),
        //    company varchar(255),
        //    package_id int(255) DEFAULT '0',
        //    lunch float(11),
        //    dinner float(11),
        //    date varchar(255),
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
        Schema::dropIfExists('addmeals');
    }
};
