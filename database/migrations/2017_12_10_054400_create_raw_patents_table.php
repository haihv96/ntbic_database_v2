<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRawPatentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('raw_patents', function (Blueprint $table) {
            $table->increments('id');
            $table->string('url', 500)->unique();
            $table->text('name');
            $table->string('patent_code');
            $table->text('technology_category');
            $table->string('public_date')->nullable();
            $table->string('provide_date')->nullable();
            $table->string('owner');
            $table->string('author');
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
        Schema::dropIfExists('raw_patents');
    }
}
