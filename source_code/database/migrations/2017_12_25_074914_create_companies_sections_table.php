<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompaniesSectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies_sections', function (Blueprint $table) {
            //$table->increments('id');
            $table->integer('company_id')->index()->unsigned();
            $table->integer('section_id')->index()->unsigned();
            $table->timestamps();
            
            $table->primary(['company_id','section_id']);
            $table->foreign('company_id')->references('id')->on('companies');
            $table->foreign('section_id')->references('id')->on('sections');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('companies_sections');
    }
}
