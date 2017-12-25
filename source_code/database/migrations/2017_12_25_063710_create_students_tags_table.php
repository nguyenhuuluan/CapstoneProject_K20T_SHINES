<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentsTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students_tags', function (Blueprint $table) {
            $table->integer('student_id')->index()->unsigned();
            $table->integer('tag_id')->index()->unsigned();
            $table->timestamps();


            $table->primary(['student_id','tag_id']);            
            $table->foreign('tag_id')->references('id')->on('tags');
            $table->foreign('student_id')->references('id')->on('students');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('students_tags');
    }
}
