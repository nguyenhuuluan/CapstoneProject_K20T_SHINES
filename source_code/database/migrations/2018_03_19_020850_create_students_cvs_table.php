<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentsCvsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_cv', function (Blueprint $table) {
            $table->integer('student_id')->index()->unsigned();
            $table->integer('cv_id')->index()->unsigned();
            $table->timestamps();

            $table->primary(['student_id','cv_id']);
            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
            $table->foreign('cv_id')->references('id')->on('cvs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('student_cv');
    }
}
