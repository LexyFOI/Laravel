<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAYearsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('a_years', function (Blueprint $table) {
            $table->id();
            $table->string('ayear');
            $table->integer('course_id');
            $table->date('semestar1_start');
            $table->date('semestar1_end');
            $table->date('semestar2_start');
            $table->date('semestar2_end');
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
        Schema::dropIfExists('a_years');
    }
}
