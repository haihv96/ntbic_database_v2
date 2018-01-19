<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('base_technology_category_id')->unsigned();
            $table->foreign('base_technology_category_id')
                ->references('id')
                ->on('base_technology_categories')
                ->onDelete('cascade');
            $table->string('url', 500)->unique();
            $table->text('name');
            $table->string('path');
            $table->text('highlights')->nullable();
            $table->text('description')->nullable();
            $table->text('transfer_description')->nullable();
            $table->text('results')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
