<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePermissionsAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permission_account', function (Blueprint $table) {
            $table->integer('account_id')->index()->unsigned();;
            $table->integer('permission_id')->index()->unsigned();;
            $table->timestamps();

            $table->primary(['account_id','permission_id']);      
            $table->foreign('account_id')->references('id')->on('accounts')->onDelete('cascade');
            $table->foreign('permission_id')->references('id')->on('permissions')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('permission_account');
    }
}
