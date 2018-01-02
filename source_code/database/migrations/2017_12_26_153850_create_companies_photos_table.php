<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompaniesPhotosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('photo_company', function (Blueprint $table) {
             $table->integer('company_id')->index()->unsigned();
            $table->integer('photo_id')->index()->unsigned();
            $table->timestamps();

            $table->primary(['company_id','photo_id']);
            $table->foreign('company_id')->references('id')->on('blogs')->onDelete('cascade');
            $table->foreign('photo_id')->references('id')->on('photos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('photo_company');
    }
}
