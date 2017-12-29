<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecruitmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recruitments', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title',255);
            $table->string('salary',255);
            $table->integer('number_of_view')->default(0);
            $table->date('expire_date');
            $table->tinyInteger('is_hot');
            $table->integer('status_id')->index()->unsigned();
            $table->integer('company_id')->index()->unsigned();
            $table->timestamps();

            $table->foreign('status_id')->references('id')->on('statuses');
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
        Schema::dropIfExists('recruitments');
    }
}
