<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',255);
            $table->string('description',255)->nullable();
            $table->tinyInteger('gender');
            $table->string('email')->unique();
            $table->string('phone',20);
            $table->string('photo',255)->nullable();
            $table->date('dateofbirth');
            $table->integer('account_id')->index()->unsigned();
            $table->integer('faculty_id')->index()->unsigned();
            $table->timestamps();


            $table->foreign('account_id')->references('id')->on('accounts')->onDelete('cascade');
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
        Schema::dropIfExists('students');
    }
}
