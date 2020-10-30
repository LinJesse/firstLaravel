<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCreditcardTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('creditcard', function (Blueprint $table) {
            $table->increments('id');
            $table->string('number', 45);
            $table->date('expiredDate');
            $table->integer('CVC');
            $table->unsignedInteger('users_id');
            $table->index(["users_id"], 'creditcard_users1_idx');
            $table->foreign('users_id', 'creditcard_users1_idx')
                ->references('id')->on('users')
                ->onDelete('no action')
                ->onUpdate('no action');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('creditcard');
    }
}
