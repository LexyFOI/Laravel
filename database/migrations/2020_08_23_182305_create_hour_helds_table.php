<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHourHeldsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hour_helds', function (Blueprint $table) {
            $table->id();
            $table->date('hs_date');
            $table->string('hs_day');
            $table->integer('group_id');
            $table->integer('student_id');
            $table->decimal('points');
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
        Schema::dropIfExists('hour_helds');
    }
}
