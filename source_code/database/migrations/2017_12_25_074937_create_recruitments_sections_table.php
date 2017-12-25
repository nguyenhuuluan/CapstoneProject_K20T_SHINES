<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecruitmentsSectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recruitments_sections', function (Blueprint $table) {
            $table->integer('recruitment_id')->index()->unsigned();
            $table->integer('section_id')->index()->unsigned();
            $table->string('content');
            $table->timestamps();


            $table->primary(['recruitment_id','section_id']);
            $table->foreign('recruitment_id')->references('id')->on('recruitments');
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
        Schema::dropIfExists('recruitments_sections');
        
    }
}
