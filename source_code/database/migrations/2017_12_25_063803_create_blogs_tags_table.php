<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlogsTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tag_blog', function (Blueprint $table) {
            $table->integer('blog_id')->index()->unsigned();
            $table->integer('tag_id')->index()->unsigned();
            $table->timestamps();


            $table->primary(['blog_id','tag_id']);          
            $table->foreign('tag_id')->references('id')->on('tags')->onDelete('cascade');
            $table->foreign('blog_id')->references('id')->on('blogs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tag_blog');
    }
}
