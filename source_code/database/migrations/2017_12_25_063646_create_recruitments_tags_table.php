<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecruitmentsTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recruitments_tags', function (Blueprint $table) {
            $table->integer('recruitment_id')->index()->unsigned();
            $table->integer('tag_id')->index()->unsigned();
            $table->timestamps();

            $table->primary(['recruitment_id','tag_id']);
            $table->foreign('recruitment_id')->references('id')->on('recruitments');
            $table->foreign('tag_id')->references('id')->on('tags');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('recruitments_tags');
    }
}
