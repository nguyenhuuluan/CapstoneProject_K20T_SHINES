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
        $table->string('introduce',255)->nullable();
        $table->string('website')->nullable();
        $table->string('email')->nullable();
        $table->string('phone',20)->nullable();
        $table->string('working_day',255)->nullable();
        $table->string('logo',255)->nullable();
        $table->string('field')->nullable();
        $table->string('business_code')->nullable();
        $table->integer('status_id')->index()->unsigned();
        $table->string('slug',255)->nullable();
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
