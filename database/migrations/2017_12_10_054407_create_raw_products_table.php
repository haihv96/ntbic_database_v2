<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRawProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('raw_products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('url', 500)->unique();
            $table->text('thumb')->nullable();
            $table->text('name');
            $table->text('technology_category');
            $table->text('highlights');
            $table->text('description');
            $table->text('transfer_description');
            $table->text('results');
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
        Schema::dropIfExists('raw_products');
    }
}
