<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
          $table->increments('id');
          $table->string('name');
          $table->string('website');
          $table->string('email');
          $table->string('phone',20);
          $table->string('working_day',255);
          $table->string('logo',255)->nullable();
          $table->integer('status_id')->index()->unsigned();
          $table->timestamps();

          $table->foreign('status_id')->references('id')->on('statuses');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {   
        //DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Schema::dropIfExists('companies');
        //DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
