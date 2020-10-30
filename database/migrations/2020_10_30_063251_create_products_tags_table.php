<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products_tags', function (Blueprint $table) {
            $table->increments('product_id');
            $table->unsignedInteger('tag_id');
            $table->index(["tag_id"], 'fk_product_has_tag_tag1_idx');
            $table->index(["product_id"], 'fk_product_has_tag_product1_idx');
            $table->foreign('product_id', 'product_has_tag_product1_idx')
                  ->nullable()
                  ->references('id')->on('products')
                  ->onDelete('no action')
                  ->onUpdate('no action');
            $table->foreign('tag_id', 'product_has_tag_tag1_idx')
                   ->nullable()
                   ->references('id')->on('tags')
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
        Schema::dropIfExists('products_tags');
    }
}
