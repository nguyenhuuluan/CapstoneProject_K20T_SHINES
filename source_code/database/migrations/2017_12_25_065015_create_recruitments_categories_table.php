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
        Schema::create('category_recruitment', function (Blueprint $table) {
            $table->integer('recruitment_id')->index()->unsigned();
            $table->integer('category_id')->index()->unsigned();
            $table->timestamps();

            $table->primary(['recruitment_id','category_id']);       
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('recruitment_id')->references('id')->on('recruitments')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('category_recruitment');
    }
}
