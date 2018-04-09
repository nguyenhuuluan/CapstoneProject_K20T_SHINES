<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentsRecruitmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_recruitment', function (Blueprint $table) {
           $table->integer('student_id')->index()->unsigned();
           $table->integer('recruitment_id')->index()->unsigned();

           $table->primary(['student_id','recruitment_id']);      
           $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
           $table->foreign('recruitment_id')->references('id')->on('recruitments')->onDelete('cascade');
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
        Schema::dropIfExists('student_recruitment');
    }
}
