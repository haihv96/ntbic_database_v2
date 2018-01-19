<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePatentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patents', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('base_technology_category_id')->unsigned();
            $table->foreign('base_technology_category_id')
                ->references('id')
                ->on('base_technology_categories')
                ->onDelete('cascade');
            $table->string('url', 500)->unique();
            $table->text('name');
            $table->string('path');
            $table->string('patent_code')->nullable();
            $table->string('public_date')->nullable();
            $table->string('provide_date')->nullable();
            $table->string('owner')->nullable();
            $table->string('author')->nullable();
            $table->text('highlights')->nullable();
            $table->mediumText('description')->nullable();
            $table->text('content_can_be_transferred')->nullable();
            $table->text('market_application')->nullable();
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
        Schema::dropIfExists('patents');
    }
}
