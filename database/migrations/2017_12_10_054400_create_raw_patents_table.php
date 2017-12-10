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
            $table->string('public_date');
            $table->string('provide_date');
            $table->string('owner');
            $table->string('author');
            $table->text('highlights');
            $table->mediumText('description');
            $table->text('content_can_be_transferred');
            $table->text('market_application');
            $table->string('image')->nullable();
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
