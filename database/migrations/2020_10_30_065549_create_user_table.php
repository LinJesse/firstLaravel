<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
class CreateUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 45);
            $table->string('phone', 45);
            $table->string('email', 45);
            $table->unsignedInteger('user_account_id');
            $table->dateTime('lastLogin');
            $table->timestamp('insert_time')->useCurrent();
            $table->timestamp('updated_time')->default(DB::raw('NULL ON UPDATE CURRENT_TIMESTAMP'))->nullable();
            $table->index(["user_account_id"], 'userAccountIndex');
            $table->foreign('user_account_id', 'userAccountIndex')
                  ->references('id')->on('users_account')
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
        Schema::dropIfExists('user');
    }
}
