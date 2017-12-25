<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecruitmentsCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recruitments_categories', function (Blueprint $table) {
            $table->integer('recruitment_id')->index()->unsigned();
            $table->integer('category_id')->index()->unsigned();
            $table->timestamps();

            $table->primary(['recruitment_id','category_id']);       
            $table->foreign('category_id')->references('id')->on('categories');
            $table->foreign('recruitment_id')->references('id')->on('recruitments');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('recruitments_categories');
    }
}
