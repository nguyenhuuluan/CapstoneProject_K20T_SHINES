<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompaniesTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tag_company', function (Blueprint $table) {
            $table->integer('company_id')->index()->unsigned();
            $table->integer('tag_id')->index()->unsigned();
            $table->timestamps();

            $table->primary(['company_id','tag_id']);        
            $table->foreign('tag_id')->references('id')->on('tags')->onDelete('cascade');
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tag_company');
    }
}
