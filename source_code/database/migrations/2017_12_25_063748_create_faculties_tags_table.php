<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFacultiesTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('faculties_tags', function (Blueprint $table) {
            $table->integer('faculty_id')->index()->unsigned();
            $table->integer('tag_id')->index()->unsigned();
            $table->timestamps();


            $table->primary(['faculty_id','tag_id']);
            $table->foreign('tag_id')->references('id')->on('tags');
            $table->foreign('faculty_id')->references('id')->on('faculties');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('faculties_tags');
    }
}
