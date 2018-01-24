<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompaniesRegistrations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::create('companies_registrations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('company_name');
            $table->string('company_website');
            $table->string('representative_name');
            $table->string('representative_position');
            $table->string('representative_phone');
            $table->string('representative_email');
            $table->integer('status_id')->unsigned()->index();
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
        Schema::dropIfExists('companies_registrations');
    }
}
