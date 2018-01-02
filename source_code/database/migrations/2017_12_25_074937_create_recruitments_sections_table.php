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
        Schema::create('section_recruitment', function (Blueprint $table) {
            $table->integer('recruitment_id')->index()->unsigned();
            $table->integer('section_id')->index()->unsigned();
            $table->text('content');
            $table->timestamps();


            $table->primary(['recruitment_id','section_id']);
            $table->foreign('recruitment_id')->references('id')->on('recruitments')->onDelete('cascade');
            $table->foreign('section_id')->references('id')->on('sections')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('section_recruitment');
        
    }
}
