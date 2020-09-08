<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTZKrecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_z_krecords', function (Blueprint $table) {
            $table->id();
            $table->integer('ayear_id');
            $table->integer('student_id');
            $table->integer('excuse_id')->nullable();
            $table->integer('nof_excused_weeks');
            $table->integer('group_id')->nullable();
            $table->integer('sumS1');
            $table->boolean('satisfiedS1');
            $table->integer('sumS2');
            $table->boolean('satisfiedS2');
            $table->string('evidence_comment')->nullable();
            $table->integer('yearOFstudy');
            $table->boolean('repeater');
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
        Schema::dropIfExists('t_z_krecords');
    }
}
