<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApplyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apply', function (Blueprint $table) {
            $table->integer('student_id')->index()->unsigned();
            $table->integer('recruitment_id')->index()->unsigned();
            $table->integer('cv_id')->index()->unsigned();
            $table->timestamps();

            $table->primary(['student_id','recruitment_id','cv_id']);      
            $table->foreign('student_id')->references('id')->on('students');
            $table->foreign('recruitment_id')->references('id')->on('recruitments');
            $table->foreign('cv_id')->references('id')->on('cvs');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('apply');
    }
}
